# Astra Awards

Dibuat menggunakan framework Laravel versi 11

## Instalasi

Berikut langkah-langkah untuk menginstal dan menjalankan proyek ini:

1. Klon repositori ini dengan

    HTTPS:

    ```bash
    git clone https://github.com/azzmnrwebdev/astra-awards.git
    ```

    SSH:

    ```bash
    git clone git@github.com:azzmnrwebdev/astra-awards.git
    ```

2. Masuk ke dalam folder `astra-awards`
3. Jalankan `composer install` untuk mengunduh dan menginstal semua dependensi atau package PHP yang tercantum dalam file `composer.json`
4. Jalankan `npm install` untuk mengunduh dan menginstal semua dependensi atau package yang tercantum dalam file `package.json`
5. Salin file `.env.example` dan tempel file yang disalin. Ubah nama file yang ditempel menjadi `.env`
6. Lakukan konfigurasi database di file `.env`
7. Jalankan `php artisan key:generate` untuk menghasilkan kunci aplikasi yang baru
8. Jalankan `php artisan stroge:link` untuk membuat symbolic link (symlink)
9. Jalankan `php artisan migrate --seed` untuk menjalankan migrasi database sekaligus menjalankan seeder
10. Jalankan `php artisan serve` untuk memulai server pengembangan bawaan Laravel
11. Jalankan `npm run dev` untuk mengompilasi dan memproses sumber daya frontend
