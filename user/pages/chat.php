<?php
require '../config/db.php';
session_start();

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['user_id'];
$id_pemilik = $_GET['id_pemilik'] ?? null;

// Cek jika pemilik tidak ada
if (!$id_pemilik) {
    echo "Pemilik tidak ditemukan.";
    exit;
}

// Ambil semua pesan
$query = "SELECT * FROM chat WHERE id_user = ? AND id_pemilik = ? ORDER BY waktu ASC";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii", $id_user, $id_pemilik);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesan = $_POST['pesan'] ?? '';
    if ($pesan) {
        $insert = "INSERT INTO chat (id_user, id_pemilik, pesan, pengirim) VALUES (?, ?, ?, 'user')";
        $stmt_insert = $connection->prepare($insert);
        $stmt_insert->bind_param("iis", $id_user, $id_pemilik, $pesan);
        $stmt_insert->execute();
        header("Location: chat.php?id_pemilik=$id_pemilik");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat dengan Pemilik</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        .chat-box { max-width: 600px; margin: auto; border: 1px solid #ccc; border-radius: 8px; padding: 10px; }
        .message { margin-bottom: 10px; }
        .user-message { text-align: right; }
        .pemilik-message { text-align: left; }
        .chat-input { width: 100%; padding: 10px; }
    </style>
</head>
<body>
    <div class="chat-box">
        <h2>Chat dengan Pemilik</h2>
        <div class="messages">
            <?php foreach ($messages as $msg): ?>
                <div class="message <?= $msg['pengirim'] === 'user' ? 'user-message' : 'pemilik-message' ?>">
                    <p><strong><?= htmlspecialchars($msg['pengirim']) ?>:</strong> <?= htmlspecialchars($msg['pesan']) ?></p>
                    <small><?= $msg['waktu'] ?></small>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="POST">
            <textarea name="pesan" class="chat-input" placeholder="Tulis pesan..." required></textarea>
            <button type="submit">Kirim</button>
        </form>
    </div>
</body>
</html>
