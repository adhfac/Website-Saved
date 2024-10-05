# Dokumentasi Proyek Dart: Kalkulasi Lingkaran dan Kubus
***
## Deskripsi Singkat
***

Program ini dirancang untuk menghitung volume kubus dan luas lingkaran. Berdasarkan ukuran yang sudah ditentukan, program menghitung volume kubus menggunakan rumus dan luas lingkaran dengan rumus. Setelah perhitungan selesai, hasil volume kubus dan luas lingkaran ditampilkan secara langsung.
## Struktur Folder Proyek
***

* `main.dart`: File dart utama yang digunakan untuk menyimpan dan menjalankan program penghitungan volume kubus dan luas lingkaran.
* `README.md`: File catatan markdown yang berfungsi sebagai dokumentasi dari proyek ini.
## Cara Instalasi
***

1. Pastikan Dart sudah terinstal pada komputer anda.
    > 2\. Buka terminal atau **CMD** (Command Prompt), lalu masuk ke folder anda menyimpan dart. Jika sudah masuk, maka jalankan perintah `dart main.dart`.
## Cara Penggunaan
***

* Untuk menghitung luas Lingkaran, panggil fungsi `luasLingkaran()` pada `void main()`.
* Contoh:
```Dart
double luas = luasLingkaran(7);
print(luas); // Output = 153.93804002589985
```
* Untuk menghitung volume kubus, panggil fungsi `volume kubus()` pada `void main()`
* Contoh:
```
double volume = volume kubus(3);
print(volume); // Output = 77
```
## Penjelasan Kode
***
> Berdasarkan input jari-jari tersebut, program akan menghitung luas lingkaran menggunakan rumus `πr²` dan menghitung volume kubus dengan panjang sisi yang sudah ditentukan menggunakan rumus `s×s×s` Setelah perhitungan selesai, hasil dari volume kubus dan luas lingkaran ditampilkan kepada pengguna.