
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login Admin CMS - Desa Wisata Karangkemiri</title>

  <link
    rel="shortcut icon"
    href="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}"
    type="image/png"
  >

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  <div class="app-shell">

    <!-- Hero Header -->
    <header class="admin-login-hero">
      <div class="admin-login-hero-inner">

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 36px;">

          <a
            href="{{ url('/') }}"
            class="brand-logo"
            style="color: #FFFFFF;"
          >
            <div class="brand-mark">
              <img
                src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}"
                alt="Logo Desa Wisata Karangkemiri"
                class="brand-logo-img"
                style="background-color: #FFFFFF; border-radius: 50%; padding: 2px;"
              >
            </div>

            <div
              class="brand-text"
              style="color: #FFFFFF; font-size: 16px;"
            >
              Desa Wisata<br>
              Karangkemiri
            </div>
          </a>

          <a
            href="{{ url('/') }}"
            style="color: #DCECD7; font-size: 14px; font-weight: 700; text-decoration: none;"
          >
            Kembali ke Website Publik
          </a>

        </div>

        <h1 style="font-size: 36px; font-weight: 800; line-height: 1.2;">
          Selamat datang, Admin!
        </h1>

        <p
          style="font-size: 16px; color: rgba(255, 255, 255, 0.9); margin-top: 8px;"
        >
          Kelola informasi wisata dengan mudah.
        </p>

      </div>
    </header>

    <!-- Login Card -->
    <main class="admin-login-wrap">
      <div class="admin-login-card">

        <h2
          style="font-size: 26px; font-weight: 800; color: var(--text-dark);"
        >
          Masuk ke CMS
        </h2>

        <p
          style="font-size: 14px; color: var(--text-muted); margin-top: 4px; margin-bottom: 24px;"
        >
          Gunakan akun admin yang diberikan pengelola.
        </p>

        <!-- Pesan error autentikasi dari Laravel -->
        @if ($errors->any())
          <div
            id="loginAlertBox"
            class="admin-login-alert"
            style="display: flex;"
            role="alert"
          >
            <svg
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2.2"
              stroke-linecap="round"
              stroke-linejoin="round"
              aria-hidden="true"
            >
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" y1="8" x2="12" y2="12"></line>
              <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>

            <span id="loginAlertText">
              {{ $errors->first('email') ?: $errors->first('password') ?: $errors->first() }}
            </span>
          </div>
        @endif

        <!-- Form Login Laravel -->
        <form
          id="adminLoginForm"
          action="{{ route('admin.login.submit') }}"
          method="POST"
        >
          @csrf

          <!-- Email Admin -->
          <div class="admin-form-group">
            <label for="loginUsername">
              Email admin
            </label>

            <input
              type="email"
              id="loginUsername"
              name="email"
              class="admin-input"
              placeholder="Masukkan email admin"
              value="{{ old('email') }}"
              autocomplete="username"
              required
              autofocus
            >
          </div>

          <!-- Password -->
          <div class="admin-form-group">
            <label for="loginPassword">
              Kata sandi
            </label>

            <input
              type="password"
              id="loginPassword"
              name="password"
              class="admin-input"
              placeholder="Masukkan kata sandi"
              autocomplete="current-password"
              required
            >
          </div>

          <!-- Tombol Login -->
          <button
            type="submit"
            id="loginSubmitBtn"
            class="btn-admin-primary"
            style="width: 100%; margin-top: 8px; padding: 15px;"
          >
            Masuk ke Dashboard
          </button>

          <p
            style="font-size: 12.5px; color: var(--text-muted); margin-top: 16px;"
          >
            Akun hanya untuk admin yang berwenang.
          </p>
        </form>

      </div>

      <!-- Bantuan -->
      <div style="margin-top: 24px; padding-left: 8px;">
        <a
          href="{{ url('/kontak.html') }}"
          style="font-size: 14px; font-weight: 700; color: var(--green-dark); text-decoration: none;"
        >
          Butuh bantuan? Hubungi koordinator website.
        </a>
      </div>
    </main>

  </div>
</body>
</html>
