<?php
require '../config/db.php';

$id_kost = $_GET['id'];

// Query untuk mengambil detail kos berdasarkan ID
$query = "SELECT k.nama, k.alamat, k.harga_3bulan, k.status, k.id_pemilik, 
                 IFNULL(f.wifi, 'Tidak tersedia') AS wifi, 
                 IFNULL(f.dapur, 'Tidak tersedia') AS dapur, 
                 IFNULL(f.parkir, 'Tidak tersedia') AS parkir
          FROM kost k
          LEFT JOIN fasilitas f ON k.id_kost = f.id_kost
          WHERE k.id_kost = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id_kost);
$stmt->execute();
$result = $stmt->get_result();

// Ambil hasil query
$kos = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kost - <?php echo htmlspecialchars($kos['nama']); ?></title>
    <link rel="stylesheet" href="../assets/css/detail.css">
</head>
<body>
    <main>
        <!-- Container Detail -->
        <div class="detail-container">
            <div class="image-gallery">
                <!-- Galeri gambar kost -->
                <?php
                $query_galeri = "SELECT file FROM galeri WHERE id_kost = $id_kost";
                $galeri_result = $connection->query($query_galeri);

                if ($galeri_result->num_rows > 0):
                    while ($gambar = $galeri_result->fetch_assoc()): ?>
                        <img src="/Milarikos-5/assets/img/kost/<?php echo $gambar['file']; ?>" alt="Gambar Kost">
                <?php
                    endwhile;
                else: ?>
                    <img src="/Milarikos-5/assets/img/kost/default.jpg" alt="Default Gambar Kost">
                <?php endif; ?>
            </div>

            <!-- Informasi Kost -->
            <h2><?php echo htmlspecialchars($kos['nama']); ?></h2>
            <p><?php echo htmlspecialchars($kos['alamat']); ?></p>
            <p><strong>Harga:</strong> Rp <?php echo number_format($kos['harga_3bulan'], 0, ',', '.'); ?> / 3 bulan</p>
            <p><strong>Untuk:</strong> <?php echo htmlspecialchars($kos['status']); ?></p>

            <a href="chat.php?id_pemilik=<?php echo $kos['id_pemilik']; ?>" class="btn-primary">Chat Pemilik</a>

            <!-- Fasilitas -->
            <h3>Fasilitas Tersedia:</h3>
<ul>
    <?php if ($kos['wifi'] !== NULL && $kos['wifi'] != ''): ?>
        <li>WiFi</li>
    <?php endif; ?>
    
    <?php if ($kos['dapur'] !== NULL && $kos['dapur'] != ''): ?>
        <li>Dapur</li>
    <?php endif; ?>
    
    <?php if ($kos['parkir'] !== NULL && $kos['parkir'] != ''): ?>
        <li>Parkir</li>
    <?php endif; ?>

    <!-- Jika tidak ada fasilitas -->
    <?php if ($kos['wifi'] === NULL && $kos['dapur'] === NULL && $kos['parkir'] === NULL): ?>
        <li>Tidak ada fasilitas yang tersedia.</li>
    <?php endif; ?>
</ul>

            <!-- Tombol Sewa -->
            <a href="pembelian.php?id=<?php echo $id_kost; ?>" class="btn-primary">Sewa</a>
        </div>
    </main>
</body>
</html>
