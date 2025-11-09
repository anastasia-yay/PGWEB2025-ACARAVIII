<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kecamatan Sleman</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <style>
        :root {
            --ungu: #5552A0;
            --biru: #6F94D6;
            --putih-muda: #E6ECF5;
            --hijau: #9BBE68;
            --krem: #D6C394;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--putih-muda);
        }

        h2 {
            color: var(--ungu);
            font-weight: 700;
        }

        #map {
            height: 500px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 3px solid var(--hijau);
        }

        .table thead {
            background-color: var(--ungu);
            color: white;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f6f7fb;
        }

        .btn-success {
            background-color: var(--hijau);
            border: none;
        }

        .btn-warning {
            background-color: var(--biru);
            border: none;
            color: white;
        }

        .btn-danger {
            background-color: var(--krem);
            border: none;
            color: #5a4a00;
        }

        .card {
            border: none;
            background-color: white;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
            border-top: 5px solid var(--biru);
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="text-center mb-4">
        <h2>🌍 Visualisasi Data Kecamatan Sleman</h2>
        <p class="text-muted">Pemetaan dan Data Statistik Kecamatan Sleman</p>
        <p class="text-muted">Anastasia Anindhita A.</p>
        <p class="text-muted">24/540610/SV/24885</p>
    </div>

    <!-- Peta -->
    <div id="map" class="shadow-sm"></div>

    <?php
    include "connection.php";
    $sql = "SELECT * FROM data_kecamatan";
    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    ?>

    <div class="card p-3 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-semibold text-primary">Daftar Data Kecamatan</h4>
            <a href="input/index.html" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Kecamatan</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Luas (km²)</th>
                            <th>Jumlah Penduduk</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?= $row["ID"]; ?></td>
                                <td><?= $row["Kecamatan"]; ?></td>
                                <td><?= $row["Longitude"]; ?></td>
                                <td><?= $row["Latitude"]; ?></td>
                                <td><?= $row["Luas"]; ?></td>
                                <td><?= $row["Jumlah_Penduduk"]; ?></td>
                                <td class="text-center">
                                    <a href="edit/index.php?id=<?= $row["ID"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td class="text-center">
                                    <a href="delete.php?id=<?= $row["ID"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center mb-0">Belum ada data kecamatan yang tersimpan.</div>
        <?php endif; ?>
    </div>
</div>

<?php $conn->close(); ?>

<script>
    var map = L.map('map').setView([-7.7, 110.4], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var kecamatanData = <?php echo json_encode($data); ?>;

    kecamatanData.forEach(function(item) {
        var marker = L.circleMarker([item.Latitude, item.Longitude], {
            color: '#5552A0',
            fillColor: '#9BBE68',
            fillOpacity: 0.9,
            radius: 8
        }).addTo(map);

        marker.bindPopup(`
            <b>${item.Kecamatan}</b><br>
            Luas: ${item.Luas} km²<br>
            Penduduk: ${item.Jumlah_Penduduk}
        `);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
