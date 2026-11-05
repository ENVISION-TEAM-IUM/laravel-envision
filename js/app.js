/* =========================================================
   SECURITY UTILITIES (XSS SANITIZATION, SAFE URL, SAFE JSON)
   ========================================================= */
function escapeHtml(str) {
  if (str === null || str === undefined) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function sanitizeUrl(url) {
  if (!url) return '#';
  const str = String(url).trim();
  if (/^(?:https?:\/\/|mailto:|tel:|https:\/\/wa\.me\/|\/)/i.test(str)) {
    return str;
  }
  return '#';
}

function safeJsonParse(jsonString, fallback) {
  if (!jsonString) return fallback;
  try {
    const parsed = JSON.parse(jsonString);
    return parsed !== null && parsed !== undefined ? parsed : fallback;
  } catch (e) {
    console.warn('Proteksi Data: Format JSON storage tidak valid.', e);
    return fallback;
  }
}

// Data Destinasi Terverifikasi (Sesuai Poin 1, 2, 3, & M03/M06/M07 PDF + web DESWIT KRKEMIRI)
const DESTINATIONS_DATA = {
  candi: {
    slug: 'candi',
    heroCaption: 'Wahana Edukasi & Outbound Candi',
    heroImage: '/assets/images/candi.png',
    eyebrow: 'DESTINASI • EDUKASI & OUTBOUND',
    title: 'Wahana Edukasi & Outbound Candi',
    badge: 'Edukasi & Outbound',
    location: 'Dusun Karang Jengkol, Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas',
    description:
      'Destinasi utama untuk kegiatan sekolah, instansi, dan keluarga dengan wahana permainan outbound, latihan ketangkasan, serta edukasi kelompok di area terbuka yang asri.',
    hours: 'Senin – Minggu, 08:00 – 17:00 WIB (Konfirmasi Rombongan)',
    priceInfo: 'Mulai Rp 75.000 – Rp 100.000 / Orang (Hubungi BUMDesa Mandiri Sejahtera)',
    facilities: ['Area Outbound Luas', 'Pendopo / Aula Kumpul', 'Toilet & Kamar Bilas', 'Mushola', 'Area Parkir Rombongan'],
    mapsUrl: 'https://www.google.com/maps/search/?api=1&query=Wahana+Edukasi+%26+Outbound+Candi+Karangkemiri+Karanglewas+Banyumas',
    mapsEmbed: 'https://maps.google.com/maps?q=Wahana+Edukasi+%26+Outbound+Candi,+Karangkemiri,+Karanglewas,+Banyumas&t=&z=17&ie=UTF8&iwloc=B&output=embed',
    activityTitle: 'Kegiatan edukasi & outbound',
    activities: ['Permainan outbound & ketangkasan kelompok', 'Kegiatan edukasi sekolah, pramuka & famili'],
    gallery: ['/assets/images/outbound.jpeg', '/assets/images/flying-fox-2.jpeg', '/assets/images/ketapel-panahan.jpeg'],
    waText: 'Halo BUMDesa Mandiri Sejahtera Karangkemiri, saya ingin menanyakan informasi kunjungan/reservasi untuk destinasi *Wahana Edukasi & Outbound Candi*.'
  },
  embung: {
    slug: 'embung',
    heroCaption: 'Embung Prabawulan',
    heroImage: '/assets/images/camping-ground.jpeg',
    eyebrow: 'DESTINASI • WISATA ALAM',
    title: 'Embung Prabawulan',
    badge: 'Wisata Alam',
    location: 'Turanggal, Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas',
    description:
      'Kawasan wisata alam berupa embung (danau buatan) di tengah suasana pedesaan yang sejuk untuk rekreasi keluarga, bersantai sore, memancing, dan mengenal budidaya ikan air tawar.',
    hours: 'Senin – Minggu, 08:00 – 17:00 WIB',
    priceInfo: 'Tiket Masuk: Konfirmasi Pengelola BUMDesa Mandiri Sejahtera',
    facilities: ['Gazebo Santai', 'Spot Memancing', 'Area Parkir', 'Toilet', 'Warung Kuliner Lokal'],
    mapsUrl: 'https://www.google.com/maps/search/?api=1&query=Embung+Prabawulan+Karangkemiri+Karanglewas+Banyumas',
    mapsEmbed: 'https://maps.google.com/maps?q=Embung+Prabawulan,+Karangkemiri,+Karanglewas,+Banyumas&t=&z=17&ie=UTF8&iwloc=B&output=embed',
    activityTitle: 'Nikmati suasana alam',
    activities: ['Rekreasi tepi embung & pemandangan alam', 'Memancing & edukasi budidaya ikan'],
    gallery: ['/assets/images/camping-ground.jpeg', '/assets/images/desa-wisata-karangkemiri-2.jpeg', '/assets/images/candi.png'],
    waText: 'Halo BUMDesa Mandiri Sejahtera Karangkemiri, saya ingin menanyakan informasi kunjungan ke destinasi *Embung Prabawulan*.'
  },
  kelengkeng: {
    slug: 'kelengkeng',
    heroCaption: 'Agrowisata Kelengkeng Thabet',
    heroImage: '/assets/images/whatsapp-image-2025-12-30-at-16.55.33.jpeg',
    eyebrow: 'DESTINASI • AGROWISATA',
    title: 'Agro Kelengkeng Thabet',
    badge: 'Agrowisata',
    location: 'Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas',
    description:
      'Pengalaman agrowisata menyusuri kebun kelengkeng lokal, belajar perawatan tanaman buah bersama pengelola, serta menikmati wisata petik buah saat musim panen tiba.',
    hours: 'Senin – Minggu, 08:00 – 16:30 WIB (Musim Panen dikonfirmasi)',
    priceInfo: 'Kunjungan & Petik Buah: Hubungi Pengelola',
    facilities: ['Kebun Edukasi Kelengkeng', 'Gazebo Kebun', 'Area Parkir', 'Toilet'],
    mapsUrl: 'https://www.google.com/maps/search/?api=1&query=Agro+Kelengkeng+Thabet+Karangkemiri+Karanglewas+Banyumas',
    mapsEmbed: 'https://maps.google.com/maps?q=Agro+Kelengkeng+Thabet,+Karangkemiri,+Karanglewas,+Banyumas&t=&z=17&ie=UTF8&iwloc=B&output=embed',
    activityTitle: 'Aktivitas agrowisata',
    activities: ['Edukasi pembibitan & budidaya kelengkeng', 'Wisata petik buah kelengkeng musiman'],
    gallery: ['/assets/images/whatsapp-image-2025-12-30-at-16.55.33.jpeg', '/assets/images/paket-edukasi-1.jpeg', '/assets/images/desa-wisata-karangkemiri-2.jpeg'],
    waText: 'Halo BUMDesa Mandiri Sejahtera Karangkemiri, saya ingin menanyakan jadwal kunjungan dan ketersediaan panen di *Agro Kelengkeng Thabet*.'
  },
  petilasan: {
    slug: 'petilasan',
    heroCaption: 'Warisan Budaya Lokal',
    heroImage: '/assets/images/sadranan.jpeg',
    eyebrow: 'DESTINASI • SEJARAH & BUDAYA',
    title: 'Petilasan Mbah Siti Benter',
    badge: 'Wisata Budaya',
    location: 'Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas',
    description:
      'Situs sejarah dan budaya lokal yang berkaitan erat dengan cerita tutur serta tradisi leluhur masyarakat Desa Karangkemiri. Pengunjung diimbau menjaga ketertiban dan tata krama lokal.',
    hours: 'Setiap Hari, 08:00 – 17:00 WIB (Dengan Konfirmasi Juru Kunci/Pengelola)',
    priceInfo: 'Tidak dipungut tiket tetap (Konfirmasi Pengelola)',
    facilities: ['Pendopo Singgah', 'Tempat Wudhu & Mushola', 'Area Parkir'],
    mapsUrl: 'https://www.google.com/maps/search/?api=1&query=Petilasan+Mbah+Siti+Benter+Karangkemiri+Karanglewas+Banyumas',
    mapsEmbed: 'https://maps.google.com/maps?q=Petilasan+Mbah+Siti+Benter,+Karangkemiri,+Karanglewas,+Banyumas&t=&z=17&ie=UTF8&iwloc=B&output=embed',
    activityTitle: 'Hormati nilai sejarah & budaya',
    activities: ['Mengenal sejarah & cerita lokal Karangkemiri', 'Wisata budaya & ziarah tertib'],
    gallery: ['/assets/images/sadranan.jpeg', '/assets/images/desa-wisata-karangkemiri-2.jpeg', '/assets/images/candi.png'],
    waText: 'Halo BUMDesa Mandiri Sejahtera Karangkemiri, saya ingin menanyakan informasi dan ketentuan kunjungan ke *Petilasan Mbah Siti Benter*.'
  }
};

document.addEventListener('DOMContentLoaded', () => {
  initGlobalTheme();
  initSmartNavbarScroll();
  initNavigationDrawer();
  initCategoryFilters();
  initDestinationDetail();
  initFeedbackModal();
  initPublicProfile();
  initProfileCMS();
  initAdminPackages();
  initPublicPackages();
  initAdminContact();
  initPublicContact();
  initAdminUMKM();
  initPublicUMKM();
  initDigitalTracker();
  initDashboardAnalytics();
  initAdminCMS();
  enhanceSelectDropdowns();
});

/* 0a. Global Dark Mode Theme Management (Mode Malam Keseluruhan Situs) */
function initGlobalTheme() {
  const themeSwitch = document.getElementById('sidebarThemeSwitch');
  const drawer = document.getElementById('navDrawer');
  const savedTheme = localStorage.getItem('site_theme');

  const applyTheme = (isDark) => {
    if (isDark) {
      document.body.classList.add('dark-mode');
      document.documentElement.classList.add('dark-mode');
      if (drawer) drawer.classList.add('dark-sidebar');
      if (themeSwitch) themeSwitch.classList.add('active');
    } else {
      document.body.classList.remove('dark-mode');
      document.documentElement.classList.remove('dark-mode');
      if (drawer) drawer.classList.remove('dark-sidebar');
      if (themeSwitch) themeSwitch.classList.remove('active');
    }
  };

  // Terapkan preferensi yang tersimpan
  if (savedTheme === 'dark') {
    applyTheme(true);
  } else {
    applyTheme(false);
  }

  if (themeSwitch) {
    themeSwitch.addEventListener('click', (e) => {
      e.stopPropagation();
      const willBeDark = !document.body.classList.contains('dark-mode');
      applyTheme(willBeDark);
      try {
        localStorage.setItem('site_theme', willBeDark ? 'dark' : 'light');
      } catch (err) {
        // Ignore quota error
      }
    });
  }
}

/* 0. Smart Sticky Navbar (Hilang saat scroll ke bawah, muncul lagi saat scroll ke atas) */
function initSmartNavbarScroll() {
  const navbar = document.querySelector('.top-navbar');
  if (!navbar) return;

  let lastScrollY = window.scrollY || 0;
  let ticking = false;
  const deltaThreshold = 6;
  const hideOffset = 80;

  const updateNavbar = () => {
    const currentScrollY = Math.max(0, window.scrollY || 0);
    const diff = currentScrollY - lastScrollY;
    const drawer = document.getElementById('navDrawer');
    const isDrawerOpen = drawer && drawer.classList.contains('open');

    // Beri bayangan halus ketika sudah di-scroll dari posisi paling atas
    if (currentScrollY > 12) {
      navbar.classList.add('navbar-scrolled');
    } else {
      navbar.classList.remove('navbar-scrolled');
    }

    // Selalu tampilkan navbar jika berada di dekat atas halaman atau menu drawer sedang terbuka
    if (currentScrollY <= hideOffset || isDrawerOpen) {
      navbar.classList.remove('navbar-hidden');
      lastScrollY = currentScrollY;
      ticking = false;
      return;
    }

    // Jika perubahan scroll cukup signifikan (> deltaThreshold)
    if (Math.abs(diff) >= deltaThreshold) {
      if (diff > 0) {
        // Scroll ke bawah -> sembunyikan navbar
        navbar.classList.add('navbar-hidden');
      } else {
        // Scroll ke atas -> tampilkan kembali navbar
        navbar.classList.remove('navbar-hidden');
      }
      lastScrollY = currentScrollY;
    }

    ticking = false;
  };

  window.addEventListener(
    'scroll',
    () => {
      if (!ticking) {
        window.requestAnimationFrame(updateNavbar);
        ticking = true;
      }
    },
    { passive: true }
  );
}

/* 1. Left Sidebar Drawer Navigation (Expand/Collapse, Theme Switch & Profile Popup) */
function initNavigationDrawer() {
  const menuBtn = document.getElementById('menuBtn');
  const drawer = document.getElementById('navDrawer');
  const backdrop = document.getElementById('drawerBackdrop');
  const closeBtn = document.getElementById('drawerClose');
  const collapseBtn = document.getElementById('sidebarCollapseBtn');
  const themeSwitch = document.getElementById('sidebarThemeSwitch');
  const profileTrigger = document.getElementById('sidebarProfileTrigger');
  const profilePopup = document.getElementById('sidebarProfilePopup');

  if (!menuBtn || !drawer || !backdrop) return;

  const openDrawer = () => {
    drawer.classList.add('open');
    backdrop.classList.add('open');
  };

  const closeDrawer = () => {
    drawer.classList.remove('open');
    backdrop.classList.remove('open');
    if (profilePopup) profilePopup.classList.remove('open');
  };

  menuBtn.addEventListener('click', () => {
    if (drawer.classList.contains('open')) {
      closeDrawer();
    } else {
      openDrawer();
    }
  });

  if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
  backdrop.addEventListener('click', closeDrawer);

  // Tombol Collapse (<) untuk mengubah ukuran sidebar antara penuh (280px) & mini icon bar (78px)
  if (collapseBtn) {
    collapseBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      drawer.classList.toggle('collapsed');
    });
  }

  // Klik kartu profil bawah untuk membuka/menutup popup menu profil di samping kanan
  if (profileTrigger && profilePopup) {
    profileTrigger.addEventListener('click', (e) => {
      if (e.target.closest('.profile-popup-links')) return;
      e.stopPropagation();
      profilePopup.classList.toggle('open');
    });

    document.addEventListener('click', (e) => {
      if (!profileTrigger.contains(e.target)) {
        profilePopup.classList.remove('open');
      }
    });
  }
}

/* 2. Interactive Category Filters (Destinasi & UMKM) */
function initCategoryFilters() {
  const pillButtons = document.querySelectorAll('[data-filter-btn]');
  const filterItems = document.querySelectorAll('[data-category]');

  if (!pillButtons.length || !filterItems.length) return;

  const applyFilter = (category) => {
    pillButtons.forEach((btn) => {
      btn.classList.toggle('active', btn.getAttribute('data-filter-btn') === category);
    });

    filterItems.forEach((item) => {
      const itemCats = item.getAttribute('data-category').split(',');
      if (category === 'semua' || itemCats.includes(category)) {
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
    });
  };

  pillButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      applyFilter(btn.getAttribute('data-filter-btn'));
    });
  });

  const params = new URLSearchParams(window.location.search);
  const urlCat = params.get('kategori');
  if (urlCat) {
    applyFilter(urlCat.toLowerCase());
  }
}

/* 3. Dynamic Detail Destinasi Renderer (04, 08, 09, 10) */
function initDestinationDetail() {
  const detailContainer = document.getElementById('detailDestinasiPage');
  if (!detailContainer) return;

  const renderSlug = (slug) => {
    const data = DESTINATIONS_DATA[slug] || DESTINATIONS_DATA.candi;

    const heroCardEl = document.getElementById('destHeroCard');
    const captionEl = document.getElementById('destHeroCaption');
    const eyebrowEl = document.getElementById('destEyebrow');
    const titleEl = document.getElementById('destTitle');
    const badgeEl = document.getElementById('destBadge');
    const locationEl = document.getElementById('destLocation');
    const descEl = document.getElementById('destDesc');
    const hoursEl = document.getElementById('destHours');
    const priceEl = document.getElementById('destPrice');
    const facilitiesEl = document.getElementById('destFacilities');
    const mapsBtnEl = document.getElementById('destMapsBtn');
    const mapsIframeEl = document.getElementById('destMapsIframe');
    const actTitleEl = document.getElementById('destActivityTitle');
    const act1El = document.getElementById('destAct1');
    const act2El = document.getElementById('destAct2');
    const gal1El = document.getElementById('destGallery1');
    const gal2El = document.getElementById('destGallery2');
    const gal3El = document.getElementById('destGallery3');
    const waBtnEl = document.getElementById('destWaBtn');
    const feedbackDestInput = document.getElementById('feedbackDestName');

    if (heroCardEl && data.heroImage) {
      heroCardEl.style.backgroundImage = `linear-gradient(180deg, rgba(16, 40, 26, 0.25) 0%, rgba(16, 40, 26, 0.72) 100%), url('${data.heroImage}')`;
    }
    if (captionEl) captionEl.textContent = data.heroCaption;
    if (eyebrowEl) eyebrowEl.textContent = data.eyebrow;
    if (titleEl) titleEl.textContent = data.title;
    if (badgeEl) badgeEl.textContent = data.badge;
    if (locationEl) locationEl.textContent = data.location;
    if (descEl) descEl.textContent = data.description;
    if (hoursEl) hoursEl.textContent = data.hours;
    if (priceEl) priceEl.textContent = data.priceInfo;
    if (facilitiesEl) {
      facilitiesEl.innerHTML = data.facilities
        .map((fac) => `<span class="facility-chip">✓ ${fac}</span>`)
        .join('');
    }
    if (mapsBtnEl) mapsBtnEl.href = data.mapsUrl;
    if (mapsIframeEl) {
      mapsIframeEl.title = `Peta Lokasi ${data.title}`;
      if (mapsIframeEl.getAttribute('src') !== data.mapsEmbed) {
        mapsIframeEl.setAttribute('src', data.mapsEmbed);
      }
    }
    if (actTitleEl) actTitleEl.textContent = data.activityTitle;
    if (act1El) act1El.textContent = data.activities[0];
    if (act2El) act2El.textContent = data.activities[1];
    if (data.gallery && data.gallery.length >= 3) {
      if (gal1El) gal1El.style.backgroundImage = `url('${data.gallery[0]}')`;
      if (gal2El) gal2El.style.backgroundImage = `url('${data.gallery[1]}')`;
      if (gal3El) gal3El.style.backgroundImage = `url('${data.gallery[2]}')`;
    }
    if (waBtnEl) {
      waBtnEl.href = `https://wa.me/6285702573013?text=${encodeURIComponent(data.waText)}`;
    }
    if (feedbackDestInput) {
      feedbackDestInput.value = data.title;
    }

    document.querySelectorAll('[data-dest-switch]').forEach((chip) => {
      chip.classList.toggle('active', chip.getAttribute('data-dest-switch') === data.slug);
    });

    document.title = `${data.title} - Desa Wisata Karangkemiri`;
  };

  const params = new URLSearchParams(window.location.search);
  const initialSlug = (params.get('slug') || 'candi').toLowerCase();
  renderSlug(initialSlug);

  document.querySelectorAll('[data-dest-switch]').forEach((chip) => {
    chip.addEventListener('click', (e) => {
      e.preventDefault();
      const slug = chip.getAttribute('data-dest-switch');
      renderSlug(slug);
      const url = new URL(window.location);
      url.searchParams.set('slug', slug);
      window.history.replaceState({}, '', url);
    });
  });
}

