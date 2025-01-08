<?php
require '../config.php';
session_start();

// Pastikan admin atau pemilik sudah login
if (!isset($_SESSION['is_logged']) || !isset($_SESSION['pemilik_id'])) {
    header("Location: ../index.php");
    exit;
}

// Ambil ID pemilik dari session
$id_pemilik = $_SESSION['pemilik_id'];

// Query untuk mengambil pembelian dengan status pending
$query = "
    SELECT p.id_pemesanan, p.nama_kost, p.harga, p.status, p.tanggal_pesan, u.username 
    FROM pemesanan p
    JOIN users u ON p.id_user = u.id
    JOIN kost k ON p.id_kost = k.id_kost
    WHERE k.id_pemilik = ? AND p.status = 'pending'
    ORDER BY p.tanggal_pesan DESC
";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id_pemilik);
$stmt->execute();
$result = $stmt->get_result();
$pending_purchases = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembelian</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 4px; color: white; }
        .btn-confirm { background-color: #28a745; }
        .btn-cancel { background-color: #dc3545; }
    </style>
</head>
<body>
    <h2>Konfirmasi Pembelian</h2>
    <?php if (!empty($pending_purchases)): ?>
        <table>
            <thead>
                <tr>
                    <th>Kost</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Tanggal Pesan</th>
                    <th>User</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pending_purchases as $purchase): ?>
                    <tr>
                        <td><?= htmlspecialchars($purchase['nama_kost']); ?></td>
                        <td>Rp <?= number_format($purchase['harga'], 0, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($purchase['status']); ?></td>
                        <td><?= htmlspecialchars($purchase['tanggal_pesan']); ?></td>
                        <td><?= htmlspecialchars($purchase['username']); ?></td>
                        <td>
                            <a href="proses_konfirmasi.php?id=<?= $purchase['id_pemesanan']; ?>&action=confirm" class="btn btn-confirm">Konfirmasi</a>
                            <a href="proses_konfirmasi.php?id=<?= $purchase['id_pemesanan']; ?>&action=cancel" class="btn btn-cancel">Batalkan</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada pembelian yang perlu dikonfirmasi.</p>
    <?php endif; ?>
</body>
</html>
