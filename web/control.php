<?php
// Konfigurasi Arduino
$ARDUINO_IP = "192.168.1.100"; // Ganti dengan IP Arduino Anda
$ARDUINO_PORT = 80;

// Fungsi untuk mengirim perintah ke Arduino
function sendCommand($action) {
    global $ARDUINO_IP, $ARDUINO_PORT;
    
    $url = "http://{$ARDUINO_IP}:{$ARDUINO_PORT}/control";
    $data = array('action' => $action);
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    
    $context = stream_context_create($options);
    
    try {
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
            throw new Exception("Gagal terhubung ke Arduino");
        }
        return true;
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        return false;
    }
}

// Proses request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    // Validasi action
    $valid_actions = array('kelas_on', 'kelas_off', 'kelompok_on', 'kelompok_off');
    if (in_array($action, $valid_actions)) {
        if (sendCommand($action)) {
            header("Location: index.php?status=success&message=Perintah berhasil dikirim");
        } else {
            header("Location: index.php?status=error&message=Gagal mengirim perintah ke Arduino");
        }
    } else {
        header("Location: index.php?status=error&message=Perintah tidak valid");
    }
} else {
    header("Location: index.php");
} 