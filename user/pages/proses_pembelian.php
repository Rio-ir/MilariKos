<?php
require '../config/db.php';  // Koneksi ke database

// Ambil ID kost yang dipilih
$id_kost = isset($_POST['id_kost']) ? (int) $_POST['id_kost'] : 0;

// Query untuk mendapatkan detail kost
$query = "SELECT k.nama, k.harga_3bulan 
          FROM kost k 
          WHERE k.id_kost = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id_kost);
$stmt->execute();
$result = $stmt->get_result();

// Ambil hasil query
$kos = $result->fetch_assoc();

// Jika tidak ada data
if (!$kos) {
    echo "Kost tidak ditemukan!";
    exit;
}

// Simulasi pemesanan (misalnya, menyimpan ke tabel pemesanan)
$query_pemesanan = "INSERT INTO pemesanan (id_kost, nama_kost, harga, status) 
                    VALUES (?, ?, ?, 'pending')";
$stmt_pemesanan = $connection->prepare($query_pemesanan);
$stmt_pemesanan->bind_param("isi", $id_kost, $kos['nama'], $kos['harga_3bulan']);
$stmt_pemesanan->execute();

// Konfirmasi pemesanan
echo "<h2>Pemesanan berhasil!</h2>";
echo "<p>Nama Kost: " . htmlspecialchars($kos['nama']) . "</p>";
echo "<p>Harga: Rp " . number_format($kos['harga_3bulan'], 0, ',', '.') . "</p>";
echo "<p>Status pemesanan: Pending</p>";
echo "<p><a href='home.php'>Kembali ke halaman utama</a></p>";
?>
