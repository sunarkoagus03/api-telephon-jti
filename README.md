<h1 align="center">Technical Test JTI</h1>

## Introduction

aplikasi ini dibangun menggunakan framework laravel dan mysql database. didalamnya sudah ada beberapa package yang terintall yaitu :
- socialite
- pusher websocket
- encryption openssl aes-256-cbc diadopsi dari CryptoJS

## Step by step

aplikasi ini dibangun menggunakan framework laravel dan mysql database. didalamnya sudah ada beberapa package yang terintall yaitu :
- Clone api-telephon-jti with git: git clone https://github.com/sunarkoagus03/api-telephon-jti.git && cd api-telephon-jti 
- buka file .env dan ubah credential database apabila berbeda
- buat database baru menggunakan mysql
- jalankan : composer install 
- jalankan : php artisan migrate --seed
- jalankan : php artisan serve

akses di browser : localhost:8000 atau 127.0.0.1:8000


## Routing Web
- akses pertama kali adalah http://localhost:8000
akan diarahkan untuk login pertama kali menggunakan otentikasi gmail (sign in with gmail)

- lalu setelah masuk akan diarahkan ke link : http://127.0.0.1:8000/input
dalam input, bisa dilakukan pengisian secara manual atau auto generate

- jika data sesuai disubmit,
lalu akan muncul sound notification

- cek hasil yang sudah disubmit di link berikut : http://127.0.0.1:8000/output
dalam output tersebut dibagi menjadi 2 tabel dimana nomor ganjil ada di table ganjil dan nomor genap ada di table genap

- untuk edit (mengubah data) dan delete (mengapus data), silakan click button edit dan delete

## Routing API with POSTMAN
- method: get | localhost:8000/api/read/ atau localhost:8000/api/read/{id} (untuk menampilkan data)
- method: get | localhost:8000/api/generate (untuk generate otomatis nomor hp dan provider)

- method: post | localhost:8000/api/create (untuk menambahkan data dibutuhkan 2 parameter yaitu id_tele_provider dan phone)
- isi pada tab "Body" dan sub tab "x-www-form-urlencoded" dengan 
- 1. key : id_tele_provider dan value : b1IhOXINGdQOh5EefOdSXw== 
- 2. key : phone dan value : W6cWqJecxk/60xvq4SBhkA==

- value diatas adalah hasil enkripsi openssl aes yang bisa di lihat di console.log saat melakukan submit data

- method: put | localhost:8000/api/update/{id} (untuk mengubah data) | perintahnya sama seperte create diatas
- method: delete | localhost:8000/api/delete/{id} (untuk mengapus data) | ubah id nya dengan id table list_telephon

## Terima Kasih
