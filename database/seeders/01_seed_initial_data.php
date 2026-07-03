<?php

use App\Core\Database;

try {
    $db = Database::getInstance()->getConnection();

    // 1. Seed Admin
    $username = 'admin';
    $password = password_hash('admin123', PASSWORD_BCRYPT);
    $name = 'Jatri Car Admin';

    // Check if admin already exists
    $stmt = $db->prepare("SELECT id FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    if (!$stmt->fetch()) {
        $stmt = $db->prepare("INSERT INTO admins (username, password, name) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $name]);
        echo "Admin user seeded successfully!\n";
    } else {
        echo "Admin user already exists. Skipping.\n";
    }

    // 2. Seed 8 Cars
    $cars = [
        [
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
            'brand' => 'BMW',
            'model' => '320i Sport',
            'year' => 2021,
            'price' => 890000000.00,
            'transmission' => 'Automatic',
            'fuel_type' => 'Petrol',
            'mileage' => 18000,
            'color' => 'Black Sapphire',
            'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=800',
            'description' => 'BMW 320i Sport 2021, interior rapi, eksterior mulus, service record ATPM BMW Astra. Kunci cadangan dan buku manual lengkap.',
            'status' => 'available'
        ],
        [
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
            'brand' => 'Mitsubishi',
            'model' => 'Pajero Sport Dakar Ultimate 4x2',
            'year' => 2023,
            'price' => 690000000.00,
            'transmission' => 'Automatic',
            'fuel_type' => 'Diesel',
            'mileage' => 10000,
            'color' => 'Quartz White Pearl',
            'image' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800',
            'description' => 'SUV tangguh Pajero Sport Dakar Ultimate 2023 dengan kabin luas dan berkelas. Dilengkapi sunroof dan radar keselamatan aktif.',
            'status' => 'available'
        ],
        [
            'brand' => 'Mercedes-Benz',
            'model' => 'C200 Avantgarde Line',
            'year' => 2022,
            'price' => 1150000000.00,
            'transmission' => 'Automatic',
            'fuel_type' => 'Petrol',
            'mileage' => 7000,
            'color' => 'Polar White',
            'image' => 'https://images.unsplash.com/photo-1617531653332-bd46c24f2068?auto=format&fit=crop&q=80&w=800',
            'description' => 'Mercedes-Benz C200 Avantgarde model terbaru W206. Kenyamanan sedan mewah khas eropa dengan dashboard digital canggih.',
            'status' => 'available'
        ],
        [
            'brand' => 'Toyota',
            'model' => 'Innova Zenix Q Hybrid TSS',
            'year' => 2023,
            'price' => 620000000.00,
            'transmission' => 'Automatic',
            'fuel_type' => 'Hybrid',
            'mileage' => 9000,
            'color' => 'Attitude Black',
            'image' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=800',
            'description' => 'Toyota Innova Zenix tipe tertinggi Q Hybrid dengan TSS (Toyota Safety Sense). Kabin sangat lega, panoramic sunroof, konsumsi BBM super irit.',
            'status' => 'available'
        ]
    ];

    // Check count of cars
    $stmt = $db->query("SELECT COUNT(*) FROM cars");
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $stmt = $db->prepare("INSERT INTO cars (brand, model, year, price, transmission, fuel_type, mileage, color, image, description, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($cars as $car) {
            $stmt->execute([
                $car['brand'],
                $car['model'],
                $car['year'],
                $car['price'],
                $car['transmission'],
                $car['fuel_type'],
                $car['mileage'],
                $car['color'],
                $car['image'],
                $car['description'],
                $car['status']
            ]);
        }
        echo "Cars seeded successfully!\n";
    } else {
        echo "Cars already exist. Skipping seeding of cars.\n";
    }

} catch (\Exception $e) {
    echo "Error running seeder: " . $e->getMessage() . "\n";
    exit(1);
}