/* 4. S02 Voluntary Feedback Modal (Privat untuk Admin BUMDes, Tanpa Review Publik) */
function initFeedbackModal() {
  const openBtn = document.getElementById('openFeedbackBtn');
  const modal = document.getElementById('feedbackModalOverlay');
  const closeBtn = document.getElementById('closeFeedbackBtn');
  const feedbackForm = document.getElementById('s02FeedbackForm');

  if (!openBtn || !modal) return;

  const RATING_TEXTS = {
    5: '5 - Sangat Baik',
    4: '4 - Baik',
    3: '3 - Cukup',
    2: '2 - Kurang',
    1: '1 - Buruk',
    0: ''
  };

  // Helper function to set star ratings
  function setRating(groupName, value) {
    const hiddenInput = document.getElementById(groupName);
    const textEl = document.getElementById(groupName + 'Text');
    const container = document.querySelector(`[data-rating-group="${groupName}"]`);
    if (hiddenInput) hiddenInput.value = value;
    if (textEl) textEl.textContent = RATING_TEXTS[value] || '';
    if (container) {
      const stars = container.querySelectorAll('.star-btn');
      stars.forEach((btn) => {
        const val = parseInt(btn.getAttribute('data-val'), 10);
        btn.classList.toggle('active', val <= value && value > 0);
      });
    }
  }

  // Setup interactive star click and hover listeners
  document.querySelectorAll('[data-rating-group]').forEach((group) => {
    const groupName = group.getAttribute('data-rating-group');
    const stars = group.querySelectorAll('.star-btn');
    stars.forEach((btn) => {
      btn.addEventListener('click', () => {
        const val = parseInt(btn.getAttribute('data-val'), 10);
        setRating(groupName, val);
      });
    });
  });

  // Character counter for textarea
  const commentInput = document.getElementById('feedbackComment');
  const counterEl = document.getElementById('feedbackCommentCounter');
  if (commentInput && counterEl) {
    commentInput.addEventListener('input', () => {
      counterEl.textContent = `${commentInput.value.length}/500`;
    });
  }

  function openModal() {
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.classList.remove('open');
    document.body.style.overflow = '';
  }

  openBtn.addEventListener('click', openModal);

  if (closeBtn) {
    closeBtn.addEventListener('click', closeModal);
  }

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      closeModal();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('open')) {
      closeModal();
    }
  });

  if (feedbackForm) {
    feedbackForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const f1 = document.getElementById('rateFasilitas')?.value || '0';
      const f2 = document.getElementById('rateKebersihan')?.value || '0';
      const f3 = document.getElementById('ratePelayanan')?.value || '0';

      if (f1 === '0' && f2 === '0' && f3 === '0') {
        showCustomPopup('Perhatian', 'Mohon beri penilaian minimal pada satu aspek (Fasilitas, Kebersihan, atau Pelayanan).', 'Mengerti');
        return;
      }

      feedbackForm.reset();
      setRating('rateFasilitas', 5);
      setRating('rateKebersihan', 5);
      setRating('ratePelayanan', 5);
      if (counterEl) counterEl.textContent = '0/500';
      closeModal();
      showCustomPopup('Masukan Terkirim', 'Terima kasih! Masukan Anda telah disimpan secara privat untuk bahan evaluasi pengelola BUMDesa Mandiri Sejahtera.', 'Tutup');
    });
  }
}

/* Reusable Custom UI Pop-up Modal */
function showCustomPopup(title, message, buttonText = 'Oke, Mengerti', onClose = null) {
  let overlay = document.getElementById('customPopupOverlay');
  if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'customPopupOverlay';
    overlay.className = 'custom-popup-overlay';
    document.body.appendChild(overlay);
  }

  overlay.innerHTML = `
    <div class="custom-popup-card" role="dialog" aria-modal="true" aria-labelledby="customPopupTitle">
      <div class="custom-popup-icon">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
      </div>
      <h3 class="custom-popup-title" id="customPopupTitle"></h3>
      <p class="custom-popup-msg" id="customPopupMsg"></p>
      <button type="button" class="custom-popup-btn" id="customPopupBtn"></button>
    </div>
  `;

  const titleEl = document.getElementById('customPopupTitle');
  const msgEl = document.getElementById('customPopupMsg');
  const btnEl = document.getElementById('customPopupBtn');

  titleEl.textContent = title;
  msgEl.textContent = message;
  btnEl.textContent = buttonText;

  const closeHandler = () => {
    overlay.classList.remove('open');
    if (typeof onClose === 'function') {
      onClose();
    }
  };

  btnEl.onclick = closeHandler;
  overlay.onclick = (e) => {
    if (e.target === overlay) closeHandler();
  };

  requestAnimationFrame(() => {
    overlay.classList.add('open');
    btnEl.focus();
  });
}

/* Modal Rincian Paket Wisata Terstruktur & Rapi */
function openPackageDetailModal(p) {
  if (!p) return;

  let overlay = document.getElementById('pkgDetailModalOverlay');
  if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'pkgDetailModalOverlay';
    overlay.className = 'custom-popup-overlay';
    document.body.appendChild(overlay);
  }

  const cleanWa = (p.waNumber || '6285702573013').replace(/\D/g, '').replace(/^0/, '62');
  const waText = encodeURIComponent(`Halo Admin, saya mau reservasi *${p.name}* (${p.price}) Desa Wisata Karangkemiri.`);

  let facilitiesList = [];
  if (Array.isArray(p.facilities)) {
    facilitiesList = p.facilities;
  } else if (typeof p.facilities === 'string') {
    facilitiesList = p.facilities
      .split('\n')
      .map((s) => s.replace(/^[•\-\*]\s*/, '').trim())
      .filter(Boolean);
  }

  const facilitiesHtml = facilitiesList.length
    ? facilitiesList
        .map(
          (f) => `
        <li style="display: flex; align-items: flex-start; gap: 9px; margin-bottom: 7px;">
          <span style="color: #2A9D8F; font-size: 14px; font-weight: 800; line-height: 1.3; flex-shrink: 0;">✓</span>
          <span style="color: var(--text-body); font-size: 13.5px; line-height: 1.55;">${f}</span>
        </li>
      `
        )
        .join('')
    : '<li style="color: var(--text-muted); font-size: 13px;">Fasilitas standar Desa Wisata Karangkemiri.</li>';

  const destHtml = p.destinasi
    ? `<div style="display: flex; align-items: center; gap: 8px; font-size: 13.5px; color: var(--text-dark); margin-bottom: 6px;">
         <span><strong>Destinasi:</strong> ${p.destinasi}</span>
       </div>`
    : '';

  const umkmHtml = p.umkm
    ? `<div style="display: flex; align-items: center; gap: 8px; font-size: 13.5px; color: var(--text-dark); margin-bottom: 6px;">
         <span><strong>Mitra UMKM:</strong> ${p.umkm}</span>
       </div>`
    : '';

  const descHtml = p.description
    ? `<div style="margin-top: 14px; padding: 12px 14px; background: var(--green-tint, rgba(42, 157, 143, 0.08)); border-radius: 12px; border: 1px solid var(--border-subtle, #E4ECE7);">
         <div style="font-size: 11px; font-weight: 700; color: var(--green-dark); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Informasi Tambahan</div>
         <p style="font-size: 13px; color: var(--text-body); line-height: 1.55; margin: 0;">${p.description}</p>
       </div>`
    : '';

  overlay.innerHTML = `
    <div class="custom-popup-card" role="dialog" aria-modal="true" aria-labelledby="pkgModalTitle" style="max-width: 500px; width: 92%; padding: 24px 22px; text-align: left; max-height: 88vh; overflow-y: auto; border-radius: 20px;">
      <!-- Modal Header -->
      <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; border-bottom: 1px solid var(--border-subtle); padding-bottom: 14px; margin-bottom: 14px;">
        <div>
          <span style="font-size: 11px; font-weight: 700; color: #2A9D8F; text-transform: uppercase; letter-spacing: 0.08em; display: block; margin-bottom: 4px;">DETAIL PAKET WISATA</span>
          <h3 id="pkgModalTitle" style="font-size: 20px; font-weight: 800; color: var(--text-dark); margin: 0; line-height: 1.25;">${p.name}</h3>
          <div style="margin-top: 8px;">
            <span class="price-tag" style="font-size: 14px; font-weight: 800; background-color: var(--green-soft); color: var(--green-dark); padding: 5px 12px; border-radius: 20px; display: inline-block;">
              ${p.price}
            </span>
          </div>
        </div>
        <button type="button" id="closePkgModalBtn" aria-label="Tutup" style="background: none; border: none; cursor: pointer; color: var(--text-muted); padding: 6px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>

      <!-- Meta Info -->
      <div style="margin-bottom: 14px;">
        ${destHtml}
        ${umkmHtml}
      </div>

      <!-- Fasilitas & Rundown Kegiatan -->
      <div style="margin-bottom: 14px;">
        <div style="font-size: 12px; font-weight: 700; color: var(--green-dark); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
          Fasilitas &amp; Rundown Kegiatan
        </div>
        <ul style="list-style: none; padding: 0; margin: 0;">
          ${facilitiesHtml}
        </ul>
      </div>

      ${descHtml}

      <!-- Actions -->
      <div style="display: flex; gap: 10px; margin-top: 20px; flex-wrap: wrap;">
        <a href="https://wa.me/${cleanWa}?text=${waText}" target="_blank" rel="noopener" class="btn-cta-green" style="flex: 1; min-width: 180px; justify-content: center; padding: 11px 18px; font-size: 13.5px; border-radius: 12px;">
          <span>Pesan via WhatsApp</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/>
          </svg>
        </a>
        <button type="button" id="closePkgModalBtn2" class="btn-admin-secondary" style="padding: 10px 18px; font-size: 13.5px; border-radius: 12px;">
          Tutup
        </button>
      </div>
    </div>
  `;

  const closeModal = () => overlay.classList.remove('open');
  const closeBtn1 = document.getElementById('closePkgModalBtn');
  const closeBtn2 = document.getElementById('closePkgModalBtn2');
  if (closeBtn1) closeBtn1.onclick = closeModal;
  if (closeBtn2) closeBtn2.onclick = closeModal;
  overlay.onclick = (e) => {
    if (e.target === overlay) closeModal();
  };

  requestAnimationFrame(() => overlay.classList.add('open'));
}

/* Enhancer untuk Semua Dropdown: Tampilan Modern, Maksimal 10 List Sebelum Scroll */
function syncCustomSelect(select) {
  if (!select) return;
  const wrap = select.nextElementSibling;
  if (wrap && wrap.classList.contains('custom-dropdown-wrap')) {
    const triggerText = wrap.querySelector('.custom-dropdown-text');
    const selectedOpt = select.options[select.selectedIndex];
    if (triggerText && selectedOpt) {
      triggerText.textContent = selectedOpt.textContent;
    }
    const items = wrap.querySelectorAll('.custom-dropdown-item');
    items.forEach((item, idx) => {
      const isSelected = select.selectedIndex === idx;
      item.classList.toggle('selected', isSelected);
      item.setAttribute('aria-selected', isSelected ? 'true' : 'false');
      const check = item.querySelector('svg');
      if (check) check.style.display = isSelected ? 'inline-block' : 'none';
    });
  }
}

function enhanceSelectDropdowns() {
  const selects = document.querySelectorAll('select.admin-select, select.styled-dropdown');
  selects.forEach((select) => {
    if (select.dataset.enhanced === 'true') {
      syncCustomSelect(select);
      return;
    }

    select.dataset.enhanced = 'true';
    select.style.display = 'none';

    const wrap = document.createElement('div');
    wrap.className = 'custom-dropdown-wrap';

    if (select.style.width) {
      wrap.style.width = select.style.width;
      wrap.style.minWidth = select.style.width;
      wrap.style.maxWidth = select.style.width;
    }

    const trigger = document.createElement('button');
    trigger.type = 'button';
    trigger.className = 'custom-dropdown-trigger';
    trigger.setAttribute('aria-haspopup', 'listbox');
    trigger.setAttribute('aria-expanded', 'false');
    trigger.style.width = '100%';
    trigger.style.minWidth = '0';
    trigger.style.maxWidth = '100%';
    trigger.style.boxSizing = 'border-box';
    trigger.style.overflow = 'hidden';

    const selectedOpt = select.options[select.selectedIndex] || select.options[0];
    const triggerText = document.createElement('span');
    triggerText.className = 'custom-dropdown-text';
    triggerText.style.width = '0';
    triggerText.style.flex = '1 1 0%';
    triggerText.style.minWidth = '0';
    triggerText.style.maxWidth = '100%';
    triggerText.style.overflow = 'hidden';
    triggerText.style.textOverflow = 'ellipsis';
    triggerText.style.whiteSpace = 'nowrap';
    triggerText.style.display = 'block';
    triggerText.textContent = selectedOpt ? selectedOpt.textContent : 'Pilih opsi...';

    const triggerArrow = document.createElement('span');
    triggerArrow.className = 'custom-dropdown-arrow';
    triggerArrow.innerHTML = `
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="6 9 12 15 18 9"></polyline>
      </svg>
    `;

    trigger.appendChild(triggerText);
    trigger.appendChild(triggerArrow);
    wrap.appendChild(trigger);

    const menu = document.createElement('div');
    menu.className = 'custom-dropdown-menu';
    menu.setAttribute('role', 'listbox');

    const renderItems = () => {
      menu.innerHTML = '';
      Array.from(select.options).forEach((opt, idx) => {
        const item = document.createElement('div');
        const isSelected = select.selectedIndex === idx;
        item.className = 'custom-dropdown-item' + (isSelected ? ' selected' : '');
        item.setAttribute('role', 'option');
        item.setAttribute('aria-selected', isSelected ? 'true' : 'false');
        item.dataset.value = opt.value;

        const checkSvg = `
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" style="display: ${isSelected ? 'inline-block' : 'none'}; flex-shrink: 0;">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        `;
        item.innerHTML = `<span>${opt.textContent}</span>${checkSvg}`;

        item.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          select.selectedIndex = idx;
          if (opt && opt.value !== undefined) {
            select.value = opt.value;
          }
          triggerText.textContent = opt.textContent;
          wrap.classList.remove('open');
          trigger.setAttribute('aria-expanded', 'false');
          syncCustomSelect(select);
          select.dispatchEvent(new Event('input', { bubbles: true }));
          select.dispatchEvent(new Event('change', { bubbles: true }));
        });

        menu.appendChild(item);
      });
    };

    renderItems();
    wrap.appendChild(menu);
    select.parentNode.insertBefore(wrap, select.nextSibling);

    trigger.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = wrap.classList.contains('open');
      document.querySelectorAll('.custom-dropdown-wrap.open').forEach((w) => {
        if (w !== wrap) {
          w.classList.remove('open');
          const t = w.querySelector('.custom-dropdown-trigger');
          if (t) t.setAttribute('aria-expanded', 'false');
        }
      });

      if (!isOpen) {
        renderItems();
        wrap.classList.add('open');
        trigger.setAttribute('aria-expanded', 'true');
      } else {
        wrap.classList.remove('open');
        trigger.setAttribute('aria-expanded', 'false');
      }
    });

    select.addEventListener('change', () => {
      syncCustomSelect(select);
    });

    const observer = new MutationObserver(() => {
      const cur = select.options[select.selectedIndex] || select.options[0];
      if (cur) triggerText.textContent = cur.textContent;
      renderItems();
    });
    observer.observe(select, { childList: true });
  });
}

// Tutup custom dropdown bila klik di luar
document.addEventListener('click', (e) => {
  if (!e.target.closest('.custom-dropdown-wrap')) {
    document.querySelectorAll('.custom-dropdown-wrap.open').forEach((w) => {
      w.classList.remove('open');
      const t = w.querySelector('.custom-dropdown-trigger');
      if (t) t.setAttribute('aria-expanded', 'false');
    });
  }
});

/* Confirmation Pop-up Modal for Delete Action */
function showDeleteConfirmPopup(itemName, onConfirm) {
  let overlay = document.getElementById('customPopupOverlay');
  if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'customPopupOverlay';
    overlay.className = 'custom-popup-overlay';
    document.body.appendChild(overlay);
  }

  overlay.innerHTML = `
    <div class="custom-popup-card" role="dialog" aria-modal="true" aria-labelledby="customPopupTitle">
      <div class="custom-popup-icon danger">
        <svg width="44" height="44" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a1 1 0 1 1 0 2h-1l-.86 12.14A3 3 0 0 1 14.15 21H9.85a3 3 0 0 1-2.99-2.86L6 6H5a1 1 0 1 1 0-2h4V3zm2 7a1 1 0 1 0-2 0v6a1 1 0 1 0 2 0v-6zm4 0a1 1 0 1 0-2 0v6a1 1 0 1 0 2 0v-6z" fill-rule="evenodd" clip-rule="evenodd"/>
        </svg>
      </div>
      <h3 class="custom-popup-title" id="customPopupTitle">Hapus Data Ini?</h3>
      <p class="custom-popup-msg" id="customPopupMsg"></p>
      <div class="custom-popup-actions">
        <button type="button" class="custom-popup-btn secondary" id="customPopupCancelBtn">Batal</button>
        <button type="button" class="custom-popup-btn danger" id="customPopupConfirmBtn">Ya, Hapus</button>
      </div>
    </div>
  `;

  const msgEl = document.getElementById('customPopupMsg');
  const cancelBtn = document.getElementById('customPopupCancelBtn');
  const confirmBtn = document.getElementById('customPopupConfirmBtn');

  msgEl.textContent = `Apakah Anda yakin ingin menghapus "${itemName}"? Gunakan status Draf / Sembunyikan jika hanya ingin menonaktifkan sementara.`;

  const closePopup = () => overlay.classList.remove('open');

  cancelBtn.onclick = closePopup;
  overlay.onclick = (e) => {
    if (e.target === overlay) closePopup();
  };
  confirmBtn.onclick = () => {
    closePopup();
    if (typeof onConfirm === 'function') {
      onConfirm();
    }
  };

  requestAnimationFrame(() => {
    overlay.classList.add('open');
    cancelBtn.focus();
  });
}

