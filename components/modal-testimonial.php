<!-- Modal: Tulis Testimoni / Ulasan Klien -->
<div class="modal fade" id="modalTestimonial" tabindex="-1" aria-labelledby="modalTestimonialLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      
      <!-- Modal Header -->
      <div class="modal-header bg-slate-900 text-white border-0 py-3.5 px-4">
        <div>
          <h5 class="modal-title fw-bold d-flex align-items-center gap-2 mb-1" id="modalTestimonialLabel">
            <i class="bi bi-star-fill text-warning"></i>
            <span>Tulis Ulasan Pengalaman</span>
          </h5>
          <small class="text-slate-400" style="font-size: 0.82rem;">Bagikan cerita dan kesan Anda bersama tim WS Visual Photo &amp; Video</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4 bg-light">
        <form id="form-testimonial" novalidate>
          
          <!-- Interactive Star Rating Picker -->
          <div class="bg-white p-3.5 rounded-3 border shadow-xs text-center mb-3">
            <label class="form-label small fw-bold text-slate-800 mb-1 d-block">Beri Nilai Kepuasan Layanan</label>
            <div class="star-rating-picker d-flex justify-content-center gap-2 my-2 fs-3 text-warning" style="cursor: pointer;">
              <i class="bi bi-star-fill rating-star" data-rating="1"></i>
              <i class="bi bi-star-fill rating-star" data-rating="2"></i>
              <i class="bi bi-star-fill rating-star" data-rating="3"></i>
              <i class="bi bi-star-fill rating-star" data-rating="4"></i>
              <i class="bi bi-star-fill rating-star" data-rating="5"></i>
            </div>
            <input type="hidden" name="rating" id="review-rating-input" value="5">
            <small class="text-muted fw-semibold" id="rating-label-text">5.0 • Luar Biasa! Sangat Puas Banget ⭐</small>
          </div>

          <!-- Input: Nama -->
          <div class="mb-3">
            <label for="review-name" class="form-label small fw-bold text-slate-800 mb-1">Nama Lengkap / Panggilan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="review-name" name="name" placeholder="Contoh: Sarah Amalia, S.Ked" required>
          </div>

          <!-- Input: Role / Kampus / Status -->
          <div class="mb-3">
            <label for="review-role" class="form-label small fw-bold text-slate-800 mb-1">Status / Asal Kampus / Acara</label>
            <input type="text" class="form-control" id="review-role" name="role" placeholder="Contoh: Wisudawati UI / Ketua Panitia Event">
            <div class="form-text text-muted" style="font-size: 0.76rem;">Membantu calon klien lain mengetahui konteks sesi pemotretan Anda.</div>
          </div>

          <!-- Input: Kategori Layanan -->
          <div class="mb-3">
            <label for="review-service" class="form-label small fw-bold text-slate-800 mb-1">Layanan yang Digunakan</label>
            <select class="form-select" id="review-service" name="service" required>
              <option value="graduation" selected>🎓 Wisuda (Graduation)</option>
              <option value="school">🏫 School Event &amp; Gathering</option>
              <option value="event">📹 Event, Sports &amp; Motorsport</option>
              <option value="trip">🌄 Trip &amp; Travel Overland</option>
            </select>
          </div>

          <!-- Input: Ulasan / Komentar -->
          <div class="mb-3">
            <label for="review-comment" class="form-label small fw-bold text-slate-800 mb-1">Cerita &amp; Ulasan Pengalaman <span class="text-danger">*</span></label>
            <textarea class="form-control" id="review-comment" name="comment" rows="4" placeholder="Ceritakan bagaimana hasil foto, keramahan tim di lapangan, kecepatan kirim file, atau kesan serunya..." required></textarea>
          </div>

          <!-- Alert Feedback Container -->
          <div id="testimonial-alert" class="d-none alert py-2 px-3 small rounded-3 mb-3"></div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-amber-dark w-100 py-2.5 rounded-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" id="btn-submit-testimonial">
            <i class="bi bi-send-fill"></i>
            <span>Terbitkan Ulasan Sekarang</span>
          </button>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer bg-white border-top py-2.5 px-4 justify-content-between">
        <small class="text-muted" style="font-size: 0.78rem;">
          <i class="bi bi-shield-check text-success me-1"></i>Ulasan Anda langsung terbit &amp; tersimpan
        </small>
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>
