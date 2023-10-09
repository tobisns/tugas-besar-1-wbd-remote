# muse app
Tugas Besar IF3110 Pengembangan Aplikasi Berbasis Web (Milestone 1)

## Daftar Isi
* [Deskripsi](#deskripsi)
* [Fitur](#fitur)
* [Requirements](#requirements)
* [Panduan Instalasi](#panduan-instalasi)
* [Panduan Menjalankan Server](#panduan-menjalankan-server)
* [Screenshot](#screenshot)
* [Pembagian Tugas](#pembagian-tugas)

## Deskripsi
Muse app adalah sebuah aplikasi berbasis web untuk memutar lagu. Dengan muse app, pengguna dapat mendengarkan lagu dari berbagai macam artist dengan berbagai macam genre lagu.
Muse app merupakan sebuah <i>vanilla web application</i> yang dibangun dengan memanfaatkan HTML, CSS, dan JavaScript untuk bagian <i>client-side</i>, serta PHP untuk bagian <i>server-side</i>. Dengan PostgreSQL, muse app menyimpan data seluruh lagu, album, artis, serta penggunanya. Muse app juga menggunakan Docker untuk menjalankan aplikasinya.

## Fitur
1. Login Page
2. Register Page
3. Home Page: View New Released Albums and Songs, Play Song
4. Explore Page: Explore Albums and Songs
5. Profile Page: View and Edit User Profile, Delete User
6. Admin Page: View Album and Song List, Add Album and Song, Delete Album and Song, Update Album and Song
7. Album Details Page: View Album Details, Play Song
8. Logout

## Requirements
1. Docker
2. PostgreSQL

## Panduan Instalasi
1. Unduh atau <i>clone</i> repositori ini dengan menjalankan perintah ```git clone https://github.com/tobisns/tugas-besar-1-wbd-remote.git``` pada teriminal.
2. Jalankan Docker pada komputer Anda.
3. <i>Build Docker image</i> dengan menjalankan perintah ```docker build -t tubes-1 .``` pada terminal yang dijalankan pada <i>directory</i> repositori.
4. Buat konfigurasi <i>environment</i> dengan cara membuat <i>file</i> ```.env``` sesuai dengan penggunaan. Anda dapat melihat contoh pada <i>file</i> ```.env.example```.

## Panduan Menjalankan Server
1. Buka terminal pada <i>directory</i> repositori aplikasi ini.
2. Jalankan perintah ```docker-compose up -d``` pada terminal.
3. Akses web dengan URL ```http://localhost:8080/public/home```.
4. Untuk menghentikan aplikasi, jalankan perintah ```docker-compose down``` pada terminal.

## Screenshot

## Pembagian Tugas
### Server-side
| Fitur       | NIM                      |
| --------- | --------------------------|
| Login  | 13521080   |
| Register |13521080 |
| Home |13521059|
| Explore (Search) |13521059|
| Profile (User CRUD) |13521080|
| Admin (Album & Song CRUD) |13521090|
### Client-side
| Fitur       | NIM                      |
| --------- | --------------------------|
| Login  | 13521080, 13521059   |
| Register | 13521080, 13521059 |
| Home | 13521059 |
| Explore (Search) | 13521059|
| Profile (User CRUD) |13521080|
| Admin (Album & Song CRUD) |13521090|
