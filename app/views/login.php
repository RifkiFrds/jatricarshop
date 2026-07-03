<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - JatriCarShop</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="auth-container">

    <div class="auth-card">
        <div class="text-center mb-4">
            <a href="<?= base_url('') ?>" class="navbar-brand navbar-brand-modern justify-content-center mb-2">
                <i class="bi bi-speedometer2"></i> JatriCarShop
            </a>
            <h5 class="fw-bold mt-3">Selamat Datang Kembali</h5>
            <p class="text-muted small">Login untuk mengelola kendaraan dan pemesanan</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 py-2 px-3 small mb-3" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.6rem 0.8rem;"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-semibold text-muted">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control form-control-modern border-start-0 ps-0" placeholder="Username Anda" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-semibold text-muted">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control form-control-modern border-start-0 ps-0" placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="btn btn-modern btn-primary-modern w-100 py-2.5 fw-semibold">Masuk Ke Dashboard</button>
        </form>
        
        <div class="text-center mt-4">
            <a href="<?= base_url('') ?>" class="text-decoration-none small text-muted"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
