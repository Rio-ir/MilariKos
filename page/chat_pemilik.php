<?php
require '../user/config/db.php';
session_start();

// Debug: Periksa session pemilik
var_dump($_SESSION);  // Cek apakah session sudah ter-set

if (!isset($_SESSION['pemilik_id'])) {
    header("Location: ../index.php");
    exit;
}

$id_pemilik = $_SESSION['pemilik_id'];

// Ambil daftar user yang pernah mengirim pesan ke pemilik ini
$query = "
    SELECT DISTINCT u.id AS user_id, u.username, 
           (SELECT pesan FROM chat WHERE id_user = u.id AND id_pemilik = ? ORDER BY waktu DESC LIMIT 1) AS pesan_terakhir,
           (SELECT waktu FROM chat WHERE id_user = u.id AND id_pemilik = ? ORDER BY waktu DESC LIMIT 1) AS waktu_terakhir
    FROM chat c
    JOIN users u ON c.id_user = u.id
    WHERE c.id_pemilik = ?
    ORDER BY waktu_terakhir DESC
";
$stmt = $connection->prepare($query);
$stmt->bind_param("iii", $id_pemilik, $id_pemilik, $id_pemilik);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

// Debug: Cek hasil query
var_dump($users);  // Lihat apakah data berhasil diambil

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat dengan User</title>
    <style>
        .chat-list { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .chat-item { margin-bottom: 15px; }
        .chat-item h4 { margin: 0; }
        .chat-item p { margin: 5px 0; color: #666; }
        .chat-item a { text-decoration: none; color: #007BFF; }
    </style>
</head>
<body>
<div class="chat-list">
    <h2>Daftar Chat</h2>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <div class="chat-item">
                <h4><?= htmlspecialchars($user['username']) ?></h4>
                <p><?= htmlspecialchars($user['pesan_terakhir']) ?></p>
                <small><?= htmlspecialchars($user['waktu_terakhir']) ?></small>
                <a href="chat_detail.php?id_user=<?= $user['user_id'] ?>">Lihat Chat</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada pesan dari user.</p>
    <?php endif; ?>
</div>
</body>
</html>
