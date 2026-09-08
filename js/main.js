/**
 * WS Visual Photo & Video - Bootstrap 5 Main Script
 * Handles scroll reveal animations, navbar scroll sync, portfolio filtering, price estimation, and WhatsApp booking.
 */

document.addEventListener('DOMContentLoaded', () => {
  // Force scroll to #home on every fresh page load — prevents jump to last hash
  if (window.location.hash) {
    history.replaceState(null, '', window.location.pathname);
  }
  window.scrollTo({ top: 0, behavior: 'instant' });

  initIntroSplash();
  initNavbarTransparency();
  initNavScrollSync();
  initScrollReveal();
  initPortfolioFilter();
  initBookingCalculator();
  initSwiperCoverflow();
  initTestimonialSubmission();
  initFeaturedReels();
});

/* ============================================================
   Intro Splash Screen — wsvisual.jkt Welcome Animation
   Shows logo + progress bar, then fades out revealing the page.
   ============================================================ */
function initIntroSplash() {
  const splash = document.getElementById('introSplash');
  if (!splash) return;

  // Lock scroll while splash is visible
  document.body.classList.add('intro-active');

  // Total display time before exit starts (ms)
  const HOLD_MS = 2200;
  // Duration of CSS exit transition (must match CSS transition: 0.7s)
  const EXIT_MS = 700;

  setTimeout(() => {
    // Trigger fade-out + slight zoom exit
    splash.classList.add('intro-exit');

    // After transition ends, fully hide and unlock scroll
    setTimeout(() => {
      splash.classList.add('intro-done');
      document.body.classList.remove('intro-active');
    }, EXIT_MS);
  }, HOLD_MS);
}

/* Navbar: Transparent over hero, solidifies on scroll */
function initNavbarTransparency() {
  const navbar = document.getElementById('mainNavbar');
  if (!navbar) return;

  function updateNavbar() {
    if (window.scrollY > 60) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  }

  window.addEventListener('scroll', updateNavbar, { passive: true });
  updateNavbar(); // run once on load
}

/* Format date from YYYY-MM-DD to "7 September 2026" (Indonesian) */
function formatTanggal(dateStr) {
  if (!dateStr) return 'Segera didiskusikan';
  const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  const [y, m, d] = dateStr.split('-');
  return `${parseInt(d)} ${bulan[parseInt(m) - 1]} ${y}`;
}

/* Direct WhatsApp opener — used by Diskusi WA & Tanya WA buttons */
function openWA(msg) {
  window.open('https://wa.me/6282112542619?text=' + encodeURIComponent(msg), '_blank');
}

/* Dynamic Navbar Scroll Sync & Click Handler (Snappy, Zero-Lag, Real-Time) */
function initNavScrollSync() {
  const sections = Array.from(document.querySelectorAll('section[id]'));
  const navLinks = Array.from(document.querySelectorAll('.navbar-nav .nav-link'));
  const navbarCollapse = document.getElementById('navbarContent');

  function setActive(targetId) {
    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      if (href === '#' + targetId) {
        link.classList.add('active');
      } else {
        link.classList.remove('active', 'bg-amber-subtle', 'text-amber');
      }
    });
  }

  // Smooth scroll handler & mobile menu auto-close
  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      const targetId = link.getAttribute('href');
      if (targetId && targetId.startsWith('#')) {
        const targetSec = document.querySelector(targetId);
        if (targetSec) {
          e.preventDefault();
          setActive(targetId.substring(1));

          const targetTop = targetSec.getBoundingClientRect().top + window.scrollY - 75;
          window.scrollTo({ top: Math.max(0, targetTop), behavior: 'smooth' });

          // Auto collapse mobile menu if open
          if (navbarCollapse && navbarCollapse.classList.contains('show')) {
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse) bsCollapse.hide();
          }
        }
      }
    });
  });

  // High-performance real-time scroll spy
  function onScroll() {
    const scrollY = window.scrollY;

    // Top of page: always Beranda (#home)
    if (scrollY < 120) {
      setActive('home');
      return;
    }

    // Bottom of page: always last section (#faq)
    if ((window.innerHeight + scrollY) >= (document.documentElement.scrollHeight - 60)) {
      const last = sections[sections.length - 1];
      if (last) setActive(last.id);
      return;
    }

    // Detect section currently in focus
    const threshold = 130;
    let currentId = 'home';

    sections.forEach(section => {
      const top = section.offsetTop - threshold;
      const height = section.offsetHeight;
      if (scrollY >= top && scrollY < top + height) {
        currentId = section.id;
      }
    });

    setActive(currentId);
  }

  let ticking = false;
  window.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        onScroll();
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });

  // Initial call on load
  onScroll();
}

