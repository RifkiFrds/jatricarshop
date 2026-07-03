<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - JatriCarShop</title>
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
                    <a href="<?= base_url('admin/cars') ?>" class="sidebar-link">
                        <i class="bi bi-car-front-fill"></i> Kelola Mobil
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/orders') ?>" class="sidebar-link active">
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
                    <h4 class="fw-bold mb-0">Kelola Pesanan</h4>
                    <p class="text-muted small mb-0">Kelola permintaan pemesanan dari pelanggan</p>
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
                                <th>Pelanggan</th>
                                <th>Kontak</th>
                                <th>Mobil Dipesan</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($orders)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-cart display-4 d-block mb-3"></i>
                                        Belum ada pesanan masuk.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= htmlspecialchars($order['customer_name']) ?></div>
                                            <div class="text-muted small"><?= htmlspecialchars($order['customer_email']) ?></div>
                                        </td>
                                        <td>
                                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $order['customer_phone']) ?>" target="_blank" class="text-decoration-none text-success fw-medium">
                                                <i class="bi bi-whatsapp"></i> <?= htmlspecialchars($order['customer_phone']) ?>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark"><?= htmlspecialchars($order['brand'] . ' ' . $order['model']) ?></div>
                                        </td>
                                        <td>
                                            <div class="text-muted small" style="max-width: 250px; white-space: normal; word-wrap: break-word;">
                                                <?= htmlspecialchars($order['notes'] ?? '-') ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-status badge-<?= $order['status'] ?>">
                                                <?php 
                                                    $statusLabels = [
                                                        'pending' => 'Pending',
                                                        'processing' => 'Diproses',
                                                        'completed' => 'Selesai',
                                                        'cancelled' => 'Batal'
                                                    ];
                                                    echo $statusLabels[$order['status']] ?? ucfirst($order['status']);
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="text-secondary small"><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></div>
                                        </td>
                                        <td class="text-end">
                                            <!-- Action Dropdown for Status and Delete -->
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-sm btn-light border rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 32px; height: 32px; padding: 0;">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2 rounded-3" style="min-width: 150px;">
                                                    <li class="dropdown-header small text-muted px-3 py-1 fw-bold">Ubah Status</li>
                                                    <li>
                                                        <form action="<?= base_url('admin/orders/status/' . $order['id']) ?>" method="POST">
                                                            <input type="hidden" name="status" value="pending">
                                                            <button type="submit" class="dropdown-item rounded-2 py-1 px-3 mb-1 text-warning small"><i class="bi bi-clock me-2"></i> Pending</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="<?= base_url('admin/orders/status/' . $order['id']) ?>" method="POST">
                                                            <input type="hidden" name="status" value="processing">
                                                            <button type="submit" class="dropdown-item rounded-2 py-1 px-3 mb-1 text-primary small"><i class="bi bi-play-fill me-2"></i> Diproses</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="<?= base_url('admin/orders/status/' . $order['id']) ?>" method="POST">
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit" class="dropdown-item rounded-2 py-1 px-3 mb-1 text-success small"><i class="bi bi-check-lg me-2"></i> Selesai</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="<?= base_url('admin/orders/status/' . $order['id']) ?>" method="POST">
                                                            <input type="hidden" name="status" value="cancelled">
                                                            <button type="submit" class="dropdown-item rounded-2 py-1 px-3 text-danger small"><i class="bi bi-x-lg me-2"></i> Batal</button>
                                                        </form>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="<?= base_url('admin/orders/delete/' . $order['id']) ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pesanan ini?');">
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
