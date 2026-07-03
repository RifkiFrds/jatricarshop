<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - JatriCarShop</title>
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
                    <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link active">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/cars') ?>" class="sidebar-link">
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
                    <h4 class="fw-bold mb-0">Dashboard</h4>
                    <p class="text-muted small mb-0">Selamat datang kembali, <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['admin_username'] ?? 'admin') ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-menu-item text-danger d-block px-3 py-2 text-decoration-none small" href="<?= base_url('admin/logout') ?>"><i class="bi bi-box-arrow-right"></i> Keluar</a></li>
                    </ul>
                </div>
            </header>

            <!-- Stats Grid -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-label">Total Mobil</div>
                        <div class="stat-number"><?= $total_cars ?></div>
                        <div class="small text-muted"><i class="bi bi-car-front-fill text-primary"></i> Terdaftar di sistem</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-label">Total Pesanan</div>
                        <div class="stat-number"><?= $total_orders ?></div>
                        <div class="small text-muted"><i class="bi bi-cart-fill text-success"></i> Menunggu tindak lanjut</div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">Pesanan Terbaru</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Kontak</th>
                                <th>Mobil Pilihan</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($latest_orders)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada pesanan masuk.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($latest_orders as $order): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold"><?= htmlspecialchars($order['customer_name']) ?></div>
                                            <div class="text-muted small"><?= htmlspecialchars($order['customer_email']) ?></div>
                                        </td>
                                        <td><?= htmlspecialchars($order['customer_phone']) ?></td>
                                        <td>
                                            <div class="fw-semibold"><?= htmlspecialchars($order['brand'] . ' ' . $order['model']) ?></div>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($order['notes']) ?>">
                                                <?= htmlspecialchars($order['notes'] ?? '-') ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-status badge-<?= $order['status'] ?>">
                                                <?= ucfirst($order['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/orders') ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">
                                                Kelola
                                            </a>
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
