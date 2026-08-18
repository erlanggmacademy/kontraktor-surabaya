# 🧠 PRODUCT REQUIREMENTS DOCUMENT (PRD)

**Website Company Profile Dinamis – Jasa Arsitek dan Kontraktor (Surabaya)**

> **PENTING UNTUK AI ASSISTANT:** Baca dokumen ini terlebih dahulu sebelum mengerjakan task apapun di project ini. PRD ini adalah sumber kebenaran utama untuk semua keputusan teknis dan desain.

---

## 1. Ringkasan Eksekutif

Website ini dirancang sebagai platform identitas digital dan mesin *lead generation* untuk perusahaan **Jasa Arsitek dan Kontraktor** di Surabaya. Tujuan utamanya adalah membangun kredibilitas, menampilkan portofolio secara profesional, dan mendorong konversi (*inquiry* via WhatsApp/Form).

**Stack Teknologi:** Laravel + Bootstrap 5 + MySQL (Laragon untuk development lokal)

Website ini dilengkapi **Admin Panel (CMS)** yang memungkinkan tim internal memperbarui proyek, artikel, dan testimoni tanpa menyentuh kode. Fokus arsitektur mempertahankan **PageSpeed ekstrem (GTmetrix Grade A)** melalui caching Laravel, optimasi aset frontend, dan struktur SEO modern (AEO/GEO).

---

## 2. Tujuan Bisnis & KPI

| Kategori | KPI Utama | Target 3 Bulan | Target 6 Bulan | Tools Ukur |
|---|---|---|---|---|
| **Konversi** | Jumlah WhatsApp Inquiry | > 20 leads/bulan | > 50 leads/bulan | GA4 (Event Tracking) |
| **Konversi** | Form Request Quote terkirim | > 5 valid/bulan | > 15 valid/bulan | Database MySQL & Email Notif |
| **SEO & Traffic** | Organic Traffic (Local) | +300 visitors/bln | +1000 visitors/bln | Google Search Console |
| **Brand** | Branded Search Growth | +15% impression | +40% impression | Google Search Console |
| **Performa** | PageSpeed & GTmetrix | Mobile > 85, Desk > 95 | Grade A Konsisten | PageSpeed Insights |

---

## 3. User Persona

### Persona 1: Bapak Budi (Corporate / Project Manager)
- **Peran:** Manager Pengadaan / Fasilitas di perusahaan skala menengah.
- **Kebutuhan:** Mencari kontraktor legal untuk renovasi kantor/gudang di Surabaya.
- **Pain Point:** Takut kontraktor bodong, butuh RAB transparan dan *track record* B2B.
- **Search Intent:** "Kontraktor gudang Surabaya", "Jasa bangun kantor Jawa Timur".
- **Faktor Trust:** Portofolio komersial, halaman Legalitas/Sertifikasi, profil perusahaan jelas.
- **CTA Relevan:** *Request Penawaran (Form to Database)*.

### Persona 2: Ibu Sari (Pemilik Rumah / End-User)
- **Peran:** Keluarga mapan yang ingin membangun rumah *custom* atau renovasi total.
- **Kebutuhan:** Mencari jasa Design & Build.
- **Pain Point:** Takut biaya bengkak dan spesifikasi material diturunkan sepihak.
- **Search Intent:** "Jasa arsitek rumah mewah Surabaya", "Kontraktor rumah terpercaya".
- **Faktor Trust:** Foto portofolio *before-after*, artikel edukasi biaya bangun rumah.
- **CTA Relevan:** *Konsultasi via WhatsApp*.

---

## 4. Positioning Brand & Pesan Utama

- **Tagline:** "Membangun dengan Kualitas, Ketepatan, dan Kepercayaan."
- **Tone of Voice:** Profesional, Solutif, Transparan, dan Ekspert.
- **Pesan Homepage:** "Solusi Rancang Bangun Terpercaya di Surabaya. Kami mewujudkan visi Anda menjadi bangunan presisi dengan manajemen waktu dan anggaran yang transparan."
- **Pesan Trust (Wajib):** Garansi retensi, alamat kantor fisik `[ALAMAT KANTOR]`, dan dokumentasi proyek nyata dari *database* (bukan render 3D generik).

---

## 5. Tech Stack & Alasan Pemilihan

| Teknologi | Peran | Alasan |
|---|---|---|
| **Laravel** | Backend/Framework | Keamanan tinggi (CSRF, XSS, SQL Injection protection), routing elegan, caching kuat, CMS custom tanpa bloatware |
| **Bootstrap 5** | Frontend UI | Cepat (tanpa jQuery), mobile-first, mudah custom via SASS, antarmuka bersih dan korporat |
| **MySQL** | Database | Menyimpan data dinamis (Portofolio, Layanan, Artikel, Testimoni, Pesan form kontak) |
| **Laragon** | Local Environment | Cepat, ringan, pretty URL (e.g. `perusahaan.test`), isolasi environment yang baik |

