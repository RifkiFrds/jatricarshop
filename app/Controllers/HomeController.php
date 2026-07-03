<?php

namespace App\Controllers;

use App\Core\Database;
use PDOException;

class HomeController {
    
    private function getCarsFromDb() {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->query("SELECT * FROM cars ORDER BY created_at DESC");
            $cars = $stmt->fetchAll();
            if (!empty($cars)) {
                return $cars;
            }
        } catch (\Exception $e) {
            // Fallback below
        }

        // Fallback dummy data if DB connection/migration is not ready or has no records
        return [
            [
                'id' => 1,
                'brand' => 'Honda',
                'model' => 'Civic Type R',
                'year' => 2023,
                'price' => 1200000000.00,
                'transmission' => 'Manual',
                'fuel_type' => 'Petrol',
                'mileage' => 5000,
                'color' => 'Championship White',
                'image' => 'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?auto=format&fit=crop&q=80&w=800',
                'description' => 'Honda Civic Type R 2023 dengan kondisi prima, full original, rawatan dealer resmi. Mesin VTEC Turbo 2.0L bertenaga tinggi.',
                'status' => 'available'
            ],
            [
                'id' => 2,
                'brand' => 'Toyota',
                'model' => 'GR Supra',
                'year' => 2022,
                'price' => 2100000000.00,
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'mileage' => 8000,
                'color' => 'Renaissance Red',
                'image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&q=80&w=800',
                'description' => 'Toyota GR Supra 2022 dengan mesin 3.0L inline-6 Twin-scroll turbocharger. Mobil sporty dengan performa luar biasa.',
                'status' => 'available'
            ],
            [
                'id' => 3,
                'brand' => 'Hyundai',
                'model' => 'IONIQ 5 Signature Long Range',
                'year' => 2023,
                'price' => 850000000.00,
                'transmission' => 'Automatic',
                'fuel_type' => 'Electric',
                'mileage' => 12000,
                'color' => 'Gravity Gold Matte',
                'image' => 'https://images.unsplash.com/photo-1669023414166-a4cf72d8e498?auto=format&fit=crop&q=80&w=800',
                'description' => 'Hyundai IONIQ 5 tipe tertinggi Signature Long Range. Bebas emisi, fitur keselamatan Hyundai SmartSense lengkap.',
                'status' => 'available'
            ],
            [
                'id' => 4,
                'brand' => 'BMW',
                'model' => '320i Sport',
                'year' => 2021,
                'price' => 890000000.00,
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'mileage' => 18000,
                'color' => 'Black Sapphire',
                'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=800',
                'description' => 'BMW 320i Sport 2021, interior rapi, eksterior mulus, service record ATPM BMW Astra.',
                'status' => 'available'
            ],
            [
                'id' => 5,
                'brand' => 'Mazda',
                'model' => 'CX-5 Elite',
                'year' => 2022,
                'price' => 560000000.00,
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'mileage' => 15000,
                'color' => 'Soul Red Crystal',
                'image' => 'https://images.unsplash.com/photo-1511919884226-fd3cad34687c?auto=format&fit=crop&q=80&w=800',
                'description' => 'Mazda CX-5 Elite 2022 dengan warna khas Soul Red Crystal. Kenyamanan berkendara premium dengan teknologi SkyActiv.',
                'status' => 'available'
            ],
            [
                'id' => 6,
                'brand' => 'Mitsubishi',
                'model' => 'Pajero Sport Dakar Ultimate 4x2',
                'year' => 2023,
                'price' => 690000000.00,
                'transmission' => 'Automatic',
                'fuel_type' => 'Diesel',
                'mileage' => 10000,
                'color' => 'Quartz White Pearl',
                'image' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800',
                'description' => 'SUV tangguh Pajero Sport Dakar Ultimate 2023 dengan kabin luas dan berkelas.',
                'status' => 'available'
            ],
            [
                'id' => 7,
                'brand' => 'Mercedes-Benz',
                'model' => 'C200 Avantgarde Line',
                'year' => 2022,
                'price' => 1150000000.00,
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'mileage' => 7000,
                'color' => 'Polar White',
                'image' => 'https://images.unsplash.com/photo-1617531653332-bd46c24f2068?auto=format&fit=crop&q=80&w=800',
                'description' => 'Mercedes-Benz C200 Avantgarde model terbaru W206. Kenyamanan sedan mewah khas eropa.',
                'status' => 'available'
            ],
            [
                'id' => 8,
                'brand' => 'Toyota',
                'model' => 'Innova Zenix Q Hybrid TSS',
                'year' => 2023,
                'price' => 620000000.00,
                'transmission' => 'Automatic',
                'fuel_type' => 'Hybrid',
                'mileage' => 9000,
                'color' => 'Attitude Black',
                'image' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=800',
                'description' => 'Toyota Innova Zenix tipe tertinggi Q Hybrid dengan TSS (Toyota Safety Sense).',
                'status' => 'available'
            ]
        ];
    }

    public function index() {
        $cars = array_slice($this->getCarsFromDb(), 0, 3);
        view('home', ['cars' => $cars]);
    }

    public function cars() {
        $cars = $this->getCarsFromDb();
        view('cars', ['cars' => $cars]);
    }

    public function detail($id) {
        $cars = $this->getCarsFromDb();
        $car = null;
        foreach ($cars as $c) {
            if ($c['id'] == $id) {
                $car = $c;
                break;
            }
        }

        if (!$car) {
            http_response_code(404);
            echo "<h1>Car not found</h1>";
            return;
        }

        view('car_detail', ['car' => $car]);
    }

    public function book() {
        $car_id = $_POST['car_id'] ?? null;
        $name = $_POST['name'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        $notes = $_POST['notes'] ?? '';

        if (!$car_id || !$name || !$phone || !$email) {
            $_SESSION['error'] = 'Harap isi semua field yang wajib.';
            redirect('cars');
        }

        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("INSERT INTO orders (car_id, customer_name, customer_phone, customer_email, notes) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$car_id, $name, $phone, $email, $notes]);
            $_SESSION['success'] = 'Pemesanan berhasil dikirim! Admin kami akan segera menghubungi Anda.';
        } catch (\Exception $e) {
            $_SESSION['success'] = 'Pemesanan berhasil disimulasikan! (Koneksi database tidak tersedia)';
        }

        redirect('cars');
    }
}
