<!-- Booking WhatsApp Bootstrap Modal Component (Matched to Screenshot 2 & 3) -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-bottom-sheet modal-lg">
    <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
      
      <!-- Modal Header -->
      <div class="modal-header bg-success text-white p-4 position-relative">
        <div class="sheet-handle d-md-none"></div>
        <div>
          <h5 class="modal-title fw-bold d-flex align-items-center gap-2 mb-1" id="bookingModalLabel">
            <i class="bi bi-whatsapp fs-5"></i>
            <span>Booking Sesi Foto</span>
          </h5>
          <small class="opacity-75" style="font-size: 0.85rem;">Isi detail sesi foto untuk mendapatkan estimasi dan melanjutkan pemesanan ke WhatsApp.</small>
        </div>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4 bg-white">
        <form id="bookingForm" novalidate>
          <div class="mb-3">
            <label for="bookName" class="form-label small fw-bold text-slate-800 mb-1">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" id="bookName" class="form-control" placeholder="Contoh: Rian Pratama" required>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label for="bookPhone" class="form-label small fw-bold text-slate-800 mb-1">Nomor WhatsApp <span class="text-danger">*</span></label>
              <input type="tel" id="bookPhone" class="form-control" placeholder="081234567890" required>
            </div>
            <div class="col-md-6">
              <label for="bookDate" class="form-label small fw-bold text-slate-800 mb-1">Tanggal Acara / Sesi</label>
              <input type="date" id="bookDate" class="form-control">
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label for="bookService" class="form-label small fw-bold text-slate-800 mb-1">Kategori Layanan <span class="text-danger">*</span></label>
              <select id="bookService" class="form-select" required>
                <option value="" disabled selected>-- Pilih Kategori Layanan --</option>
                <option value="graduation">Graduation</option>
                <option value="school">School</option>
                <option value="event">Event</option>
                <option value="trip">Trip</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="bookPackage" class="form-label small fw-bold text-slate-800 mb-1">Pilihan Paket <span class="text-danger">*</span></label>
              <select id="bookPackage" class="form-select" required>
                <option value="" disabled selected>-- Pilih Paket --</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="bookArea" class="form-label small fw-bold text-slate-800 mb-1">Lokasi Coverage (Jabodetabek) <span class="text-danger">*</span></label>
            <select id="bookArea" class="form-select" required>
              <option value="" disabled selected>-- Pilih Lokasi Coverage --</option>
              <option value="Jakarta Selatan">Jakarta Selatan</option>
              <option value="Jakarta Barat">Jakarta Barat</option>
              <option value="Jakarta Pusat">Jakarta Pusat</option>
              <option value="Jakarta Timur">Jakarta Timur</option>
              <option value="Jakarta Utara">Jakarta Utara</option>
              <option value="Bogor">Bogor</option>
              <option value="Depok">Depok</option>
              <option value="Tangerang / BSD">Tangerang / BSD</option>
              <option value="Bekasi">Bekasi</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="bookNotes" class="form-label small fw-bold text-slate-800 mb-1">Catatan / Permintaan Khusus</label>
            <textarea id="bookNotes" class="form-control" rows="2" placeholder="Contoh: Sesi foto jam 09.00 pagi di Kampus UI Depok, butuh video reel 1 menit."></textarea>
          </div>

          <!-- Estimasi Biaya Box Placeholder -->
          <div id="priceBoxPlaceholder" class="bg-light p-3 rounded-3 border d-flex align-items-center gap-3 mb-4">
            <i class="bi bi-info-circle text-amber fs-5"></i>
            <small class="text-muted">Pilih <strong>Kategori Layanan</strong>, <strong>Paket</strong>, dan <strong>Lokasi Coverage</strong> untuk melihat total estimasi biaya.</small>
          </div>

          <!-- Estimasi Biaya Result Box -->
          <div id="priceBoxResult" class="bg-success-subtle p-3 rounded-3 border border-success-subtle d-flex justify-content-between align-items-center mb-4 d-none">
            <div>
              <small class="text-muted fw-semibold">Estimasi Total Biaya</small>
              <div id="estimatedPriceDisplay" class="h4 fw-bold text-success mb-0">Rp 350.000</div>
            </div>
            <small id="transportFeeNote" class="text-muted">*Termasuk Transport Jabodetabek</small>
          </div>

          <button type="submit" class="btn btn-success btn-lg w-100 fw-bold py-3 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-whatsapp fs-5"></i>
            <span>Kirim Booking via WhatsApp</span>
          </button>
        </form>
      </div>

    </div>
  </div>
</div>
