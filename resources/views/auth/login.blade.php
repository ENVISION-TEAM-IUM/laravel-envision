<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-Content-Type-Options" content="nosniff">
  <meta name="referrer" content="strict-origin-when-cross-origin">
  <style id="antiClickjack">body { display: none !important; }</style>
  <script>
    /* Proteksi Anti-Clickjacking Frontend */
    if (self === top) {
      var antiClickjack = document.getElementById('antiClickjack');
      if (antiClickjack) antiClickjack.parentNode.removeChild(antiClickjack);
    } else {
      top.location = self.location;
    }
  </script>
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
          <a href="{{ route('home') }}" class="brand-logo" style="color: #FFFFFF;">
            <div class="brand-mark">
              <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="Logo Desa Wisata Karangkemiri" class="brand-logo-img" style="background-color: #FFFFFF; border-radius: 50%; padding: 2px;">
            </div>
            <div class="brand-text" style="color: #FFFFFF; font-size: 16px;">
              Desa Wisata<br>Karangkemiri
            </div>
          </a>

          <a href="{{ route('home') }}" style="color: #DCECD7; font-size: 14px; font-weight: 700; text-decoration: none;">
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

        @if ($errors->any())
          <div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 12px 14px; border-radius: 8px; margin-bottom: 18px; font-size: 13.5px;">
            {{ $errors->first('email') ?: 'Periksa kembali email dan kata sandi Anda.' }}
          </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
          @csrf

          <div class="admin-form-group">
            <label for="loginEmail">Email admin</label>
            <input 
              type="email" 
              id="loginEmail" 
              name="email" 
              class="admin-input" 
              placeholder="admin@bumdes.id" 
              value="{{ old('email', 'admin@bumdes.id') }}" 
              required 
              autofocus
            >
          </div>

          <div class="admin-form-group">
            <label for="loginPassword">Kata sandi</label>
            <input 
              type="password" 
              id="loginPassword" 
              name="password" 
              class="admin-input" 
              placeholder="Masukkan kata sandi" 
              required
            >
          </div>

          <button type="submit" class="btn-admin-primary" style="width: 100%; margin-top: 8px; padding: 15px;">
            Masuk ke Dashboard
          </button>

          <p style="font-size: 12.5px; color: var(--text-muted); margin-top: 16px;">
            Akun hanya untuk admin yang berwenang.
          </p>
        </form>
      </div>

      <div style="margin-top: 24px; padding-left: 8px;">
        <a href="{{ route('home') }}" style="font-size: 14px; font-weight: 700; color: var(--green-dark); text-decoration: none;">
          Butuh bantuan? Hubungi koordinator website.
        </a>
      </div>
    </main>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