/* 5. Admin CMS Interactive Features */
function initAdminCMS() {
  // 5.0 Check if just logged in and landed on Dashboard -> show welcome pop-up on Dashboard
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('login') === 'success') {
    showCustomPopup(
      'Login Berhasil!',
      'Selamat datang di Panel Admin BUMDes Karangkemiri. Anda kini dapat mengelola seluruh konten website desa wisata.',
      'Mulai Kelola Konten'
    );
    if (window.history && window.history.replaceState) {
      const cleanUrl = window.location.pathname;
      window.history.replaceState({}, document.title, cleanUrl);
    }
  }

  // 5a. Search filter on Kelola Destinasi (admin-destinasi.html)
  const searchInput = document.getElementById('adminSearchDest');
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      const q = searchInput.value.toLowerCase().trim();
      document.querySelectorAll('[data-admin-dest-item]').forEach((item) => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(q) ? '' : 'none';
      });
    });
  }

  // 5b. Dynamic Edit Destinasi Form (admin-edit-destinasi.html)
  const editDestForm = document.getElementById('adminEditDestForm');
  if (editDestForm) {
    const params = new URLSearchParams(window.location.search);
    const slug = (params.get('slug') || 'candi').toLowerCase();
    const data = DESTINATIONS_DATA[slug];

    if (data && slug !== 'new') {
      const nameInput = document.getElementById('inputDestName');
      const catInput = document.getElementById('inputDestCategory');
      const locInput = document.getElementById('inputDestLocation');
      const descInput = document.getElementById('inputDestDesc');
      const hoursInput = document.getElementById('inputDestHours');
      const facInput = document.getElementById('inputDestFacilities');

      if (nameInput) nameInput.value = data.title;
      if (catInput) catInput.value = data.badge;
      if (locInput) locInput.value = data.location;
      if (descInput) descInput.value = data.description;
      if (hoursInput) hoursInput.value = data.hours;
      if (facInput) facInput.value = data.facilities.join(', ');
    }
  }

  // 5c. Interactive Package Selection on Kelola Paket (admin-paket.html)
  document.querySelectorAll('[data-edit-pkg]').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const name = btn.getAttribute('data-pkg-name') || '';
      const price = btn.getAttribute('data-pkg-price') || '';
      const status = btn.getAttribute('data-pkg-status') || 'Tayang';
      const desc = btn.getAttribute('data-pkg-desc') || '';
      const nameEl = document.getElementById('pkgFormName');
      const priceEl = document.getElementById('pkgFormPrice');
      const statusEl = document.getElementById('pkgFormStatus');
      const descEl = document.getElementById('pkgFormDesc');
      if (nameEl) {
        nameEl.value = name;
        nameEl.focus();
      }
      if (priceEl) priceEl.value = price;
      if (statusEl) statusEl.value = status;
      if (descEl) descEl.value = desc;
    });
  });

  // 5d. Interactive Product Selection on Kelola UMKM (admin-umkm.html)
  document.querySelectorAll('[data-edit-umkm]').forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const name = btn.getAttribute('data-umkm-name') || '';
      const owner = btn.getAttribute('data-umkm-owner') || '';
      const cat = btn.getAttribute('data-umkm-cat') || '';
      const status = btn.getAttribute('data-umkm-status') || 'Tayang';
      const price = btn.getAttribute('data-umkm-price') || '';
      const nameEl = document.getElementById('umkmFormName');
      const ownerEl = document.getElementById('umkmFormOwner');
      const catEl = document.getElementById('umkmFormCat');
      const statusEl = document.getElementById('umkmFormStatus');
      const priceEl = document.getElementById('umkmFormPrice');
      if (nameEl) {
        nameEl.value = name;
        nameEl.focus();
      }
      if (ownerEl) ownerEl.value = owner;
      if (catEl) catEl.value = cat;
      if (statusEl) statusEl.value = status;
      if (priceEl) priceEl.value = price;
    });
  });

  // 5e. Delete Item Buttons on Cards ([data-delete-item])
  document.querySelectorAll('[data-delete-item]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const itemName = btn.getAttribute('data-delete-item') || 'Item ini';
      const card = btn.closest('.admin-item-card');
      showDeleteConfirmPopup(itemName, () => {
        if (card) {
          card.style.display = 'none';
        }
        setTimeout(() => {
          showCustomPopup('Berhasil Dihapus', `"${itemName}" telah dihapus dari daftar.`, 'Tutup');
        }, 180);
      });
    });
  });

  // 5f. Delete Button Inside Edit Form ([data-delete-from-form])
  document.querySelectorAll('[data-delete-from-form]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const inputId = btn.getAttribute('data-delete-from-form');
      const redirectUrl = btn.getAttribute('data-delete-redirect');
      const inputEl = inputId ? document.getElementById(inputId) : null;
      const itemName = (inputEl && inputEl.value.trim()) ? inputEl.value.trim() : 'Item ini';

      showDeleteConfirmPopup(itemName, () => {
        const matchingCard = document.querySelector(`[data-admin-card="${itemName}"]`);
        if (matchingCard) {
          matchingCard.style.display = 'none';
        }
        setTimeout(() => {
          showCustomPopup('Berhasil Dihapus', `"${itemName}" telah dihapus dari CMS.`, 'Selesai', () => {
            if (redirectUrl) {
              window.location.href = redirectUrl;
            }
          });
        }, 180);
      });
    });
  });

  // 5g. Generic Admin Form Save, Status Badge Update & Login Redirect Simulation
  document.querySelectorAll('[data-admin-save-form]').forEach((form) => {
    if (
      form.id === 'adminProfileForm' ||
      form.id === 'formPaket' ||
      form.id === 'adminContactForm' ||
      form.id === 'formUMKMProduct' ||
      form.id === 'formUMKMProfile'
    )
      return;
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const msg = form.getAttribute('data-save-msg') || 'Perubahan berhasil disimpan ke CMS.';
      const redirectUrl = form.getAttribute('data-redirect');

      // Jika form login menuju dashboard, arahkan ke dashboard lalu tampilkan pop-up di halaman dashboard
      if (redirectUrl && redirectUrl.includes('admin-dashboard.html')) {
        window.location.href = 'admin-dashboard.html?login=success';
        return;
      }

      // Perbarui badge status (Tayang / Draf / Sembunyikan) pada kartu jika ada
      const statusSelect = form.querySelector('[data-status-select]');
      const nameInput = form.querySelector('#pkgFormName, #umkmFormName');
      if (statusSelect && nameInput) {
        const currentName = nameInput.value.trim();
        const currentStatus = statusSelect.value;
        const card = document.querySelector(`[data-admin-card="${currentName}"]`);
        if (card) {
          const badge = card.querySelector('[data-item-badge]');
          const editBtn = card.querySelector('[data-edit-pkg], [data-edit-umkm]');
          if (badge) {
            badge.textContent = currentStatus;
            badge.className =
              currentStatus === 'Tayang'
                ? 'badge-tayang'
                : currentStatus === 'Draf'
                ? 'badge-draf'
                : 'badge-sembunyi';
          }
          if (editBtn) {
            if (editBtn.hasAttribute('data-pkg-status')) editBtn.setAttribute('data-pkg-status', currentStatus);
            if (editBtn.hasAttribute('data-umkm-status')) editBtn.setAttribute('data-umkm-status', currentStatus);
          }
        }
      }

      showCustomPopup('Berhasil Disimpan', msg, 'Oke, Mengerti', () => {
        if (redirectUrl) {
          window.location.href = redirectUrl;
        }
      });
    });
  });
}

const DEFAULT_PROFILE_DATA = {
  title: 'Desa Wisata Karangkemiri',
  heroCaption: 'Mengenal desa kami',
  summary: 'Harmoni Alam, Budaya, Edukasi, dan UMKM Lokal di Kecamatan Karanglewas, Kabupaten Banyumas.',
  status: 'Tayang',
  history:
    'Desa Wisata Karangkemiri merupakan salah satu destinasi wisata berbasis masyarakat di Kabupaten Banyumas yang dikelola oleh BUMDesa Mandiri Sejahtera bersama pemerintah desa, pelaku UMKM, serta kelompok masyarakat setempat. Terletak di wilayah yang masih asri di Kecamatan Karanglewas, Desa Karangkemiri menawarkan perpaduan antara keindahan alam pedesaan, kekayaan tradisi dan sejarah lokal, kegiatan wisata edukasi, serta beragam produk UMKM unggulan warga.',
  potensiDesc:
    'Sebagai desa yang terus berkembang, Karangkemiri menghadirkan pengalaman wisata yang tidak hanya rekreatif, tetapi juga bernilai edukatif dan memberdayakan masyarakat. Pengunjung dapat menikmati suasana sejuk di kawasan Embung Prabawulan, mengikuti kegiatan kelompok dan permainan ketangkasan di Wahana Edukasi & Outbound Candi, menjelajahi kebun buah di Agrowisata Kelengkeng Thabet, hingga mengenal nilai sejarah dan kearifan lokal di Petilasan Mbah Siti Benter.',
  cultureDesc:
    'Selain destinasi wisata, Desa Karangkemiri juga menjaga warisan budaya seperti Tradisi Sadranan dan kesenian Begalan yang menjadi identitas kultural masyarakat. Di sisi ekonomi kreatif, pengunjung dapat melihat langsung proses produksi sekaligus membawa pulang oleh-oleh khas desa seperti tahu tradisional, gula jawa dan semut aren, kerajinan kain perca, serta madu klanceng.',
  accessInfo:
    'Desa Wisata Karangkemiri terletak di Kecamatan Karanglewas, Kabupaten Banyumas, dengan jarak tempuh sekitar 15–20 menit (kurang lebih 7 km) dari pusat Kota Purwokerto maupun Stasiun Purwokerto. Akses jalan menuju desa sudah beraspal baik dan dapat dilalui kendaraan roda dua, mobil pribadi, hingga bus pariwisata untuk kegiatan rombongan sekolah atau instansi.',
  sinceYear: '2017',
  manager: 'BUMDesa Mandiri Sejahtera',
  focus: 'Wisata, Edukasi & UMKM',
  visionTitle: 'Visi, Misi & Tujuan Kami',
  potensiCaption: 'Wahana Edukasi & Outbound Candi',
  vision:
    'Mewujudkan Desa Wisata Karangkemiri sebagai destinasi wisata edukasi, alam, dan budaya yang maju, mandiri, berkelanjutan, serta mampu meningkatkan kesejahteraan masyarakat berbasis kearifan lokal.',
  goal:
    'Meningkatkan pendapatan asli desa dan ekonomi warga, menciptakan lapangan kerja lokal di sektor pariwisata dan ekonomi kreatif, serta menjadikan Desa Wisata Karangkemiri sebagai rujukan wisata edukasi dan keluarga di Kabupaten Banyumas.',
  mission:
    'Mengembangkan potensi wisata alam, edukasi, outbound, agrowisata, dan wisata budaya desa secara terpadu.\nMeningkatkan kualitas sarana prasarana serta pelayanan wisata yang aman, ramah, bersih, dan nyaman bagi pengunjung.\nMelestarikan tradisi, adat istiadat, kesenian lokal, serta kelestarian lingkungan hidup Desa Karangkemiri.\nMemberdayakan pelaku UMKM lokal melalui promosi produk unggulan desa sebagai bagian dari ekosistem wisata.\nMeningkatkan kapasitas SDM pengelola wisata dan partisipasi aktif masyarakat melalui tata kelola BUMDesa Mandiri Sejahtera yang profesional dan transparan.\nMembangun jejaring kerja sama dengan sekolah, instansi, perguruan tinggi, dan mitra pariwisata.'
};

const PROFILE_STORAGE_KEY = 'cms_profil_desa_data';

function getSavedProfileData() {
  const raw = localStorage.getItem(PROFILE_STORAGE_KEY);
  if (!raw) return null;
  const parsed = safeJsonParse(raw, null);
  if (!parsed) return null;
  return { ...DEFAULT_PROFILE_DATA, ...parsed };
}

/* 6. Sinkronisasi Data Profil CMS ke Halaman Publik (/profil) */
function initPublicProfile() {
  const pubTitleEl = document.getElementById('pubProfTitle');
  if (!pubTitleEl) return;

  const saved = getSavedProfileData();
  if (!saved) return;

  const heroCaptionEl = document.getElementById('pubProfHeroCaption');
  const historyEl = document.getElementById('pubProfHistory');
  const potensiDescEl = document.getElementById('pubProfPotensiDesc');
  const cultureDescEl = document.getElementById('pubProfCultureDesc');
  const accessEl = document.getElementById('pubProfAccess');
  const sinceEl = document.getElementById('pubProfSince');
  const managerEl = document.getElementById('pubProfManager');
  const focusEl = document.getElementById('pubProfFocus');
  const potensiCaptionEl = document.getElementById('pubProfPotensiCaption');
  const visionTitleEl = document.getElementById('pubProfVisionTitle');
  const visionEl = document.getElementById('pubProfVision');
  const goalEl = document.getElementById('pubProfGoal');
  const missionListEl = document.getElementById('pubProfMissionList');
  const mainPhotoEl = document.getElementById('pubProfMainPhoto');
  const mainImgEl = document.getElementById('pubProfMainImg');
  const structPhotoEl = document.getElementById('pubProfStructPhoto');
  const structImgEl = document.getElementById('pubProfStructImg');
  const supportPhotoEl = document.getElementById('pubSupportPhoto1') || document.getElementById('pubProfSupportImg1');

  if (heroCaptionEl && saved.heroCaption) heroCaptionEl.textContent = saved.heroCaption;
  if (pubTitleEl && saved.title) pubTitleEl.textContent = saved.title;
  if (historyEl && saved.history) historyEl.textContent = saved.history;
  if (potensiDescEl && saved.potensiDesc) potensiDescEl.textContent = saved.potensiDesc;
  if (cultureDescEl && saved.cultureDesc) cultureDescEl.textContent = saved.cultureDesc;
  if (accessEl && saved.accessInfo) accessEl.textContent = saved.accessInfo;
  if (sinceEl && saved.sinceYear) sinceEl.textContent = saved.sinceYear;
  if (managerEl && saved.manager) managerEl.textContent = saved.manager;
  if (focusEl && saved.focus) focusEl.textContent = saved.focus;
  if (potensiCaptionEl && saved.potensiCaption) potensiCaptionEl.textContent = saved.potensiCaption;
  if (visionTitleEl && saved.visionTitle) visionTitleEl.textContent = saved.visionTitle;
  if (visionEl && saved.vision) visionEl.textContent = saved.vision;
  if (goalEl && saved.goal) goalEl.textContent = saved.goal;
  if (missionListEl && saved.mission) {
    const items = saved.mission
      .split('\n')
      .map((line) => line.trim())
      .filter(Boolean);
    if (items.length) {
      missionListEl.innerHTML = items.map((item) => `<li>${escapeHtml(item)}</li>`).join('');
    }
  }
  if (mainPhotoEl && saved.mainPhotoDataUrl) {
    mainPhotoEl.style.backgroundImage = `linear-gradient(180deg, rgba(16, 40, 26, 0.2) 0%, rgba(16, 40, 26, 0.72) 100%), url('${saved.mainPhotoDataUrl}')`;
  }
  if (mainImgEl && saved.mainPhotoDataUrl) {
    mainImgEl.src = saved.mainPhotoDataUrl;
  }
  if (structPhotoEl && saved.structPhotoDataUrl) {
    structPhotoEl.src = saved.structPhotoDataUrl;
  }
  if (structImgEl && saved.structPhotoDataUrl) {
    structImgEl.src = saved.structPhotoDataUrl;
  }
  if (supportPhotoEl && saved.supportPhotoDataUrl) {
    supportPhotoEl.src = saved.supportPhotoDataUrl;
  }
}

