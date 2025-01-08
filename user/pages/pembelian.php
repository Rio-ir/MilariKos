<?php
require '../config/db.php';  // Koneksi ke database

// Ambil ID kost dari URL
$id_kost = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Query untuk mengambil detail kos berdasarkan ID
$query = "SELECT k.nama, k.alamat, k.harga_3bulan, k.status 
          FROM kost k
          WHERE k.id_kost = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id_kost);
$stmt->execute();
$result = $stmt->get_result();

// Ambil hasil query
$kos = $result->fetch_assoc();

// Redirect jika data tidak ditemukan
if (!$kos) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian - <?php echo htmlspecialchars($kos['nama']); ?></title>
    <style>
        /* Styling untuk halaman pembelian */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #218838;
        }

        .details {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Pembelian Kost</h2>
    <div class="details">
        <p><strong>Nama Kost:</strong> <?php echo htmlspecialchars($kos['nama']); ?></p>
        <p><strong>Alamat:</strong> <?php echo htmlspecialchars($kos['alamat']); ?></p>
        <p><strong>Harga (3 bulan):</strong> Rp <?php echo number_format($kos['harga_3bulan'], 0, ',', '.'); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($kos['status']); ?></p>
    </div>

    <!-- Form untuk mengonfirmasi pembelian -->
    <form action="proses_pembelian.php" method="POST">
        <input type="hidden" name="id_kost" value="<?php echo $id_kost; ?>">
        <button type="submit" class="btn">Lanjutkan Pembelian</button>
    </form>
</div>

</body>
</html>
