-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table kosan.admin: ~0 rows (approximately)
INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- Dumping data for table kosan.chat: ~5 rows (approximately)
INSERT INTO `chat` (`id_chat`, `id_user`, `id_pemilik`, `pesan`, `waktu`, `pengirim`) VALUES
	(1, 1, 2, 'Hallo', '2024-12-11 09:28:58', 'user'),
	(2, 1, 2, 'Punten', '2024-12-11 11:42:49', 'user'),
	(3, 1, 5, 'Punten', '2024-12-11 11:42:57', 'user'),
	(4, 1, 6, 'P', '2024-12-14 05:42:05', 'user'),
	(5, 5, 7, 'P', '2024-12-14 07:43:31', 'user');

-- Dumping data for table kosan.fasilitas: ~2 rows (approximately)

-- Dumping data for table kosan.galeri: ~8 rows (approximately)
INSERT INTO `galeri` (`id_galeri`, `id_kost`, `judul`, `file`) VALUES
	(4, 3, 'belakang', '2313122024131518.jpg'),
	(5, 4, 'Kos halim', '5407122024055104.jpg'),
	(6, 5, 'depan', '2513122024130511.jpg'),
	(7, 3, 'belakang', '2313122024131948.jpg'),
	(8, 3, 'depan', '2313122024131848.jpg'),
	(9, 6, 'kos2', '2613122024132134.jpg'),
	(10, 7, 'depan', '6714122024021107.jpeg'),
	(11, 8, 'depan', '6814122024055529.jpeg'),
	(12, 9, 'depan', '7914122024074203.jpg');

-- Dumping data for table kosan.kost: ~6 rows (approximately)
INSERT INTO `kost` (`id_kost`, `id_pemilik`, `nama`, `alamat`, `latitude`, `longitude`, `tersedia`, `status`, `fasilitas`, `harga_3bulan`, `pengunjung`) VALUES
	(3, 2, 'Bagindakost', 'Darmaraja, Sumedang', -6.85686886, 107.92057732, 1, 'Laki-laki', '1', 500000, 5),
	(4, 5, 'Bapa Halim', 'Cimalaka', -6.85676815, 107.92008980, 2, 'Perempuan', 'Wifi, Parkir', 250000, 4),
	(5, 2, 'Bapa Dudung', 'Cimalaka, Sumedang', -6.95676815, 107.92008980, 1, 'Perempuan', '1', 250000, NULL),
	(6, 2, 'Bagindakost', 'Darmaraja, Sumedang', -6.85676815, 107.92057732, 1, 'Perempuan', 'Wifi', 250000, NULL),
	(7, 6, 'Jakost', 'Alun-alun, Sumedang', -6.86041860, 107.92018617, 1, 'Laki-laki', 'Wifi, Parkir', 350000, NULL),
	(8, 6, 'Jakost2', 'Cisitu, Sumedang', -6.85676815, 107.92057732, 1, 'Laki-laki', 'Wifi', 450000, NULL),
	(9, 7, 'Aditkos', 'Paseh, Sumedang', -6.86029898, 107.92014392, 1, 'Laki-laki', 'Wifi', 400000, NULL);

-- Dumping data for table kosan.pemesanan: ~5 rows (approximately)
INSERT INTO `pemesanan` (`id_pemesanan`, `id_kost`, `nama_kost`, `harga`, `status`, `tanggal_pesan`) VALUES
	(3, 3, 'Huhu', 500000, 'pending', '2024-12-07 07:02:46'),
	(4, 7, 'Jakost', 350000, 'pending', '2024-12-14 05:38:41'),
	(5, 5, 'Bapa Dudung', 250000, 'pending', '2024-12-14 05:40:09'),
	(6, 3, 'Bagindakost', 500000, 'pending', '2024-12-14 05:57:08'),
	(7, 9, 'Aditkos', 400000, 'pending', '2024-12-14 07:43:41');

-- Dumping data for table kosan.pemilik: ~5 rows (approximately)
INSERT INTO `pemilik` (`id_pemilik`, `nama`, `alamat`, `telepon`, `email`, `username`, `password`) VALUES
	(2, 'dudung', 'Cimalaka', '081914212209', 'thuglifesyle@gmail.com', 'dungg', '202cb962ac59075b964b07152d234b70'),
	(4, 'Fafa', 'Paseh', '081914212209', 'thuglifesyle@gmail.com', 'dengg', '81dc9bdb52d04dc20036dbd8313ed055'),
	(5, 'Halimm', 'Cimalaka', '089237746372', 'Halim@example.com', 'halim', 'd0970714757783e6cf17b26fb8e2298f'),
	(6, 'Jajang', 'Paseh', '081914212209', 'thuglifesyle@gmail.com', 'Jang', '202cb962ac59075b964b07152d234b70'),
	(7, 'Adit', 'Paseh, Sumedang', '081914212209', 'thuglifesyle@gmail.com', 'adit', '202cb962ac59075b964b07152d234b70');

-- Dumping data for table kosan.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
	(1, 'Gugun', 'gugun@example.com', '$2y$12$qWWAJHLtsSr8GjCsv3nv9uT7tVSKblC9a0s2ZbOBNP77mjFb0E3LC'),
	(2, 'Rangga', 'rangga@example.com', '$2y$12$LcChdjJqyJhgGzcM1s2AeOH9NhujBS2rzuxlWMPT9GQxX2gFUDN8y'),
	(3, 'Ahmad', 'ahmad@example.com', '$2y$12$RCInDuz4buxjky266lMTWeMUf.J06beNF1VVxtxHs1W4JQSYHQODi'),
	(4, 'Dadang', 'dadang@example.com', '$2y$12$cwdkdAN4U1oakfFG7/0H2O2WCaK/JTRrCTWgL70mUCDByQcxL.eoC'),
	(5, 'Agus', 'agus@example.com', '$2y$12$ZFY5sQgchebOmcVBXzE.C.YpB7lgIjY9eyqFBikf/C9bjSKGclzTe');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
