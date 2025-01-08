<?php
session_start();  // Memulai session agar bisa mengakses data session
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milarikos</title>
    <link rel="stylesheet" href="/User/assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Faculty+Glyphic&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>
        /* Header Styling */
    
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: nunito;
    }

    header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background-color: #D7C38C;
    color: white;
    }

    header h1 {
    font-size: 1.5rem;
    margin: 0;
    }

    header h1 a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    }

    header h1 a:hover {
    color: #FFD700;
    }

    header div {
    display: flex;
    align-items: center;
    gap: 10px;
    }

    header div a {
    text-decoration: none;
    color: black;
    padding: 5px 10px;
    transition: background-color 0.3s ease, color 0.3s ease;
    }

    header div a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    }

    .form1 {
    padding: 10px 20px;
    background-color: #D7C38C;
    }

    .form-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    background-color: #D7C38C;
    box-shadow: none;
    }

.form-container input,
.form-container select,
.form-container button {
    padding: 10px;
    font-size: 1rem;
    border: 1px #ddd;
    border-radius: 20px;
    flex: 1; /* Lebar elemen input otomatis */
}

.form-container button {
    background-color: #39DAAC;
    color: white;
    cursor: pointer;
}

.form-container button:hover {
    background-color:rgb(47, 181, 143);
    color: white;
}

.homeabout {
    list-style: none;
    display: flex;
    margin-right: 800px;
}

.homeabout li {
    margin-right: 20px; /* Adjust margin as needed */
}

.homeabout li .home{
    color: black;
    text-decoration: none;
}

.homeabout li .about{
    color: black;
    
}

/* Optional: Style for logged-in user section */
.logged-in-user {
    display: flex;
    align-items: center;
}

.logged-in-user a {
    margin-left: 10px;
}

.halo {
    color: black;
}

/* Ini yang about */

/* Styling untuk seluruh bagian */
.about-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
    padding: 40px;
    background-color: #ffffff; /* Warna latar */
    font-family: Arial, sans-serif;
}

/* Bagian teks */
.text-content {
    flex: 1; /* Mengatur lebar otomatis untuk teks */
    max-width: 60%; /* Batas lebar teks */
}

.text-content h2 {
    font-size: 1.8rem;
    color: #333333; /* Warna teks utama */
    margin-bottom: 15px;
}

.text-content h3 {
    font-size: 1.4rem;
    color: #333333; /* Warna teks subjudul */
    margin-top: 20px;
    margin-bottom: 10px;
}

.text-content p {
    font-size: 1rem;
    color: #555555; /* Warna teks paragraf */
    line-height: 1.6;
    margin-bottom: 15px;
}

/* Bagian gambar */
.image-content {
    flex: 1; /* Lebar otomatis untuk gambar */
    max-width: 40%; /* Batas lebar gambar */
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-content img {
    max-width: 100%;
    height: auto; /* Gambar tetap proporsional */
    border-radius: 10px; /* Efek melengkung pada sudut gambar */
}

   </style>
</head>
<body>
<header>
    <a href="home.php"><img src="../../assets/img/mk-high-resolution-logo-transparent.png" alt="logo milarikos" width="120px" height="47px"></a>
    <ul class="homeabout">
        <li><a class="home" href="../pages/home.php">Home</a></li>
        <li><a class="about" href="../includes/about.php">About</a></li>
    </ul>
    
    
    <div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Jika user sudah login -->
            <span class="halo">Halo, <a href="/Milarikos-5/user/pages/profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a></span>
            <a href="/Milarikos-5/user/api/logout.php" style="margin-left: 10px;">Logout</a>
        <?php else: ?>
            <!-- Jika user belum login -->
            <a href="/Milarikos-5/user/pages/login.php"><i class="fa fa-user" aria-hidden="true"></i></a>
            <a href="/Milarikos-5/user/pages/login.php">Masuk</a>
            <a href="/Milarikos-5/user/pages/register.php">Daftar</a>
        <?php endif; ?>
    </div>
</header>

<!-- Ini yang about -->

<div class="about-section">
    <div class="text-content">
        <h2>Sekilas Tentang MILARIKOST</h2>
        <p>
            Selamat datang di MILARIKOST, platform inovatif yang hadir untuk mempermudah Anda dalam menemukan tempat tinggal sementara yang nyaman dan sesuai kebutuhan. Kami memahami bahwa mencari kost yang ideal bisa menjadi tantangan, terutama dengan berbagai pilihan yang tersedia. Oleh karena itu, kami hadir sebagai solusi terbaik untuk menjembatani pencari kost dengan pemilik kost di seluruh Indonesia.
        </p>
        <h3>Misi Kami</h3>
        <p>
            Menjadi platform terpercaya yang menghubungkan pencari kost dengan pilihan yang sesuai, memberikan pengalaman pencarian yang mudah, cepat, dan transparan.
        </p>
        <h3>Visi Kami</h3>
        <p>
            Menjadi aplikasi nomor satu dalam pencarian kost di Indonesia dengan menyediakan informasi yang akurat, sistem pembayaran yang fleksibel, dan layanan pelanggan yang unggul.
        </p>
    </div>
    <div class="image-content">
        <img src="../assets/img/pexels-daniele-la-rosa-messina-1626789-14911895.jpg" alt="Gambar Kota di Malam Hari">
    </div>
</div>

</body>
</html>