/* 7. Formulir Pengelolaan Profil Desa melalui CMS (/admin/profil) */
function initProfileCMS() {
  const profileForm = document.getElementById('adminProfileForm');
  if (!profileForm) return;

  const titleInput = document.getElementById('profTitle');
  const heroCaptionInput = document.getElementById('profHeroCaption');
  const summaryInput = document.getElementById('profSummary');
  const statusSelect = document.getElementById('profStatus');
  const historyInput = document.getElementById('profHistory');
  const potensiDescInput = document.getElementById('profPotensiDesc');
  const cultureDescInput = document.getElementById('profCultureDesc');
  const accessInput = document.getElementById('profAccess');
  const sinceInput = document.getElementById('profSince');
  const managerInput = document.getElementById('profManager');
  const focusInput = document.getElementById('profFocus');
  const visionTitleInput = document.getElementById('profVisionTitle');
  const potensiCaptionInput = document.getElementById('profPotensiCaption');
  const visionInput = document.getElementById('profVision');
  const goalInput = document.getElementById('profGoal');
  const missionInput = document.getElementById('profMission');

  const statusBadge = document.getElementById('profStatusBadge');
  const lastSavedEl = document.getElementById('profLastSaved');
  const alertBox = document.getElementById('profFormAlert');
  const alertText = document.getElementById('profFormAlertText');
  const resetBtn = document.getElementById('resetProfileBtn');

  // Elemen Live Preview
  const prevTitle = document.getElementById('previewProfTitle');
  const prevHistory = document.getElementById('previewProfHistory');
  const prevSince = document.getElementById('previewProfSince');
  const prevManager = document.getElementById('previewProfManager');
  const prevFocus = document.getElementById('previewProfFocus');
  const prevVisionTitle = document.getElementById('previewProfVisionTitle');
  const prevVision = document.getElementById('previewProfVision');
  const prevBadge = document.getElementById('previewBadgeStatus');
  const mainPhotoPreview = document.getElementById('profMainPhotoPreview');
  const structPhotoPreview = document.getElementById('profStructPhotoPreview');
  const supportPhotoPreview = document.getElementById('profSupportPhotoPreview');

  let uploadedPhotos = {
    mainPhotoDataUrl: null,
    structPhotoDataUrl: null,
    supportPhotoDataUrl: null
  };

  const showAlert = (msg) => {
    if (!alertBox || !alertText) return;
    alertText.textContent = msg;
    alertBox.style.display = 'flex';
  };

  const hideAlert = () => {
    if (!alertBox || !alertText) return;
    alertBox.style.display = 'none';
    alertText.textContent = '';
  };

  const syncLivePreview = () => {
    if (prevTitle && titleInput) prevTitle.textContent = titleInput.value.trim() || DEFAULT_PROFILE_DATA.title;
    if (prevHistory && historyInput) prevHistory.textContent = historyInput.value.trim() || DEFAULT_PROFILE_DATA.history;
    if (prevSince && sinceInput) prevSince.textContent = sinceInput.value.trim() || DEFAULT_PROFILE_DATA.sinceYear;
    if (prevManager && managerInput) prevManager.textContent = managerInput.value.trim() || DEFAULT_PROFILE_DATA.manager;
    if (prevFocus && focusInput) prevFocus.textContent = focusInput.value.trim() || DEFAULT_PROFILE_DATA.focus;
    if (prevVisionTitle && visionTitleInput) prevVisionTitle.textContent = visionTitleInput.value.trim() || DEFAULT_PROFILE_DATA.visionTitle;
    if (prevVision && visionInput) prevVision.textContent = visionInput.value.trim() || DEFAULT_PROFILE_DATA.vision;

    if (statusSelect) {
      const isTayang = statusSelect.value === 'Tayang';
      if (statusBadge) {
        statusBadge.textContent = isTayang ? 'Tayang di Website' : 'Draf Sementara';
        statusBadge.className = isTayang ? 'badge-tayang' : 'badge-draf';
      }
      if (prevBadge) {
        prevBadge.textContent = isTayang ? 'Status: Tayang' : 'Status: Draf';
        prevBadge.className = isTayang ? 'badge-tayang' : 'badge-draf';
      }
    }
  };

  const populateForm = (data) => {
    if (titleInput) titleInput.value = data.title || '';
    if (heroCaptionInput) heroCaptionInput.value = data.heroCaption || '';
    if (summaryInput) summaryInput.value = data.summary || '';
    if (statusSelect) statusSelect.value = data.status || 'Tayang';
    if (historyInput) historyInput.value = data.history || '';
    if (potensiDescInput) potensiDescInput.value = data.potensiDesc || '';
    if (cultureDescInput) cultureDescInput.value = data.cultureDesc || '';
    if (accessInput) accessInput.value = data.accessInfo || '';
    if (sinceInput) sinceInput.value = data.sinceYear || '';
    if (managerInput) managerInput.value = data.manager || '';
    if (focusInput) focusInput.value = data.focus || '';
    if (visionTitleInput) visionTitleInput.value = data.visionTitle || '';
    if (potensiCaptionInput) potensiCaptionInput.value = data.potensiCaption || '';
    if (visionInput) visionInput.value = data.vision || '';
    if (goalInput) goalInput.value = data.goal || '';
    if (missionInput) missionInput.value = data.mission || '';
    if (data.mainPhotoDataUrl && mainPhotoPreview) {
      mainPhotoPreview.src = data.mainPhotoDataUrl;
      uploadedPhotos.mainPhotoDataUrl = data.mainPhotoDataUrl;
    }
    if (data.structPhotoDataUrl && structPhotoPreview) {
      structPhotoPreview.src = data.structPhotoDataUrl;
      uploadedPhotos.structPhotoDataUrl = data.structPhotoDataUrl;
    }
    if (data.supportPhotoDataUrl && supportPhotoPreview) {
      supportPhotoPreview.src = data.supportPhotoDataUrl;
      uploadedPhotos.supportPhotoDataUrl = data.supportPhotoDataUrl;
    }
    if (lastSavedEl && data.updatedAt) {
      lastSavedEl.textContent = `Diperbarui: ${data.updatedAt}`;
    }
    syncLivePreview();
  };

  // Muat data yang pernah disimpan di localStorage jika ada
  const existingData = getSavedProfileData();
  if (existingData) {
    populateForm(existingData);
  } else {
    syncLivePreview();
  }

  // Listener perubahan input untuk Live Preview realtime
  [
    titleInput,
    heroCaptionInput,
    summaryInput,
    statusSelect,
    historyInput,
    potensiDescInput,
    cultureDescInput,
    accessInput,
    sinceInput,
    managerInput,
    focusInput,
    visionTitleInput,
    potensiCaptionInput,
    visionInput,
    goalInput,
    missionInput
  ].forEach((el) => {
    if (!el) return;
    el.addEventListener('input', () => {
      hideAlert();
      syncLivePreview();
    });
    el.addEventListener('change', syncLivePreview);
  });

  // Handler Upload & Validasi Foto Profil / Struktur Organisasi / Foto Pendukung
  const bindPhotoUpload = (inputId, previewId, labelId, photoLabel, stateKey) => {
    const fileInput = document.getElementById(inputId);
    const previewImg = document.getElementById(previewId);
    const labelEl = document.getElementById(labelId);
    if (!fileInput) return;

    fileInput.addEventListener('change', () => {
      const file = fileInput.files && fileInput.files[0];
      if (!file) return;

      const maxBytes = 5 * 1024 * 1024; // 5 MB
      if (file.size > maxBytes) {
        showAlert(`Ukuran file ${photoLabel} melebihi batas maksimal 5 MB.`);
        fileInput.value = '';
        return;
      }

      hideAlert();
      const reader = new FileReader();
      reader.onload = (ev) => {
        if (ev.target && ev.target.result) {
          if (previewImg) {
            previewImg.src = ev.target.result;
          }
          if (stateKey) {
            uploadedPhotos[stateKey] = ev.target.result;
          }
        }
      };
      reader.readAsDataURL(file);

      if (labelEl) {
        labelEl.textContent = `File dipilih: ${file.name} (${(file.size / 1024).toFixed(0)} KB)`;
      }
      showCustomPopup('Foto Dipilih', `${photoLabel} berhasil dipilih: ${file.name}`, 'Lanjutkan');
    });
  };

  bindPhotoUpload('profMainPhotoInput', 'profMainPhotoPreview', 'profMainPhotoName', 'Foto utama desa', 'mainPhotoDataUrl');
  bindPhotoUpload('profStructPhotoInput', 'profStructPhotoPreview', 'profStructPhotoName', 'Bagan struktur organisasi', 'structPhotoDataUrl');
  bindPhotoUpload('profSupportPhotoInput', 'profSupportPhotoPreview', 'profSupportPhotoName', 'Foto pendukung desa', 'supportPhotoDataUrl');

  // Handler Submit Simpan Perubahan Profil
  profileForm.addEventListener('submit', (e) => {
    e.preventDefault();
    hideAlert();

    const requiredChecks = [
      { el: titleInput, name: 'Judul profil desa' },
      { el: heroCaptionInput, name: 'Caption banner utama' },
      { el: summaryInput, name: 'Ringkasan singkat desa' },
      { el: historyInput, name: 'Paragraf 1 — Sejarah & pengenalan desa' },
      { el: sinceInput, name: 'Tahun berdiri (Sejak)' },
      { el: managerInput, name: 'Lembaga pengelola' },
      { el: focusInput, name: 'Fokus pengembangan' },
      { el: visionTitleInput, name: 'Judul bagian visi' },
      { el: visionInput, name: 'Visi desa wisata' }
    ];

    for (const check of requiredChecks) {
      if (check.el && !check.el.value.trim()) {
        showAlert(`Kolom "${check.name}" wajib diisi sebelum menyimpan perubahan.`);
        check.el.focus();
        return;
      }
    }

    const nowStr = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';
    const payload = {
      title: titleInput ? titleInput.value.trim() : DEFAULT_PROFILE_DATA.title,
      heroCaption: heroCaptionInput ? heroCaptionInput.value.trim() : DEFAULT_PROFILE_DATA.heroCaption,
      summary: summaryInput ? summaryInput.value.trim() : DEFAULT_PROFILE_DATA.summary,
      status: statusSelect ? statusSelect.value : 'Tayang',
      history: historyInput ? historyInput.value.trim() : DEFAULT_PROFILE_DATA.history,
      potensiDesc: potensiDescInput ? potensiDescInput.value.trim() : DEFAULT_PROFILE_DATA.potensiDesc,
      cultureDesc: cultureDescInput ? cultureDescInput.value.trim() : DEFAULT_PROFILE_DATA.cultureDesc,
      accessInfo: accessInput ? accessInput.value.trim() : DEFAULT_PROFILE_DATA.accessInfo,
      sinceYear: sinceInput ? sinceInput.value.trim() : DEFAULT_PROFILE_DATA.sinceYear,
      manager: managerInput ? managerInput.value.trim() : DEFAULT_PROFILE_DATA.manager,
      focus: focusInput ? focusInput.value.trim() : DEFAULT_PROFILE_DATA.focus,
      visionTitle: visionTitleInput ? visionTitleInput.value.trim() : DEFAULT_PROFILE_DATA.visionTitle,
      potensiCaption: potensiCaptionInput ? potensiCaptionInput.value.trim() : DEFAULT_PROFILE_DATA.potensiCaption,
      vision: visionInput ? visionInput.value.trim() : DEFAULT_PROFILE_DATA.vision,
      goal: goalInput ? goalInput.value.trim() : DEFAULT_PROFILE_DATA.goal,
      mission: missionInput ? missionInput.value.trim() : DEFAULT_PROFILE_DATA.mission,
      mainPhotoDataUrl: uploadedPhotos.mainPhotoDataUrl,
      structPhotoDataUrl: uploadedPhotos.structPhotoDataUrl,
      supportPhotoDataUrl: uploadedPhotos.supportPhotoDataUrl,
      updatedAt: nowStr
    };

    try {
      localStorage.setItem(PROFILE_STORAGE_KEY, JSON.stringify(payload));
    } catch (err) {
      // Ignore storage quota errors
    }

    if (lastSavedEl) {
      lastSavedEl.textContent = `Diperbarui: ${nowStr}`;
    }
    syncLivePreview();

    const saveMsg = profileForm.getAttribute('data-save-msg') || 'Informasi Profil Desa berhasil diperbarui!';
    showCustomPopup('Berhasil Disimpan', saveMsg, 'Oke, Mengerti');
  });

  // Handler Reset ke Default
  if (resetBtn) {
    resetBtn.addEventListener('click', () => {
      try {
        localStorage.removeItem(PROFILE_STORAGE_KEY);
      } catch (err) {
        // Ignore
      }
      uploadedPhotos = {
        mainPhotoDataUrl: null,
        structPhotoDataUrl: null,
        supportPhotoDataUrl: null
      };
      if (mainPhotoPreview) mainPhotoPreview.src = '/assets/images/candi.png';
      if (structPhotoPreview) structPhotoPreview.src = '/assets/images/struktur-unit-wisata.png';
      if (supportPhotoPreview) supportPhotoPreview.src = '/assets/images/penghargaan-ldwn-peringkat-ke-13-nasional-2023.jpeg';
      populateForm(DEFAULT_PROFILE_DATA);
      if (lastSavedEl) {
        lastSavedEl.textContent = 'Default dikembalikan';
      }
      hideAlert();
      showCustomPopup('Profil Direset', 'Formulir profil desa telah dikembalikan ke data awal bawaan.', 'Mengerti');
    });
  }
}

/* =========================================================
   8. PENGELOLAAN MODUL PAKET WISATA (CMS & HALAMAN PUBLIK)
   ========================================================= */
const PACKAGES_STORAGE_KEY = 'cms_paket_wisata_data';

const DEFAULT_PACKAGES_DATA = [
  {
    id: 'outbound',
    name: 'Paket Outbound',
    price: 'mulai Rp 100.000 ,- / Orang',
    status: 'Aktif',
    image: '/assets/images/paket-1.jpeg',
    destinasi: 'Wahana Edukasi & Outbound Candi',
    umkm: 'Kriya Kain Perca & Kerajinan Lokal',
    waNumber: '085702573013',
    facilities: [
      'Pilihan: Paket Edukasi Ceria, Team Building & Petualang Muda',
      'Wahana outbound, flying fox, ketapel & panahan',
      'Permainan kelompok & pendamping instruktur berpengalaman',
      'Penggunaan area outbound & pendopo luas'
    ],
    description:
      'Nikmati pengalaman seru penuh kebersamaan melalui Paket Outbound di Desa Wisata Karangkemiri. Beragam aktivitas menantang dan menyenangkan di alam terbuka yang dirancang untuk melatih kerja sama, kepemimpinan, dan kekompakan tim.'
  },
  {
    id: 'edukasi',
    name: 'Paket Edukasi',
    price: 'mulai Rp 75.000 ,- / Orang',
    status: 'Aktif',
    image: '/assets/images/paket-edukasi-1.jpeg',
    destinasi: 'Sentra Edukasi & UMKM Desa',
    umkm: 'Tahu, Gula Jawa, Kriya Perca, Madu Klanceng',
    waNumber: '085702573013',
    facilities: [
      'Praktik langsung bersama pelaku UMKM & pemandu lokal',
      'Edukasi pengolahan tahu, gula jawa, & kriya kain perca',
      'Edukasi pertanian & budidaya lokal desa',
      'Cocok untuk rombongan sekolah, mahasiswa & instansi'
    ],
    description:
      'Paket Edukasi menawarkan pengalaman belajar langsung dari kehidupan desa yang kaya akan kearifan lokal. Pengunjung dapat mengenal proses pembuatan produk UMKM seperti tahu, kerajinan kain perca, budidaya madu klanceng, serta aktivitas pertanian tradisional.'
  }
];

function getSavedPackages() {
  const raw = localStorage.getItem(PACKAGES_STORAGE_KEY);
  if (!raw) return DEFAULT_PACKAGES_DATA;
  const parsed = safeJsonParse(raw, DEFAULT_PACKAGES_DATA);
  return Array.isArray(parsed) && parsed.length ? parsed : DEFAULT_PACKAGES_DATA;
}

function savePackages(list) {
  try {
    localStorage.setItem(PACKAGES_STORAGE_KEY, JSON.stringify(list));
  } catch (err) {
    // Ignore quota errors
  }
}

/* 8a. CMS Admin: Tambah, Edit, Upload Foto, Kelola & Hapus Paket Wisata */
function initAdminPackages() {
  const form = document.getElementById('formPaket');
  const listContainer = document.getElementById('adminPackageList');
  if (!form || !listContainer) return;

  const idInput = document.getElementById('pkgFormId');
  const nameInput = document.getElementById('pkgFormName');
  const priceInput = document.getElementById('pkgFormPrice');
  const statusSelect = document.getElementById('pkgFormStatus');
  const destInput = document.getElementById('pkgFormDest');
  const umkmInput = document.getElementById('pkgFormUmkm');
  const waInput = document.getElementById('pkgFormWa');
  const facInput = document.getElementById('pkgFormFacilities');
  const descInput = document.getElementById('pkgFormDesc');
  const photoInput = document.getElementById('pkgFormPhotoInput');
  const photoPreview = document.getElementById('pkgFormPhotoPreview');
  const photoNameLabel = document.getElementById('pkgFormPhotoName');
  const headerTitle = document.getElementById('pkgFormHeaderTitle');
  const modeBadge = document.getElementById('pkgFormModeBadge');
  const headerSub = document.getElementById('pkgFormHeaderSub');
  const btnNewPkg = document.getElementById('btnNewPackage');
  const btnCancel = document.getElementById('btnCancelEdit');
  const btnDelete = document.getElementById('btnDeleteCurrentPkg');
  const countLabel = document.getElementById('pkgCountLabel');
  const alertBox = document.getElementById('pkgFormAlert');
  const alertText = document.getElementById('pkgFormAlertText');

  let currentPhotoDataUrl = null;

  const showAlert = (msg) => {
    if (alertBox && alertText) {
      alertText.textContent = msg;
      alertBox.style.display = 'flex';
    }
  };

  const hideAlert = () => {
    if (alertBox) alertBox.style.display = 'none';
  };

  const renderAdminList = () => {
    const packages = getSavedPackages();
    if (countLabel) countLabel.textContent = `${packages.length} Paket`;

    listContainer.innerHTML = packages
      .map((pkg) => {
        const isAktif = pkg.status === 'Aktif' || pkg.status === 'Tayang';
        const badgeClass = isAktif ? 'badge-tayang' : 'badge-draf';
        const badgeText = isAktif ? 'Aktif' : 'Nonaktif';
        const imgSrc = escapeHtml(pkg.image || '/assets/images/paket-1.jpeg');
        const safeId = escapeHtml(pkg.id);
        const safeName = escapeHtml(pkg.name);
        const safePrice = escapeHtml(pkg.price);
        const safeDest = escapeHtml(pkg.destinasi || 'Desa Wisata');
        return `
          <div class="admin-item-card" data-admin-pkg-card="${safeId}">
            <div class="admin-item-left">
              <div class="admin-item-thumb" style="background-image: url('${imgSrc}'); background-size: cover; background-position: center;"></div>
              <div>
                <div class="admin-item-title">${safeName}</div>
                <div class="admin-item-sub">${safePrice} &bull; ${safeDest}</div>
              </div>
            </div>
            <div class="admin-item-right">
              <span class="${badgeClass}" data-pkg-badge>${badgeText}</span>
              <div class="admin-card-actions">
                <button type="button" class="admin-edit-link" data-edit-pkg-btn="${safeId}" style="background: none; border: none; cursor: pointer;">
                  Edit &#10095;
                </button>
                <button type="button" class="admin-delete-link" data-delete-pkg-btn="${safeId}">Hapus</button>
              </div>
            </div>
          </div>
        `;
      })
      .join('');

    // Re-bind click event on edit buttons
    listContainer.querySelectorAll('[data-edit-pkg-btn]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const pkgId = btn.getAttribute('data-edit-pkg-btn');
        loadPackageIntoForm(pkgId);
      });
    });

    // Re-bind delete event
    listContainer.querySelectorAll('[data-delete-pkg-btn]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const pkgId = btn.getAttribute('data-delete-pkg-btn');
        const packages = getSavedPackages();
        const target = packages.find((p) => p.id === pkgId);
        const name = target ? target.name : 'Paket ini';
        showDeleteConfirmPopup(name, () => {
          const updated = packages.filter((p) => p.id !== pkgId);
          savePackages(updated);
          renderAdminList();
          if (idInput && idInput.value === pkgId) {
            resetFormToNew();
          }
          showCustomPopup('Paket Dihapus', `"${name}" berhasil dihapus dari daftar paket.`, 'Tutup');
        });
      });
    });
  };

  const loadPackageIntoForm = (pkgId) => {
    hideAlert();
    const packages = getSavedPackages();
    const pkg = packages.find((p) => p.id === pkgId);
    if (!pkg) return;

    if (idInput) idInput.value = pkg.id;
    if (nameInput) nameInput.value = pkg.name;
    if (priceInput) priceInput.value = pkg.price;
    if (statusSelect) {
      statusSelect.value = (pkg.status === 'Aktif' || pkg.status === 'Tayang') ? 'Aktif' : 'Nonaktif';
      syncCustomSelect(statusSelect);
    }
    if (destInput) {
      destInput.value = pkg.destinasi || 'Wahana Edukasi & Outbound Candi';
      syncCustomSelect(destInput);
    }
    if (umkmInput) umkmInput.value = pkg.umkm || '';
    if (waInput) waInput.value = pkg.waNumber || '0857 0257 3013';
    if (facInput) facInput.value = Array.isArray(pkg.facilities) ? pkg.facilities.join('\n') : (pkg.facilities || '');
    if (descInput) descInput.value = pkg.description || '';

    currentPhotoDataUrl = pkg.image || null;
    if (photoPreview) {
      photoPreview.src = pkg.image || '/assets/images/paket-1.jpeg';
    }
    if (photoNameLabel) {
      photoNameLabel.textContent = pkg.image ? 'Foto paket terpasang' : 'Belum ada foto';
    }

    if (headerTitle) headerTitle.textContent = 'Edit Paket Wisata';
    if (modeBadge) {
      const isAktif = pkg.status === 'Aktif' || pkg.status === 'Tayang';
      modeBadge.textContent = isAktif ? 'Mode: Edit Paket (Aktif)' : 'Mode: Edit Paket (Nonaktif)';
      modeBadge.className = isAktif ? 'badge-category' : 'badge-sembunyi';
    }
    if (headerSub) headerSub.textContent = `Mengubah data "${pkg.name}".`;
    if (btnCancel) btnCancel.style.display = 'inline-block';
    if (btnDelete) btnDelete.style.display = 'inline-block';

    form.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  const resetFormToNew = () => {
    hideAlert();
    if (idInput) idInput.value = 'new_' + Date.now();
    if (nameInput) {
      nameInput.value = '';
      nameInput.focus();
    }
    if (priceInput) priceInput.value = 'mulai Rp 50.000 ,- / Orang';
    if (statusSelect) {
      statusSelect.value = 'Aktif';
      syncCustomSelect(statusSelect);
    }
    if (destInput) {
      destInput.selectedIndex = 0;
      syncCustomSelect(destInput);
    }
    if (umkmInput) umkmInput.value = '';
    if (waInput) waInput.value = '0857 0257 3013';
    if (facInput) facInput.value = '';
    if (descInput) descInput.value = '';

    currentPhotoDataUrl = null;
    if (photoPreview) photoPreview.src = '/assets/images/paket-1.jpeg';
    if (photoNameLabel) photoNameLabel.textContent = 'Gunakan foto default atau upload foto baru';
    if (photoInput) photoInput.value = '';

    if (headerTitle) headerTitle.textContent = 'Tambah Paket Baru';
    if (modeBadge) {
      modeBadge.textContent = 'Mode: Tambah Paket Baru';
      modeBadge.className = 'badge-tayang';
    }
    if (headerSub) headerSub.textContent = 'Lengkapi data untuk menambahkan paket wisata baru ke website.';
    if (btnCancel) btnCancel.style.display = 'inline-block';
    if (btnDelete) btnDelete.style.display = 'none';
  };

  // Bind Photo Upload
  if (photoInput) {
    photoInput.addEventListener('change', () => {
      const file = photoInput.files && photoInput.files[0];
      if (!file) return;

      const maxBytes = 5 * 1024 * 1024; // 5 MB
      if (file.size > maxBytes) {
        showAlert('Ukuran file foto melebihi batas 5 MB.');
        photoInput.value = '';
        return;
      }

      hideAlert();
      const reader = new FileReader();
      reader.onload = (ev) => {
        if (ev.target && ev.target.result) {
          currentPhotoDataUrl = ev.target.result;
          if (photoPreview) photoPreview.src = ev.target.result;
        }
      };
      reader.readAsDataURL(file);

      if (photoNameLabel) {
        photoNameLabel.textContent = `File dipilih: ${file.name} (${(file.size / 1024).toFixed(0)} KB)`;
      }
      showCustomPopup('Foto Terpilih', `Foto "${file.name}" berhasil diunggah untuk paket ini.`, 'Lanjutkan');
    });
  }

  if (statusSelect) {
    statusSelect.addEventListener('change', () => {
      const isAktif = statusSelect.value === 'Aktif' || statusSelect.value === 'Tayang';
      if (modeBadge) {
        modeBadge.textContent = isAktif ? 'Mode: Edit Paket (Aktif)' : 'Mode: Edit Paket (Nonaktif)';
        modeBadge.className = isAktif ? 'badge-category' : 'badge-sembunyi';
      }
    });
  }

  if (btnNewPkg) btnNewPkg.addEventListener('click', resetFormToNew);
  if (btnCancel) btnCancel.addEventListener('click', () => {
    const packages = getSavedPackages();
    if (packages.length) {
      loadPackageIntoForm(packages[0].id);
    } else {
      resetFormToNew();
    }
  });

  if (btnDelete) {
    btnDelete.addEventListener('click', () => {
      const pkgId = idInput ? idInput.value : '';
      if (!pkgId || pkgId.startsWith('new_')) {
        resetFormToNew();
        return;
      }
      const packages = getSavedPackages();
      const target = packages.find((p) => p.id === pkgId);
      const name = target ? target.name : 'Paket ini';
      showDeleteConfirmPopup(name, () => {
        const updated = packages.filter((p) => p.id !== pkgId);
        savePackages(updated);
        renderAdminList();
        if (updated.length) {
          loadPackageIntoForm(updated[0].id);
        } else {
          resetFormToNew();
        }
        showCustomPopup('Paket Dihapus', `"${name}" berhasil dihapus dari CMS.`, 'Tutup');
      });
    });
  }

  // Handle Submit Save
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    hideAlert();

    const name = nameInput ? nameInput.value.trim() : '';
    const price = priceInput ? priceInput.value.trim() : '';
    const status = statusSelect ? statusSelect.value : 'Aktif';
    const destinasi = destInput ? destInput.value.trim() : '';
    const umkm = umkmInput ? umkmInput.value.trim() : '';
    const waNumber = waInput ? waInput.value.trim() : '0857 0257 3013';
    const description = descInput ? descInput.value.trim() : '';
    const rawFac = facInput ? facInput.value.trim() : '';
    const facilities = rawFac
      .split('\n')
      .map((s) => s.trim())
      .filter(Boolean);

    if (!name) {
      showAlert('Nama paket wisata wajib diisi.');
      nameInput && nameInput.focus();
      return;
    }
    if (!price) {
      showAlert('Harga paket wisata wajib diisi.');
      priceInput && priceInput.focus();
      return;
    }

    const packages = getSavedPackages();
    let pkgId = idInput ? idInput.value : '';
    const isNew = !pkgId || pkgId.startsWith('new_');

    if (isNew) {
      pkgId = 'pkg_' + Date.now();
    }

    const payload = {
      id: pkgId,
      name,
      price,
      status,
      image: currentPhotoDataUrl || (isNew ? '/assets/images/paket-1.jpeg' : '/assets/images/paket-1.jpeg'),
      destinasi,
      umkm,
      waNumber,
      facilities: facilities.length ? facilities : ['Fasilitas & edukasi BUMDes Karangkemiri'],
      description
    };

    if (isNew) {
      packages.push(payload);
    } else {
      const idx = packages.findIndex((p) => p.id === pkgId);
      if (idx !== -1) {
        if (!currentPhotoDataUrl && packages[idx].image) {
          payload.image = packages[idx].image;
        }
        packages[idx] = payload;
      } else {
        packages.push(payload);
      }
    }

    savePackages(packages);
    renderAdminList();
    loadPackageIntoForm(pkgId);

    showCustomPopup(
      'Berhasil Disimpan',
      `Paket "${name}" berhasil disimpan dengan status ${status}! Perubahan langsung aktif di website publik.`,
      'Oke, Mengerti'
    );
  });

  // Initial load
  renderAdminList();
  const initialPackages = getSavedPackages();
  if (initialPackages.length) {
    loadPackageIntoForm(initialPackages[0].id);
  }
}

