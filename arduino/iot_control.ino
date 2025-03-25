 #include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>

// Konfigurasi WiFi
const char* ssid = "NAMA_WIFI_ANDA";
const char* password = "PASSWORD_WIFI_ANDA";

// Pin LED
const int LED_KELAS = 4;    // Pin untuk LED Kelas
const int LED_KELOMPOK = 5; // Pin untuk LED Kelompok
const int RELAY_PIN = 6;    // Pin untuk Relay

ESP8266WebServer server(80);

void setup() {
  Serial.begin(115200);
  
  // Inisialisasi pin
  pinMode(LED_KELAS, OUTPUT);
  pinMode(LED_KELOMPOK, OUTPUT);
  pinMode(RELAY_PIN, OUTPUT);
  
  // Koneksi WiFi
  WiFi.begin(ssid, password);
  Serial.print("Menghubungkan ke WiFi");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  
  Serial.println("\nTerhubung ke WiFi");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());
  
  // Setup server
  server.on("/", HTTP_GET, handleRoot);
  server.on("/control", HTTP_POST, handleControl);
  
  server.begin();
  Serial.println("Server HTTP dimulai");
}

void loop() {
  server.handleClient();
}

void handleRoot() {
  String html = "<html><head><title>Kontrol LED</title>";
  html += "<style>body{font-family:Arial;text-align:center;margin-top:50px;}";
  html += "button{padding:10px 20px;margin:10px;font-size:16px;cursor:pointer;}</style>";
  html += "</head><body>";
  html += "<h1>Kontrol LED</h1>";
  html += "<form action='/control' method='post'>";
  html += "<button name='action' value='kelas_on'>LED Kelas ON</button>";
  html += "<button name='action' value='kelas_off'>LED Kelas OFF</button><br><br>";
  html += "<button name='action' value='kelompok_on'>LED Kelompok ON</button>";
  html += "<button name='action' value='kelompok_off'>LED Kelompok OFF</button>";
  html += "</form></body></html>";
  
  server.send(200, "text/html", html);
}

void handleControl() {
  if (server.hasArg("action")) {
    String action = server.arg("action");
    
    if (action == "kelas_on") {
      digitalWrite(LED_KELAS, HIGH);
    } else if (action == "kelas_off") {
      digitalWrite(LED_KELAS, LOW);
    } else if (action == "kelompok_on") {
      digitalWrite(LED_KELOMPOK, HIGH);
    } else if (action == "kelompok_off") {
      digitalWrite(LED_KELOMPOK, LOW);
    }
  }
  
  server.sendHeader("Location", "/");
  server.send(302, "text/plain", "");
} 