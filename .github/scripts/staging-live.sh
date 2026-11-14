#!/usr/bin/env bash
# PHP snippets intentionally use single quotes to protect PHP variables.
# shellcheck disable=SC2016
set -Eeuo pipefail
umask 077

PHASE=${1:?phase required}
SHA=${2:?commit required}
RUN_ID=${3:?run required}
ATTEMPT=${4:?attempt required}
[[ "$PHASE" = prepare || "$PHASE" = activate ]]
[[ "$SHA" =~ ^[0-9a-f]{40}$ && "$RUN_ID" =~ ^[0-9]+$ && "$ATTEMPT" =~ ^[0-9]+$ ]]
APP=/home/desawi41/ium-staging/laravel-envision
BACKUP_ROOT=/home/desawi41/ium-backups
BACKUP="$BACKUP_ROOT/live-${RUN_ID}-${ATTEMPT}"
INCOMING="/home/desawi41/ium-staging/.ium-vite-incoming-${RUN_ID}-${ATTEMPT}"
REVIEWED=65f1fd7e7337070f4763297355e924ac23671d40
MIGRATIONS=(
  database/migrations/2026_11_09_000001_add_username_to_admins_table.php
  database/migrations/2026_11_09_000002_create_destinasi_table.php
  database/migrations/2026_11_09_000003_create_paket_wisata_table.php
  database/migrations/2026_11_09_000004_create_umkm_table.php
  database/migrations/2026_11_09_000005_create_produk_umkm_table.php
)
fail() { echo "ERROR: $*" >&2; exit 1; }
physical_path() {
  test ! -L "$1"
  test "$(realpath -e "$1")" = "$1"
}
physical_path "$APP"
physical_path "$BACKUP_ROOT"
cd "$APP"
for item in .git .env database database/database.sqlite vendor bootstrap/cache storage public public/build; do
  physical_path "$APP/$item"
done
test "$(stat -c %h .env)" = 1
test "$(stat -c %h database/database.sqlite)" = 1
# Do not follow runtime symlinks into another application during cache/asset operations.
test -z "$(find storage bootstrap/cache public/build -type l -print -quit)"
test -z "$(find storage bootstrap/cache public/build -type f -links +1 -print -quit)"
if test -e public/storage || test -L public/storage; then
  test "$(realpath -e public/storage)" = "$APP/storage/app/public"
fi
test -s public/build/manifest.json
test -s vendor/autoload.php
test "$(git branch --show-current)" = main
test -z "$(git status --porcelain --untracked-files=no)"
test ! -e storage/framework/down
test ! -e storage/framework/maintenance.php
# One server-side activation at a time; GitHub concurrency also covers prepare/upload.
test ! -L /home/desawi41/ium-staging/.ium-deploy.lock
exec 9>/home/desawi41/ium-staging/.ium-deploy.lock
flock -n 9 || fail 'Another staging deployment is running'
GIT_TERMINAL_PROMPT=0 timeout 60 git fetch origin main
test "$(git rev-parse origin/main)" = "$SHA"
git merge-base --is-ancestor HEAD "$SHA"
OLD_SHA=$(git rev-parse HEAD)
git diff --quiet "$OLD_SHA" "$SHA" -- composer.json composer.lock || fail 'Composer changes blocked'
git diff --quiet "$OLD_SHA" "$SHA" -- .env vendor storage bootstrap/cache database/database.sqlite public/build || fail 'Runtime file changes blocked'
CHANGED=$(git diff --no-renames --name-status "$OLD_SHA" "$SHA" -- database/migrations)
EXPECTED=$(printf 'A\t%s\n' "${MIGRATIONS[@]}")
if test -n "$CHANGED"; then
  test "$CHANGED" = "$EXPECTED" || fail 'Unreviewed migration changes'
  for file in "${MIGRATIONS[@]}"; do
    test "$(git rev-parse "$SHA:$file")" = "$(git rev-parse "$REVIEWED:$file")" || fail 'Migration content differs from review'
  done
fi
# Git may overwrite ignored files. Reject collisions, symlink parents, and hardlinks first.

git diff --no-renames --name-only -z "$OLD_SHA" "$SHA" |
while IFS= read -r -d '' file; do
  path="$APP/$file"

  while test "$path" != "$APP"; do
    test ! -L "$path" || fail "Symlink in changed path: $file"

    if test -f "$path"; then
      test "$(stat -c %h "$path")" = 1
    fi

    path=$(dirname "$path")
  done

  if ! git cat-file -e "$OLD_SHA:$file" 2>/dev/null; then
    test ! -e "$file" || fail "Untracked/ignored file collision: $file"
  fi
done

if git ls-tree -r "$SHA" | grep '^120000 '; then
  fail 'Tracked symlinks require separate review'
fi


verify_database() {
  php -r 'require "vendor/autoload.php";$app=require "bootstrap/app.php";$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();$expected=getcwd()."/database/database.sqlite";if(config("database.default")!=="sqlite"||realpath((string)config("database.connections.sqlite.database"))!==$expected||config("app.maintenance.driver")!=="file"||$app->storagePath()!==getcwd()."/storage"){fwrite(STDERR,"Unsafe database, storage, or maintenance configuration\n");exit(1);}$db=\Illuminate\Support\Facades\DB::connection()->getPdo();if($db->query("PRAGMA integrity_check")->fetchColumn()!=="ok"){exit(1);}echo "Staging database target and integrity verified\n";'
}

