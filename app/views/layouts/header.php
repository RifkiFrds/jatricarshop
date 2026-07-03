<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'JatriCarShop - Showroom Mobil Modern' ?></title>
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-modern fixed-top">
        <div class="container">
            <a class="navbar-brand navbar-brand-modern" href="<?= base_url('') ?>">
                <i class="bi bi-speedometer2"></i> JatriCarShop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="<?= base_url('') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="<?= base_url('cars') ?>">Daftar Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="<?= base_url('') ?>#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern" href="<?= base_url('') ?>#contact">Kontak</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-modern btn-primary-modern" href="<?= admin_url('login') ?>">
                            <i class="bi bi-person-fill"></i> Admin Panel
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
