# 📸 WS Visual JKT — Official Website & Documentation Portfolio

![PHP Native](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)
![Swiper](https://img.shields.io/badge/Swiper-11-6332F6?logo=swiper&logoColor=white)
![Status](https://img.shields.io/badge/Status-Production%20Ready-success)

Website Company Profile dan Layanan Fotografi & Videografi Sinematik untuk **wsvisual.jkt** yang melayani dokumentasi Wisuda, Event/Concert, Overland Trip, dan Drone Aerial 4K di wilayah Jabodetabek.

---

## ✨ Fitur Unggulan Website

- **Intro Welcome Splash Screen**: Animasi pembuka elegan dengan logo studio dan progress bar modern.
- **Hero Section Fullscreen**: Visual sinematik Bromo Sunrise dengan gradien gelap, tipografi tegas, floating category cards, dan tombol CTA.
- **3D Swiper Coverflow Gallery**: Showcase galeri interaktif dengan animasi coverflow 3D dan kapsul pagination.
- **Galeri Portofolio Berfilter**: Filter dinamis (Wisuda, Sekolah, Event, Trip) dengan aspect ratio 16:9 yang rapi.
- **Video & Social Showcase**: Kurasi cuplikan video YouTube resmi dan konten visual TikTok/Instagram.
- **Katalog Paket Harga & Biaya Layanan**: Rincian harga transparan untuk Personal, Group, Event, Trip, dan Drone Aerial 4K.
- **Featured Work / Featured Reels**: Floating video player vertikal 9:16 di pojok kanan bawah dengan lazy loading cerdas, touch swipe untuk mobile, modal viewer fullscreen, dan tombol mini reopen.
- **Form Pemesanan & Kalkulator Booking WhatsApp**: Estimator biaya otomatis dan generator pesan booking langsung ke WhatsApp tim WS Visual.
- **Profil Lead / Founder**: Narasi profil Afif Dhiya Ulhaq sebagai lead creator.
- **100% Responsif**: Dioptimalkan untuk tampilan smartphone, tablet, laptop, dan layar monitor resolusi tinggi.

---

## 🛠️ Tech Stack

- **Backend**: PHP 8.x Native (Modular Component Structure)
- **Frontend**: HTML5, Vanilla CSS3 (Custom Design System), JavaScript (ES6+)
- **Frameworks & Libraries**:
  - [Bootstrap 5.3](https://getbootstrap.com/)
  - [Bootstrap Icons 1.11](https://icons.getbootstrap.com/)
  - [SwiperJS 11](https://swiperjs.com/)
- **Typography**: [Plus Jakarta Sans](https://fonts.google.com/specimen/Plus+Jakarta+Sans)

---

## 📂 Struktur Direktori

```text
wsvisualjkt/
├── assets/
│   ├── foto/             # Seluruh aset foto, logo studio, dan ikon sosial media
│   └── videos/           # File video vertikal 9:16 (Featured Reels)
├── components/           # Komponen UI modular
│   ├── navbar.php        # Navigasi transparan & solid on scroll
│   ├── hero.php          # Hero section fullscreen
│   ├── portfolio.php     # 3D Coverflow & galeri portofolio
│   ├── videos.php        # Video YouTube showcase
│   ├── pricing.php       # Katalog paket harga resmi
│   ├── featured-reels.php# Floating video player 9:16
│   ├── testimonials.php  # Ulasan klien
│   ├── founder.php       # Profil founder
│   ├── gear.php          # Spesifikasi kamera & equipment
│   ├── faq.php           # Tanya jawab seputar pemesanan
│   ├── modal-booking.php # Modal form order WhatsApp
│   └── modal-testimonial.php # Modal submit ulasan klien
├── css/
│   └── style.css         # Styling custom terpadu (Design Tokens & Responsive)
├── includes/
│   ├── header.php        # Meta tag SEO, favicon, font, & splash screen
│   └── footer.php        # Footer, link sosial media, & skrip bundle
├── js/
│   └── main.js           # Logika interaktif, animasi, coverflow, kalkulator, & reels
├── index.php             # Main entry point modular
└── README.md             # Dokumentasi project
```

---

## 🚀 Menjalankan Project Secara Lokal

### Menggunakan Laragon / XAMPP:
1. Clone repositori ke folder `www` (Laragon) atau `htdocs` (XAMPP):
   ```bash
   git clone https://github.com/nopaall-jo/wsvisualjkt.git
   ```
2. Buka browser dan akses:
   ```text
   http://localhost/wsvisualjkt/
   ```

### Menggunakan PHP Built-in Server:
```bash
cd wsvisualjkt
php -S localhost:8000
```
Buka browser pada `http://localhost:8000/`.

---

## 📞 Kontak & Sosial Media Resmi

- **Instagram**: [@wsvisual.jkt](https://www.instagram.com/wsvisual.jkt)
- **TikTok**: [@withlesehan](https://www.tiktok.com/@withlesehan) | [@afifdhiyaa](https://www.tiktok.com/@afifdhiyaa)
- **WhatsApp**: [+62 821-1254-2619](https://wa.me/6282112542619)
- **Founder**: Afif Dhiya Ulhaq ([@afifdhiya.ul](https://www.instagram.com/afifdhiya.ul))

---

&copy; 2026 WS Visual Photo & Video. All rights reserved.
