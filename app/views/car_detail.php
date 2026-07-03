<?php view('layouts/header', ['title' => $car['brand'] . ' ' . $car['model'] . ' - JatriCarShop']); ?>

<section class="py-5 mt-5">
    <div class="container py-5">
        <a href="<?= base_url('cars') ?>" class="btn btn-modern btn-secondary-modern mb-4"><i class="bi bi-arrow-left"></i> Kembali ke Katalog</a>
        
        <div class="row g-5">
            <div class="col-lg-6">
                <img src="<?= $car['image'] ?>" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 450px; object-fit: cover;" alt="<?= $car['brand'] . ' ' . $car['model'] ?>">
            </div>
            <div class="col-lg-6">
                <span class="text-primary fw-semibold text-uppercase tracking-wider"><?= htmlspecialchars($car['brand']) ?></span>
                <h1 class="fw-bold mb-3"><?= htmlspecialchars($car['model']) ?></h1>
                
                <h2 class="text-primary fw-bold mb-4">Rp <?= number_format($car['price'], 0, ',', '.') ?></h2>
                
                <div class="row g-3 mb-4">
                    <div class="col-6 col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small">Tahun</div>
                            <div class="fw-bold"><?= $car['year'] ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small">Transmisi</div>
                            <div class="fw-bold"><?= htmlspecialchars($car['transmission']) ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small">Bahan Bakar</div>
                            <div class="fw-bold"><?= htmlspecialchars($car['fuel_type']) ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small">Jarak Tempuh</div>
                            <div class="fw-bold"><?= number_format($car['mileage'], 0, ',', '.') ?> km</div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small">Warna</div>
                            <div class="fw-bold"><?= htmlspecialchars($car['color']) ?></div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small">Status</div>
                            <span class="badge bg-success-subtle text-success"><?= htmlspecialchars($car['status']) ?></span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold">Deskripsi</h5>
                    <p class="text-muted"><?= nl2br(htmlspecialchars($car['description'])) ?></p>
                </div>

                <button class="btn btn-modern btn-primary-modern px-5 py-3 w-100 w-sm-auto" data-bs-toggle="modal" data-bs-target="#bookModal">Pesan Sekarang</button>
            </div>
        </div>
    </div>
</section>

<!-- Booking Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: var(--border-radius);">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="bookModalLabel">Form Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('book') ?>" method="POST">
                <div class="modal-body pt-3">
                    <div class="p-3 bg-light rounded-3 mb-4 d-flex align-items-center gap-3">
                        <img src="<?= $car['image'] ?>" class="rounded" style="width: 80px; height: 50px; object-fit: cover;">
                        <div>
                            <div class="text-primary small fw-semibold text-uppercase"><?= htmlspecialchars($car['brand']) ?></div>
                            <div class="fw-bold"><?= htmlspecialchars($car['model']) ?></div>
                            <div class="text-muted small">Rp <?= number_format($car['price'], 0, ',', '.') ?></div>
                        </div>
                    </div>
                    <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-control-modern" required placeholder="Masukkan nama lengkap Anda">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Nomor WhatsApp</label>
                        <input type="tel" name="phone" class="form-control form-control-modern" required placeholder="Contoh: 081234567890">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Alamat Email</label>
                        <input type="email" name="email" class="form-control form-control-modern" required placeholder="Contoh: nama@domain.com">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted">Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" class="form-control form-control-modern" rows="3" placeholder="Tuliskan catatan atau warna pilihan Anda"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-modern btn-secondary-modern" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modern btn-primary-modern">Kirim Pemesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php view('layouts/footer'); ?>