/* 8b. Halaman Publik: Render Paket Aktif dari CMS */
function initPublicPackages() {
  const container = document.getElementById('publicPackageList');
  if (!container) return;

  const packages = getSavedPackages();
  // Filter HANYA paket yang berstatus Aktif
  const activePackages = packages.filter((p) => p.status === 'Aktif' || p.status === 'Tayang');

  if (!activePackages.length) {
    container.innerHTML = `
      <div class="admin-panel-card empty-state-card" style="text-align: center; padding: 40px 20px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <h3 style="font-size: 18px; font-weight: 800; color: var(--text-dark); margin-bottom: 8px;">Belum Ada Paket Wisata Aktif</h3>
        <p style="color: var(--text-muted); font-size: 14px; max-width: 520px; margin: 0 auto 16px; line-height: 1.6;">Silakan hubungi pengelola BUMDesa Mandiri Sejahtera untuk informasi pemesanan khusus.</p>
        <a href="https://wa.me/6285702573013?text=Halo%20BUMDesa%20Karangkemiri%2C%20saya%20ingin%20menanyakan%20paket%20wisata." target="_blank" rel="noopener" class="btn-empty-state-wa">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/>
          </svg>
          <span>Hubungi BUMDes via WhatsApp</span>
        </a>
      </div>
    `;
    return;
  }

  container.innerHTML = activePackages
    .map((pkg) => {
      const cleanWa = (pkg.waNumber || '6285702573013').replace(/\D/g, '').replace(/^0/, '62');
      const waText = encodeURIComponent(`Halo Admin, saya mau reservasi *${pkg.name}* Desa Wisata Karangkemiri.`);
      const imgSrc = pkg.image || '/assets/images/paket-1.jpeg';
      const tagText = pkg.name.toLowerCase().includes('outbound')
        ? 'Outbound'
        : pkg.name.toLowerCase().includes('edukasi')
        ? 'Edukasi'
        : 'Wisata';

      const facilitiesHtml = Array.isArray(pkg.facilities)
        ? pkg.facilities.map((fac) => `<li>${escapeHtml(fac)}</li>`).join('')
        : `<li>${escapeHtml(pkg.facilities)}</li>`;

      const destHtml = pkg.destinasi
        ? `<span class="meta-tag-small">${escapeHtml(pkg.destinasi)}</span>`
        : '';
      const umkmHtml = pkg.umkm
        ? `<span class="meta-tag-small" style="background-color: var(--green-soft); color: var(--green-dark);">UMKM: ${escapeHtml(pkg.umkm)}</span>`
        : '';

      const safeId = escapeHtml(pkg.id);
      const safeName = escapeHtml(pkg.name);
      const safePrice = escapeHtml(pkg.price);
      const safeDesc = escapeHtml(pkg.description || '');

      return `
        <div style="display: flex; flex-direction: column; gap: 14px;" data-public-pkg="${safeId}">
          <div class="horiz-card pkg-card" style="flex: 1;">
            <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('${imgSrc}'); background-size: cover; background-position: center;">
              <span>${escapeHtml(tagText)}</span>
            </div>
            <div class="card-body">
              <div>
                <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 8px;">
                  ${destHtml}
                  ${umkmHtml}
                </div>
                <h2 class="card-title">${safeName}</h2>
                <p class="card-subtitle">
                  ${safeDesc}
                </p>
                <ul class="pkg-checklist">
                  ${facilitiesHtml}
                </ul>
              </div>
              <div class="pkg-price-footer">
                <span class="price-tag">${safePrice}</span>
              </div>
            </div>
          </div>

          <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <button type="button" class="btn-admin-secondary" data-view-pkg-detail="${safeId}" style="padding: 12px 20px; border-radius: 99px; font-weight: 700; font-size: 14px;">
              Lihat Detail &amp; Fasilitas
            </button>
            <a href="${sanitizeUrl(`https://wa.me/${cleanWa}?text=${waText}`)}" target="_blank" rel="noopener noreferrer" class="btn-cta-green" style="flex: 1;">
              <span>Reservasi via WhatsApp</span>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/>
              </svg>
            </a>
          </div>
        </div>
      `;
    })
    .join('');

  // Bind tombol Lihat Detail & Fasilitas (Modal Terstruktur & Rapi)
  const bindDetailBtns = (parentEl) => {
    if (!parentEl) return;
    parentEl.querySelectorAll('[data-view-pkg-detail]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-view-pkg-detail');
        const pkgs = getSavedPackages();
        const p = pkgs.find((item) => item.id === id);
        if (!p) return;
        openPackageDetailModal(p);
      });
    });
  };

  bindDetailBtns(container);
  bindDetailBtns(document);
}

/* =========================================================
   9. MODUL KONTAK & LOKASI (CMS & PUBLIK)
   Sesuai Checklist:
   - Pengaturan informasi kontak BUMDes pada CMS
   - Perubahan nomor WhatsApp utama
   - Pengaturan tautan Google Maps (Navigasi & Embed)
   - Pengaturan tautan Media Sosial (Instagram, Facebook, TikTok, YouTube)
   - Integrasi tombol WhatsApp & Peta pada website publik
   - Sinkronisasi otomatis ke website publik tanpa ubah kode
   ========================================================= */

const CONTACT_STORAGE_KEY = 'cms_kontak_data';

const DEFAULT_CONTACT_DATA = {
  address: 'Karang Jengkol, Karangkemiri, Kec. Karanglewas, Kabupaten Banyumas, Jawa Tengah 53161',
  whatsapp: '0857 0257 3013',
  email: 'mandirisejahtera.karangkemiri@gmail.com',
  hours: 'Senin – Minggu, 08:00 – 17:00 WIB (Konfirmasi Rombongan)',
  mapsUrl: 'https://maps.app.goo.gl/VF9FUXXkzUoiD7YT8',
  mapsEmbed: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.489368405458!2d109.1782712!3d-7.410963700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65609ae8b98401%3A0xac573850d62e937c!2sWahana%20Edukasi%20%26%20Outbond%20CANDI!5e0!3m2!1sid!2sid!4v1787295836593!5m2!1sid!2sid',
  socials: {
    instagram: 'https://instagram.com/desawisatakarangkemiri',
    facebook: 'https://facebook.com/desawisatakarangkemiri',
    tiktok: 'https://tiktok.com/@desawisatakarangkemiri',
    youtube: 'https://youtube.com/@desawisatakarangkemiri'
  }
};

function getSavedContact() {
  try {
    const raw = localStorage.getItem(CONTACT_STORAGE_KEY);
    if (!raw) {
      return {
        ...DEFAULT_CONTACT_DATA,
        socials: { ...DEFAULT_CONTACT_DATA.socials }
      };
    }
    const parsed = JSON.parse(raw);
    return {
      ...DEFAULT_CONTACT_DATA,
      ...parsed,
      socials: {
        ...DEFAULT_CONTACT_DATA.socials,
        ...(parsed.socials || {})
      }
    };
  } catch (err) {
    console.error('Gagal membaca data kontak dari localStorage:', err);
    return {
      ...DEFAULT_CONTACT_DATA,
      socials: { ...DEFAULT_CONTACT_DATA.socials }
    };
  }
}

function saveContact(data) {
  try {
    localStorage.setItem(CONTACT_STORAGE_KEY, JSON.stringify(data));
    return true;
  } catch (err) {
    console.error('Gagal menyimpan data kontak ke localStorage:', err);
    return false;
  }
}

function cleanWhatsAppNumber(num) {
  if (!num) return '6285702573013';
  let cleaned = String(num).replace(/\D/g, '');
  if (cleaned.startsWith('0')) {
    cleaned = '62' + cleaned.slice(1);
  } else if (!cleaned.startsWith('62')) {
    cleaned = '62' + cleaned;
  }
  return cleaned;
}

function formatMapsEmbedUrl(embedUrl, directUrl) {
  if (embedUrl && (embedUrl.includes('maps/embed') || embedUrl.includes('output=embed'))) {
    return embedUrl;
  }
  if (directUrl) {
    if (directUrl.includes('maps/embed') || directUrl.includes('output=embed')) {
      return directUrl;
    }
    return `https://maps.google.com/maps?q=${encodeURIComponent(directUrl)}&t=&z=16&ie=UTF8&iwloc=&output=embed`;
  }
  return DEFAULT_CONTACT_DATA.mapsEmbed;
}

/* 9a. Panel Admin: Kelola Kontak & Lokasi */
function initAdminContact() {
  const form = document.getElementById('adminContactForm');
  if (!form) return;

  const addrInput = document.getElementById('contactAddr');
  const waInput = document.getElementById('contactWa');
  const emailInput = document.getElementById('contactEmail');
  const hoursInput = document.getElementById('contactHours');
  const mapUrlInput = document.getElementById('contactMapUrl');
  const mapEmbedInput = document.getElementById('contactMapEmbed');
  const igInput = document.getElementById('contactIg');
  const fbInput = document.getElementById('contactFb');
  const tiktokInput = document.getElementById('contactTiktok');
  const ytInput = document.getElementById('contactYoutube');

  const previewIframe = document.getElementById('adminMapPreviewIframe');
  const openMapBtn = document.getElementById('adminOpenMapBtn');
  const testWaBtn = document.getElementById('adminTestWaBtn');
  const waSummary = document.getElementById('adminWaSummary');
  const emailSummary = document.getElementById('adminEmailSummary');
  const hoursSummary = document.getElementById('adminHoursSummary');
  const socialsSummary = document.getElementById('adminSocialsSummary');
  const btnReset = document.getElementById('btnResetContact');

  const populateForm = (data) => {
    if (addrInput) addrInput.value = data.address || '';
    if (waInput) waInput.value = data.whatsapp || '';
    if (emailInput) emailInput.value = data.email || '';
    if (hoursInput) hoursInput.value = data.hours || '';
    if (mapUrlInput) mapUrlInput.value = data.mapsUrl || '';
    if (mapEmbedInput) mapEmbedInput.value = data.mapsEmbed || '';

    const socials = data.socials || {};
    if (igInput) igInput.value = socials.instagram || '';
    if (fbInput) fbInput.value = socials.facebook || '';
    if (tiktokInput) tiktokInput.value = socials.tiktok || '';
    if (ytInput) ytInput.value = socials.youtube || '';

    updateLivePreview();
  };

  const updateLivePreview = () => {
    const waVal = waInput ? waInput.value.trim() : '';
    const emailVal = emailInput ? emailInput.value.trim() : '';
    const hoursVal = hoursInput ? hoursInput.value.trim() : '';
    const mapUrlVal = mapUrlInput ? mapUrlInput.value.trim() : '';
    const mapEmbedVal = mapEmbedInput ? mapEmbedInput.value.trim() : '';

    const igVal = igInput ? igInput.value.trim() : '';
    const fbVal = fbInput ? fbInput.value.trim() : '';
    const tiktokVal = tiktokInput ? tiktokInput.value.trim() : '';
    const ytVal = ytInput ? ytInput.value.trim() : '';

    if (waSummary) waSummary.textContent = waVal || '-';
    if (emailSummary) emailSummary.textContent = emailVal || '-';
    if (hoursSummary) hoursSummary.textContent = hoursVal || '-';

    const activeSocials = [];
    if (igVal) activeSocials.push('Instagram');
    if (fbVal) activeSocials.push('Facebook');
    if (tiktokVal) activeSocials.push('TikTok');
    if (ytVal) activeSocials.push('YouTube');
    if (socialsSummary) {
      socialsSummary.textContent = activeSocials.length ? activeSocials.join(', ') : 'Belum ada akun media sosial';
    }

    if (testWaBtn) {
      const cleanWa = cleanWhatsAppNumber(waVal);
      testWaBtn.href = `https://wa.me/${cleanWa}?text=${encodeURIComponent('Halo Admin BUMDes Karangkemiri, saya menguji nomor WhatsApp utama.')}`;
    }

    if (openMapBtn) {
      openMapBtn.href = mapUrlVal || 'https://maps.google.com';
    }

    if (previewIframe) {
      const targetEmbed = formatMapsEmbedUrl(mapEmbedVal, mapUrlVal);
      if (previewIframe.src !== targetEmbed) {
        previewIframe.src = targetEmbed;
      }
    }
  };

  // Live preview update saat admin mengetik
  [addrInput, waInput, emailInput, hoursInput, mapUrlInput, mapEmbedInput, igInput, fbInput, tiktokInput, ytInput]
    .filter(Boolean)
    .forEach((input) => {
      input.addEventListener('input', updateLivePreview);
    });

  // Tampilkan data yang tersimpan saat pertama kali halaman dibuka
  const currentData = getSavedContact();
  populateForm(currentData);

  // Tombol Reset ke Pengaturan Default
  if (btnReset) {
    btnReset.addEventListener('click', () => {
      if (confirm('Apakah Anda yakin ingin mengembalikan seluruh informasi kontak & lokasi ke data asli Karangkemiri?')) {
        saveContact(DEFAULT_CONTACT_DATA);
        populateForm(DEFAULT_CONTACT_DATA);
        showCustomPopup(
          'Reset Selesai',
          'Informasi kontak dan tautan lokasi telah dikembalikan ke pengaturan awal Karangkemiri.',
          'Selesai'
        );
      }
    });
  }

  // Handle Form Submit
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const newData = {
      address: addrInput ? addrInput.value.trim() : DEFAULT_CONTACT_DATA.address,
      whatsapp: waInput ? waInput.value.trim() : DEFAULT_CONTACT_DATA.whatsapp,
      email: emailInput ? emailInput.value.trim() : DEFAULT_CONTACT_DATA.email,
      hours: hoursInput ? hoursInput.value.trim() : DEFAULT_CONTACT_DATA.hours,
      mapsUrl: mapUrlInput ? mapUrlInput.value.trim() : DEFAULT_CONTACT_DATA.mapsUrl,
      mapsEmbed: mapEmbedInput ? mapEmbedInput.value.trim() : DEFAULT_CONTACT_DATA.mapsEmbed,
      socials: {
        instagram: igInput ? igInput.value.trim() : '',
        facebook: fbInput ? fbInput.value.trim() : '',
        tiktok: tiktokInput ? tiktokInput.value.trim() : '',
        youtube: ytInput ? ytInput.value.trim() : ''
      }
    };

    saveContact(newData);
    updateLivePreview();

    // Tampilkan notifikasi popup berhasil
    showCustomPopup(
      'Kontak Berhasil Disimpan!',
      'Pengaturan informasi kontak, tautan Google Maps, nomor WhatsApp utama, dan media sosial berhasil diperbarui dan langsung tampil di website publik.',
      'Selesai'
    );
  });
}

