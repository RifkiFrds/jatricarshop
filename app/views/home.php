<?php view('layouts/header', ['title' => 'JatriCarShop - Temukan Mobil Impian Anda']); ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2 rounded-pill fw-semibold">Premium Showroom</span>
                <h1 class="hero-title">Temukan Mobil Impian Anda Bersama JatriCarShop</h1>
                <p class="hero-subtitle">Kami menyediakan berbagai pilihan mobil premium berkualitas terbaik dengan kondisi prima dan harga bersaing. Proses cepat dan transparan.</p>
                <div class="d-flex gap-3">
                    <a href="<?= base_url('cars') ?>" class="btn btn-modern btn-primary-modern px-4 py-3">Lihat Katalog Mobil</a>
                    <a href="#about" class="btn btn-modern btn-secondary-modern px-4 py-3">Tentang Kami</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&q=80&w=1000" class="img-fluid rounded-4 shadow-lg" alt="JatriCarShop Hero Car">
            </div>
        </div>
    </div>
</section>

<!-- Featured Cars Section -->
<section class="py-5" id="featured">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <span class="text-primary fw-semibold">Koleksi Terbaru</span>
                <h2 class="fw-bold mt-1">Rekomendasi Mobil Pilihan</h2>
            </div>
            <a href="<?= base_url('cars') ?>" class="text-decoration-none fw-semibold">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        
        <div class="row g-4">
            <?php foreach ($cars as $car): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card-modern">
                        <img src="<?= $car['image'] ?>" class="card-img-modern" alt="<?= $car['brand'] . ' ' . $car['model'] ?>">
                        <div class="card-body-modern">
                            <div class="card-brand"><?= htmlspecialchars($car['brand']) ?></div>
                            <h5 class="card-title-modern"><?= htmlspecialchars($car['model']) ?></h5>
                            <div class="d-flex flex-wrap gap-2 my-3">
                                <span class="spec-badge"><i class="bi bi-calendar3"></i> <?= $car['year'] ?></span>
                                <span class="spec-badge"><i class="bi bi-gear-fill"></i> <?= htmlspecialchars($car['transmission']) ?></span>
                                <span class="spec-badge"><i class="bi bi-droplet-fill"></i> <?= htmlspecialchars($car['fuel_type']) ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <div class="card-price">Rp <?= number_format($car['price'], 0, ',', '.') ?></div>
                                <a href="<?= base_url('cars/' . $car['id']) ?>" class="btn btn-modern btn-primary-modern py-2">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5 bg-white" id="about">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="https://i.ibb.co.com/JR5vwV4d/Gemini-Generated-Image-4ypg0i4ypg0i4ypg.png" class="img-fluid rounded-4 shadow-sm" alt="About JatriCarShop" style="height: 450px; object-fit: cover; width: 100%;">
            </div>
            <div class="col-lg-6">
                <span class="text-primary fw-semibold">Tentang Kami</span>
                <h2 class="fw-bold mt-1 mb-4">Pengalaman Membeli Mobil Terbaik Untuk Anda</h2>
                <p class="text-muted">JatriCarShop berdiri sejak tahun 2010 dan telah melayani ribuan pelanggan yang mendambakan mobil berkualitas tinggi. Kami berkomitmen memberikan kualitas pelayanan dan unit terbaik di kelasnya.</p>
                <div class="row g-4 mt-2">
                    <div class="col-sm-6">
                        <div class="d-flex gap-3 align-items-start">
                            <div class="p-3 bg-primary-subtle text-primary rounded-3">
                                <i class="bi bi-shield-check fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Kualitas Terjamin</h6>
                                <p class="text-muted small mb-0">Inspeksi ketat 150+ titik uji oleh mekanik profesional.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex gap-3 align-items-start">
                            <div class="p-3 bg-primary-subtle text-primary rounded-3">
                                <i class="bi bi-wallet2 fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Harga Transparan</h6>
                                <p class="text-muted small mb-0">Harga jujur tanpa biaya tersembunyi atau tambahan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5" id="contact">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <span class="text-primary fw-semibold">Kontak Kami</span>
                <h2 class="fw-bold mt-1">Kunjungi Showroom Kami</h2>
                <p class="text-muted">Ada pertanyaan mengenai mobil impian Anda? Silakan hubungi kami atau kunjungi showroom secara langsung.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card-modern p-4 d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-3 bg-primary-subtle text-primary rounded-3">
                            <i class="bi bi-geo-alt-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Alamat Showroom</h6>
                            <span class="text-muted small">Jl. Raya Sudirman No. 123, Jakarta</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-3 bg-primary-subtle text-primary rounded-3">
                            <i class="bi bi-telephone-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Telepon & WhatsApp</h6>
                            <span class="text-muted small">+62 856-9335-2648</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-3 bg-primary-subtle text-primary rounded-3">
                            <i class="bi bi-envelope-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Email Dukungan</h6>
                            <span class="text-muted small">info@jatricarshop.com</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-modern p-4">
                    <form action="#" method="GET">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-modern" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-muted">Email</label>
                                <input type="email" class="form-control form-control-modern" placeholder="Masukkan email Anda">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold text-muted">Pesan</label>
                                <textarea class="form-control form-control-modern" rows="4" placeholder="Tuliskan pertanyaan atau kebutuhan Anda"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-modern btn-primary-modern w-100" onclick="alert('Pesan Anda berhasil disimulasikan!')">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php view('layouts/footer'); ?>
