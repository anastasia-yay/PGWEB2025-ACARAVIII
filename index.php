<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    //Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pgweb_acara8";

    //Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM data_kecamatan";
    $result = $conn->query($sql);

    echo "<a href='input/index.html'>Input</a>";

    if ($result->num_rows > 0) { 
        echo "<table border='1px'>
            <tr> 
                <th>ID</th> 
                <th>Kecamatan</th> 
                <th>Longitude</th> 
                <th>Latitude</th>
                <th>Luas</th>
                <th>Jumlah Penduduk</th>"; 

    // output data of each row 
    while($row = $result->fetch_assoc()) { 
        echo "<tr>
                 <td>".$row["ID"]."</td>
                 <td>".$row["Kecamatan"]."</td>
                 <td>".$row["Longitude"]."</td>
                 <td>".$row["Latitude"]."</td>
                 <td>".$row["Luas"]."</td>
                 <td>".$row["Jumlah_Penduduk"]."</td>
            </tr>"; 
    } 

    echo "</table>"; 
        } else { 
    echo "0 results"; 
    }

$conn->close();
    
    ?>

</body>
</html>