/* 9b. Halaman Publik: Tampilkan Kontak, WhatsApp, Medsos & Peta Interaktif */
function initPublicContact() {
  const contact = getSavedContact();
  const cleanWa = cleanWhatsAppNumber(contact.whatsapp);
  const waGreeting = encodeURIComponent('Halo Admin BUMDesa Karangkemiri, saya mau bertanya seputar kunjungan/reservasi.');

  // 1. Alamat
  const addrLink = document.getElementById('pubContactAddrLink');
  const addrText = document.getElementById('pubContactAddrText');
  if (addrText) addrText.textContent = contact.address;
  if (addrLink) addrLink.href = contact.mapsUrl || 'https://maps.google.com';

  // 2. WhatsApp Item
  const waLink = document.getElementById('pubContactWaLink');
  const waText = document.getElementById('pubContactWaText');
  if (waText) waText.textContent = `${contact.whatsapp} (Reservasi & Informasi Wisata)`;
  if (waLink) waLink.href = `https://wa.me/${cleanWa}?text=${waGreeting}`;

  // 3. Email Item
  const emailLink = document.getElementById('pubContactEmailLink');
  const emailText = document.getElementById('pubContactEmailText');
  if (emailText) emailText.textContent = contact.email;
  if (emailLink) emailLink.href = `mailto:${contact.email}`;

  // 4. Jam Operasional
  const hoursText = document.getElementById('pubContactHoursText');
  if (hoursText) hoursText.textContent = contact.hours;

  // 5. Media Sosial Section
  const socialsContainer = document.getElementById('pubContactSocials');
  if (socialsContainer) {
    const s = contact.socials || {};
    const socialItems = [
      {
        name: 'Instagram',
        url: s.instagram,
        handle: '@desawisatakarangkemiri',
        icon: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>'
      },
      {
        name: 'Facebook',
        url: s.facebook,
        handle: 'Desa Wisata Karangkemiri',
        icon: '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>'
      },
      {
        name: 'TikTok',
        url: s.tiktok,
        handle: '@desawisatakarangkemiri',
        icon: '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.89 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.35 0 .68.06 1 .16V9.32a6.34 6.34 0 0 0-1-.08A6.34 6.34 0 0 0 3 15.58a6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V8.5a8.31 8.31 0 0 0 4.91 1.6V6.69z"></path></svg>'
      },
      {
        name: 'YouTube',
        url: s.youtube,
        handle: 'Desa Wisata Karangkemiri',
        icon: '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.43z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#FFFFFF"></polygon></svg>'
      }
    ];

    const validSocials = socialItems.filter((item) => !!item.url);
    if (validSocials.length) {
      socialsContainer.innerHTML = validSocials
        .map(
          (item) => `
          <a href="${sanitizeUrl(item.url)}" target="_blank" rel="noopener noreferrer" class="contact-social-btn" title="Buka ${escapeHtml(item.name)} Desa Wisata Karangkemiri">
            <span class="contact-social-icon">${item.icon}</span>
            <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
              <div>${escapeHtml(item.name)}</div>
              <div style="font-size: 11px; color: var(--text-muted); font-weight: 400;">Buka Profil</div>
            </div>
          </a>
        `
        )
        .join('');
    } else {
      socialsContainer.innerHTML = `
        <div style="font-size: 13px; color: var(--text-muted); font-style: italic; padding: 4px 0;">
          Tautan media sosial sedang dalam pembaruan oleh pengelola.
        </div>
      `;
    }
  }

  // 6. Google Maps Iframe & Button
  const mapIframe = document.getElementById('pubContactMapIframe');
  const mapBtn = document.getElementById('pubContactMapBtn');
  if (mapIframe) {
    const embedSrc = formatMapsEmbedUrl(contact.mapsEmbed, contact.mapsUrl);
    mapIframe.src = embedSrc;
  }
  if (mapBtn) {
    mapBtn.href = contact.mapsUrl || 'https://maps.google.com';
  }

  // 7. Tombol CTA WhatsApp Utama Publik
  const ctaWaBtn = document.getElementById('pubContactWaBtn');
  if (ctaWaBtn) {
    ctaWaBtn.href = `https://wa.me/${cleanWa}?text=${waGreeting}`;
  }

  // 8. Sinkronisasi Kontak di Footer Seluruh Halaman Website Publik
  const footerAddr = document.getElementById('footerContactAddr');
  const footerWa = document.getElementById('footerContactWa');
  const footerEmail = document.getElementById('footerContactEmail');
  if (footerAddr) footerAddr.textContent = contact.address;
  if (footerWa) {
    footerWa.textContent = `WhatsApp: ${contact.whatsapp}`;
    footerWa.href = `https://wa.me/${cleanWa}?text=${encodeURIComponent('Halo BUMDesa Mandiri Sejahtera Desa Wisata Karangkemiri, saya mau bertanya.')}`;
  }
  if (footerEmail) {
    footerEmail.textContent = contact.email;
    footerEmail.href = `mailto:${contact.email}`;
  }
}

/* =========================================================
   10. MODUL KATALOG & PROFIL UMKM (CMS & PUBLIK)
   Sesuai Checklist:
   - Fitur tambah dan edit profil UMKM (Alamat, WhatsApp, Jam Buka)
   - Tambah, edit, dan nonaktifkan produk (Relasi 1 UMKM : Banyak Produk)
   - Pengelolaan foto serta harga produk
   - Tampilkan katalog UMKM dan produk pada website publik
   ========================================================= */

const UMKM_PROFILES_KEY = 'cms_umkm_profiles_data';
const UMKM_PRODUCTS_KEY = 'cms_umkm_products_data';

const DEFAULT_UMKM_PROFILES = [
  {
    id: 'umkm_sari_kedelai',
    name: 'UMKM Sari Kedelai',
    owner: 'Ibu Siti Khodijah & Bpk. Slamet',
    category: 'Makanan olahan',
    address: 'RT 03 / RW 01 Dusun Karang Jengkol, Desa Karangkemiri, Kec. Karanglewas',
    whatsapp: '0857 0257 3013',
    hours: 'Setiap Hari, 07:00 – 17:00 WIB',
    description: 'Produsen tahu tradisional khas Karangkemiri yang menggunakan kedelai pilihan dan resep turun-temurun tanpa bahan pengawet.'
  },
  {
    id: 'umkm_nira_lestari',
    name: 'UMKM Nira Lestari',
    owner: 'Bpk. Sutarman',
    category: 'Produk lokal',
    address: 'RT 01 / RW 02 Dusun Candi, Desa Karangkemiri, Kec. Karanglewas',
    whatsapp: '0857 0257 3013',
    hours: 'Senin – Sabtu, 08:00 – 16:30 WIB',
    description: 'Pengrajin gula kelapa murni, gula jawa cetak, dan gula semut aren higienis yang dihasilkan langsung dari penderes lokal desa.'
  },
  {
    id: 'umkm_griya_kriya',
    name: 'UMKM Griya Kriya Perca',
    owner: 'Ibu Daryati & Kelompok PKK Karangkemiri',
    category: 'Kerajinan tangan',
    address: 'RW 03 Dusun Karang Jengkol, Desa Karangkemiri, Kec. Karanglewas',
    whatsapp: '0857 0257 3013',
    hours: 'Senin – Jumat, 09:00 – 16:00 WIB',
    description: 'Sentra ekonomi kreatif pengolahan limbah kain perca menjadi tas jinjing, dompet, taplak meja, dan aneka cinderamata etnik desa.'
  },
  {
    id: 'umkm_lebah_klanceng',
    name: 'Kelompok Tani Lebah Klanceng',
    owner: 'Bpk. Rasam & Petani Klanceng',
    category: 'Hasil pertanian',
    address: 'Kawasan Wisata Candi, Desa Karangkemiri, Kec. Karanglewas',
    whatsapp: '0857 0257 3013',
    hours: 'Setiap Hari, 08:00 – 17:00 WIB',
    description: 'Budidaya lebah tanpa sengat (Trigona/Klanceng) menghasilkan madu murni kaya propolis dan antioksidan berkhasiat tinggi.'
  }
];

const DEFAULT_UMKM_PRODUCTS = [
  {
    id: 'prod_tahu_karangkemiri',
    umkmId: 'umkm_sari_kedelai',
    name: 'Tahu Karangkemiri Super',
    category: 'makanan',
    price: 'Rp 10.000 / besek',
    status: 'Tayang',
    image: '/assets/images/paket-1.jpeg',
    description: 'Tahu putih segar lembut bertekstur padat, diproduksi setiap subuh dari kedelai murni pilihan.'
  },
  {
    id: 'prod_keripik_tahu',
    umkmId: 'umkm_sari_kedelai',
    name: 'Keripik Tahu Gurih',
    category: 'makanan',
    price: 'Rp 15.000 / bungkus',
    status: 'Tayang',
    image: '/assets/images/paket-edukasi-1.jpeg',
    description: 'Keripik tahu renyah bumbu rempah alami, cocok sebagai cemilan dan oleh-oleh khas kunjungan wisata.'
  },
  {
    id: 'prod_gula_jawa',
    umkmId: 'umkm_nira_lestari',
    name: 'Gula Jawa Cetak Asli',
    category: 'makanan',
    price: 'Rp 22.000 / kg',
    status: 'Tayang',
    image: '/assets/images/whatsapp-image-2025-12-30-at-16.55.33.jpeg',
    description: 'Gula kelapa murni tanpa campuran bahan kimia sintetik, beraroma harum legit khas penderes Banyumas.'
  },
  {
    id: 'prod_gula_semut',
    umkmId: 'umkm_nira_lestari',
    name: 'Gula Semut Aren Kristal',
    category: 'makanan',
    price: 'Rp 28.000 / toples',
    status: 'Tayang',
    image: '/assets/images/candi.png',
    description: 'Gula semut kering mudah larut, sangat cocok untuk pemanis kopi, teh, dan aneka minuman herbal.'
  },
  {
    id: 'prod_kain_perca_tas',
    umkmId: 'umkm_griya_kriya',
    name: 'Tas Jinjing Kain Perca',
    category: 'kerajinan',
    price: 'Rp 45.000 / pcs',
    status: 'Tayang',
    image: '/assets/images/sadranan.jpeg',
    description: 'Tas tote bag ramah lingkungan karya tangan ibu-ibu PKK desa dengan kombinasi motif kain perca artistik.'
  },
  {
    id: 'prod_kain_perca_bros',
    umkmId: 'umkm_griya_kriya',
    name: 'Bros & Souvenir Etnik',
    category: 'kerajinan',
    price: 'Rp 5.000 / pcs',
    status: 'Tayang',
    image: '/assets/images/desa-wisata-karangkemiri-2.jpeg',
    description: 'Cinderamata bros hijab dan gantungan kunci etnik cantik untuk kenang-kenangan study tour.'
  },
  {
    id: 'prod_madu_klanceng',
    umkmId: 'umkm_lebah_klanceng',
    name: 'Madu Klanceng Murni 250ml',
    category: 'tani',
    price: 'Rp 85.000 / botol',
    status: 'Tayang',
    image: '/assets/images/camping-ground.jpeg',
    description: 'Madu murni lebah Klanceng dengan rasa asam manis segar khas, dipanen langsung dari sarang vegetasi asri desa.'
  }
];

function getSavedUmkmProfiles() {
  const raw = localStorage.getItem(UMKM_PROFILES_KEY);
  return safeJsonParse(raw, DEFAULT_UMKM_PROFILES);
}

function saveUmkmProfiles(profiles) {
  try {
    localStorage.setItem(UMKM_PROFILES_KEY, JSON.stringify(profiles));
    return true;
  } catch (err) {
    console.error('Gagal menyimpan data profil UMKM:', err);
    return false;
  }
}

function getSavedUmkmProducts() {
  const raw = localStorage.getItem(UMKM_PRODUCTS_KEY);
  return safeJsonParse(raw, DEFAULT_UMKM_PRODUCTS);
}

function saveUmkmProducts(products) {
  try {
    localStorage.setItem(UMKM_PRODUCTS_KEY, JSON.stringify(products));
    return true;
  } catch (err) {
    console.error('Gagal menyimpan data produk UMKM:', err);
    return false;
  }
}

