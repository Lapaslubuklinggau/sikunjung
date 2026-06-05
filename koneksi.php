<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sikunjung_lapas";

$conn = @mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Koneksi Database Gagal</title>
      <style>
        body{font-family:Arial,Helvetica,sans-serif;background:#f3f6fb;margin:0;display:grid;place-items:center;min-height:100vh;color:#172033}
        .box{background:#fff;max-width:720px;padding:34px;border-radius:24px;box-shadow:0 18px 50px rgba(10,35,73,.12);border-top:6px solid #d7a848}
        h1{margin:0 0 12px;color:#08244a}
        p{line-height:1.7;color:#52627b}
        code{background:#f6f8fc;padding:4px 7px;border-radius:7px;color:#08244a}
        .step{background:#fff7de;border-left:5px solid #d7a848;padding:14px;border-radius:12px;margin-top:14px}
      </style>
    </head>
    <body>
      <div class='box'>
        <h1>Koneksi Database Belum Aktif</h1>
        <p>Website belum bisa terhubung ke database MySQL. Biasanya ini terjadi karena <b>MySQL di XAMPP belum di-start</b> atau database <code>sikunjung_lapas</code> belum diimport.</p>
        <div class='step'>
          <b>Langkah perbaikan:</b><br>
          1. Buka XAMPP Control Panel.<br>
          2. Klik <b>Start</b> pada <b>Apache</b> dan <b>MySQL</b> sampai hijau.<br>
          3. Buka <code>http://localhost/phpmyadmin</code>.<br>
          4. Import file <code>database/sikunjung_lapas.sql</code>.<br>
          5. Refresh halaman website.
        </div>
      </div>
    </body>
    </html>";
    exit;
}

mysqli_set_charset($conn, "utf8mb4");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function e($value) {
    return htmlspecialchars($value ?? "", ENT_QUOTES, "UTF-8");
}

function require_login($role) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== $role) {
        if ($role === 'admin') {
            header("Location: ../auth/login-admin.php");
        } else {
            header("Location: ../auth/login-pengunjung.php");
        }
        exit;
    }
}
?>