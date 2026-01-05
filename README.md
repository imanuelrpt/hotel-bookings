# Hotel Booking (Laravel + Tailwind) — Starter

Proyek ini adalah starter untuk website booking kamar hotel menggunakan Laravel dan Tailwind CSS. Ini berisi scaffolding models, migrations, controllers, views, dan integrasi awal untuk Midtrans (Snap).

Catatan penting:
- Repository saat ini menggunakan Laravel 10 (lihat `composer.json`). Jika Anda ingin Laravel 11, upgrade Laravel lewat composer terlebih dahulu.
- Beberapa dependensi (Laravel Breeze, Livewire, Midtrans SDK) tidak terpasang otomatis. Panduan instalasi ada di bawah.

Quick setup (Windows / PowerShell):

1. Pasang dependensi PHP

    composer install

2. Salin file environment dan sesuaikan

    copy .env.example .env
    # lalu isi DB dan MIDTRANS_ env

3. Jalankan artisan key dan migrasi

    php artisan key:generate; php artisan migrate

4. Pasang front-end tools (Tailwind via Vite)

    npm install
    npm run dev

5. (Opsional) Install Laravel Breeze dan Livewire untuk scaffolding auth/UI:

    composer require laravel/breeze --dev
    php artisan breeze:install blade
    npm install && npm run dev

6. Install Midtrans PHP SDK untuk proses pembayaran server-side:

    composer require midtrans/midtrans-php

7. Isi env dengan kunci Midtrans:

    MIDTRANS_SERVER_KEY=your_server_key
    MIDTRANS_CLIENT_KEY=your_client_key
    MIDTRANS_PRODUCTION=false

8. Menjalankan server lokal:

    php artisan serve

Fitur yang disertakan:
- Models: Room, Booking, Payment, Review, Promo
- Migrations untuk tabel di atas
- Controllers: RoomController, BookingController, PaymentController, AdminController
- Blade views dasar: landing/rooms/list/detail, checkout, user bookings, admin dashboard
- Konfigurasi Midtrans placeholder di `config/midtrans.php`

Next steps / recommended improvements:
- Pasang Laravel Breeze untuk otentikasi yang rapi
- Lengkapi validasi dan policy untuk akses/admin
- Tambahkan upload image storage dan manajemen fasilitas di admin CRUD
- Tambahkan seeder sample data dan unit/feature tests
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
