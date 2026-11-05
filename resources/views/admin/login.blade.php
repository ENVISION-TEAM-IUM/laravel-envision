<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin CMS - Desa Wisata Karangkemiri</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <div class="app-shell">
    <!-- Hero Header Hijau (01 • Login Admin) -->
    <header class="admin-login-hero">
      <div class="admin-login-hero-inner">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 36px;">
          <a href="{{ url('/') }}" class="brand-logo" style="color: #FFFFFF;">
            <div class="brand-mark">
              <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="Logo Desa Wisata Karangkemiri" class="brand-logo-img" style="background-color: #FFFFFF; border-radius: 50%; padding: 2px;">
            </div>
            <div class="brand-text" style="color: #FFFFFF; font-size: 16px;">
              Desa Wisata<br>Karangkemiri
            </div>
          </a>

          <a href="{{ url('/') }}" style="color: #DCECD7; font-size: 14px; font-weight: 700; text-decoration: none;">
            Kembali ke Website Publik
          </a>
        </div>

        <h1 style="font-size: 36px; font-weight: 800; line-height: 1.2;">Selamat datang, Admin!</h1>
        <p style="font-size: 16px; color: rgba(255, 255, 255, 0.9); margin-top: 8px;">
          Kelola informasi wisata dengan mudah.
        </p>
      </div>
    </header>

    <!-- Login Card (Web Centered Layout) -->
    <main class="admin-login-wrap">
      <div class="admin-login-card">
        <h2 style="font-size: 26px; font-weight: 800; color: var(--text-dark);">Masuk ke CMS</h2>
        <p style="font-size: 14px; color: var(--text-muted); margin-top: 4px; margin-bottom: 24px;">
          Gunakan akun admin yang diberikan pengelola.
        </p>

        <!-- Kotak Pesan Error Login (Checklist E06-A Poin 4 & 7) -->
        <div id="loginAlertBox" class="admin-login-alert" style="display: none;" role="alert">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
          </svg>
          <span id="loginAlertText"></span>
        </div>

        <form id="adminLoginForm" novalidate>
          <div class="admin-form-group">
            <label for="loginUsername">Nama pengguna</label>
            <input type="text" id="loginUsername" class="admin-input" placeholder="Masukkan nama pengguna" value="admin_bumdes" autocomplete="username" required>
          </div>

          <div class="admin-form-group">
            <label for="loginPassword">Kata sandi</label>
            <input type="password" id="loginPassword" class="admin-input" placeholder="Masukkan kata sandi" value="••••••••" autocomplete="current-password" required>
          </div>

          <button type="submit" id="loginSubmitBtn" class="btn-admin-primary" style="width: 100%; margin-top: 8px; padding: 15px;">
            Masuk ke Dashboard
          </button>

          <p style="font-size: 12.5px; color: var(--text-muted); margin-top: 16px;">
            Akun hanya untuk admin yang berwenang.
          </p>
        </form>
      </div>

      <div style="margin-top: 24px; padding-left: 8px;">
        <a href="{{ url('/kontak.html') }}" style="font-size: 14px; font-weight: 700; color: var(--green-dark); text-decoration: none;">
          Butuh bantuan? Hubungi koordinator website.
        </a>
      </div>
    </main>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const loginForm = document.getElementById('adminLoginForm');
      const usernameInput = document.getElementById('loginUsername');
      const passwordInput = document.getElementById('loginPassword');
      const submitBtn = document.getElementById('loginSubmitBtn');
      const alertBox = document.getElementById('loginAlertBox');
      const alertText = document.getElementById('loginAlertText');

      let failedAttempts = 0;
      const MAX_ATTEMPTS = 5;

      const showAlert = (message) => {
        alertText.textContent = message;
        alertBox.style.display = 'flex';
      };

      const hideAlert = () => {
        alertBox.style.display = 'none';
        alertText.textContent = '';
      };

      loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        hideAlert();

        const username = usernameInput.value.trim();
        const password = passwordInput.value;

        // 1. Validasi kolom wajib belum diisi (Checklist Poin 4)
        if (!username && !password) {
          showAlert('Nama pengguna dan kata sandi wajib diisi.');
          usernameInput.focus();
          return;
        }
        if (!username) {
          showAlert('Nama pengguna tidak boleh kosong.');
          usernameInput.focus();
          return;
        }
        if (!password) {
          showAlert('Kata sandi tidak boleh kosong.');
          passwordInput.focus();
          return;
        }

        // 2. Pembatasan percobaan login (Checklist Poin 7)
        if (failedAttempts >= MAX_ATTEMPTS) {
          showAlert('Terlalu banyak percobaan gagal. Mohon tunggu beberapa saat sebelum mencoba kembali.');
          return;
        }

        // 3. Kondisi "Sedang masuk..." dan pencegahan pengiriman berulang (Checklist Poin 6)
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.75';
        submitBtn.style.cursor = 'not-allowed';
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span>Sedang masuk...</span>';

        // 4. Simulasi proses autentikasi (Checklist Poin 7 & 8)
        setTimeout(() => {
          const isValidAdmin = (username === 'admin_bumdes' || username === 'admin');

          if (isValidAdmin) {
            // Login Berhasil -> Arahkan ke dashboard (Checklist Poin 8)
            window.location.href = "{{ url('/admin-dashboard.html?login=success') }}";
          } else {
            // Login Gagal -> Tampilkan pesan error dan form tetap bisa dicoba (Checklist Poin 7 & 8)
            failedAttempts++;
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
            submitBtn.innerHTML = originalText;

            if (failedAttempts >= MAX_ATTEMPTS) {
              showAlert('Terlalu banyak percobaan gagal. Akses sementara dibatasi demi keamanan.');
            } else {
              showAlert('Nama pengguna atau kata sandi salah. Silakan periksa kembali.');
            }
            passwordInput.value = '';
            passwordInput.focus();
          }
        }, 650);
      });
    });
  </script>
</body>
</html>