---

## 6. Struktur Website

### A. Sisi Publik (Front-End)

```
├── Beranda (Dinamis: Tarik section portofolio & layanan terbaru dari DB)
├── Tentang Kami (Statis/Semi-Dinamis)
├── Layanan (Dinamis dari DB)
│   └── Detail Layanan (Slug dinamis, misal: /layanan/jasa-arsitek-surabaya)
├── Portofolio (Dinamis dari DB)
│   └── Detail Proyek (Menampilkan galeri, deskripsi, nilai proyek, timeline)
├── Artikel / Blog (Dinamis dari DB - SEO Engine)
└── Kontak (Form dinamis -> Simpan ke DB & Notif Email)
```

### B. Sisi Admin (Back-End / CMS)

- **Dashboard:** Statistik pesan masuk, jumlah proyek.
- **Kelola Layanan:** CRUD layanan (Judul, Deskripsi, Icon, Meta SEO).
- **Kelola Portofolio:** CRUD proyek (Upload banyak gambar, Client, Tahun, Kategori).
- **Kelola Artikel:** CRUD blog dengan editor WYSIWYG, tags, kategori, Meta SEO.
- **Kelola Inbox:** Melihat pesan masuk dari form kontak publik.
- **Pengaturan Website:** Update No WA, Email, Alamat, Logo, Teks Footer.

---

## 7. Arsitektur File & Folder (Laravel MVC)

```
/
├── app/
│   ├── Http/Controllers/ (HomeController, PortfolioController, AdminController, dll)
│   └── Models/ (Service, Portfolio, Article, Message, Setting)
├── database/
│   └── migrations/ (Struktur tabel MySQL)
├── public/
│   ├── assets/
│   │   ├── css/ (bootstrap.min.css custom, style.css)
│   │   ├── js/ (main.js)
│   │   └── img/ (Aset statis seperti logo, banner default)
│   └── storage/ (Symlink ke storage/app/public untuk gambar dinamis)
├── resources/
│   ├── views/
│   │   ├── layouts/ (app.blade.php, admin.blade.php)
│   │   ├── components/ (navbar, footer, hero, CTA)
│   │   ├── pages/ (home.blade.php, about.blade.php, contact.blade.php)
│   │   └── admin/ (halaman CRUD)
├── routes/
│   └── web.php (Definisi URL publik & middleware admin)
└── .env (Konfigurasi DB Laragon & Production)
```

---

## 8. Spesifikasi Fungsional & Database

| Fitur | Deskripsi & Perilaku | Interaksi Database (MySQL) | Acceptance Criteria |
|---|---|---|---|
| **Dinamis Portofolio** | Filter galeri proyek berdasarkan kategori (Arsitek, Interior, dll). | `SELECT * FROM portfolios WHERE category = X` | Data muncul cepat, gambar ter-lazyload. |
| **Contact Form to DB** | Form "Request Quote" di halaman kontak. | `INSERT INTO messages` + Trigger Email (SMTP). | Form tidak bisa disubmit ganda, pesan tersimpan aman di admin. |
| **Dynamic Meta SEO** | Title, Description, OG Image berubah sesuai halaman. | Diambil dari kolom `meta_title`, `meta_desc` pada tabel masing-masing. | Source code halaman menampilkan tag meta yang unik. |
| **Admin Authentication** | Login untuk pemilik web mengelola konten. | Autentikasi bawaan Laravel (Breeze/UI). | Rute `/admin` dilindungi middleware auth. |

---

## 9. Design System & UI/UX

- **Kesan:** Profesional, *Trustworthy*, Industrial-Modern.
- **Warna Utama:** *Navy Blue* (Profesionalisme) & *Safety Yellow/Gold* (Aksen/Konstruksi).
- **Tipografi:** *Montserrat* (Heading, tebal & solid), *Inter/Open Sans* (Body, mudah dibaca panjang).
- **Blade Components:** Gunakan komponen Laravel Blade (`<x-button>`, `<x-card-project>`) agar UI konsisten dan kode DRY.
- **Gambar Dinamis:** Validasi ukuran upload gambar max 2MB di CMS untuk menjaga performa.

---

## 10. Strategi Performa (PageSpeed & GTmetrix)

### Backend (Laravel)
- **Route & Config Caching:** Jalankan `php artisan route:cache` dan `config:cache` di production.
- **View Caching:** Blade templates dicompile otomatis oleh Laravel.
- **Eager Loading (N+1 Prevention):** Gunakan `with()` untuk semua relasi database.

