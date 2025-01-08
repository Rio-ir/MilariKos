<?php
require '../user/config/db.php';
session_start();

if (!isset($_SESSION['pemilik_id'])) {
    header("Location: ../index.php");
    exit;
}

$id_pemilik = $_SESSION['pemilik_id'];
$id_user = $_GET['id_user'] ?? null;

if (!$id_user) {
    echo "User tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM chat WHERE id_user = ? AND id_pemilik = ? ORDER BY waktu ASC";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii", $id_user, $id_pemilik);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesan = $_POST['pesan'] ?? '';
    if ($pesan) {
        $insert = "INSERT INTO chat (id_user, id_pemilik, pesan, pengirim) VALUES (?, ?, ?, 'pemilik')";
        $stmt_insert = $connection->prepare($insert);
        $stmt_insert->bind_param("iis", $id_user, $id_pemilik, $pesan);
        $stmt_insert->execute();
        header("Location: chat_detail.php?id_user=$id_user");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Detail</title>
</head>
<body>
<div class="chat-box">
    <h2>Chat dengan User</h2>
    <div class="messages">
        <?php foreach ($messages as $msg): ?>
            <p><strong><?= htmlspecialchars($msg['pengirim']) ?>:</strong> <?= htmlspecialchars($msg['pesan']) ?></p>
        <?php endforeach; ?>
    </div>
    <form method="POST">
        <textarea name="pesan" placeholder="Tulis pesan..." required></textarea>
        <button type="submit">Kirim</button>
    </form>
</div>
</body>
</html>
