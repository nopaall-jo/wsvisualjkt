<?php
/**
 * Featured Work / Featured Reels Component
 * Fixed floating 9:16 video player at bottom-right with interactive carousel & modal viewer
 */
?>
<!-- Featured Reels Floating Player -->
<div id="featuredReelsContainer" class="ws-featured-reels" aria-label="Featured Work Player" role="region">
  
  <!-- Video Frame & Surface -->
  <div class="ws-reels-frame" id="reelsVideoFrame" title="Klik untuk memperbesar video">
    <!-- Single Active Video (Dynamically Swapped for High Performance) -->
    <video id="reelsVideoPlayer"
           autoplay
           muted
           loop
           playsinline
           preload="metadata"
           class="ws-reels-video">
      <source id="reelsSourceWebm" src="assets/videos/latest-work-01.webm" type="video/webm">
      <source id="reelsSourceMp4" src="assets/videos/latest-work-01.mp4" type="video/mp4">
      Browser Anda tidak mendukung video HTML5.
    </video>

    <!-- Top Controls Overlay -->
    <div class="ws-reels-overlay-top">
      <div class="ws-reels-badge">
        <span class="ws-reels-dot"></span>
        <span class="ws-reels-badge-text">FEATURED WORK</span>
      </div>
      <div class="ws-reels-actions">
        <button type="button" class="ws-reels-btn-icon" id="reelsMuteToggle" aria-label="Aktifkan Suara" title="Suara">
          <i class="bi bi-volume-mute-fill"></i>
        </button>
        <button type="button" class="ws-reels-btn-icon ws-reels-close" id="reelsCloseBtn" aria-label="Tutup Featured Work" title="Tutup">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
    </div>

    <!-- Center Play/Expand Cue on Hover -->
    <div class="ws-reels-expand-cue">
      <div class="ws-reels-cue-icon">
        <i class="bi bi-arrows-angle-expand"></i>
      </div>
      <span class="ws-reels-cue-text">Perbesar</span>
    </div>

    <!-- Bottom Controls Overlay -->
    <div class="ws-reels-overlay-bottom">
      <div class="ws-reels-meta">
        <span class="ws-reels-category" id="reelsCategory"><i class="bi bi-tiktok"></i> TIKTOK REEL</span>
        <h4 class="ws-reels-title" id="reelsTitle">@withlesehan</h4>
      </div>

      <div class="ws-reels-nav-row">
        <!-- Prev Button -->
        <button type="button" class="ws-reels-nav-btn" id="reelsPrevBtn" aria-label="Video Sebelumnya" title="Sebelumnya">
          <i class="bi bi-chevron-left"></i>
        </button>

        <!-- Slide Counter -->
        <div class="ws-reels-counter" aria-live="polite">
          <span id="reelsCurrentNum" class="ws-reels-current">01</span>
          <span class="ws-reels-divider">/</span>
          <span class="ws-reels-total">04</span>
        </div>

        <!-- Next Button -->
        <button type="button" class="ws-reels-nav-btn" id="reelsNextBtn" aria-label="Video Berikutnya" title="Berikutnya">
          <i class="bi bi-chevron-right"></i>
        </button>
      </div>
    </div>

  </div>
</div>

<!-- Reopen Mini Pill Button (Revealed when closed) -->
<button type="button"
        id="featuredReelsReopenBtn"
        class="ws-reels-reopen-pill"
        aria-label="Buka kembali Featured Work"
        title="Lihat Featured Work"
        style="display: none;">
  <span class="ws-reels-reopen-dot"></span>
  <i class="bi bi-film text-warning"></i>
  <span class="ws-reels-reopen-label">Featured Work</span>
  <span class="badge bg-warning text-dark rounded-pill px-2 py-0-5 small fw-bold">4</span>
</button>

<!-- Enlarged Modal Viewer (Fullscreen 9:16) -->
<div id="featuredReelsModal" class="ws-reels-modal" role="dialog" aria-modal="true" aria-label="Featured Work Fullscreen Viewer" style="display: none;">
  <div class="ws-reels-modal-backdrop" id="reelsModalBackdrop"></div>

  <div class="ws-reels-modal-content">
    <!-- Modal Close Button -->
    <button type="button" class="ws-reels-modal-close" id="reelsModalCloseBtn" aria-label="Tutup Tampilan Penuh">
      <i class="bi bi-x-lg"></i>
    </button>

    <!-- Modal Video Card -->
    <div class="ws-reels-modal-card">
      <video id="reelsModalVideo"
             autoplay
             loop
             playsinline
             class="ws-reels-modal-video">
        <source id="reelsModalSourceWebm" src="assets/videos/latest-work-01.webm" type="video/webm">
        <source id="reelsModalSourceMp4" src="assets/videos/latest-work-01.mp4" type="video/mp4">
      </video>

      <!-- Modal Info Overlay -->
      <div class="ws-reels-modal-overlay-top">
        <div class="ws-reels-badge">
          <span class="ws-reels-dot"></span>
          <span>FEATURED WORK</span>
        </div>
        <button type="button" class="ws-reels-btn-icon" id="reelsModalMuteToggle" aria-label="Toggle Suara">
          <i class="bi bi-volume-up-fill"></i>
        </button>
      </div>

      <div class="ws-reels-modal-overlay-bottom">
        <div class="ws-reels-meta">
          <span class="ws-reels-category" id="reelsModalCategory"><i class="bi bi-tiktok"></i> TIKTOK REEL</span>
          <h3 class="ws-reels-title fs-5" id="reelsModalTitle">@withlesehan</h3>
        </div>

        <div class="ws-reels-nav-row">
          <button type="button" class="ws-reels-nav-btn" id="reelsModalPrevBtn" aria-label="Video Sebelumnya">
            <i class="bi bi-chevron-left"></i>
          </button>
          <div class="ws-reels-counter">
            <span id="reelsModalCurrentNum" class="ws-reels-current">01</span>
            <span class="ws-reels-divider">/</span>
            <span>04</span>
          </div>
          <button type="button" class="ws-reels-nav-btn" id="reelsModalNextBtn" aria-label="Video Berikutnya">
            <i class="bi bi-chevron-right"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