/* Scroll Reveal Animations */
function initScrollReveal() {
  const revealElements = document.querySelectorAll('.scroll-reveal');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
      }
    });
  }, { threshold: 0.15 });

  revealElements.forEach(el => observer.observe(el));
}

let portfolioSwiperInstance = null;

/* Swiper 3D Coverflow Initialization — 6 Slides */
function initSwiperCoverflow() {
  if (typeof Swiper === 'undefined') return;
  const coverflowEl = document.querySelector('.swiper-portfolio-coverflow');
  if (coverflowEl) {
    portfolioSwiperInstance = new Swiper('.swiper-portfolio-coverflow', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      initialSlide: 1,
      observer: true,
      observeParents: true,
      coverflowEffect: {
        rotate: 15,
        stretch: 0,
        depth: 120,
        modifier: 1,
        slideShadows: true,
      },
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  }
}


/* Portfolio Category Filtering & Compact Capsule Pagination (Original) */
function initPortfolioFilter() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const allItems = Array.from(document.querySelectorAll('.portfolio-item'));
  const paginationNav = document.getElementById('portfolioPagination');

  const itemsPerPage = 6;
  let currentPage = 1;
  let currentFilter = 'all';

  function renderGrid(animate = false) {
    if (!allItems.length) return;

    // Filter items by category
    const matchingItems = allItems.filter(item => {
      const category = item.getAttribute('data-category');
      return currentFilter === 'all' || category === currentFilter;
    });

    const totalPages = Math.ceil(matchingItems.length / itemsPerPage) || 1;
    if (currentPage > totalPages) currentPage = totalPages;
    if (currentPage < 1) currentPage = 1;

    // Hide all items first & clear animation
    allItems.forEach(item => {
      item.style.display = 'none';
      item.classList.remove('is-transitioning');
    });

    // Show items for the current page
    const startIdx = (currentPage - 1) * itemsPerPage;
    const endIdx = startIdx + itemsPerPage;
    const pageItems = matchingItems.slice(startIdx, endIdx);

    pageItems.forEach(item => {
      item.style.display = 'block';
      if (animate) {
        void item.offsetWidth; // trigger reflow for animation
        item.classList.add('is-transitioning');
      }
    });

    // Render original compact capsule pagination
    if (paginationNav) {
      if (totalPages <= 1) {
        paginationNav.innerHTML = '';
      } else {
        let html = '<ul class="pagination pagination-sm shadow-xs rounded-pill overflow-hidden bg-white mb-0 border">';

        // Prev button
        html += `
          <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <button type="button" class="page-link" data-page="${currentPage - 1}" aria-label="Previous" ${currentPage === 1 ? 'disabled' : ''}>
              <span aria-hidden="true">&laquo;</span> Prev
            </button>
          </li>
        `;

        // Page number buttons
        for (let i = 1; i <= totalPages; i++) {
          html += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
              <button type="button" class="page-link" data-page="${i}">${i}</button>
            </li>
          `;
        }

        // Next button
        html += `
          <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <button type="button" class="page-link" data-page="${currentPage + 1}" aria-label="Next" ${currentPage === totalPages ? 'disabled' : ''}>
              Next <span aria-hidden="true">&raquo;</span>
            </button>
          </li>
        `;

        html += '</ul>';
        paginationNav.innerHTML = html;

        // Attach click listeners to pagination buttons
        paginationNav.querySelectorAll('button.page-link').forEach(btn => {
          btn.addEventListener('click', (e) => {
            e.preventDefault();
            const page = parseInt(btn.getAttribute('data-page'), 10);
            if (page && page !== currentPage && page >= 1 && page <= totalPages) {
              currentPage = page;
              renderGrid(true); // Smoothly slide & switch photos right in place, no scrolling up!
            }
          });
        });
      }
    }
  }

  // Filter button listeners - whichever button is clicked turns warm brown/amber
  filterBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      currentFilter = btn.getAttribute('data-filter') || 'all';
      currentPage = 1; // Reset to page 1 on filter switch
      renderGrid(true);
    });
  });

  // Initial render on page load without animation
  renderGrid(false);
}

/* Booking Price Calculator & WhatsApp Form Handler */
function initBookingCalculator() {
  const serviceSelect  = document.getElementById('bookService');
  const packageSelect  = document.getElementById('bookPackage');
  const areaSelect     = document.getElementById('bookArea');
  const priceDisplay   = document.getElementById('estimatedPriceDisplay');
  const bookingForm    = document.getElementById('bookingForm');
  const pricePlaceholder = document.getElementById('priceBoxPlaceholder');
  const priceResult      = document.getElementById('priceBoxResult');
  const transportFeeNote = document.getElementById('transportFeeNote');

  // Show/hide price box helpers (using Bootstrap d-none for reliability)
  function showPriceBox() {
    if (pricePlaceholder) pricePlaceholder.classList.add('d-none');
    if (priceResult)      priceResult.classList.remove('d-none');
  }
  function hidePriceBox() {
    if (pricePlaceholder) pricePlaceholder.classList.remove('d-none');
    if (priceResult)      priceResult.classList.add('d-none');
  }

  // All packages grouped by service, each with a name and base price
  const packagesByService = {
    graduation: [
      { name: 'Personal (350K)',  price: 350000 },
      { name: 'Couple (400K)',    price: 400000 },
      { name: 'Group (500K)',     price: 500000 }
    ],
    school: [
      { name: 'Personal (350K)',  price: 350000 },
      { name: 'Couple (400K)',    price: 400000 },
      { name: 'Group (500K)',     price: 500000 }
    ],
    event: [
      { name: 'Drone Only (500K)',       price: 500000 },
      { name: 'Camera Only (600K)',      price: 600000 },
      { name: 'Camera + Drone (800K)',   price: 800000 }
    ],
    trip: [
      { name: 'Camera Only Trip (450K/Day)',     price: 450000 },
      { name: 'Camera + Drone Trip (700K/Day)',  price: 700000 }
    ]
  };

  const areaFees = {
    'Jakarta Selatan': 0,  'Jakarta Barat': 0,   'Jakarta Pusat': 0,
    'Jakarta Timur': 0,    'Jakarta Utara': 0,
    'Bogor': 0,            'Depok': 0,           'Tangerang / BSD': 0, 'Bekasi': 0
  };

  // Reset dropdowns to placeholder
  function resetToPlaceholder() {
    if (serviceSelect) serviceSelect.value = '';
    if (packageSelect) {
      packageSelect.innerHTML = '<option value="" disabled selected>-- Pilih Paket --</option>';
    }
    if (areaSelect) areaSelect.value = '';
    hidePriceBox();
  }

  // Populate package <select> based on current service value.
  // Optionally pre-select a specific package name.
  function syncPackageOptions(presetPackageName) {
    if (!serviceSelect || !packageSelect) return;
    const service = serviceSelect.value;

    // No service selected yet — show placeholder only
    if (!service) {
      packageSelect.innerHTML = '<option value="" disabled selected>-- Pilih Paket --</option>';
      hidePriceBox();
      return;
    }

    const list = packagesByService[service] || [];
    packageSelect.innerHTML = '';

    // If no preset, add placeholder first so user must actively choose
    if (!presetPackageName) {
      const placeholder = document.createElement('option');
      placeholder.value = '';
      placeholder.textContent = '-- Pilih Paket --';
      placeholder.disabled = true;
      placeholder.selected = true;
      packageSelect.appendChild(placeholder);
    }

    list.forEach(pkgObj => {
      const opt = document.createElement('option');
      opt.value = pkgObj.name;
      opt.textContent = pkgObj.name;
      packageSelect.appendChild(opt);
    });

    // Pre-select if a preset package name was provided
    if (presetPackageName) {
      const found = Array.from(packageSelect.options).find(o => o.value === presetPackageName);
      if (found) found.selected = true;
      updatePrice(true);
    } else {
      hidePriceBox();
    }
  }

  function updatePrice(reveal) {
    if (!serviceSelect || !packageSelect || !priceDisplay) return;

    const service = serviceSelect.value;
    const pkgName = packageSelect.value;
    const area    = areaSelect ? areaSelect.value : '';

    // Guide user with clear message depending on what is still missing
    if (pricePlaceholder) {
      if (service && pkgName && !area) {
        pricePlaceholder.innerHTML = '<i class="bi bi-geo-alt-fill text-amber fs-5"></i><small class="text-muted">Silakan pilih <strong>Lokasi Coverage (Jabodetabek)</strong> untuk melihat total estimasi biaya.</small>';
      } else {
        pricePlaceholder.innerHTML = '<i class="bi bi-info-circle text-secondary fs-5"></i><small class="text-muted">Pilih <strong>Kategori Layanan</strong>, <strong>Paket</strong>, dan <strong>Lokasi Coverage</strong> untuk melihat estimasi biaya.</small>';
      }
    }

    // If service, package, or area is not selected yet, ensure price box stays hidden
    if (!service || !pkgName || !area) {
      hidePriceBox();
      return;
    }

    const list     = packagesByService[service] || [];
    const foundPkg = list.find(p => p.name === pkgName);
    if (!foundPkg) return;

    const fee      = areaFees[area] || 0;
    priceDisplay.textContent = 'Rp ' + (foundPkg.price + fee).toLocaleString('id-ID');

    if (transportFeeNote) {
      transportFeeNote.textContent = '*Termasuk Transport Jabodetabek';
    }

    // reveal=true means all fields selected — show the price box
    if (reveal) showPriceBox();
  }

  // User manually changes service — repopulate packages but keep price hidden until paket dipilih
  if (serviceSelect) serviceSelect.addEventListener('change', () => { syncPackageOptions(); });
  // User manually picks a package — update price
  if (packageSelect) packageSelect.addEventListener('change', () => updatePrice(true));
  // User picks area — update price
  if (areaSelect)    areaSelect.addEventListener('change', () => updatePrice(true));

  // --- Modal show event: runs EVERY time modal opens, gets the triggering button ---
  const bookingModalEl = document.getElementById('bookingModal');
  if (bookingModalEl) {
    bookingModalEl.addEventListener('show.bs.modal', event => {
      const triggerBtn    = event.relatedTarget;
      const presetService = triggerBtn ? triggerBtn.getAttribute('data-service') : null;
      const presetPackage = triggerBtn ? triggerBtn.getAttribute('data-package') : null;

      // Always reset area so customer explicitly chooses location
      if (areaSelect) areaSelect.value = '';

      if (presetService) {
        // Opened from a pricing card — auto-fill & LOCK dropdowns
        serviceSelect.value = presetService;
        syncPackageOptions(presetPackage || null);
        serviceSelect.disabled = true;
        packageSelect.disabled = true;
      } else {
        // Opened without context — reset & UNLOCK dropdowns
        resetToPlaceholder();
        serviceSelect.disabled = false;
        packageSelect.disabled = false;
      }
    });
  }

  // Initial page load: start blank
  resetToPlaceholder();


  // --- WhatsApp Submit Handler ---
  if (bookingForm) {
    bookingForm.addEventListener('submit', e => {
      e.preventDefault();

      const name      = document.getElementById('bookName').value.trim();
      const phone     = document.getElementById('bookPhone').value.trim();
      const dateEl    = document.getElementById('bookDate');
      const date      = dateEl ? dateEl.value.trim() : '';
      const service   = (serviceSelect.selectedIndex >= 0 && serviceSelect.options[serviceSelect.selectedIndex])
        ? serviceSelect.options[serviceSelect.selectedIndex].text
        : '';
      const pkg       = packageSelect.value;
      const area      = areaSelect.value;
      const notes     = document.getElementById('bookNotes').value.trim();
      const priceText = priceDisplay.textContent;

      // Optional background save
      fetch('api/booking.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, phone, service, package: pkg, area, date, notes, price: priceText })
      }).catch(() => {});

      const messageText =
`Halo kak, saya ingin melakukan *booking sesi foto* di *wsvisual.jkt*.

*Detail Booking*

*Nama:* ${name}
*No. WhatsApp:* ${phone}
*Layanan:* ${service}
*Paket:* ${pkg}
*Area Coverage:* ${area} (Jabodetabek)
*Tanggal Acara:* ${formatTanggal(date)}
*Estimasi Total:* ${priceText}
*Catatan:* ${notes || 'Tidak ada'}

Mohon info ketersediaan jadwal dan proses selanjutnya ya, kak.
Terima kasih.`;

      const waUrl = `https://wa.me/6282112542619?text=${encodeURIComponent(messageText)}`;
      window.open(waUrl, '_blank');

      // Close modal
      const modalEl = document.getElementById('bookingModal');
      const modalInstance = bootstrap.Modal.getInstance(modalEl);
      if (modalInstance) modalInstance.hide();
    });
  }
}

/* ==========================================================================
   Customer Review / Testimonial Real-Time Submission Handler
   ========================================================================== */
function initTestimonialSubmission() {
  const form = document.getElementById('form-testimonial');
  if (!form) return;

  const stars = form.querySelectorAll('.rating-star');
  const ratingInput = document.getElementById('review-rating-input');
  const ratingLabel = document.getElementById('rating-label-text');
  const alertBox = document.getElementById('testimonial-alert');
  const submitBtn = document.getElementById('btn-submit-testimonial');

  const ratingDescriptions = {
    1: '1.0 • Kurang Memuaskan',
    2: '2.0 • Cukup, Masih Perlu Peningkatan',
    3: '3.0 • Bagus & Sesuai Ekspektasi',
    4: '4.0 • Sangat Bagus & Memuaskan!',
    5: '5.0 • Luar Biasa! Sangat Puas Banget ⭐'
  };

  // Update star visuals
  function setStars(rating) {
    stars.forEach(s => {
      const val = parseInt(s.getAttribute('data-rating'), 10);
      if (val <= rating) {
        s.classList.remove('bi-star', 'text-muted', 'opacity-25');
        s.classList.add('bi-star-fill', 'text-warning');
      } else {
        s.classList.remove('bi-star-fill', 'text-warning');
        s.classList.add('bi-star', 'text-muted', 'opacity-25');
      }
    });
    if (ratingLabel && ratingDescriptions[rating]) {
      ratingLabel.textContent = ratingDescriptions[rating];
    }
  }

  // Interactive star click & hover
  stars.forEach(star => {
    star.addEventListener('click', () => {
      const val = parseInt(star.getAttribute('data-rating'), 10);
      ratingInput.value = val;
      setStars(val);
    });

    star.addEventListener('mouseenter', () => {
      const val = parseInt(star.getAttribute('data-rating'), 10);
      setStars(val);
    });
  });

  const picker = form.querySelector('.star-rating-picker');
  if (picker) {
    picker.addEventListener('mouseleave', () => {
      const currentVal = parseInt(ratingInput.value, 10) || 5;
      setStars(currentVal);
    });
  }

  // Handle AJAX submission
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const name = document.getElementById('review-name').value.trim();
    const role = document.getElementById('review-role').value.trim();
    const service = document.getElementById('review-service').value;
    const rating = parseInt(ratingInput.value, 10) || 5;
    const comment = document.getElementById('review-comment').value.trim();

    if (!name) {
      showAlert('danger', 'Nama lengkap wajib diisi.');
      return;
    }

    if (!comment || comment.length < 5) {
      showAlert('danger', 'Mohon tuliskan ulasan pengalaman Anda (minimal 5 karakter).');
      return;
    }

    // Button loading state
    const originalBtnHtml = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Menerbitkan Ulasan...';

    try {
      const response = await fetch('api/testimonial.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, role, service, rating, comment })
      });

      const result = await response.json();

      if (result.success && result.testimonial) {
        const item = result.testimonial;

        // Construct star icons HTML
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
          if (i <= item.rating) {
            starsHtml += '<i class="bi bi-star-fill"></i> ';
          } else {
            starsHtml += '<i class="bi bi-star text-muted opacity-25"></i> ';
          }
        }

        const initial = (item.name || 'K').charAt(0).toUpperCase();

        // Create new testimonial DOM card
        const grid = document.getElementById('testimonials-grid');
        if (grid) {
          const col = document.createElement('div');
          col.className = 'col-lg-4 col-md-6 scroll-reveal active';
          col.style.transition = 'all 0.5s ease';
          col.innerHTML = `
            <div class="card border-amber border-2 shadow-lg rounded-4 p-4 h-100 bg-white portfolio-card d-flex flex-column" style="border-top: 4px solid #f59e0b !important; animation: fadeInDown 0.6s ease;">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="text-warning fs-6">
                  ${starsHtml}
                  <span class="text-dark fw-bold ms-1">${parseFloat(item.rating).toFixed(1)}</span>
                </div>
                <span class="${item.badge_class || 'text-primary'} fw-semibold small">${item.service_label}</span>
              </div>
              
              <p class="card-text text-secondary italic mb-4 flex-grow-1">
                "${item.comment}"
              </p>

              <div class="d-flex align-items-center gap-3 pt-3 border-top mt-auto">
                <div class="${item.avatar_bg || 'bg-primary'} text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-5 shadow-sm" style="width: 44px; height: 44px; min-width: 44px;">
                  ${initial}
                </div>
                <div class="min-w-0">
                  <div class="d-flex align-items-center gap-1.5">
                    <h6 class="fw-bold text-dark mb-0 text-truncate">${item.name}</h6>
                    <span class="badge bg-success-subtle text-success border border-success" style="font-size: 0.65rem;">Baru</span>
                  </div>
                  <small class="text-muted text-truncate d-block">${item.role || 'Klien WS Visual'}</small>
                </div>
              </div>
            </div>
          `;

          // Prepend as first card in the testimonials grid!
          grid.insertBefore(col, grid.firstChild);

          // Smooth scroll to testimonials
          const testSec = document.getElementById('testimonials');
          if (testSec) {
            testSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }

        // Close modal
        const modalEl = document.getElementById('modalTestimonial');
        if (modalEl) {
          const bsModal = bootstrap.Modal.getInstance(modalEl);
          if (bsModal) bsModal.hide();
        }

        // Reset form
        form.reset();
        ratingInput.value = '5';
        setStars(5);
        if (alertBox) alertBox.classList.add('d-none');

        // Toast success alert
        showCustomNotification('🎉 Ulasan Anda Berhasil Diterbitkan!', 'Terima kasih telah berbagi pengalaman bersama tim WS Visual Photo & Video.');

      } else {
        showAlert('danger', result.message || 'Gagal menerbitkan ulasan. Silakan coba lagi.');
      }
    } catch (err) {
      showAlert('danger', 'Terjadi gangguan koneksi. Pastikan server lokal aktif.');
    } finally {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalBtnHtml;
    }
  });

  function showAlert(type, msg) {
    if (!alertBox) return;
    alertBox.className = `alert alert-${type} py-2 px-3 small rounded-3 mb-3`;
    alertBox.textContent = msg;
    alertBox.classList.remove('d-none');
  }
}

