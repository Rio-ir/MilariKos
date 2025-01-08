<?php
require '../config.php';
session_start();

// Pastikan admin atau pemilik sudah login
if (!isset($_SESSION['is_logged']) || !isset($_SESSION['pemilik_id'])) {
    header("Location: ../index.php");
    exit;
}

// Ambil data dari URL
$id_pemesanan = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Validasi tindakan
if (!in_array($action, ['confirm', 'cancel'])) {
    echo "Tindakan tidak valid!";
    exit;
}

// Tentukan status baru berdasarkan tindakan
$status_baru = $action === 'confirm' ? 'confirmed' : 'cancelled';

// Perbarui status pemesanan di database
$query = "UPDATE pemesanan SET status = ? WHERE id_pemesanan = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("si", $status_baru, $id_pemesanan);
if ($stmt->execute()) {
    header("Location: konfirmasi_pembelian.php");
    exit;
} else {
    echo "Gagal memperbarui status pembelian.";
}
?>
