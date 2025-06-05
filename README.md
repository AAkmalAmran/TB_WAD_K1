# Tugas Besar - Web Application Development

Ini adalah repository Laravel untuk aplikasi Forum Aspirasi dan Diskusi Umum Mahasiswa.  
Aplikasi ini mendukung fitur pengelolaan profil, pengiriman aspirasi, diskusi umum, berita, dan komentar .

Anggota Kelompok 1 SI4708:
1. Ahmad Akmal Amran      - 102022300010
2. Rahmania Anggraini     - 102022300034
3. Raafi Naufal Fadhillah - 102022300053
4. Hanif Irsaddul Fikri   - 102022300072
5. Annisa Fatimatus Zahro - 102022330350

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
```

### 2. Install Dependency

```bash
composer install
```

### 3. Copy dan Edit File Environment (env)

Edit `.env` sesuai konfigurasi database lokal Anda.
Ganti APP_LOCALE=en menjadi APP_LOCALE=id

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

### 7. Install Package

```bash
composer require anhskohbo/no-captcha
```

### 8. Atur file .env
NOCAPTCHA_SITEKEY=your_site_key
NOCAPTCHA_SECRET=your_secret_key

#### Note:
Bisa buat key reCAPTCHA sendiri
Link: https://www.google.com/recaptcha/admin/create 

### 9. Jalankan Server

```bash
php artisan serve
```

---

## Workflow Git

### Membuat Branch Baru
```bash
git branch nama-branch-baru
```

### Pindah Branch
```bash
git checkout nama-branch
```

### Push Branch ke Remote

```bash
git add .
git commit -m "Pesan commit"
git push origin nama-branch-baru
```

## Catatan

- Untuk development, gunakan database MySQL dan sesuaikan konfigurasi di `.env`.

## Link API 
Ini adalah link API yang kami gunakan:
- reCAPTCHA: https://github.com/anhskohbo/no-captcha
- CNN ID: https://github.com/rizki4106/cnnindonesia-news-api?tab=readme-ov-file 

