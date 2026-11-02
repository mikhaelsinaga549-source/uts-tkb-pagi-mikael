# My Store - Admin Login & CRUD Produk

Project mandiri **My Store** (toko gadget) yang dilanjutkan untuk **UTS Praktek Pemrograman Web 2**.

- **Mata Kuliah**: Praktek Pemrograman Web 2
- **Dosen**: Primatua Sitompul, M.Kom
- **Kelas**: Teknik Komputer Group B - Semester III
- **Nama / NIM**: _(Mikhael Saputra Sinaga 25110118)_

## Fitur
1. **Login Admin berbasis UI** (`login.php`) - password di-hash (`password_hash`), session, proteksi CSRF.
2. **Dashboard Admin** (`admin/dashboard.php`) - ringkasan (total produk, stok, kategori) dan tabel produk dengan pencarian.
3. **CRUD Produk**
   - **Create** - `admin/create.php`
   - **Update** - `admin/edit.php`
   - **Delete** - `admin/delete.php` (konfirmasi + POST + CSRF) untuk produk discontinued
4. **Katalog publik** (`index.php`) dengan pencarian.
5. **Data dummy 25 produk** otomatis dibuat saat pertama kali dijalankan (`includes/db.php`).
6. **Angka genap 2-20** (`genap.php`) - sambungan soal 3, memakai `for ($i = 2; $i <= 20; $i += 2)`.

## Teknologi
PHP native (PDO), SQLite, Bootstrap 5.3 + Bootstrap Icons (CDN).

## Akun Admin
| Username | Password |
|----------|----------|
| admin    | admin123 |

## Cara Menjalankan
```bash
php -S localhost:8000
```
Buka `http://localhost:8000` (butuh PHP 8+ dengan ekstensi `pdo_sqlite`). Di XAMPP: taruh folder di `htdocs`, lalu buka `http://localhost/<nama-folder>`.
Database `database/mystore.sqlite` dibuat otomatis.

## Struktur Folder
```
├── admin/          dashboard, create, edit, delete
├── includes/       db, auth, header, footer
├── database/       file SQLite (otomatis)
├── screenshoot/    screenshot hasil pekerjaan
├── index.php  login.php  logout.php  genap.php
└── README.md
```

## Screenshot
Lihat folder `screenshoot/`:
- `01-login.png`, `02-dashboard.png`, `03-create.png`, `04-update.png`, `05-delete.png`, `06-genap.png`