### Frontend (Bootstrap 5)
- **Image Optimization:** Gunakan Intervention Image atau Spatie Media Library untuk auto-convert ke **WebP** dan buat variasi ukuran (Thumbnail, Medium, Large) untuk `srcset`.
- **Critical CSS & Defer JS:** CSS penting di `<head>`, JS diletakkan sebelum `</body>` dengan atribut `defer`.

---

## 11. SEO Modern, AEO & GEO Dinamis

### Meta Management di Blade Layout
```html
<title>{{ $meta_title ?? 'Jasa Kontraktor Surabaya | [Nama Perusahaan]' }}</title>
<meta name="description" content="{{ $meta_desc ?? 'Solusi kontraktor terpercaya di Surabaya...' }}">
<link rel="canonical" href="{{ url()->current() }}">
```

### AEO & GEO
- **FAQ Dinamis:** Tabel `faqs` di database. Admin tambah FAQ per layanan. Output menggunakan `<details>` dan `<summary>` yang ramah AI.
- **Trust Signals Tersentralisasi:** Fitur "Company Facts" di CMS (Tahun Berdiri, Jumlah Proyek Selesai) — data konsisten di seluruh halaman (syarat E-E-A-T & GEO).

---

## 12. Schema Markup / Structured Data (JSON-LD Dinamis)

Inject JSON-LD via variabel Laravel di layout utama:
- **LocalBusiness** → Homepage & Contact
- **Article** → Halaman detail Blog
- **Service** → Halaman Layanan

```html
@if(Route::is('home'))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "GeneralContractor",
  "name": "{{ $settings->company_name }}",
  "url": "{{ url('/') }}",
  "telephone": "{{ $settings->whatsapp_number }}"
}
</script>
@endif
```

---

## 13. Open Graph & Social Meta Tags

```html
<meta property="og:title" content="{{ $og_title ?? 'Jasa Arsitek Surabaya' }}">
<meta property="og:description" content="{{ $og_desc ?? '...' }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ isset($og_image) ? asset('storage/'.$og_image) : asset('assets/og/default.jpg') }}">
<meta property="og:type" content="{{ $og_type ?? 'website' }}">
```

---

## 14. Analytics & Tracking

- **GA4 Setup:** Simpan Tag ID di tabel `settings` atau file `.env`. Panggil di `<head>` layout utama.
- **Event Tracking:** Gunakan *Thank You Page* redirect atau tangkap event submit via JS sebelum POST request berjalan.

---

## 15. Deployment

- **Staging:** Laragon lokal — `company.test`
- **Production:** VPS Linux (Nginx/Apache, PHP 8.2+, MySQL) atau Shared Hosting cPanel yang support Laravel.

### Command Wajib Saat Deploy
```bash
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

---

## 16. Checklist Launch

### Backend & CMS
- [ ] Migrasi database berjalan tanpa error.
- [ ] Admin panel dilindungi autentikasi.
- [ ] Upload gambar sudah menggunakan optimasi (kompresi, WebP).
- [ ] Form submit (Request Quote) tersimpan ke database + kirim email notifikasi.

### Frontend & SEO
- [ ] Responsivitas Bootstrap 5 sempurna di Mobile, Tablet, Desktop.
- [ ] Navigasi dan Hamburger Menu berjalan tanpa error JS.
- [ ] Semua URL dinamis ter-generate benar (tidak ada 404).
- [ ] Meta Tag, Title, Deskripsi dinamis keluar sesuai konten database.
- [ ] `sitemap.xml` dinamis dibuat (package `spatie/laravel-sitemap`).

---

## 17. Risiko & Antisipasi

| Risiko Utama | Dampak | Mitigasi |
|---|---|---|
| **SQL Injection / CSRF** | Data diubah peretas, website diambil alih. | Wajib pakai Eloquent ORM. Jangan matikan `@csrf` di setiap `<form>`. Batasi rute `/admin`. |
| **Server Overload (Gambar Besar)** | PageSpeed anjlok, disk penuh. | Auto-resize & kompresi gambar di Controller saat upload. Batasi `<input type="file">`. |
| **Lupa `storage:link`** | Gambar tidak muncul (broken image). | Masukkan dalam SOP Deployment checklist. |

---

## 18. Prioritas Eksekusi 30 Hari Pertama

| Minggu | Fokus |
|---|---|
| **Minggu 1** | Setup Laragon, Database Schema (Migrations), slicing UI Bootstrap 5 ke Laravel Blade components |
| **Minggu 2** | Sistem Admin (CRUD Portofolio, Layanan, Artikel, Pengaturan Situs) |
| **Minggu 3** | Integrasi Frontend-Backend (data DB ke homepage, SEO Meta dinamis, setup form email) |
| **Minggu 4** | Optimasi performa (Caching, Image Compression), UAT, Deploy Production, submit Sitemap ke GSC |
