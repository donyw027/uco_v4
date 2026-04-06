# UCO Trading Solution - CI3 Runnable Package

## Ringkasan
Paket ini adalah hasil konversi dari source native web menjadi struktur **CodeIgniter 3 style** (`application/controllers`, `models`, `views`, `config`) dan sudah dibuat **langsung runnable** tanpa perlu download framework tambahan.

### Catatan penting
Karena environment kerja ini tidak punya akses internet untuk mengambil **core resmi CodeIgniter 3**, maka saya membuat **kernel PHP ringan yang kompatibel dengan pola CI3 yang dipakai project ini**.

Artinya:
- struktur project tetap gaya **CI3**
- controller / model / view sudah dipisah ala **CI3**
- routing, session, loader, database, helper, dan render sudah bisa jalan
- tetapi ini **bukan bundle core resmi CodeIgniter 3 dari EllisLab/BCIT**

Untuk kebutuhan running, fitur project ini sudah saya siapkan agar bisa dipakai langsung.

---

## Fitur yang sudah dibawa
- Public website: Home, About, Products, Contact
- Auth: Login / Logout
- Dashboard admin
- Master data:
  - Products
  - Customers
  - Suppliers
  - UOM
  - Currencies
  - Incoterms
  - Payment Terms
  - Warehouses
  - Users
- Transactions:
  - Sales Orders
  - Confirm SO
  - Ship SO
  - Generate Packing List
  - Generate Invoice
  - SO Detail modal/page
  - Print Invoice
  - Print Packing List
- Inventory:
  - Stock Overview
  - Stock Movements
- Settings:
  - Company Profile

---

## Login default
- **Username:** `admin`
- **Password:** `admin123`

Kalau login gagal setelah import database, jalankan file:
- `sql_reset_admin_password.sql`

---

## Cara running di XAMPP / Laragon

### 1. Extract project
Extract ZIP ini ke folder web server, misalnya:
- XAMPP: `htdocs/uco_ci3_runnable`
- Laragon: `www/uco_ci3_runnable`

### 2. Buat database
Buat database baru dengan nama:
- `uco_backend`

### 3. Import database
Import file:
- `database.sql`

### 4. Cek koneksi database
Buka file:
- `application/config/database.php`

Lalu sesuaikan:
- hostname
- username
- password
- database

Default sekarang:
- host: `localhost`
- user: `root`
- pass: kosong
- db: `uco_backend`

### 5. Jalankan project
Akses dari browser:
- `http://localhost/uco_ci3_runnable/`

Kalau pakai Laragon dan auto virtual host:
- `http://uco_ci3_runnable.test/`

---

## Struktur project
- `application/controllers` -> logic controller
- `application/models` -> query dan business logic
- `application/views` -> tampilan
- `application/config` -> config, route, db
- `application/helpers` -> helper umum
- `system/core` -> lightweight CI3-compatible kernel
- `assets` -> file CSS, JS, image, font
- `database.sql` -> schema + sample data

---

## Route utama
- `/` -> home
- `/about`
- `/products`
- `/contact`
- `/login`
- `/dashboard`
- `/masters/products`
- `/masters/customers`
- `/masters/suppliers`
- `/masters/uom`
- `/masters/currencies`
- `/masters/incoterms`
- `/masters/payment_terms`
- `/masters/warehouses`
- `/masters/users`
- `/transactions/sales-orders`
- `/transactions/packing-lists`
- `/transactions/invoices`
- `/inventory/stock`
- `/inventory/movements`
- `/settings/company`

---

## Alur stok
Saat Sales Order di-**ship**:
- sistem cek stok gudang
- bila stok cukup, sistem insert ke `stock_movements` dengan tipe `SHIP`
- stok gudang otomatis berkurang
- status SO berubah menjadi `SHIPPED`

---

## Hal yang saya rapikan dari source lama
- pemisahan native procedural ke pola MVC style
- routing lebih rapi
- auth dipisah dari page biasa
- query master dipusatkan ke model
- transaksi SO dipisah dari inventory
- company profile dipisah ke settings
- public site dan admin site dipisahkan layout-nya

---

## Keterbatasan yang perlu kamu tahu
- kernel `system/` di paket ini adalah **buatan custom agar runnable**, bukan core resmi CI3
- belum memakai seluruh fitur resmi CI3 seperti hook, library lengkap, form validation class resmi, migration class resmi, dsb
- fitur yang saya buat fokus ke kebutuhan aplikasi UCO ini

---

## Saran next step
Kalau kamu mau tahap berikutnya, paling bagus:
1. saya bantu pecah lagi master module per controller biar lebih clean
2. saya bantu buat versi **CI3 official-ready** bila kamu kirim base CodeIgniter 3 resmi
3. saya bantu tambah fitur:
   - purchase order
   - receiving
   - stock card per produk
   - report export doc
   - approval workflow
   - multi warehouse transfer

