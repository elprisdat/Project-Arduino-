# Project IoT - Kontrol LED via Web

## Deskripsi Project
Project ini merupakan implementasi IoT sederhana untuk mengontrol LED menggunakan Arduino UNO, ESP8266 WiFi Module, dan web interface PHP. LED akan membentuk pola sesuai dengan kelas dan kelompok (contoh: C7).

## Komponen yang Dibutuhkan
1. Arduino UNO
2. ESP8266 WiFi Module
3. LED (minimal 2 buah)
4. Breadboard
5. Kabel jumper
6. Relay module
7. USB Programmer Cable
8. Power supply (5V)

## Rangkaian Hardware
1. Hubungkan ESP8266 dengan Arduino:
   - VCC -> 3.3V
   - GND -> GND
   - TX -> RX (Pin 2)
   - RX -> TX (Pin 3)

2. Hubungkan LED:
   - LED Kelas:
     - Anoda -> Pin 4 (melalui resistor 220Ω)
     - Katoda -> GND
   - LED Kelompok:
     - Anoda -> Pin 5 (melalui resistor 220Ω)
     - Katoda -> GND

3. Hubungkan Relay:
   - VCC -> 5V
   - GND -> GND
   - IN -> Pin 6

## Instalasi Software
1. Install Arduino IDE
2. Install library ESP8266:
   - Buka Arduino IDE
   - Klik menu `File` -> `Preferences`
   - Di "Additional Boards Manager URLs", tambahkan:
     ```
     http://arduino.esp8266.com/stable/package_esp8266com_index.json
     ```
   - Klik OK
   - Buka menu `Tools` -> `Board` -> `Boards Manager`
   - Cari "esp8266" dan install "ESP8266 by ESP8266 Community"
3. Konfigurasi Board:
   - Klik menu `Tools` -> `Board`
   - Pilih "ESP8266 Boards" -> "Generic ESP8266 Module"
4. Install XAMPP (untuk web server)

## Konfigurasi WiFi
1. Buka file `arduino/iot_control.ino`
2. Sesuaikan SSID dan password WiFi Anda
3. Upload kode ke Arduino

## Menjalankan Program
1. Buka XAMPP Control Panel
2. Start Apache server
3. Letakkan file PHP di folder htdocs
4. Buka browser dan akses `http://localhost/iot_control`

## Struktur File
```
project/
├── arduino/
│   └── iot_control.ino
├── web/
│   ├── index.php
│   └── control.php
└── README.md
```

## Kontributor
- [Nama Mahasiswa 1] - [NIM]
- [Nama Mahasiswa 2] - [NIM]
- [Nama Mahasiswa 3] - [NIM]

## Catatan
- Pastikan ESP8266 terhubung ke WiFi yang sama dengan komputer
- Gunakan power supply yang cukup untuk semua komponen
- Jangan lupa menggunakan resistor untuk LED
- Jika muncul error "cannot open source file ESP8266WiFi.h", pastikan library ESP8266 sudah terinstall dengan benar 