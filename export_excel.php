<?php

$app_env = $_SERVER['APP_ENV'] ?? 'production';

if ($app_env === 'production') {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    error_reporting(0);
    error_log('D:/laragon/logs/php_errors.log');
} else {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}


// file konfigurasi
require_once 'config.php'; 

// Koneksi ke database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_printer.xls");
header("Pragma: no-cache");
header("Expires: 0");

$query = "SELECT * FROM printers";
$result = $conn->query($query);

echo "<table border='1'>";
echo "<tr>
        <th>Nama Customer</th>
        <th>Nomor Customer</th>
        <th>Printer</th>
        <th>Model</th>
        <th>Status</th>
        <th>Tanggal Servis</th>
      </tr>";

      while ($row = $result->fetch_assoc()) {
        $customer_number = "=\"" . $row['customer_number'] . "\""; // Tambahkan tab untuk memaksa format teks
        echo "<tr>
                <td>{$row['customer']}</td>
                <td>{$customer_number}</td> <!-- Nomor tetap muncul dengan 0 di awal -->
                <td>{$row['name']}</td>
                <td>{$row['model']}</td>
                <td>{$row['status']}</td>
                <td>{$row['service_date']}</td>
              </tr>";
    }
    
    
    

echo "</table>";
?>
