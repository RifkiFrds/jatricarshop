<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mobil - JatriCarShop</title>
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
            <a href="<?= admin_url('dashboard') ?>" class="sidebar-brand mb-0">
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
                    <a href="<?= admin_url('dashboard') ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= admin_url('cars') ?>" class="sidebar-link active">
                        <i class="bi bi-car-front-fill"></i> Kelola Mobil
                    </a>
                </li>
                <li>
                    <a href="<?= admin_url('orders') ?>" class="sidebar-link">
                        <i class="bi bi-cart-fill"></i> Pesanan
                    </a>
                </li>
                <li class="mt-auto">
                    <a href="<?= admin_url('logout') ?>" class="sidebar-link text-danger">
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
                    <h4 class="fw-bold mb-0">Kelola Mobil</h4>
                    <p class="text-muted small mb-0">Manajemen data kendaraan showroom</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= admin_url('cars/create') ?>" class="btn btn-primary-modern d-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i> Tambah Mobil Baru
                    </a>
                </div>
            </header>

            <!-- Alerts -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Table Section -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Mobil</th>
                                <th>Tahun</th>
                                <th>Harga</th>
                                <th>Spesifikasi</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($cars)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-car-front display-4 d-block mb-3"></i>
                                        Belum ada mobil terdaftar.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($cars as $car): ?>
                                    <tr>
                                        <td style="width: 100px;">
                                            <img src="<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['model']) ?>" class="rounded-3 shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?></div>
                                            <div class="text-muted small"><?= htmlspecialchars($car['color']) ?></div>
                                        </td>
                                        <td><?= htmlspecialchars($car['year']) ?></td>
                                        <td>
                                            <div class="fw-bold text-primary">Rp <?= number_format($car['price'], 0, ',', '.') ?></div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <span class="badge bg-light text-dark border"><i class="bi bi-gear-fill small me-1"></i><?= htmlspecialchars($car['transmission']) ?></span>
                                                <span class="badge bg-light text-dark border"><i class="bi bi-fuel-pump-fill small me-1"></i><?= htmlspecialchars($car['fuel_type']) ?></span>
                                                <span class="badge bg-light text-dark border"><i class="bi bi-speedometer small me-1"></i><?= number_format($car['mileage'], 0, ',', '.') ?> km</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-status badge-<?= $car['status'] ?>">
                                                <?= ucfirst($car['status']) ?>
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <!-- Action Dropdown for Edit and Delete -->
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-sm btn-light border rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 32px; height: 32px; padding: 0;">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2 rounded-3" style="min-width: 120px;">
                                                    <li>
                                                        <a class="dropdown-item rounded-2 py-1 px-3 mb-1 small text-dark" href="<?= admin_url('cars/edit/' . $car['id']) ?>">
                                                            <i class="bi bi-pencil-square me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="<?= admin_url('cars/delete/' . $car['id']) ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil ini? Semua pesanan terkait mobil ini juga akan dihapus.');">
                                                            <button type="submit" class="dropdown-item rounded-2 py-1 px-3 text-danger small"><i class="bi bi-trash3 me-2"></i> Hapus</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
