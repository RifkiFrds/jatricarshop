<?php view('layouts/header', ['title' => 'Katalog Mobil - JatriCarShop']); ?>

<section class="py-5 mt-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Katalog Mobil Pilihan Terbaik</h1>
            <p class="text-muted">Temukan berbagai model kendaraan berkualitas tinggi untuk kenyamanan perjalanan Anda.</p>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <?php foreach ($cars as $car): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="card-modern">
                        <img src="<?= $car['image'] ?>" class="card-img-modern" alt="<?= $car['brand'] . ' ' . $car['model'] ?>">
                        <div class="card-body-modern">
                            <div class="card-brand"><?= htmlspecialchars($car['brand']) ?></div>
                            <h5 class="card-title-modern text-truncate" title="<?= htmlspecialchars($car['model']) ?>"><?= htmlspecialchars($car['model']) ?></h5>
                            <div class="d-flex flex-wrap gap-1 my-3">
                                <span class="spec-badge"><i class="bi bi-calendar3"></i> <?= $car['year'] ?></span>
                                <span class="spec-badge"><i class="bi bi-gear-fill"></i> <?= htmlspecialchars($car['transmission']) ?></span>
                            </div>
                            <div class="pt-2 border-top">
                                <div class="card-price mb-3">Rp <?= number_format($car['price'], 0, ',', '.') ?></div>
                                <div class="d-grid gap-2">
                                    <a href="<?= base_url('cars/' . $car['id']) ?>" class="btn btn-modern btn-secondary-modern py-2">Detail Spesifikasi</a>
                                    <button class="btn btn-modern btn-primary-modern py-2" data-bs-toggle="modal" data-bs-target="#bookModal<?= $car['id'] ?>">Pesan Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Modal -->
                <div class="modal fade" id="bookModal<?= $car['id'] ?>" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
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
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php view('layouts/footer'); ?>
