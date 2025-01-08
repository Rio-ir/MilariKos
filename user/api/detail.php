<?php include_once '../includes/header.php'; ?>
<?php
if (!isset($_GET['id'])) {
    echo "ID kos tidak ditemukan!";
    exit;
}

$id_kos = $_GET['id'];
$api_url = "http://localhost/User/api/search.php?lokasi=&min=0&max=999999999&status=";
$data = file_get_contents($api_url);
$kos_list = json_decode($data, true);

// Cari data kos berdasarkan ID
$kos_detail = null;
foreach ($kos_list as $kos) {
    if ($kos['id_kost'] == $id_kos) {
        $kos_detail = $kos;
        break;
    }
}

if (!$kos_detail) {
    echo "Kos tidak ditemukan!";
    exit;
}
?>
<main>
    <h2>Detail Kos</h2>
    <p><strong>Nama:</strong> <?php echo htmlspecialchars($kos_detail['nama']); ?></p>
    <p><strong>Alamat:</strong> <?php echo htmlspecialchars($kos_detail['alamat']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($kos_detail['status']); ?></p>
    <p><strong>Harga 3 Bulan:</strong> Rp <?php echo number_format($kos_detail['harga_3bulan']); ?></p>
    <p><strong>Fasilitas:</strong> <?php echo htmlspecialchars($kos_detail['fasilitas']); ?></p>
    <p><strong>Lokasi:</strong> Latitude <?php echo htmlspecialchars($kos_detail['latitude']); ?>, Longitude <?php echo htmlspecialchars($kos_detail['longitude']); ?></p>
    <a href="sewa.php?id=<?php echo $kos_detail['id_kost']; ?>">Sewa Kos</a>
    <a href="chat.php?owner_id=<?php echo $kos_detail['id_pemilik']; ?>">Chat Pemilik</a>
</main>