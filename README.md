# Project IoT - Kontrol LED via Web

## Deskripsi Project
Project ini merupakan implementasi IoT sederhana untuk mengontrol LED menggunakan ESP8266 WiFi Module dan web interface PHP. LED akan membentuk pola sesuai dengan kelas dan kelompok (contoh: C7).

## Komponen yang Dibutuhkan
1. ESP8266 WiFi Module (NodeMCU atau Wemos D1 Mini)
2. LED (minimal 2 buah)
3. Breadboard
4. Kabel jumper
5. Resistor 220Ω (2 buah)
6. USB Programmer Cable
7. Power supply (5V)

## Rangkaian Hardware
1. Hubungkan LED:
   - LED Kelas:
     - Anoda -> GPIO4 (D2) melalui resistor 220Ω
     - Katoda -> GND
   - LED Kelompok:
     - Anoda -> GPIO5 (D1) melalui resistor 220Ω
     - Katoda -> GND

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
2. Sesuaikan SSID dan password WiFi Anda:
   ```cpp
   const char* ssid = "NAMA_WIFI_ANDA";
   const char* password = "PASSWORD_WIFI_ANDA";
   ```
3. Upload kode ke ESP8266
4. Buka Serial Monitor (115200 baud) untuk melihat IP Address

## Menjalankan Program
1. Buka XAMPP Control Panel
2. Start Apache server
3. Letakkan file PHP di folder htdocs
4. Buka browser dan akses `http://localhost/iot_control`
5. Gunakan tombol atau saklar untuk mengontrol LED

## Struktur File
```
project/
├── arduino/
│   └── iot_control.ino    # Kode untuk ESP8266
├── web/
│   ├── index.php         # Halaman utama dengan UI
│   └── control.php       # Script PHP untuk kontrol LED
└── README.md
```

## Penjelasan Kode

### 1. Kode ESP8266 (iot_control.ino)
```cpp
// Library yang digunakan
#include <ESP8266WiFi.h>      // Untuk koneksi WiFi
#include <ESP8266WebServer.h> // Untuk membuat web server

// Konfigurasi WiFi
const char* ssid = "NAMA_WIFI_ANDA";     // Nama WiFi
const char* password = "PASSWORD_WIFI_ANDA"; // Password WiFi

// Pin LED
const int LED_KELAS = 4;    // GPIO4 (D2) untuk LED Kelas
const int LED_KELOMPOK = 5; // GPIO5 (D1) untuk LED Kelompok

// Membuat web server di port 80
ESP8266WebServer server(80);
```

#### Fungsi-fungsi Utama:
1. `setup()`:
   - Inisialisasi Serial Monitor (115200 baud)
   - Mengatur pin LED sebagai OUTPUT
   - Menghubungkan ke WiFi
   - Menampilkan IP Address di Serial Monitor
   - Mengatur endpoint web server:
     - `/` untuk halaman utama
     - `/control` untuk kontrol LED

2. `loop()`:
   - Menangani request dari client web

3. `handleRoot()`:
   - Membuat halaman HTML sederhana
   - Menampilkan tombol untuk kontrol LED
   - Menggunakan form POST untuk mengirim perintah

4. `handleControl()`:
   - Menerima perintah dari web interface
   - Mengontrol LED sesuai perintah:
     - `kelas_on/off`: mengontrol LED Kelas
     - `kelompok_on/off`: mengontrol LED Kelompok

### 2. Kode PHP (web/index.php)
- Membuat interface web yang modern dan responsif
- Menggunakan CSS untuk styling:
  - Gradient background
  - Card layout
  - Toggle switch
  - Animasi hover dan transisi
  - Responsive design
- Menampilkan status operasi (sukses/error)
- Menggunakan form POST untuk mengirim perintah ke ESP8266

### 3. Kode PHP (web/control.php)
```php
// Konfigurasi
$ARDUINO_IP = "192.168.1.100"; // IP ESP8266
$ARDUINO_PORT = 80;

// Fungsi sendCommand()
function sendCommand($action) {
    // Mengirim perintah POST ke ESP8266
    // Menggunakan file_get_contents untuk HTTP request
}

// Proses request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi perintah
    // Kirim perintah ke ESP8266
    // Redirect dengan status
}
```

#### Fitur-fitur:
1. Validasi input untuk keamanan
2. Error handling untuk koneksi gagal
3. Redirect dengan pesan status
4. Logging error untuk debugging

## Kontributor
- [Nama Mahasiswa 1] - [NIM]
- [Nama Mahasiswa 2] - [NIM]
- [Nama Mahasiswa 3] - [NIM]
