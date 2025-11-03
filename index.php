<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kecamatan Sleman</title>

    <!-- Tambahkan Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #map {
            height: 500px;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<h2>Visualisasi Data Kecamatan Sleman</h2>

<!-- Peta Leaflet -->
<div id="map"></div>

<?php
include "connection.php";

$sql = "SELECT * FROM data_kecamatan";
$result = $conn->query($sql);

// Buat array untuk JavaScript
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Tombol Input
echo "<a href='input/index.html'>+ Tambah Data</a><br><br>";

// Tabel Data
if ($result->num_rows > 0) { 
    echo "<table border='1'>
        <tr> 
            <th>ID</th> 
            <th>Kecamatan</th> 
            <th>Longitude</th> 
            <th>Latitude</th>
            <th>Luas (km²)</th>
            <th>Jumlah Penduduk</th>
            <th colspan='2'>Aksi</th>
        </tr>"; 

    foreach ($data as $row) { 
        echo "<tr>
                <td>".$row["ID"]."</td>
                <td>".$row["Kecamatan"]."</td>
                <td>".$row["Longitude"]."</td>
                <td>".$row["Latitude"]."</td>
                <td>".$row["Luas"]."</td>
                <td>".$row["Jumlah_Penduduk"]."</td>
                <td><a href='delete.php?id=".$row["ID"]."'>Hapus</a></td>
                <td><a href='edit/index.php?id=".$row["ID"]."'>Edit</a></td>
            </tr>"; 
    } 

    echo "</table>"; 
} else { 
    echo "Belum ada data."; 
}

$conn->close();
?>

<!-- Script Peta -->
<script>
    var map = L.map('map').setView([-7.7, 110.4], 11);

    // Tambahkan tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Ambil data dari PHP
    var kecamatanData = <?php echo json_encode($data); ?>;

    // Tambahkan marker untuk tiap kecamatan
    kecamatanData.forEach(function(item) {
        var marker = L.marker([item.Latitude, item.Longitude]).addTo(map);
        marker.bindPopup(
            "<b>" + item.Kecamatan + "</b><br>" +
            "Luas: " + item.Luas + " km²<br>" +
            "Penduduk: " + item.Jumlah_Penduduk
        );
    });
</script>

</body>
</html>
