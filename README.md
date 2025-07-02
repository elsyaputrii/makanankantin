# Kantin-App

![Laravel](https://img.shields.io/badge/Laravel-10-red?style=for-the-badge&logo=laravel)
![MySQL](https://img.shields.io/badge/MySQL-DB-blue?style=for-the-badge&logo=mysql)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-purple?style=for-the-badge&logo=php)

Aplikasi pemesanan makanan/minuman berbasis web untuk kantin atau toko offline menggunakan sistem kios. Aplikasi ini didesain untuk memudahkan pelanggan melakukan pemesanan secara mandiri di lokasi.

## Fitur Utama

* **Sistem Pemesanan Kios:** Pelanggan dapat melihat menu dan melakukan pemesanan langsung dari perangkat kios.
* **Integrasi Midtrans:** Mendukung pembayaran non-tunai melalui Midtrans (misalnya QRIS, Virtual Account, dll.).
* **Manajemen Produk Sederhana:** Admin dapat mengelola daftar produk yang tersedia.
* **Otentikasi Pengguna:** Menggunakan Laravel Breeze untuk otentikasi admin.

## Teknologi yang Digunakan

* **Backend:** Laravel 10 (PHP)
* **Database:** MySQL
* **Frontend:** Blade Template (HTML, CSS, JavaScript)
* **Otentikasi:** Laravel Breeze
* **Pembayaran:** Midtrans
* **Testing:** PHPUnit, PestPHP (default Laravel)

## Prasyarat Instalasi

Pastikan kamu memiliki perangkat lunak berikut terinstal di sistemmu:

* **PHP** (Versi 8.2 atau lebih tinggi direkomendasikan)
* **Composer**
* **Node.js & npm/yarn**
* **XAMPP / WAMP / MAMP** (untuk Apache dan MySQL)
* **Ngrok** (Opsional, untuk pengujian webhook Midtrans secara lokal)

## Panduan Instalasi

Ikuti langkah-langkah di bawah ini untuk mengatur dan menjalankan proyek secara lokal:

### 1. Kloning Repositori

```bash
git clone <URL_REPOSITORI_KAMU>
cd kantin-app
