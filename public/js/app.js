// Data Destinasi Terverifikasi (Sesuai Poin 1, 2, 3, & M03/M06/M07 PDF)
const DESTINATIONS_DATA = {
  candi: {
    slug: 'candi',
    heroCaption: 'Wahana Edukasi & Outbound Candi',
    eyebrow: 'DESTINASI • EDUKASI & OUTBOUND',
    title: 'Wahana Edukasi & Outbound Candi',
    badge: 'Edukasi & Outbound',
    location: 'Dusun Karang Jengkol, Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas',
    description:
      'Destinasi utama untuk kegiatan sekolah, instansi, dan keluarga dengan wahana permainan outbound, latihan ketangkasan, serta edukasi kelompok di area terbuka yang asri.',
    hours: 'Senin – Minggu, 08:00 – 17:00 WIB (Konfirmasi Rombongan)',
    priceInfo: 'Tiket & Paket: Hubungi Pengelola BUMDes',
    facilities: ['Area Outbound Luas', 'Pendopo / Aula Kumpul', 'Toilet & Kamar Bilas', 'Mushola', 'Area Parkir Rombongan'],
    mapsUrl: 'https://www.google.com/maps/search/?api=1&query=Wahana+Edukasi+%26+Outbound+Candi+Karangkemiri+Karanglewas+Banyumas',
    mapsEmbed: 'https://maps.google.com/maps?q=Wahana+Edukasi+%26+Outbound+Candi,+Karangkemiri,+Karanglewas,+Banyumas&t=&z=17&ie=UTF8&iwloc=B&output=embed',
    activityTitle: 'Kegiatan edukasi & outbound',
    activities: ['Permainan outbound & ketangkasan kelompok', 'Kegiatan edukasi sekolah, pramuka & famili'],
    waText: 'Halo BUMDes Karangkemiri, saya ingin menanyakan informasi kunjungan/reservasi untuk destinasi *Wahana Edukasi & Outbound Candi*.'
  },
  embung: {
    slug: 'embung',
    heroCaption: 'Embung Prabawulan',
    eyebrow: 'DESTINASI • WISATA ALAM',
    title: 'Embung Prabawulan',
    badge: 'Wisata Alam',
    location: 'Turanggal, Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas',
    description:
      'Kawasan wisata alam berupa embung (danau buatan) di tengah suasana pedesaan yang sejuk untuk rekreasi keluarga, bersantai sore, memancing, dan mengenal budidaya ikan air tawar.',
    hours: 'Senin – Minggu, 08:00 – 17:00 WIB',
    priceInfo: 'Tiket Masuk: Konfirmasi Pengelola BUMDes',
    facilities: ['Gazebo Santai', 'Spot Memancing', 'Area Parkir', 'Toilet', 'Warung Kuliner Lokal'],
    mapsUrl: 'https://www.google.com/maps/search/?api=1&query=Embung+Prabawulan+Karangkemiri+Karanglewas+Banyumas',
    mapsEmbed: 'https://maps.google.com/maps?q=Embung+Prabawulan,+Karangkemiri,+Karanglewas,+Banyumas&t=&z=17&ie=UTF8&iwloc=B&output=embed',
    activityTitle: 'Nikmati suasana alam',
    activities: ['Rekreasi tepi embung & pemandangan alam', 'Memancing & edukasi budidaya ikan'],
    waText: 'Halo BUMDes Karangkemiri, saya ingin menanyakan informasi kunjungan ke destinasi *Embung Prabawulan*.'
  },
  kelengkeng: {
    slug: 'kelengkeng',
    heroCaption: 'Agrowisata Kelengkeng Thabet',
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
    waText: 'Halo BUMDes Karangkemiri, saya ingin menanyakan jadwal kunjungan dan ketersediaan panen di *Agro Kelengkeng Thabet*.'
  },
  petilasan: {
    slug: 'petilasan',
    heroCaption: 'Warisan Budaya Lokal',
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
    waText: 'Halo BUMDes Karangkemiri, saya ingin menanyakan informasi dan ketentuan kunjungan ke *Petilasan Mbah Siti Benter*.'
  }
};

document.addEventListener('DOMContentLoaded', () => {
  initNavigationDrawer();
  initCategoryFilters();
  initDestinationDetail();
  initFeedbackModal();
  initAdminCMS();
});

/* 1. Hamburger Menu Drawer */
function initNavigationDrawer() {
  const menuBtn = document.getElementById('menuBtn');
  const drawer = document.getElementById('navDrawer');
  const backdrop = document.getElementById('drawerBackdrop');
  const closeBtn = document.getElementById('drawerClose');

  if (!menuBtn || !drawer || !backdrop) return;

  const openDrawer = () => {
    drawer.classList.add('open');
    backdrop.classList.add('open');
  };

  const closeDrawer = () => {
    drawer.classList.remove('open');
    backdrop.classList.remove('open');
  };

  menuBtn.addEventListener('click', openDrawer);
  if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
  backdrop.addEventListener('click', closeDrawer);
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
    const waBtnEl = document.getElementById('destWaBtn');
    const feedbackDestInput = document.getElementById('feedbackDestName');

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
    if (waBtnEl) {
      waBtnEl.href = `https://wa.me/6281234567890?text=${encodeURIComponent(data.waText)}`;
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

  openBtn.addEventListener('click', () => {
    modal.classList.add('open');
  });

  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      modal.classList.remove('open');
    });
  }

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.remove('open');
    }
  });

  if (feedbackForm) {
    feedbackForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const f1 = document.getElementById('rateFasilitas').value;
      const f2 = document.getElementById('rateKebersihan').value;
      const f3 = document.getElementById('ratePelayanan').value;

      if (f1 === '0' && f2 === '0' && f3 === '0') {
        showCustomPopup('Perhatian', 'Mohon beri penilaian minimal pada satu aspek (Fasilitas, Kebersihan, atau Pelayanan).', 'Mengerti');
        return;
      }

      feedbackForm.reset();
      modal.classList.remove('open');
      showCustomPopup('Masukan Terkirim', 'Terima kasih! Masukan Anda telah disimpan secara privat untuk bahan evaluasi Admin BUMDes Karangkemiri.', 'Tutup');
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
