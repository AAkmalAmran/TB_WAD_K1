# TB_WAD_SI4708_K1 - Laravel Project

Ini adalah repository Laravel untuk aplikasi Forum Aspirasi Mahasiswa.  
Aplikasi ini mendukung fitur autentikasi, pengelolaan profil, pengiriman aspirasi, dan riwayat aspirasi.

---

## Struktur Folder Penting

- **app/**  
  Berisi logic aplikasi (Controllers, Models, dll).
- **resources/views/**  
  Berisi file Blade untuk tampilan (UI).
- **routes/**  
  Berisi file route web.php dan api.php.
- **public/**  
  Berisi file yang bisa diakses publik (termasuk storage link).
- **database/**  
  Berisi migration dan seeder.

---

## Cara Menjalankan Project

### 1. Clone Repository

```bash
git clone https://github.com/username/TB_WAD_SI4708_K1.git
cd TB_WAD_SI4708_K1
```

### 2. Install Dependency

```bash
composer install
npm install
npm run build
```

### 3. Copy dan Edit File Environment

```bash
cp .env.example .env
```
Edit `.env` sesuai konfigurasi database lokal Anda.

### 4. Generate Key

```bash
php artisan key:generate
```

### 5. Migrasi dan Seed Database

```bash
php artisan migrate --seed
```

### 6. Buat Storage Link

```bash
php artisan storage:link
```

### 7. Jalankan Server

```bash
php artisan serve
```

---

## Workflow Git

### Membuat Branch Baru

```bash
git checkout -b nama-branch-baru
```

### Push Branch ke Remote

```bash
git add .
git commit -m "Pesan commit"
git push origin nama-branch-baru
```

### Merge Branch ke Main (dari GitHub Pull Request)

1. Push branch ke remote.
2. Buka repository di GitHub.
3. Klik "Compare & pull request".
4. Review dan merge.

---

## Catatan

- Pastikan sudah menjalankan `php artisan storage:link` agar upload foto profil berjalan normal.
- Untuk development, gunakan database MySQL dan sesuaikan konfigurasi di `.env`.
- Fitur anonim pada aspirasi: Nama & NIM pengirim hanya terlihat oleh pemilik aspirasi.

---

Selamat mengembangkan aplikasi!
