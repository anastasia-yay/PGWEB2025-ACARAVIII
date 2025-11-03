<?php
$id = $_POST['id'];
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_acara8";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query update data
$sql = "UPDATE data_kecamatan 
        SET Kecamatan='$kecamatan', 
            Longitude='$longitude', 
            Latitude='$latitude', 
            Luas='$luas', 
            Jumlah_Penduduk='$jumlah_penduduk' 
        WHERE ID=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record edited succesfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: ../index.php");
?>
