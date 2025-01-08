<?php
include_once '../config/db.php';

$lokasi = $_GET['lokasi'] ?? '';
$min = $_GET['min'] ?? 0;
$max = $_GET['max'] ?? 999999999;
$status = $_GET['status'] ?? '';

// Buat query SQL dengan kondisi filter
$query = "SELECT * FROM kost WHERE 1=1";

if (!empty($lokasi)) {
    $query .= " AND alamat LIKE '%$lokasi%'";
}
if (!empty($status)) {
    $query .= " AND status = '$status'";
}
$query .= " AND harga_3bulan BETWEEN $min AND $max";

// Eksekusi query
$result = $connection->query($query);

// Simpan hasil ke array
$kosts = [];
while ($row = $result->fetch_assoc()) {
    $kosts[] = $row;
}

$sql = "SELECT kos.id_kost, kos.nama, kos.alamat, kos.status, kos.fasilitas, kos.harga_3bulan, 
               kos.latitude, kos.longitude, kos.id_pemilik,
               (SELECT file FROM galeri WHERE galeri.id_kost = kos.id_kost LIMIT 1) AS gambar 
        FROM kos 
        WHERE ...";


// Kembalikan data dalam format JSON
echo json_encode($kosts);
?>

