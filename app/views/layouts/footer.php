    <!-- Footer -->
    <footer class="footer-modern">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <a class="navbar-brand footer-logo mb-3 d-inline-block" href="<?= base_url('') ?>">
                        <i class="bi bi-speedometer2"></i> JatriCarShop
                    </a>
                    <p class="text-muted">Showroom mobil modern yang menghadirkan kendaraan berkualitas dengan pelayanan terbaik. Temukan mobil impian Anda bersama kami.</p>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="text-white fw-bold mb-3">Tautan Langsung</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="<?= base_url('') ?>" class="footer-link">Home</a></li>
                        <li><a href="<?= base_url('cars') ?>" class="footer-link">Daftar Mobil</a></li>
                        <li><a href="<?= base_url('') ?>#about" class="footer-link">Tentang Kami</a></li>
                        <li><a href="<?= base_url('') ?>#contact" class="footer-link">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <h6 class="text-white fw-bold mb-3">Jam Operasional</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li>Senin - Jumat: 09:00 - 18:00</li>
                        <li>Sabtu: 09:00 - 15:00</li>
                        <li>Minggu: Tutup</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Hubungi Kami</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><i class="bi bi-geo-alt-fill text-primary"></i> Jl. Raya Sudirman No. 123, Jakarta</li>
                        <li><i class="bi bi-telephone-fill text-primary"></i> +62 812-3456-7890</li>
                        <li><i class="bi bi-envelope-fill text-primary"></i> info@jatricarshop.com</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 border-secondary opacity-25">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-muted">&copy; <?= date('Y') ?> JatriCarShop. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <a href="#" class="footer-link me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="footer-link me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="footer-link me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="footer-link"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
