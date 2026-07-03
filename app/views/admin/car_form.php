<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - JatriCarShop</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

    <div class="dashboard-container">
        <!-- Mobile Header -->
        <div class="mobile-header d-lg-none d-flex justify-content-between align-items-center p-3 bg-white border-bottom w-100">
            <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-brand mb-0">
                <i class="bi bi-speedometer2"></i> JatriCarShop
            </a>
            <button class="btn btn-outline-primary btn-sm rounded-pill px-3" type="button" id="sidebarToggle">
                <i class="bi bi-list"></i> Menu
            </button>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar-modern">
            <a href="<?= base_url('') ?>" class="sidebar-brand">
                <i class="bi bi-speedometer2"></i> JatriCarShop
            </a>
            <ul class="sidebar-menu">
                <li>
                    <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/cars') ?>" class="sidebar-link active">
                        <i class="bi bi-car-front-fill"></i> Kelola Mobil
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/orders') ?>" class="sidebar-link">
                        <i class="bi bi-cart-fill"></i> Pesanan
                    </a>
                </li>
                <li class="mt-auto">
                    <a href="<?= base_url('admin/logout') ?>" class="sidebar-link text-danger">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-main">
            <!-- Topbar -->
            <header class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-0"><?= $title ?></h4>
                    <p class="text-muted small mb-0">Isi formulir data mobil secara lengkap</p>
                </div>
                <div>
                    <a href="<?= base_url('admin/cars') ?>" class="btn btn-light border rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </header>

            <!-- Alerts -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Form Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <form action="<?= $action ?>" method="POST">
                    <div class="row g-3">
                        <!-- Brand -->
                        <div class="col-md-6">
                            <label for="brand" class="form-label fw-semibold text-secondary">Merk Mobil <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-modern" id="brand" name="brand" placeholder="Contoh: Toyota, Honda" value="<?= htmlspecialchars($car['brand'] ?? '') ?>" required>
                        </div>
                        
                        <!-- Model -->
                        <div class="col-md-6">
                            <label for="model" class="form-label fw-semibold text-secondary">Model Mobil <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-modern" id="model" name="model" placeholder="Contoh: Civic Type R, GR Supra" value="<?= htmlspecialchars($car['model'] ?? '') ?>" required>
                        </div>

                        <!-- Year -->
                        <div class="col-md-4">
                            <label for="year" class="form-label fw-semibold text-secondary">Tahun Pembuatan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-modern" id="year" name="year" min="1990" max="<?= date('Y') + 1 ?>" placeholder="Contoh: 2023" value="<?= htmlspecialchars($car['year'] ?? '') ?>" required>
                        </div>

                        <!-- Price -->
                        <div class="col-md-4">
                            <label for="price" class="form-label fw-semibold text-secondary">Harga (IDR) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-modern" id="price" name="price" placeholder="Contoh: 1200000000" value="<?= htmlspecialchars($car['price'] ?? '') ?>" required>
                        </div>

                        <!-- Transmission -->
                        <div class="col-md-4">
                            <label for="transmission" class="form-label fw-semibold text-secondary">Transmisi <span class="text-danger">*</span></label>
                            <select class="form-select form-control-modern" id="transmission" name="transmission" required>
                                <option value="" disabled selected>Pilih Transmisi</option>
                                <option value="Manual" <?= (isset($car['transmission']) && $car['transmission'] === 'Manual') ? 'selected' : '' ?>>Manual</option>
                                <option value="Automatic" <?= (isset($car['transmission']) && $car['transmission'] === 'Automatic') ? 'selected' : '' ?>>Automatic</option>
                            </select>
                        </div>

                        <!-- Fuel Type -->
                        <div class="col-md-4">
                            <label for="fuel_type" class="form-label fw-semibold text-secondary">Jenis Bahan Bakar <span class="text-danger">*</span></label>
                            <select class="form-select form-control-modern" id="fuel_type" name="fuel_type" required>
                                <option value="" disabled selected>Pilih Bahan Bakar</option>
                                <option value="Petrol" <?= (isset($car['fuel_type']) && $car['fuel_type'] === 'Petrol') ? 'selected' : '' ?>>Petrol (Bensin)</option>
                                <option value="Diesel" <?= (isset($car['fuel_type']) && $car['fuel_type'] === 'Diesel') ? 'selected' : '' ?>>Diesel</option>
                                <option value="Electric" <?= (isset($car['fuel_type']) && $car['fuel_type'] === 'Electric') ? 'selected' : '' ?>>Electric (Listrik)</option>
                                <option value="Hybrid" <?= (isset($car['fuel_type']) && $car['fuel_type'] === 'Hybrid') ? 'selected' : '' ?>>Hybrid</option>
                            </select>
                        </div>

                        <!-- Mileage -->
                        <div class="col-md-4">
                            <label for="mileage" class="form-label fw-semibold text-secondary">Jarak Tempuh (km) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-modern" id="mileage" name="mileage" placeholder="Contoh: 15000" value="<?= htmlspecialchars($car['mileage'] ?? '') ?>" required>
                        </div>

                        <!-- Color -->
                        <div class="col-md-4">
                            <label for="color" class="form-label fw-semibold text-secondary">Warna <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-modern" id="color" name="color" placeholder="Contoh: Championship White" value="<?= htmlspecialchars($car['color'] ?? '') ?>" required>
                        </div>

                        <!-- Image URL -->
                        <div class="col-md-8">
                            <label for="image" class="form-label fw-semibold text-secondary">URL Foto Mobil</label>
                            <input type="url" class="form-control form-control-modern" id="image" name="image" placeholder="https://example.com/image.jpg" value="<?= htmlspecialchars($car['image'] ?? '') ?>">
                            <div class="form-text text-muted small">Kosongkan untuk menggunakan gambar default showroom.</div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label for="status" class="form-label fw-semibold text-secondary">Status Ketersediaan <span class="text-danger">*</span></label>
                            <select class="form-select form-control-modern" id="status" name="status" required>
                                <option value="available" <?= (isset($car['status']) && $car['status'] === 'available') ? 'selected' : '' ?>>Tersedia (Available)</option>
                                <option value="sold" <?= (isset($car['status']) && $car['status'] === 'sold') ? 'selected' : '' ?>>Terjual (Sold)</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label for="description" class="form-label fw-semibold text-secondary">Deskripsi Singkat & Kondisi Mobil <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-modern" id="description" name="description" rows="4" placeholder="Jelaskan kondisi mobil secara lengkap..." required><?= htmlspecialchars($car['description'] ?? '') ?></textarea>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="col-12 mt-4 d-flex gap-2 justify-content-end">
                            <a href="<?= base_url('admin/cars') ?>" class="btn btn-light border rounded-pill px-4 py-2">Batal</a>
                            <button type="submit" class="btn btn-primary-modern rounded-pill px-5 py-2">
                                <i class="bi bi-save me-1"></i> Simpan Data Mobil
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
