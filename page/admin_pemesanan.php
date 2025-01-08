<?php
require '../../config/db.php'; // Koneksi ke database

// Query untuk mengambil pemesanan dengan status 'pending'
$query = "SELECT id_pemesanan, nama_kost, harga, metode_pembayaran, tanggal_pesan 
          FROM pemesanan 
          WHERE status = 'pending'";
$result = $connection->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pemesanan</title>
</head>
<body>
    <h2>Daftar Pemesanan Pending</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID Pemesanan</th>
                <th>Nama Kost</th>
                <th>Harga</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal Pesan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_pemesanan']; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_kost']); ?></td>
                    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($row['metode_pembayaran']); ?></td>
                    <td><?php echo $row['tanggal_pesan']; ?></td>
                    <td>
                        <form action="konfirmasi.php" method="POST">
                            <input type="hidden" name="id_pemesanan" value="<?php echo $row['id_pemesanan']; ?>">
                            <button type="submit">Konfirmasi</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
