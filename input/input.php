<?php
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Konfigurasi koneksi database MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_acara8";

//pembuatan koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

//cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

//pengiriman data
$sql = "INSERT INTO data_kecamatan (Kecamatan, Longitude, Latitude, Luas, Jumlah_Penduduk)
        VALUES ('$kecamatan', '$longitude', '$latitude', '$luas', '$jumlah_penduduk')";

//penyimpanan data dan memeriksa apakah berhasil
if ($conn->query($sql) === TRUE) {
    $message = "Record berhasil ditambahkan!";
} else {
    $message = "ERROR: " . $conn->error;
}

$conn->close();

//pengarahan kembali ke index.php dengan pesan
header("Location: ../index.php?message=" . urlencode($message));
exit();
?>
