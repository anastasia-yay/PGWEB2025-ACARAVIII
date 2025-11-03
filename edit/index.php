<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kecamatan</title>
</head>
<body>

<?php
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

$id = $_GET['id'];
$sql = "SELECT * FROM data_kecamatan WHERE ID = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form action='edit.php' onsubmit='return validateForm()' method='post'>";
    while($row = $result->fetch_assoc()) {
        echo "<input type='hidden' name='id' value='".$row['ID']."'><br>";
        echo "<label for='kecamatan'>Kecamatan:</label><br>";
        echo "<input type='text' id='kec' name='kecamatan' value='".$row['Kecamatan']."'><br>";
        echo "<label for='longitude'>Longitude:</label><br>";
        echo "<input type='text' id='long' name='longitude' value='".$row['Longitude']."'><br>";
        echo "<label for='latitude'>Latitude:</label><br>";
        echo "<input type='text' id='lat' name='latitude' value='".$row['Latitude']."'><br>";
        echo "<label for='luas'>Luas:</label><br>";
        echo "<input type='text' id='luas' name='luas' value='".$row['Luas']."'><br>";
        echo "<label for='jumlah_penduduk'>Jumlah Penduduk:</label><br>";
        echo "<input type='text' id='jml_pddk' name='jumlah_penduduk' value='".$row['Jumlah_Penduduk']."'><br><br>";
    }
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
}
?>

<p id="informasi"></p>

<script>
function validateForm() {
    let luas = document.getElementById("luas").value;
    let text = "";
    if (isNaN(luas) || luas < 1) {
        text = "Data luas harus angka dan tidak boleh bernilai negatif";
        //stop the form submission
        event.preventDefault();
    }

    document.getElementById("informasi").innerHTML = text;
}
</script>
</body>
</html>