/* Reusable Floating Toast Notification */
function showCustomNotification(title, message) {
  let toastContainer = document.getElementById('ws-toast-container');
  if (!toastContainer) {
    toastContainer = document.createElement('div');
    toastContainer.id = 'ws-toast-container';
    toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
    toastContainer.style.zIndex = '1090';
    document.body.appendChild(toastContainer);
  }

  const toastEl = document.createElement('div');
  toastEl.className = 'toast align-items-center text-bg-dark border-0 shadow-lg rounded-4 show mb-2';
  toastEl.setAttribute('role', 'alert');
  toastEl.setAttribute('aria-live', 'assertive');
  toastEl.setAttribute('aria-atomic', 'true');
  toastEl.innerHTML = `
    <div class="d-flex p-3 align-items-start">
      <div class="toast-body p-0 flex-grow-1">
        <div class="fw-bold text-warning mb-1">${title}</div>
        <div class="small text-slate-200">${message}</div>
      </div>
      <button type="button" class="btn-close btn-close-white me-1 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  `;

  toastContainer.appendChild(toastEl);
  setTimeout(() => {
    toastEl.classList.remove('show');
    setTimeout(() => toastEl.remove(), 300);
  }, 5000);
}

/* ============================================================
   Featured Work / Featured Reels (Floating 9:16 Video Player)
   Auto-delayed entrance after splash screen, carousel, mobile swipe,
   single-stream lazy load, and modal viewer.
   ============================================================ */
