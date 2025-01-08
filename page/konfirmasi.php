<?php
require '../../config/db.php'; // Koneksi ke database

// Ambil ID pemesanan dari POST
$id_pemesanan = isset($_POST['id_pemesanan']) ? (int) $_POST['id_pemesanan'] : 0;

// Periksa apakah ID valid
if ($id_pemesanan <= 0) {
    echo "ID Pemesanan tidak valid.";
    exit;
}

// Query untuk mengubah status menjadi 'confirmed'
$query = "UPDATE pemesanan SET status = 'confirmed' WHERE id_pemesanan = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id_pemesanan);

// Eksekusi query
if ($stmt->execute()) {
    echo "Pemesanan berhasil dikonfirmasi.";
    header("Location: admin_pemesanan.php"); // Redirect ke halaman daftar pemesanan
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}
