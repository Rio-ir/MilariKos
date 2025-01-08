<?php
session_start();
session_destroy(); // Hapus semua session
header('Location: ../pages/home.php'); // Redirect ke halaman home
exit;
