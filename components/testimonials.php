<?php
/**
 * Client Testimonials & Reviews Component
 * Dynamically loads customer reviews from data/testimonials.json (Matched to Image 5)
 */
$testimonialsFile = __DIR__ . '/../data/testimonials.json';
$testimonials = [];
if (file_exists($testimonialsFile)) {
    $content = file_get_contents($testimonialsFile);
    $testimonials = json_decode($content, true) ?: [];
}

// Fallback if empty
if (empty($testimonials)) {
    $testimonials = [
        [
            'id' => 1,
            'name' => 'Budi Santoso',
            'role' => 'Wisudawan UI 2026',
            'service' => 'graduation',
            'service_label' => '🎓 Wisuda',
            'rating' => 5,
            'badge_class' => 'text-primary',
            'avatar_bg' => 'bg-primary',
            'comment' => 'Pelayanan ramah dan hasil foto cinematic super memuaskan!'
        ],
        [
            'id' => 2,
            'name' => 'Dewi Lestari',
            'role' => 'Wisudawati Trisakti 2026',
            'service' => 'graduation',
            'service_label' => '🎓 Wisuda',
            'rating' => 5,
            'badge_class' => 'text-primary',
            'avatar_bg' => 'bg-primary',
            'comment' => 'Foto wisudanya keren banget, pengarahannya asik dan ga kaku sama sekali. Recommended banget!'
        ],
        [
            'id' => 3,
            'name' => 'Rizky & Tim Trip Lesehan',
            'role' => 'Participant Belitung Expedition',
            'service' => 'trip',
            'service_label' => '🌄 Overland Trip',
            'rating' => 5,
            'badge_class' => 'text-amber',
            'avatar_bg' => 'bg-amber',
            'comment' => 'Paket Drone + Kamera pas trip Belitung kemarin beneran worth it parah. Video reels-nya rame banget di TikTok. Hasil foto landscape tajem dan tone warna sinematiknya dapet banget!'
        ]
    ];
}
?>
<!-- Client Testimonials & Reviews Component (Matched to Image 5) -->
<section id="testimonials" class="py-5 bg-white border-top">
  <div class="container py-4">
    <!-- Section Header (Matched to Image 5) -->
    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 max-w-900 mx-auto mb-5 scroll-reveal">
      <div>
        <span class="badge bg-amber-subtle text-amber border border-amber px-3 py-1.5 rounded-pill fw-bold small mb-2 d-inline-flex align-items-center gap-1.5">
          <i class="bi bi-chat-quote-fill"></i> Real Client Stories
        </span>
        <h2 class="fw-bold text-slate-900 display-6 mb-1">Kata Mereka tentang wsvisual.jkt</h2>
        <p class="text-secondary mb-0">Ulasan jujur dari para wisudawan, panitia event, dan peserta trip.</p>
      </div>
      <div class="flex-shrink-0">
        <button type="button" class="btn btn-outline-dark fw-bold rounded-pill px-3.5 py-2 shadow-xs d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTestimonial">
          <i class="bi bi-pencil-square text-amber"></i>
          <span>Tulis Ulasan Kamu</span>
        </button>
      </div>
    </div>

    <!-- Testimonials Cards Grid -->
    <div class="row row-mobile-scroll g-4 justify-content-center align-items-stretch" id="testimonials-grid">
      <?php foreach ($testimonials as $index => $item): 
        $initial = strtoupper(mb_substr($item['name'] ?? 'K', 0, 1, 'UTF-8'));
        $ratingNum = (int)($item['rating'] ?? 5);
        $badgeClass = !empty($item['badge_class']) ? $item['badge_class'] : 'text-primary';
        $avatarBg = !empty($item['avatar_bg']) ? $item['avatar_bg'] : 'bg-primary';
        $serviceLabel = !empty($item['service_label']) ? $item['service_label'] : '🎓 Wisuda';
      ?>
      <!-- Testimonial Item -->
      <div class="col-lg-4 col-md-6 scroll-reveal delay-<?= ($index % 3) + 1 ?>">
        <div class="card border shadow-sm rounded-4 p-4 h-100 bg-white portfolio-card d-flex flex-column">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="text-warning fs-6">
              <?php for ($s = 1; $s <= 5; $s++): ?>
                <i class="bi <?= $s <= $ratingNum ? 'bi-star-fill' : 'bi-star text-muted opacity-25' ?>"></i>
              <?php endfor; ?>
              <span class="text-dark fw-bold ms-1"><?= number_format($ratingNum, 1) ?></span>
            </div>
            <span class="<?= htmlspecialchars($badgeClass) ?> bg-light px-2.5 py-1 rounded-pill border fw-semibold small"><?= htmlspecialchars($serviceLabel) ?></span>
          </div>
          
          <p class="card-text text-secondary mb-4 flex-grow-1" style="font-style: italic; line-height: 1.65;">
            "<?= htmlspecialchars($item['comment']) ?>"
          </p>

          <div class="d-flex align-items-center gap-3 pt-3 border-top mt-auto">
            <div class="<?= htmlspecialchars($avatarBg) ?> text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-5 shadow-xs" style="width: 44px; height: 44px; min-width: 44px;">
              <?= htmlspecialchars($initial) ?>
            </div>
            <div class="min-w-0">
              <h6 class="fw-bold text-slate-900 mb-0 text-truncate"><?= htmlspecialchars($item['name']) ?></h6>
              <small class="text-muted text-truncate d-block"><?= htmlspecialchars($item['role'] ?? 'Klien WS Visual') ?></small>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