backup_database() {
  php -r 'SQLite3::enableExceptions(true);$source=new SQLite3($argv[1],SQLITE3_OPEN_READONLY);$target=new SQLite3($argv[2],SQLITE3_OPEN_READWRITE|SQLITE3_OPEN_CREATE);$source->busyTimeout(10000);$target->busyTimeout(10000);if(!$source->backup($target)||$target->querySingle("PRAGMA integrity_check")!=="ok"){exit(1);}$target->close();$source->close();' "$APP/database/database.sqlite" "$1"
}

verify_database
if test "$PHASE" = prepare; then
  test ! -e "$BACKUP" && test ! -L "$BACKUP"
  test ! -e "$INCOMING" && test ! -L "$INCOMING"
  mkdir -m 700 "$INCOMING"
  printf '%s\n' "$OLD_SHA" > "$INCOMING/previous-commit"
  echo 'Staging prepare passed; website unchanged'
  exit 0
fi
physical_path "$INCOMING"
test "$(cat "$INCOMING/previous-commit")" = "$OLD_SHA"
test -z "$(find "$INCOMING" -type l -print -quit)"
test -s "$INCOMING/build/manifest.json"
(cd "$INCOMING/build" && sha256sum --check SHA256SUMS)
mkdir -m 700 "$BACKUP"
printf '%s\n' "$OLD_SHA" > "$BACKUP/previous-commit"
printf '%s\n' "$SHA" > "$BACKUP/target-commit"
STATE=before-maintenance
on_exit() {
  code=$?
  trap - EXIT INT TERM HUP
  if test "$code" -ne 0; then
    printf '%s\n' "$STATE" > "$BACKUP/failure-phase"
    echo "Deployment stopped in phase: $STATE. Backup: $BACKUP" >&2
    echo 'No automatic database restore or hard reset. Keep staging closed for supervised recovery.' >&2
  fi
  exit "$code"
}
trap on_exit EXIT
trap 'exit 130' INT
trap 'exit 143' TERM HUP
STATE=entering-maintenance
php artisan down --retry=60 --render=errors::503
test -s storage/framework/down
test -s storage/framework/maintenance.php
STATE=backup
# Back up after closing HTTP access. Preserve the live DB on every failure;
# maintenance does not guarantee that in-flight requests or forced workers stopped.
backup_database "$BACKUP/database.sqlite"
cp -p .env "$BACKUP/.env"
cp -a public/build "$BACKUP/old-public-build"
tar -czf "$BACKUP/source.tar.gz" \
  --exclude='laravel-envision/.git' \
  --exclude='laravel-envision/vendor' \
  --exclude='laravel-envision/node_modules' \
  --exclude='laravel-envision/database/database.sqlite*' \
  -C /home/desawi41/ium-staging laravel-envision
tar -tzf "$BACKUP/source.tar.gz" >/dev/null
(cd "$BACKUP" && sha256sum .env database.sqlite source.tar.gz > SHA256SUMS && sha256sum -c SHA256SUMS)
STATE=source-activation
git merge --ff-only "$SHA"
mv public/build "$BACKUP/build-before-activation"
mv "$INCOMING/build" public/build
php artisan config:clear
verify_database
STATE=migration
if test -n "$CHANGED"; then
  args=()
  for file in "${MIGRATIONS[@]}"; do args+=(--path="$file"); done
  php artisan migrate --force --no-interaction "${args[@]}"
fi
php artisan migrate:status --no-ansi > "$BACKUP/migrations-after.txt"
if grep -q Pending "$BACKUP/migrations-after.txt"; then fail 'Pending migrations remain'; fi
STATE=verification
verify_database
php artisan route:clear
php artisan view:clear
php artisan route:list --json > "$BACKUP/routes-after.json"
php -r '
  $routes = json_decode(file_get_contents($argv[1]), true, 512, JSON_THROW_ON_ERROR);
  $count = 0;
  foreach ($routes as $route) {
    $uri = $route["uri"] ?? "";
    if (!str_starts_with($uri, "admin") || in_array($uri, ["admin/login", "admin-login", "admin-login.html"], true)) { continue; }
    if (!in_array("auth:admin", (array) ($route["middleware"] ?? []), true)) { fwrite(STDERR, "Unprotected admin route\n"); exit(1); }
    $count++;
  }
  if ($count === 0) { exit(1); }
' "$BACKUP/routes-after.json"
test "$(git rev-parse HEAD)" = "$SHA"
test -z "$(git status --porcelain --untracked-files=no)"
(cd public/build && sha256sum --check SHA256SUMS)
printf '%s\n' 'verified-before-reopen' > "$BACKUP/deployment-state"
STATE=reopening
php artisan up
test ! -e storage/framework/down
test ! -e storage/framework/maintenance.php
STATE=complete
printf '%s\n' "$STATE" > "$BACKUP/deployment-state"
echo "STAGING DEPLOYMENT SUCCESS: $SHA"
echo "Verified backup: $BACKUP"
