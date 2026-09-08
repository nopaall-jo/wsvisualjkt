<!-- Portfolio Component with 3D Coverflow Showcase & 4-Category Pure Photo Gallery Grid (Matched to Image 2) -->
<section id="portfolio" class="py-5 bg-white">
  <div class="container py-4">
    <!-- Section Header (Clean without eyebrow badge as in Image 2) -->
    <div class="text-center max-w-700 mx-auto mb-4 scroll-reveal">
      <h2 class="fw-bold text-slate-900 display-6 mb-2">Galeri Karya Visual Terpopuler</h2>
      <p class="text-secondary mb-0" style="font-size: 0.95rem;">Dokumentasi sinematik portrait wisuda, overland trip alam terbuka, event seru, dan lanskap udara 4K.</p>
    </div>

    <!-- 3D Coverflow Showcase Carousel — 6 Slides -->
    <div class="swiper-coverflow-container scroll-reveal mb-4">
      <div class="swiper swiper-portfolio-coverflow">
        <div class="swiper-wrapper">
          <!-- Slide 1: Graduation -->
          <div class="swiper-slide">
            <img src="assets/foto/graduation_1.jpg" alt="Graduation Portrait">
          </div>

          <!-- Slide 2: Trip & Travel — Bromo Sunrise (centered on load) -->
          <div class="swiper-slide">
            <img src="assets/foto/trip_1.jpg" alt="Trip & Travel Expedition">
          </div>

          <!-- Slide 3: Live Event Concert -->
          <div class="swiper-slide">
            <img src="assets/foto/event_1.jpg" alt="Live Event Concert Stage">
          </div>

          <!-- Slide 4: F1 Night Race — Las Vegas Strip -->
          <div class="swiper-slide">
            <img src="assets/foto/rblas.jpg" alt="F1 Night Race Las Vegas">
          </div>

          <!-- Slide 5: F1 Race Start Grid -->
          <div class="swiper-slide">
            <img src="assets/foto/start.jpg" alt="F1 Race Start Grid">
          </div>

          <!-- Slide 6: Barcelona Trophy Celebration -->
          <div class="swiper-slide">
            <img src="assets/foto/barcasupercopa (14).jpg" alt="Victory Trophy Celebration">
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- 4 Category Filter Pills (Matched to Image 2: Turns warm brown/amber when clicked) -->
    <div class="d-flex justify-content-center flex-wrap gap-2 mb-4 scroll-reveal">
      <button type="button" class="filter-btn active" data-filter="all">Semua Foto</button>
      <button type="button" class="filter-btn" data-filter="graduation">Graduation</button>
      <button type="button" class="filter-btn" data-filter="school">School</button>
      <button type="button" class="filter-btn" data-filter="event">Event</button>
      <button type="button" class="filter-btn" data-filter="trip">Trip</button>
    </div>

    <!-- Pure Photo Grid (Landscape 16:9 - Matched exactly to Image 2) -->
    <div class="row g-3 g-md-4" id="portfolioGrid">
      <!-- Item 1: Graduation (Page 1, Row 1, Col 1) -->
      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="graduation">
        <div class="pure-photo-card">
          <img src="assets/foto/graduation_1.jpg" alt="Graduation Portrait 1">
        </div>
      </div>

      <!-- Item 2: Night Racetrack Motion Blur (Page 1, Row 1, Col 2 - assets/foto/a.jpg) -->
      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="event">
        <div class="pure-photo-card">
          <img src="assets/foto/a.jpg" alt="Night Track Motion Action">
        </div>
      </div>

      <!-- Item 3: F1 Track Cars Rounding Corner (Page 1, Row 1, Col 3 - assets/foto/b.jpg) -->
      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="event">
        <div class="pure-photo-card">
          <img src="assets/foto/b.jpg" alt="F1 Racing Cornering Action">
        </div>
      </div>

      <!-- Item 4: F1 Start Grid under Rolex Bridge (Page 1, Row 2, Col 1 - assets/foto/start.jpg) -->
      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="event">
        <div class="pure-photo-card">
          <img src="assets/foto/start.jpg" alt="Motorsport Start Grid">
        </div>
      </div>

      <!-- Item 5: Concert Festival Stage (Page 1, Row 2, Col 2 - assets/foto/event_1.jpg) -->
      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="event">
        <div class="pure-photo-card">
          <img src="assets/foto/event_1.jpg" alt="Live Fest Concert Stage">
        </div>
      </div>

      <!-- Item 6: Barca Campeones Stage Trophy Celebration (Page 1, Row 2, Col 3 - assets/foto/barcasupercopa (14).jpg) -->
      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="event">
        <div class="pure-photo-card">
          <img src="assets/foto/barcasupercopa (14).jpg" alt="Victory Trophy Celebration">
        </div>
      </div>

      <!-- Page 2 Items: Additional Photos for Categories -->
      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="graduation">
        <div class="pure-photo-card">
          <img src="assets/foto/graduation_1.jpg" alt="Graduation Portrait Session 2">
        </div>
      </div>

      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="school">
        <div class="pure-photo-card">
          <img src="assets/foto/garagde.jpg" alt="School Activity &amp; Event 1" onerror="this.src='assets/foto/a.jpg'">
        </div>
      </div>

      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="school">
        <div class="pure-photo-card">
          <img src="assets/foto/mexico.jpg" alt="School Activity 2" onerror="this.src='assets/foto/b.jpg'">
        </div>
      </div>

      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="trip">
        <div class="pure-photo-card">
          <img src="assets/foto/trip_1.jpg" alt="Bromo Travel Expedition 1">
        </div>
      </div>

      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="trip">
        <div class="pure-photo-card">
          <img src="assets/foto/ferlasv.jpg" alt="Outdoor Travel Adventure 2" onerror="this.src='assets/foto/trip_1.jpg'">
        </div>
      </div>

      <div class="col-6 col-md-6 col-lg-4 portfolio-item" data-category="trip">
        <div class="pure-photo-card">
          <img src="assets/foto/drone_1.jpg" alt="Aerial Drone Landscape Trip 3">
        </div>
      </div>
    </div>

    <!-- Pagination Navigation (Matched to Image 2 Capsule) -->
    <nav id="portfolioPagination" class="d-flex justify-content-center mt-4" aria-label="Portfolio gallery pagination"></nav>
  </div>
</section>
