<?php
// Koneksi database (SQLite) + auto-create tabel + seed 25 data dummy
if (session_status() === PHP_SESSION_NONE) session_start();

$dbFile = __DIR__ . '/../database/mystore.sqlite';
$pdo = new PDO('sqlite:' . $dbFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$pdo->exec("CREATE TABLE IF NOT EXISTS admins (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL
)");
$pdo->exec("CREATE TABLE IF NOT EXISTS products (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  category TEXT NOT NULL,
  price INTEGER NOT NULL,
  stock INTEGER NOT NULL DEFAULT 0,
  description TEXT,
  created_at TEXT DEFAULT CURRENT_TIMESTAMP
)");

if ((int)$pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn() === 0) {
    $st = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $st->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT)]);
}

if ((int)$pdo->query("SELECT COUNT(*) FROM products")->fetchColumn() === 0) {
    $dummy = [
        ['Smartphone Galaxy A55', 'Smartphone', 5499000, 20, 'RAM 8GB, memori 256GB, kamera 50MP'],
        ['Smartphone Redmi Note 13', 'Smartphone', 2899000, 35, 'Layar AMOLED 120Hz, baterai 5000mAh'],
        ['iPhone 14 128GB', 'Smartphone', 11999000, 10, 'Chip A15 Bionic, kamera ganda 12MP'],
        ['Laptop ASUS Vivobook 14', 'Laptop', 7999000, 12, 'Intel Core i5, RAM 8GB, SSD 512GB'],
        ['Laptop Acer Aspire 5', 'Laptop', 8499000, 9, 'Ryzen 5, RAM 16GB, SSD 512GB'],
        ['Laptop Lenovo IdeaPad Slim 3', 'Laptop', 6999000, 14, 'Intel Core i3, RAM 8GB, SSD 256GB'],
        ['Tablet Samsung Tab A9', 'Tablet', 2599000, 18, 'Layar 8.7 inci, RAM 4GB'],
        ['Tablet Xiaomi Pad 6', 'Tablet', 4799000, 11, 'Layar 11 inci 144Hz, Snapdragon 870'],
        ['Smartwatch Amazfit Bip 5', 'Wearable', 899000, 40, 'GPS, baterai hingga 10 hari'],
        ['Smartband Xiaomi Band 8', 'Wearable', 499000, 60, 'AMOLED 1.62 inci, sensor SpO2'],
        ['Earbuds TWS Soundcore P30i', 'Audio', 399000, 50, 'Noise cancelling, baterai 45 jam'],
        ['Headphone Sony WH-CH520', 'Audio', 799000, 25, 'Bluetooth, baterai 50 jam'],
        ['Speaker JBL Go 3', 'Audio', 549000, 30, 'Waterproof IP67, portabel'],
        ['Powerbank Anker 10000mAh', 'Aksesoris', 349000, 70, 'Fast charging 22.5W'],
        ['Charger GaN 65W Baseus', 'Aksesoris', 289000, 45, '2 port USB-C + 1 USB-A'],
        ['Kabel USB-C to USB-C 1m', 'Aksesoris', 59000, 150, 'Mendukung PD 60W'],
        ['Mouse Wireless Logitech M331', 'Komputer', 189000, 55, 'Silent click, 2.4GHz'],
        ['Keyboard Mechanical Rexus K9', 'Komputer', 459000, 22, 'Switch blue, RGB backlight'],
        ['Monitor LG 24 inci IPS', 'Komputer', 1799000, 16, 'Full HD 75Hz, IPS'],
        ['Webcam Logitech C270', 'Komputer', 449000, 28, 'HD 720p, mic built-in'],
        ['Flashdisk SanDisk 64GB', 'Penyimpanan', 89000, 100, 'USB 3.0'],
        ['SSD Eksternal Samsung T7 500GB', 'Penyimpanan', 1299000, 13, 'Kecepatan hingga 1050MB/s'],
        ['MicroSD Kingston 128GB', 'Penyimpanan', 149000, 80, 'Class 10, A1'],
        ['Router TP-Link Archer C6', 'Jaringan', 549000, 24, 'Dual band AC1200'],
        ['Action Cam GoPro Hero 12', 'Kamera', 4999000, 7, 'Video 5.3K, waterproof 10m'],
    ];
    $st = $pdo->prepare("INSERT INTO products (name, category, price, stock, description) VALUES (?,?,?,?,?)");
    foreach ($dummy as $d) $st->execute($d);
}

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function rupiah($n) { return 'Rp ' . number_format((int)$n, 0, ',', '.'); }