function initFeaturedReels() {
  const container = document.getElementById('featuredReelsContainer');
  const frame = document.getElementById('reelsVideoFrame');
  const video = document.getElementById('reelsVideoPlayer');
  const sourceWebm = document.getElementById('reelsSourceWebm');
  const sourceMp4 = document.getElementById('reelsSourceMp4');
  const prevBtn = document.getElementById('reelsPrevBtn');
  const nextBtn = document.getElementById('reelsNextBtn');
  const closeBtn = document.getElementById('reelsCloseBtn');
  const muteBtn = document.getElementById('reelsMuteToggle');
  const reopenBtn = document.getElementById('featuredReelsReopenBtn');

  const currentNumEl = document.getElementById('reelsCurrentNum');
  const titleEl = document.getElementById('reelsTitle');
  const categoryEl = document.getElementById('reelsCategory');

  // Modal elements
  const modal = document.getElementById('featuredReelsModal');
  const modalBackdrop = document.getElementById('reelsModalBackdrop');
  const modalCloseBtn = document.getElementById('reelsModalCloseBtn');
  const modalVideo = document.getElementById('reelsModalVideo');
  const modalSourceWebm = document.getElementById('reelsModalSourceWebm');
  const modalSourceMp4 = document.getElementById('reelsModalSourceMp4');
  const modalMuteBtn = document.getElementById('reelsModalMuteToggle');
  const modalPrevBtn = document.getElementById('reelsModalPrevBtn');
  const modalNextBtn = document.getElementById('reelsModalNextBtn');
  const modalCurrentNumEl = document.getElementById('reelsModalCurrentNum');
  const modalTitleEl = document.getElementById('reelsModalTitle');
  const modalCategoryEl = document.getElementById('reelsModalCategory');

  if (!container || !video) return;

  const REELS_DATA = [
    {
      num: '01',
      category: '<i class="bi bi-tiktok"></i> TIKTOK REEL',
      title: '@withlesehan',
      webm: 'assets/videos/latest-work-01.webm',
      mp4: 'assets/videos/latest-work-01.mp4'
    },
    {
      num: '02',
      category: '<i class="bi bi-instagram"></i> INSTAGRAM REEL',
      title: '@wsvisual.jkt',
      webm: 'assets/videos/latest-work-02.webm',
      mp4: 'assets/videos/latest-work-02.mp4'
    },
    {
      num: '03',
      category: '<i class="bi bi-instagram"></i> INSTAGRAM REEL',
      title: '@afifdhiya.ul',
      webm: 'assets/videos/latest-work-03.webm',
      mp4: 'assets/videos/latest-work-03.mp4'
    },
    {
      num: '04',
      category: '<i class="bi bi-tiktok"></i> TIKTOK REEL',
      title: '@afifdhiyaa',
      webm: 'assets/videos/latest-work-04.webm',
      mp4: 'assets/videos/latest-work-04.mp4'
    }
  ];

  let currentIndex = 0;
  let isMuted = true;
  let isModalOpen = false;

  function updateReel(index) {
    currentIndex = index;
    const item = REELS_DATA[currentIndex];

    // Update floating player
    if (sourceWebm) sourceWebm.src = item.webm;
    if (sourceMp4) sourceMp4.src = item.mp4;
    video.load();
    video.muted = isMuted;
    video.play().catch(() => {});

    if (currentNumEl) currentNumEl.textContent = item.num;
    if (titleEl) titleEl.textContent = item.title;
    if (categoryEl) categoryEl.innerHTML = item.category;

    // Update modal if open
    if (isModalOpen) {
      if (modalSourceWebm) modalSourceWebm.src = item.webm;
      if (modalSourceMp4) modalSourceMp4.src = item.mp4;
      modalVideo.load();
      modalVideo.muted = false;
      modalVideo.play().catch(() => {});
      if (modalCurrentNumEl) modalCurrentNumEl.textContent = item.num;
      if (modalTitleEl) modalTitleEl.textContent = item.title;
      if (modalCategoryEl) modalCategoryEl.innerHTML = item.category;
    }
  }

  function nextReel() {
    const nextIdx = (currentIndex + 1) % REELS_DATA.length;
    updateReel(nextIdx);
  }

  function prevReel() {
    const prevIdx = (currentIndex - 1 + REELS_DATA.length) % REELS_DATA.length;
    updateReel(prevIdx);
  }

  // Next / Prev click handlers
  if (nextBtn) {
    nextBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      nextReel();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      prevReel();
    });
  }

  // Floating mute toggle
  if (muteBtn) {
    muteBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      isMuted = !isMuted;
      video.muted = isMuted;
      const icon = muteBtn.querySelector('i');
      if (icon) {
        icon.className = isMuted ? 'bi bi-volume-mute-fill' : 'bi bi-volume-up-fill';
      }
      muteBtn.setAttribute('aria-label', isMuted ? 'Aktifkan Suara' : 'Bisukan Suara');
    });
  }

  // Close floating player
  if (closeBtn) {
    closeBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      video.pause();
      container.classList.remove('reels-active');
      if (reopenBtn) {
        reopenBtn.style.display = 'inline-flex';
      }
    });
  }

  // Reopen floating player
  if (reopenBtn) {
    reopenBtn.addEventListener('click', () => {
      reopenBtn.style.display = 'none';
      container.classList.add('reels-active');
      video.play().catch(() => {});
    });
  }

  // Touch Swipe for Mobile (left = next, right = prev)
  let touchStartX = 0;
  let touchStartY = 0;
  let touchStartTime = 0;

  if (frame) {
    frame.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
      touchStartY = e.changedTouches[0].screenY;
      touchStartTime = Date.now();
    }, { passive: true });

    frame.addEventListener('touchend', (e) => {
      const diffX = e.changedTouches[0].screenX - touchStartX;
      const diffY = e.changedTouches[0].screenY - touchStartY;
      const elapsed = Date.now() - touchStartTime;

      // Horizontal swipe detected
      if (Math.abs(diffX) > 35 && Math.abs(diffX) > Math.abs(diffY) && elapsed < 500) {
        if (diffX < 0) {
          nextReel();
        } else {
          prevReel();
        }
      }
    }, { passive: true });

    // Clicking on frame opens Modal Viewer
    frame.addEventListener('click', (e) => {
      // Ignore if click originated from interactive buttons
      if (e.target.closest('button')) return;
      openModal();
    });
  }

  // Modal Functions
  function openModal() {
    if (!modal) return;
    isModalOpen = true;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden'; // lock background scroll

    // Pause floating video while modal is active
    video.pause();

    const item = REELS_DATA[currentIndex];
    if (modalSourceWebm) modalSourceWebm.src = item.webm;
    if (modalSourceMp4) modalSourceMp4.src = item.mp4;
    modalVideo.load();
    modalVideo.muted = false; // unmuted by default in modal
    modalVideo.play().catch(() => {
      // If browser blocks unmuted autoplay, fallback to muted
      modalVideo.muted = true;
      modalVideo.play().catch(() => {});
    });

    if (modalCurrentNumEl) modalCurrentNumEl.textContent = item.num;
    if (modalTitleEl) modalTitleEl.textContent = item.title;
    if (modalCategoryEl) modalCategoryEl.innerHTML = item.category;

    // Update modal mute button icon
    if (modalMuteBtn) {
      const icon = modalMuteBtn.querySelector('i');
      if (icon) {
        icon.className = modalVideo.muted ? 'bi bi-volume-mute-fill' : 'bi bi-volume-up-fill';
      }
    }
  }

  function closeModal() {
    if (!modal) return;
    isModalOpen = false;
    modalVideo.pause();
    modal.style.display = 'none';
    document.body.style.overflow = ''; // unlock scroll

    // Resume floating video
    video.play().catch(() => {});
  }

  if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
  if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);

  if (modalMuteBtn) {
    modalMuteBtn.addEventListener('click', () => {
      modalVideo.muted = !modalVideo.muted;
      const icon = modalMuteBtn.querySelector('i');
      if (icon) {
        icon.className = modalVideo.muted ? 'bi bi-volume-mute-fill' : 'bi bi-volume-up-fill';
      }
    });
  }

  if (modalNextBtn) {
    modalNextBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      nextReel();
    });
  }

  if (modalPrevBtn) {
    modalPrevBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      prevReel();
    });
  }

  // Keyboard navigation & Esc to close
  window.addEventListener('keydown', (e) => {
    if (isModalOpen) {
      if (e.key === 'Escape') closeModal();
      if (e.key === 'ArrowRight') nextReel();
      if (e.key === 'ArrowLeft') prevReel();
    }
  });

  // Entrance timing: Wait until splash screen finishes + 4.5 seconds delay
  function triggerEntrance() {
    container.classList.add('reels-active');
    video.play().catch(() => {});
  }

  const splash = document.getElementById('introSplash');
  const DELAY_AFTER_SPLASH = 4500;

  if (splash && !splash.classList.contains('intro-done')) {
    // 2200ms hold + 700ms exit = 2900ms + 4500ms = 7400ms
    setTimeout(triggerEntrance, 2900 + DELAY_AFTER_SPLASH);
  } else {
    setTimeout(triggerEntrance, DELAY_AFTER_SPLASH);
  }
}