/* 10a. Panel Admin: Kelola Produk & Profil UMKM */
function initAdminUMKM() {
  const tabBtnProducts = document.getElementById('tabBtnProducts');
  const tabBtnProfiles = document.getElementById('tabBtnProfiles');
  const tabContentProducts = document.getElementById('tabContentProducts');
  const tabContentProfiles = document.getElementById('tabContentProfiles');

  if (!tabBtnProducts || !tabBtnProfiles) return;

  // 1. Tab Switching
  tabBtnProducts.addEventListener('click', () => {
    tabBtnProducts.classList.add('active');
    tabBtnProducts.setAttribute('aria-selected', 'true');
    tabBtnProfiles.classList.remove('active');
    tabBtnProfiles.setAttribute('aria-selected', 'false');
    if (tabContentProducts) tabContentProducts.style.display = 'block';
    if (tabContentProfiles) tabContentProfiles.style.display = 'none';
  });

  tabBtnProfiles.addEventListener('click', () => {
    tabBtnProfiles.classList.add('active');
    tabBtnProfiles.setAttribute('aria-selected', 'true');
    tabBtnProducts.classList.remove('active');
    tabBtnProducts.setAttribute('aria-selected', 'false');
    if (tabContentProfiles) tabContentProfiles.style.display = 'block';
    if (tabContentProducts) tabContentProducts.style.display = 'none';
  });

  // ==========================================
  // BAGIAN A: PENGELOLAAN PRODUK UMKM
  // ==========================================
  const productsListContainer = document.getElementById('adminProductsListContainer');
  const filterUmkmSelect = document.getElementById('adminFilterProductByUmkm');
  const formProduct = document.getElementById('formUMKMProduct');
  const btnNewProduct = document.getElementById('btnNewProduct');
  const btnCancelProductEdit = document.getElementById('btnCancelProductEdit');
  const btnDeleteProduct = document.getElementById('btnDeleteProduct');

  const prodIdInput = document.getElementById('prodFormId');
  const prodUmkmInput = document.getElementById('prodFormUmkmId');
  const prodNameInput = document.getElementById('prodFormName');
  const prodCatInput = document.getElementById('prodFormCat');
  const prodStatusInput = document.getElementById('prodFormStatus');
  const prodPriceInput = document.getElementById('prodFormPrice');
  const prodPhotoInput = document.getElementById('prodFormPhotoInput');
  const prodPhotoPreview = document.getElementById('prodFormPhotoPreview');
  const prodPhotoLabel = document.getElementById('prodFormPhotoLabel');
  const prodDescInput = document.getElementById('prodFormDesc');
  const prodHeaderTitle = document.getElementById('prodFormHeaderTitle');
  const prodHeaderSub = document.getElementById('prodFormHeaderSub');
  const prodModeBadge = document.getElementById('prodFormModeBadge');

  let currentProductPhotoUrl = null;

  // Isi dropdown UMKM di form produk & filter
  const refreshUmkmSelectOptions = () => {
    const profiles = getSavedUmkmProfiles();
    if (prodUmkmInput) {
      const currentVal = prodUmkmInput.value;
      prodUmkmInput.innerHTML = profiles
        .map((p) => `<option value="${escapeHtml(p.id)}">${escapeHtml(p.name)} (${escapeHtml(p.owner)})</option>`)
        .join('');
      if (currentVal && profiles.some((p) => p.id === currentVal)) {
        prodUmkmInput.value = currentVal;
      }
    }

    if (filterUmkmSelect) {
      const currentFilter = filterUmkmSelect.value;
      filterUmkmSelect.innerHTML =
        '<option value="all">Semua UMKM</option>' +
        profiles.map((p) => `<option value="${escapeHtml(p.id)}">${escapeHtml(p.name)}</option>`).join('');
      if (currentFilter && (currentFilter === 'all' || profiles.some((p) => p.id === currentFilter))) {
        filterUmkmSelect.value = currentFilter;
      }
    }
  };

  const loadProductIntoForm = (productId) => {
    const products = getSavedUmkmProducts();
    const prod = products.find((p) => p.id === productId);
    if (!prod) return;

    if (prodIdInput) prodIdInput.value = prod.id;
    if (prodUmkmInput) {
      prodUmkmInput.value = prod.umkmId;
      syncCustomSelect(prodUmkmInput);
    }
    if (prodNameInput) {
      prodNameInput.value = prod.name;
      prodNameInput.focus();
    }
    if (prodCatInput) {
      prodCatInput.value = prod.category;
      syncCustomSelect(prodCatInput);
    }
    if (prodStatusInput) {
      prodStatusInput.value = prod.status;
      syncCustomSelect(prodStatusInput);
    }
    if (prodPriceInput) prodPriceInput.value = prod.price;
    if (prodDescInput) prodDescInput.value = prod.description || '';

    currentProductPhotoUrl = prod.image || null;
    if (prodPhotoPreview) {
      prodPhotoPreview.src = prod.image || '/assets/images/paket-1.jpeg';
    }
    if (prodPhotoLabel) {
      prodPhotoLabel.textContent = prod.image ? 'Foto terpasang (Pilih file baru untuk mengganti)' : 'Pilih file JPG/PNG/WEBP (Maksimal 5MB)';
    }
    if (prodPhotoInput) prodPhotoInput.value = '';

    if (prodHeaderTitle) prodHeaderTitle.textContent = 'Edit Produk: ' + prod.name;
    if (prodHeaderSub) prodHeaderSub.textContent = 'Mengubah data produk "' + prod.name + '".';
    if (prodModeBadge) {
      const isTayang = prod.status === 'Tayang' || prod.status === 'Aktif';
      const isDraf = prod.status === 'Draf';
      prodModeBadge.textContent = isTayang ? 'Mode: Edit (Tayang)' : (isDraf ? 'Mode: Edit (Draf)' : 'Mode: Edit (Nonaktif)');
      prodModeBadge.className = isTayang ? 'badge-tayang' : (isDraf ? 'badge-draf' : 'badge-sembunyi');
    }
    if (btnDeleteProduct) btnDeleteProduct.style.display = 'inline-block';

    formProduct.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  const resetProductForm = () => {
    if (prodIdInput) prodIdInput.value = 'new_' + Date.now();
    if (prodNameInput) {
      prodNameInput.value = '';
      prodNameInput.focus();
    }
    if (prodUmkmInput) {
      prodUmkmInput.selectedIndex = 0;
      syncCustomSelect(prodUmkmInput);
    }
    if (prodCatInput) {
      prodCatInput.selectedIndex = 0;
      syncCustomSelect(prodCatInput);
    }
    if (prodStatusInput) {
      prodStatusInput.value = 'Tayang';
      syncCustomSelect(prodStatusInput);
    }
    if (prodPriceInput) prodPriceInput.value = 'Rp 15.000 / bungkus';
    if (prodDescInput) prodDescInput.value = '';

    currentProductPhotoUrl = null;
    if (prodPhotoPreview) prodPhotoPreview.src = '/assets/images/paket-1.jpeg';
    if (prodPhotoLabel) prodPhotoLabel.textContent = 'Gunakan foto default atau upload foto baru';
    if (prodPhotoInput) prodPhotoInput.value = '';

    if (prodHeaderTitle) prodHeaderTitle.textContent = 'Tambah Produk UMKM Baru';
    if (prodHeaderSub) prodHeaderSub.textContent = 'Lengkapi data untuk menambahkan produk UMKM baru.';
    if (prodModeBadge) {
      prodModeBadge.textContent = 'Mode: Tambah Baru';
      prodModeBadge.className = 'badge-tayang';
    }
    if (btnDeleteProduct) btnDeleteProduct.style.display = 'none';
  };

  // Upload Foto Produk
  if (prodPhotoInput) {
    prodPhotoInput.addEventListener('change', () => {
      const file = prodPhotoInput.files && prodPhotoInput.files[0];
      if (!file) return;

      if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file foto melebihi batas 5 MB.');
        prodPhotoInput.value = '';
        return;
      }

      const reader = new FileReader();
      reader.onload = (ev) => {
        if (ev.target && ev.target.result) {
          currentProductPhotoUrl = ev.target.result;
          if (prodPhotoPreview) prodPhotoPreview.src = ev.target.result;
        }
      };
      reader.readAsDataURL(file);

      if (prodPhotoLabel) {
        prodPhotoLabel.textContent = `File dipilih: ${file.name} (${(file.size / 1024).toFixed(0)} KB)`;
      }
    });
  }

  // Render Daftar Produk Admin
  const renderAdminProductList = () => {
    if (!productsListContainer) return;

    const products = getSavedUmkmProducts();
    const profiles = getSavedUmkmProfiles();
    const filterVal = filterUmkmSelect ? filterUmkmSelect.value : 'all';

    const filtered = filterVal === 'all'
      ? products
      : products.filter((p) => p.umkmId === filterVal);

    if (!filtered.length) {
      productsListContainer.innerHTML = `
        <div class="admin-panel-card" style="text-align: center; padding: 32px 16px;">
          <p style="color: var(--text-muted); margin-bottom: 10px;">Tidak ada produk untuk UMKM yang dipilih.</p>
          <button type="button" class="btn-admin-primary" id="btnEmptyAddProd">+ Tambah Produk untuk UMKM ini</button>
        </div>
      `;
      const btn = document.getElementById('btnEmptyAddProd');
      if (btn) btn.addEventListener('click', resetProductForm);
      return;
    }

    productsListContainer.innerHTML = filtered
      .map((p) => {
        const umkm = profiles.find((u) => u.id === p.umkmId) || { name: 'UMKM Tidak Diketahui' };
        const isTayang = p.status === 'Tayang' || p.status === 'Aktif';
        const badgeClass = isTayang ? 'badge-tayang' : 'badge-draf';
        const badgeText = isTayang ? 'Tayang' : (p.status || 'Nonaktif');
        const imgSrc = escapeHtml(p.image || '/assets/images/paket-1.jpeg');
        const safeId = escapeHtml(p.id);
        const safeName = escapeHtml(p.name);
        const safePrice = escapeHtml(p.price);
        const safeUmkmName = escapeHtml(umkm.name);

        return `
          <div class="admin-item-card" data-admin-prod-card="${safeId}">
            <div class="admin-item-header">
              <div class="admin-item-left">
                <div class="admin-item-thumb" style="background-image: url('${imgSrc}'); background-size: cover; background-position: center;"></div>
                <div style="min-width: 0;">
                  <div class="admin-item-title">${safeName}</div>
                  <div class="admin-item-sub">
                    ${safePrice} &bull; <strong>${safeUmkmName}</strong>
                  </div>
                </div>
              </div>
              <span class="${badgeClass}" style="flex-shrink: 0;">${escapeHtml(badgeText)}</span>
            </div>
            <div class="admin-item-footer">
              <button type="button" class="admin-toggle-status-btn" data-toggle-prod-status="${safeId}" title="Klik untuk mengaktifkan/menonaktifkan produk">
                ${isTayang ? 'Nonaktifkan' : 'Aktifkan'}
              </button>
              <div class="admin-card-actions" style="margin-top: 0;">
                <button type="button" class="admin-edit-link" data-edit-product="${safeId}">
                  Edit &#10095;
                </button>
                <button type="button" class="admin-delete-link" data-delete-product="${safeId}">
                  Hapus
                </button>
              </div>
            </div>
          </div>
        `;
      })
      .join('');

    // Bind Edit, Toggle Status & Delete buttons
    productsListContainer.querySelectorAll('[data-edit-product]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-edit-product');
        loadProductIntoForm(id);
      });
    });

    productsListContainer.querySelectorAll('[data-toggle-prod-status]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-toggle-prod-status');
        const prods = getSavedUmkmProducts();
        const target = prods.find((p) => p.id === id);
        if (!target) return;

        const newStatus = (target.status === 'Tayang' || target.status === 'Aktif') ? 'Nonaktif' : 'Tayang';
        target.status = newStatus;
        saveUmkmProducts(prods);
        renderAdminProductList();

        showCustomPopup(
          'Status Diperbarui',
          `Produk "${target.name}" sekarang berstatus: ${newStatus}.`,
          'Mengerti'
        );
      });
    });

    productsListContainer.querySelectorAll('[data-delete-product]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-delete-product');
        const prods = getSavedUmkmProducts();
        const target = prods.find((p) => p.id === id);
        const name = target ? target.name : 'Produk ini';

        showDeleteConfirmPopup(name, () => {
          const updated = prods.filter((p) => p.id !== id);
          saveUmkmProducts(updated);
          renderAdminProductList();
          resetProductForm();
          showCustomPopup('Berhasil Dihapus', `Produk "${name}" telah dihapus dari katalog UMKM.`, 'Tutup');
        });
      });
    });
  };

  // Form Product Submit
  if (formProduct) {
    formProduct.addEventListener('submit', (e) => {
      e.preventDefault();

      const prodId = prodIdInput ? prodIdInput.value.trim() : '';
      const umkmId = prodUmkmInput ? prodUmkmInput.value : '';
      const name = prodNameInput ? prodNameInput.value.trim() : '';
      const cat = prodCatInput ? prodCatInput.value : 'makanan';
      const status = prodStatusInput ? prodStatusInput.value : 'Tayang';
      const price = prodPriceInput ? prodPriceInput.value.trim() : '';
      const desc = prodDescInput ? prodDescInput.value.trim() : '';

      if (!name || !umkmId) {
        alert('Mohon lengkapi nama produk dan UMKM pemilik.');
        return;
      }

      const products = getSavedUmkmProducts();
      const isNew = !prodId || prodId.startsWith('new_');
      const finalId = isNew ? 'prod_' + Date.now() : prodId;

      const finalProduct = {
        id: finalId,
        umkmId,
        name,
        category: cat,
        status,
        price,
        image: currentProductPhotoUrl || '/assets/images/paket-1.jpeg',
        description: desc
      };

      if (isNew) {
        products.unshift(finalProduct);
      } else {
        const idx = products.findIndex((p) => p.id === prodId);
        if (idx !== -1) {
          products[idx] = finalProduct;
        } else {
          products.unshift(finalProduct);
        }
      }

      saveUmkmProducts(products);
      renderAdminProductList();
      loadProductIntoForm(finalId);

      showCustomPopup(
        'Produk Berhasil Disimpan',
        `Produk "${name}" berhasil disimpan dengan status ${status}! Data langsung aktif di website publik.`,
        'Selesai'
      );
    });
  }

  if (filterUmkmSelect) {
    filterUmkmSelect.addEventListener('change', renderAdminProductList);
  }
  if (prodStatusInput) {
    prodStatusInput.addEventListener('change', () => {
      const val = prodStatusInput.value;
      const isTayang = val === 'Tayang' || val === 'Aktif';
      const isDraf = val === 'Draf';
      if (prodModeBadge) {
        prodModeBadge.textContent = isTayang ? 'Mode: Edit (Tayang)' : (isDraf ? 'Mode: Edit (Draf)' : 'Mode: Edit (Nonaktif)');
        prodModeBadge.className = isTayang ? 'badge-tayang' : (isDraf ? 'badge-draf' : 'badge-sembunyi');
      }
    });
  }
  if (btnNewProduct) btnNewProduct.addEventListener('click', resetProductForm);
  if (btnCancelProductEdit) btnCancelProductEdit.addEventListener('click', resetProductForm);
  if (btnDeleteProduct) {
    btnDeleteProduct.addEventListener('click', () => {
      const prodId = prodIdInput ? prodIdInput.value.trim() : '';
      if (!prodId || prodId.startsWith('new_')) {
        resetProductForm();
        return;
      }
      const products = getSavedUmkmProducts();
      const target = products.find((p) => p.id === prodId);
      const name = target ? target.name : 'Produk ini';

      showDeleteConfirmPopup(name, () => {
        const updated = products.filter((p) => p.id !== prodId);
        saveUmkmProducts(updated);
        renderAdminProductList();
        resetProductForm();
        showCustomPopup('Berhasil Dihapus', `Produk "${name}" telah dihapus dari katalog UMKM.`, 'Tutup');
      });
    });
  }

  // ==========================================
  // BAGIAN B: PENGELOLAAN PROFIL UMKM
  // ==========================================
  const umkmListContainer = document.getElementById('adminUmkmProfilesListContainer');
  const formUmkmProfile = document.getElementById('formUMKMProfile');
  const btnNewUmkmProfile = document.getElementById('btnNewUmkmProfile');
  const btnCancelUmkmProfileEdit = document.getElementById('btnCancelUmkmProfileEdit');
  const btnDeleteUmkmProfile = document.getElementById('btnDeleteUmkmProfile');

  const umkmIdEl = document.getElementById('umkmProfileId');
  const umkmNameEl = document.getElementById('umkmProfileName');
  const umkmOwnerEl = document.getElementById('umkmProfileOwner');
  const umkmCatEl = document.getElementById('umkmProfileCat');
  const umkmWaEl = document.getElementById('umkmProfileWa');
  const umkmHoursEl = document.getElementById('umkmProfileHours');
  const umkmAddressEl = document.getElementById('umkmProfileAddress');
  const umkmDescEl = document.getElementById('umkmProfileDesc');
  const umkmFormTitle = document.getElementById('umkmProfileFormTitle');
  const umkmFormSub = document.getElementById('umkmProfileFormSub');
  const umkmFormModeBadge = document.getElementById('umkmProfileFormModeBadge');

  const loadUmkmIntoForm = (umkmId) => {
    const profiles = getSavedUmkmProfiles();
    const item = profiles.find((p) => p.id === umkmId);
    if (!item) return;

    if (umkmIdEl) umkmIdEl.value = item.id;
    if (umkmNameEl) {
      umkmNameEl.value = item.name;
      umkmNameEl.focus();
    }
    if (umkmOwnerEl) umkmOwnerEl.value = item.owner || '';
    if (umkmCatEl) {
      umkmCatEl.value = item.category || 'Makanan olahan';
      syncCustomSelect(umkmCatEl);
    }
    if (umkmWaEl) umkmWaEl.value = item.whatsapp || '0857 0257 3013';
    if (umkmHoursEl) umkmHoursEl.value = item.hours || '';
    if (umkmAddressEl) umkmAddressEl.value = item.address || '';
    if (umkmDescEl) umkmDescEl.value = item.description || '';

    if (umkmFormTitle) umkmFormTitle.textContent = 'Edit Profil: ' + item.name;
    if (umkmFormSub) umkmFormSub.textContent = 'Memperbarui profil UMKM "' + item.name + '".';
    if (umkmFormModeBadge) {
      umkmFormModeBadge.textContent = 'Mode: Edit';
      umkmFormModeBadge.className = 'badge-tayang';
    }
    if (btnDeleteUmkmProfile) btnDeleteUmkmProfile.style.display = 'inline-block';

    formUmkmProfile.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  const resetUmkmProfileForm = () => {
    if (umkmIdEl) umkmIdEl.value = 'umkm_' + Date.now();
    if (umkmNameEl) {
      umkmNameEl.value = '';
      umkmNameEl.focus();
    }
    if (umkmOwnerEl) umkmOwnerEl.value = '';
    if (umkmCatEl) {
      umkmCatEl.selectedIndex = 0;
      syncCustomSelect(umkmCatEl);
    }
    if (umkmWaEl) umkmWaEl.value = '0857 0257 3013';
    if (umkmHoursEl) umkmHoursEl.value = 'Setiap Hari, 08:00 – 17:00 WIB';
    if (umkmAddressEl) umkmAddressEl.value = 'Desa Karangkemiri, Kec. Karanglewas';
    if (umkmDescEl) umkmDescEl.value = '';

    if (umkmFormTitle) umkmFormTitle.textContent = 'Tambah Profil UMKM Baru';
    if (umkmFormSub) umkmFormSub.textContent = 'Lengkapi data untuk mendaftarkan unit usaha/pengrajin UMKM baru.';
    if (umkmFormModeBadge) {
      umkmFormModeBadge.textContent = 'Mode: Tambah Baru';
      umkmFormModeBadge.className = 'badge-tayang';
    }
    if (btnDeleteUmkmProfile) btnDeleteUmkmProfile.style.display = 'none';
  };

  // Render Daftar Profil UMKM Admin
  const renderAdminUmkmProfilesList = () => {
    if (!umkmListContainer) return;

    const profiles = getSavedUmkmProfiles();
    const products = getSavedUmkmProducts();

    if (!profiles.length) {
      umkmListContainer.innerHTML = `
        <div class="admin-panel-card" style="text-align: center; padding: 32px 16px;">
          <p style="color: var(--text-muted); margin-bottom: 10px;">Belum ada profil UMKM terdaftar.</p>
          <button type="button" class="btn-admin-primary" id="btnEmptyAddUmkm">+ Tambah Profil UMKM Pertama</button>
        </div>
      `;
      const btn = document.getElementById('btnEmptyAddUmkm');
      if (btn) btn.addEventListener('click', resetUmkmProfileForm);
      return;
    }

    umkmListContainer.innerHTML = profiles
      .map((item) => {
        const prodCount = products.filter((p) => p.umkmId === item.id).length;
        const safeId = escapeHtml(item.id);
        const safeCat = escapeHtml(item.category || 'UMKM');
        const safeName = escapeHtml(item.name);
        const safeOwner = escapeHtml(item.owner);
        const safeAddr = escapeHtml(item.address);
        const safeHours = escapeHtml(item.hours);
        const safeWa = escapeHtml(item.whatsapp);

        return `
          <div class="admin-panel-card umkm-profile-card" data-admin-umkm-card="${safeId}" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
              <div>
                <span class="umkm-owner-badge" style="margin-bottom: 4px;">${safeCat}</span>
                <h3 style="font-size: 17px; font-weight: 800; color: var(--text-dark); margin: 4px 0;">${safeName}</h3>
                <div style="font-size: 13px; color: var(--text-muted);">
                  Pengelola: <strong>${safeOwner}</strong> &bull; ${prodCount} Produk
                </div>
              </div>
              <div class="admin-card-actions" style="margin-top: 0;">
                <button type="button" class="admin-edit-link" data-edit-umkm-profile="${safeId}" style="background: none; border: none; padding: 0; cursor: pointer;">Edit &#10095;</button>
                <button type="button" class="admin-delete-link" data-delete-umkm-profile="${safeId}" style="background: none; border: none; padding: 0; cursor: pointer;">Hapus</button>
              </div>
            </div>

            <div style="font-size: 12.5px; color: var(--text-muted); display: flex; flex-direction: column; gap: 4px; margin-top: 6px; padding-top: 8px; border-top: 1px dashed var(--border-light);">
              <div><strong>Alamat:</strong> ${safeAddr}</div>
              <div><strong>Jam:</strong> ${safeHours}</div>
              <div><strong>WhatsApp:</strong> ${safeWa}</div>
            </div>
          </div>
        `;
      })
      .join('');

    // Bind Edit & Delete buttons
    umkmListContainer.querySelectorAll('[data-edit-umkm-profile]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-edit-umkm-profile');
        loadUmkmIntoForm(id);
      });
    });

    umkmListContainer.querySelectorAll('[data-delete-umkm-profile]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-delete-umkm-profile');
        const profiles = getSavedUmkmProfiles();
        const target = profiles.find((p) => p.id === id);
        const name = target ? target.name : 'UMKM ini';

        const prods = getSavedUmkmProducts();
        const relatedCount = prods.filter((p) => p.umkmId === id).length;
        const confirmMsg = relatedCount
          ? `UMKM "${name}" memiliki ${relatedCount} produk terdaftar. Menghapus UMKM ini juga akan menghapus produk-produk tersebut. Lanjutkan?`
          : `Apakah Anda yakin ingin menghapus profil UMKM "${name}"?`;

        if (!confirm(confirmMsg)) return;

        const updatedProfiles = profiles.filter((p) => p.id !== id);
        const updatedProds = prods.filter((p) => p.umkmId !== id);

        saveUmkmProfiles(updatedProfiles);
        saveUmkmProducts(updatedProds);

        refreshUmkmSelectOptions();
        renderAdminUmkmProfilesList();
        renderAdminProductList();
        resetUmkmProfileForm();

        showCustomPopup('Profil Dihapus', `Profil UMKM "${name}" berhasil dihapus.`, 'Tutup');
      });
    });
  };

  // Form UMKM Profile Submit
  if (formUmkmProfile) {
    formUmkmProfile.addEventListener('submit', (e) => {
      e.preventDefault();

      const id = umkmIdEl ? umkmIdEl.value.trim() : '';
      const name = umkmNameEl ? umkmNameEl.value.trim() : '';
      const owner = umkmOwnerEl ? umkmOwnerEl.value.trim() : '';
      const category = umkmCatEl ? umkmCatEl.value : 'Makanan olahan';
      const whatsapp = umkmWaEl ? umkmWaEl.value.trim() : '0857 0257 3013';
      const hours = umkmHoursEl ? umkmHoursEl.value.trim() : '';
      const address = umkmAddressEl ? umkmAddressEl.value.trim() : '';
      const description = umkmDescEl ? umkmDescEl.value.trim() : '';

      if (!name || !owner) {
        alert('Mohon lengkapi nama UMKM dan nama pemilik.');
        return;
      }

      const profiles = getSavedUmkmProfiles();
      const isNew = !id || id.startsWith('umkm_');
      const finalId = isNew ? 'umkm_' + Date.now() : id;

      const profileData = {
        id: finalId,
        name,
        owner,
        category,
        whatsapp,
        hours,
        address,
        description
      };

      if (isNew) {
        profiles.push(profileData);
      } else {
        const idx = profiles.findIndex((p) => p.id === id);
        if (idx !== -1) {
          profiles[idx] = profileData;
        } else {
          profiles.push(profileData);
        }
      }

      saveUmkmProfiles(profiles);
      refreshUmkmSelectOptions();
      renderAdminUmkmProfilesList();
      renderAdminProductList();
      loadUmkmIntoForm(finalId);

      showCustomPopup(
        'Profil UMKM Disimpan',
        `Profil UMKM "${name}" berhasil diperbarui. Seluruh produk yang terhubung dengan UMKM ini otomatis tersinkronisasi.`,
        'Selesai'
      );
    });
  }

  if (btnNewUmkmProfile) btnNewUmkmProfile.addEventListener('click', resetUmkmProfileForm);
  if (btnCancelUmkmProfileEdit) btnCancelUmkmProfileEdit.addEventListener('click', resetUmkmProfileForm);
  if (btnDeleteUmkmProfile) {
    btnDeleteUmkmProfile.addEventListener('click', () => {
      const id = umkmIdEl ? umkmIdEl.value.trim() : '';
      if (!id || id.startsWith('umkm_')) {
        resetUmkmProfileForm();
        return;
      }
      const profiles = getSavedUmkmProfiles();
      const target = profiles.find((p) => p.id === id);
      const name = target ? target.name : 'UMKM ini';

      if (confirm(`Apakah Anda yakin ingin menghapus profil UMKM "${name}"?`)) {
        const updatedProfiles = profiles.filter((p) => p.id !== id);
        const prods = getSavedUmkmProducts();
        const updatedProds = prods.filter((p) => p.umkmId !== id);

        saveUmkmProfiles(updatedProfiles);
        saveUmkmProducts(updatedProds);

        refreshUmkmSelectOptions();
        renderAdminUmkmProfilesList();
        renderAdminProductList();
        resetUmkmProfileForm();

        showCustomPopup('Profil Dihapus', `Profil UMKM "${name}" berhasil dihapus.`, 'Tutup');
      }
    });
  }

  // Inisialisasi awal
  refreshUmkmSelectOptions();
  renderAdminProductList();
  renderAdminUmkmProfilesList();

  const prods = getSavedUmkmProducts();
  if (prods.length) {
    loadProductIntoForm(prods[0].id);
  }
  const profiles = getSavedUmkmProfiles();
  if (profiles.length) {
    loadUmkmIntoForm(profiles[0].id);
  }
}

