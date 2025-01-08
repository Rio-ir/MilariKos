<?php
require '../config/db.php';
?>
<?php include_once '../includes/header.php'; ?>
<?php
// Ambil data kos dari API
$api_url = "http://localhost/Milarikos-5/user/api/search.php?lokasi=&min=0&max=999999999&status=";
$data = file_get_contents($api_url);
$kos_list = json_decode($data, true); // Decode JSON menjadi array
?>

<style>
    * {
        font-family: nunito;
    }
    .gambarkos{
        margin-top: 30px;
        margin-left: 50px;
    }

    .gambar {
    transition: transform 0.3s ease-in-out; /* Animasi transisi */
    }

.gambar:hover {
  transform: scale(1.08); /* Memperbesar 10% saat di-hover */
}

.alamat{
    font-size: 12px;
}

.harga {
    font-size: 12px;
}

.harga .currency {
    font-size: 1rem; /* Ukuran font untuk "Rp." */
    font-weight: bold; /* Membuat lebih tebal */
}

.harga .price {
    font-size: 1rem; /* Ukuran font untuk harga */
    font-weight: bold; /* Membuat lebih tebal */
}
</style>

<main>
    <div class="gambarkos">
    <div style="display: flex; flex-wrap: wrap; gap: 40px;">
        <?php if (!empty($kos_list)): ?>
            <?php foreach ($kos_list as $kos): ?>
                <?php
                    // Ambil gambar kosan dari tabel galeri berdasarkan id_kost
                    $id_kost = $kos['id_kost'];
                    $query = "SELECT file FROM galeri WHERE id_kost = $id_kost LIMIT 1";
                    $result = $connection->query($query);
                    $gambar = $result->fetch_assoc();
                    // Ambil nama file gambar jika ada
                    $gambar_file = $gambar ? $gambar['file'] : ''; 
                    
                    // Path gambar absolut
                    $gambar_path = '/Milarikos-5/assets/img/kost/' . $gambar_file;
                ?>
                <!-- Membuat seluruh card dapat diklik -->
                <a href="detail.php?id=<?php echo $kos['id_kost']; ?>" style="text-decoration: none; color: inherit;">
                    <div style="border: 1px solid #ddd; padding: 10px; width: 250px; border-radius: 8px;">
                        <!-- Gambar Kos -->
                        <?php if ($gambar_file): ?>
                            <img class = "gambar" src="<?php echo $gambar_path; ?>" alt="Gambar Kos" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                        <?php else: ?>
                            <img src="/Milarikos-5/assets/img/kost/default.jpg" alt="Gambaos" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                        <?php endif; ?>
                        
                        <!-- Nama dan Detail Kosan -->
                        <h4><?php echo htmlspecialchars($kos['nama']); ?></h4>
                        <p class="alamat"><?php echo htmlspecialchars($kos['alamat']); ?></p>
                        <br>
                        <p class="harga">
                         Harga <span class="currency">Rp.</span> <strong class="price"><?php echo number_format($kos['harga_3bulan']); ?></strong> / Bulan
                        </p>

                        <?php echo htmlspecialchars($kos['status']); ?>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada data kos tersedia.</p>
        <?php endif; ?>
    </div>
    </div>
</main>