/* 10b. Halaman Publik: Render Katalog UMKM & Produk */
function initPublicUMKM() {
  const gridContainer = document.getElementById('publicUmkmGrid');
  const profilesContainer = document.getElementById('publicUmkmProfilesGrid');
  const filterUmkmSelect = document.getElementById('publicFilterUmkmSelect');
  const categoryPillsContainer = document.getElementById('publicCategoryFilterPills');

  if (!gridContainer) return;

  const profiles = getSavedUmkmProfiles();
  const products = getSavedUmkmProducts();

  // 1. Isi Pilihan Filter UMKM
  if (filterUmkmSelect) {
    filterUmkmSelect.innerHTML =
      '<option value="all">Semua UMKM Karangkemiri</option>' +
      profiles.map((p) => `<option value="${p.id}">${p.name}</option>`).join('');
  }

  let activeCategory = 'semua';
  let activeUmkm = 'all';

  const renderProducts = () => {
    // Filter HANYA yang Tayang / Aktif
    const activeProducts = products.filter((p) => p.status === 'Tayang' || p.status === 'Aktif');

    const filtered = activeProducts.filter((p) => {
      const matchCat = activeCategory === 'semua' || p.category.toLowerCase() === activeCategory.toLowerCase();
      const matchUmkm = activeUmkm === 'all' || p.umkmId === activeUmkm;
      return matchCat && matchUmkm;
    });

    if (!filtered.length) {
      gridContainer.innerHTML = `
        <div class="admin-panel-card empty-state-card" style="grid-column: 1 / -1; text-align: center; padding: 44px 20px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
          <h3 style="font-size: 18px; font-weight: 800; color: var(--text-dark); margin-bottom: 8px;">Belum Ada Produk yang Sesuai</h3>
          <p style="color: var(--text-muted); font-size: 14px; max-width: 520px; margin: 0 auto 16px; line-height: 1.6;">Silakan pilih kategori atau UMKM lain, atau hubungi pengelola BUMDesa untuk bantuan pemesanan produk khusus.</p>
          <a href="https://wa.me/6285702573013?text=Halo%20BUMDesa%20Karangkemiri%2C%20saya%20ingin%20menanyakan%20produk%20UMKM." target="_blank" rel="noopener" class="btn-empty-state-wa">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/>
            </svg>
            <span>Tanya BUMDes via WhatsApp</span>
          </a>
        </div>
      `;
      return;
    }

    gridContainer.innerHTML = filtered
      .map((p) => {
        const umkm = profiles.find((u) => u.id === p.umkmId) || {
          name: 'Pelaku UMKM Karangkemiri',
          whatsapp: '0857 0257 3013'
        };

        const cleanWa = cleanWhatsAppNumber(umkm.whatsapp);
        const waText = encodeURIComponent(
          `Halo *${umkm.name}*, saya melihat produk *${p.name}* di Katalog Website Desa Wisata Karangkemiri dan ingin menanyakan/memesan produk ini.`
        );
        const imgSrc = escapeHtml(p.image || '/assets/images/paket-1.jpeg');
        const catLabel =
          p.category === 'makanan'
            ? 'Makanan olahan'
            : p.category === 'kerajinan'
            ? 'Kerajinan tangan'
            : p.category === 'tani'
            ? 'Hasil pertanian'
            : 'Produk lokal';

        const safeCat = escapeHtml(p.category);
        const safeName = escapeHtml(p.name);
        const safeUmkmName = escapeHtml(umkm.name);
        const safeAddr = escapeHtml(umkm.address || '-');
        const safePrice = escapeHtml(p.price);
        const safeDesc = p.description ? `<p style="font-size: 12.5px; color: var(--text-muted); line-height: 1.4; margin: 4px 0 8px;">${escapeHtml(p.description)}</p>` : '';

        return `
          <div class="umkm-card" data-category="${safeCat}">
            <div class="umkm-thumb" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.1) 0%, rgba(14, 68, 33, 0.7) 100%), url('${imgSrc}'); background-size: cover; background-position: center;">
              <span>${safeName}</span>
            </div>
            <span class="umkm-owner-badge" title="Alamat: ${safeAddr}">
              ${safeUmkmName}
            </span>
            <h2 class="umkm-title">${safeName}</h2>
            <p class="umkm-cat">${escapeHtml(catLabel)}</p>
            ${safeDesc}
            <div class="umkm-price-row">${safePrice}</div>
            <a href="${sanitizeUrl(`https://wa.me/${cleanWa}?text=${waText}`)}" target="_blank" rel="noopener noreferrer" class="btn-product-wa">
              <span>Hubungi Penjual</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink: 0;"><path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/></svg>
            </a>
          </div>
        `;
      })
      .join('');
  };

  // 2. Render Seksi Profil UMKM Desa di Bagian Bawah
  if (profilesContainer) {
    profilesContainer.innerHTML = profiles
      .map((item) => {
        const cleanWa = cleanWhatsAppNumber(item.whatsapp);
        const prodCount = products.filter((p) => p.umkmId === item.id && (p.status === 'Tayang' || p.status === 'Aktif')).length;
        const chatText = encodeURIComponent(`Halo ${item.name}, saya ingin menanyakan informasi produk dan kunjungan ke sentra usaha Anda.`);
        const safeCat = escapeHtml(item.category || 'UMKM Lokal');
        const safeName = escapeHtml(item.name);
        const safeOwner = escapeHtml(item.owner);
        const safeDesc = item.description ? `<p style="font-size: 13px; color: var(--text-muted); line-height: 1.45; margin: 6px 0;">${escapeHtml(item.description)}</p>` : '';
        const safeAddr = escapeHtml(item.address);
        const safeHours = escapeHtml(item.hours);

        return `
          <div class="umkm-profile-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 8px;">
              <div style="flex: 1; min-width: 0;">
                <span class="umkm-owner-badge">${safeCat}</span>
                <h3 style="font-size: 17px; font-weight: 800; color: var(--text-dark); margin: 6px 0 2px;">${safeName}</h3>
                <div style="font-size: 13px; color: var(--text-muted);">
                  Pengelola: <strong>${safeOwner}</strong>
                </div>
              </div>
              <span class="meta-tag-small" style="font-size: 11px; white-space: nowrap; flex-shrink: 0; padding: 4px 10px; display: inline-flex; align-items: center;">${prodCount} Produk</span>
            </div>

            ${safeDesc}

            <div style="font-size: 12.5px; color: var(--text-muted); display: flex; flex-direction: column; gap: 4px; padding: 10px 0; border-top: 1px dashed var(--border-light); border-bottom: 1px dashed var(--border-light);">
              <div><strong>Alamat:</strong> ${safeAddr}</div>
              <div><strong>Jam:</strong> ${safeHours}</div>
            </div>

            <a href="${sanitizeUrl(`https://wa.me/${cleanWa}?text=${chatText}`)}" target="_blank" rel="noopener noreferrer" class="btn-product-wa" style="margin-top: 4px; justify-content: center;">
              <span>Hubungi Pengrajin via WA</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/></svg>
            </a>
          </div>
        `;
      })
      .join('');
  }

  // 3. Event Listener Kategori Pills
  if (categoryPillsContainer) {
    categoryPillsContainer.querySelectorAll('[data-filter-btn]').forEach((btn) => {
      btn.addEventListener('click', () => {
        categoryPillsContainer.querySelectorAll('[data-filter-btn]').forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');
        activeCategory = btn.getAttribute('data-filter-btn') || 'semua';
        renderProducts();
      });
    });
  }

  // 4. Event Listener Filter Dropdown UMKM
  if (filterUmkmSelect) {
    filterUmkmSelect.addEventListener('change', () => {
      activeUmkm = filterUmkmSelect.value;
      renderProducts();
    });
  }

  // Initial render
  renderProducts();
}

/* =========================================================
   11. MODUL STATISTIK KUNJUNGAN DIGITAL & MINAT PENGUNJUNG
   Sesuai Checklist:
   - Menentukan metode pencatatan statistik yang sederhana & menjaga privasi
   - Pencatatan page views halaman website publik
   - Pencatatan klik tombol WhatsApp (minat reservasi/pemesanan)
   - Estimasi pengunjung unik yang menjaga privasi (tanpa data pribadi/IP)
   - Ringkasan halaman yang paling banyak dikunjungi
   - Menampilkan statistik dasar melalui dashboard CMS
   - Simulasi interaksi & pengujian untuk QA
   ========================================================= */

const ANALYTICS_STORAGE_KEY = 'cms_digital_analytics_data';
const VISITOR_COOKIE_KEY = '_deswit_anon_visitor_id';

const DEFAULT_ANALYTICS_DATA = {
  totalViews: 1248,
  uniqueVisitors: 412,
  totalWaClicks: 168,
  pages: {
    candi: 386,
    paket: 294,
    umkm: 225,
    home: 180,
    embung: 98,
    profil: 65
  },
  waInquiries: {
    'Reservasi Paket Wisata': 78,
    'Pemesanan Produk UMKM': 46,
    'Informasi Outbound & Candi': 31,
    'Kontak & Bantuan Umum': 13
  }
};

function getSavedAnalytics() {
  try {
    const raw = localStorage.getItem(ANALYTICS_STORAGE_KEY);
    if (!raw) return JSON.parse(JSON.stringify(DEFAULT_ANALYTICS_DATA));
    const parsed = JSON.parse(raw);
    return {
      totalViews: parsed.totalViews || DEFAULT_ANALYTICS_DATA.totalViews,
      uniqueVisitors: parsed.uniqueVisitors || DEFAULT_ANALYTICS_DATA.uniqueVisitors,
      totalWaClicks: parsed.totalWaClicks || DEFAULT_ANALYTICS_DATA.totalWaClicks,
      pages: { ...DEFAULT_ANALYTICS_DATA.pages, ...(parsed.pages || {}) },
      waInquiries: { ...DEFAULT_ANALYTICS_DATA.waInquiries, ...(parsed.waInquiries || {}) }
    };
  } catch (e) {
    console.error('Gagal membaca data analitik:', e);
    return JSON.parse(JSON.stringify(DEFAULT_ANALYTICS_DATA));
  }
}

function saveAnalytics(data) {
  try {
    localStorage.setItem(ANALYTICS_STORAGE_KEY, JSON.stringify(data));
    return true;
  } catch (e) {
    console.error('Gagal menyimpan data analitik:', e);
    return false;
  }
}

/* 11a. Pelacak Kunjungan Halaman & Klik WhatsApp di Website Publik (Menjaga Privasi) */
function initDigitalTracker() {
  const path = window.location.pathname.toLowerCase();
  // Jangan catat halaman admin / login sebagai pengunjung publik
  if (path.includes('admin') || path.includes('login')) return;

  const stats = getSavedAnalytics();

  // Tentukan Page Key
  let pageKey = 'home';
  if (path.includes('detail-destinasi')) {
    const urlParams = new URLSearchParams(window.location.search);
    const slug = (urlParams.get('slug') || 'candi').toLowerCase();
    pageKey = slug === 'candi' ? 'candi' : slug === 'embung' ? 'embung' : 'candi';
  } else if (path.includes('destinasi')) {
    pageKey = 'candi';
  } else if (path.includes('paket')) {
    pageKey = 'paket';
  } else if (path.includes('umkm')) {
    pageKey = 'umkm';
  } else if (path.includes('profil')) {
    pageKey = 'profil';
  } else if (path.includes('kontak')) {
    pageKey = 'profil';
  }

  // 1. Catat Page View
  stats.totalViews = (stats.totalViews || 0) + 1;
  stats.pages[pageKey] = (stats.pages[pageKey] || 0) + 1;

  // 2. Estimasi Pengunjung Unik (Privasi Aman: Anonymous Token per Browser)
  let visitorId = localStorage.getItem(VISITOR_COOKIE_KEY);
  if (!visitorId) {
    visitorId = 'anon_' + Date.now().toString(36) + Math.random().toString(36).substring(2, 6);
    localStorage.setItem(VISITOR_COOKIE_KEY, visitorId);
    stats.uniqueVisitors = (stats.uniqueVisitors || 0) + 1;
  }

  saveAnalytics(stats);

  // 3. Catat Klik Tombol WhatsApp di Website Publik
  document.querySelectorAll('a[href*="wa.me"], a[href*="whatsapp.com"], [data-track-wa]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const currentStats = getSavedAnalytics();
      currentStats.totalWaClicks = (currentStats.totalWaClicks || 0) + 1;

      let waType = 'Kontak & Bantuan Umum';
      if (path.includes('paket')) {
        waType = 'Reservasi Paket Wisata';
      } else if (path.includes('umkm')) {
        waType = 'Pemesanan Produk UMKM';
      } else if (path.includes('destinasi')) {
        waType = 'Informasi Outbound & Candi';
      }

      currentStats.waInquiries[waType] = (currentStats.waInquiries[waType] || 0) + 1;
      saveAnalytics(currentStats);
    });
  });
}

/* 11b. Tampilkan Statistik di Dashboard Admin CMS */
function initDashboardAnalytics() {
  const container = document.getElementById('adminDashboardAnalytics');
  if (!container) return;

  const metricTotalViews = document.getElementById('metricTotalViews');
  const metricUniqueVisitors = document.getElementById('metricUniqueVisitors');
  const metricTotalWa = document.getElementById('metricTotalWa');
  const metricAvgViews = document.getElementById('metricAvgViews');
  const pagesList = document.getElementById('analyticsTopPagesList');
  const waList = document.getElementById('analyticsTopWaList');

  const btnSimulateVisit = document.getElementById('btnSimulateVisit');
  const btnSimulateWa = document.getElementById('btnSimulateWa');
  const btnResetAnalytics = document.getElementById('btnResetAnalytics');

  // Update jumlah paket & umkm aktif pada kartu ringkasan atas
  const dashTotalPackages = document.getElementById('dashTotalPackages');
  const dashTotalUmkm = document.getElementById('dashTotalUmkm');
  if (dashTotalPackages) {
    const pkgs = getSavedPackages();
    const activeCount = pkgs.filter((p) => p.status === 'Aktif' || p.status === 'Tayang').length;
    dashTotalPackages.textContent = activeCount || '2';
  }
  if (dashTotalUmkm) {
    const profiles = getSavedUmkmProfiles();
    dashTotalUmkm.textContent = profiles.length || '4';
  }

  const PAGE_LABELS = {
    candi: 'Wahana Edukasi & Outbound Candi',
    paket: 'Paket Wisata & Edukasi Desa',
    umkm: 'Katalog UMKM & Produk Lokal',
    home: 'Beranda & Jelajah Karangkemiri',
    embung: 'Embung Prabawulan & Wisata Alam',
    profil: 'Profil Desa Wisata & Kontak'
  };

  const renderDashboard = () => {
    const stats = getSavedAnalytics();

    // 1. Metrics Cards
    if (metricTotalViews) metricTotalViews.textContent = stats.totalViews.toLocaleString('id-ID');
    if (metricUniqueVisitors) metricUniqueVisitors.textContent = stats.uniqueVisitors.toLocaleString('id-ID');
    if (metricTotalWa) metricTotalWa.textContent = stats.totalWaClicks.toLocaleString('id-ID');

    const avg = (stats.totalViews / Math.max(1, stats.uniqueVisitors)).toFixed(1).replace('.', ',');
    if (metricAvgViews) metricAvgViews.textContent = avg;

    // 2. Ranking Halaman Terpopuler
    if (pagesList) {
      const pageEntries = Object.entries(stats.pages).sort((a, b) => b[1] - a[1]);
      const maxPageViews = pageEntries.length ? Math.max(...pageEntries.map((e) => e[1])) : 1;

      pagesList.innerHTML = pageEntries
        .map(([key, count], index) => {
          const label = PAGE_LABELS[key] || key;
          const percent = Math.min(100, Math.round((count / maxPageViews) * 100));

          return `
            <div>
              <div style="display: flex; justify-content: space-between; font-size: 13.5px; font-weight: 600; color: var(--text-dark);">
                <span>#${index + 1} ${escapeHtml(label)}</span>
                <span style="font-weight: 700;">${count.toLocaleString('id-ID')} tayangan</span>
              </div>
              <div class="stat-progress-bar-wrap">
                <div class="stat-progress-bar-fill" style="width: ${percent}%;"></div>
              </div>
            </div>
          `;
        })
        .join('');
    }

    // 3. Minat Interaksi WhatsApp
    if (waList) {
      const waEntries = Object.entries(stats.waInquiries).sort((a, b) => b[1] - a[1]);
      const maxWaClicks = waEntries.length ? Math.max(...waEntries.map((e) => e[1])) : 1;

      waList.innerHTML = waEntries
        .map(([label, count]) => {
          const percent = Math.min(100, Math.round((count / maxWaClicks) * 100));

          return `
            <div>
              <div style="display: flex; justify-content: space-between; font-size: 13.5px; font-weight: 600; color: var(--text-dark);">
                <span>${escapeHtml(label)}</span>
                <span style="font-weight: 700; color: #0E7490;">${count.toLocaleString('id-ID')} klik</span>
              </div>
              <div class="stat-progress-bar-wrap">
                <div class="stat-progress-bar-fill" style="width: ${percent}%; background-color: #0E7490;"></div>
              </div>
            </div>
          `;
        })
        .join('');
    }
  };

  // 4. Tombol Simulasi & Pengujian Interaktif (Checklist QA)
  if (btnSimulateVisit) {
    btnSimulateVisit.addEventListener('click', () => {
      const stats = getSavedAnalytics();
      stats.totalViews += 1;
      stats.uniqueVisitors += 1;
      stats.pages.candi += 1;
      saveAnalytics(stats);
      renderDashboard();
      showCustomPopup(
        'Simulasi Berhasil',
        'Satu kunjungan baru berhasil ditambahkan! Statistik Total Tayangan & Pengunjung Unik telah bertambah secara real-time.',
        'Oke'
      );
    });
  }

  if (btnSimulateWa) {
    btnSimulateWa.addEventListener('click', () => {
      const stats = getSavedAnalytics();
      stats.totalWaClicks += 1;
      stats.waInquiries['Reservasi Paket Wisata'] += 1;
      saveAnalytics(stats);
      renderDashboard();
      showCustomPopup(
        'Simulasi Klik Berhasil',
        'Satu klik tombol WhatsApp berhasil ditambahkan! Statistik Minat Interaksi telah bertambah secara real-time.',
        'Oke'
      );
    });
  }

  if (btnResetAnalytics) {
    btnResetAnalytics.addEventListener('click', () => {
      if (confirm('Kembalikan data statistik kunjungan digital ke nilai default awal?')) {
        saveAnalytics(DEFAULT_ANALYTICS_DATA);
        renderDashboard();
        showCustomPopup(
          'Statistik Direset',
          'Data statistik kunjungan digital dan minat WhatsApp telah dikembalikan ke data awal default.',
          'Tutup'
        );
      }
    });
  }

  // Render awal
  renderDashboard();
}
