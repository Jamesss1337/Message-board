<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO comments (message_id, author, content) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['message_id'], $_POST['author'], $_POST['content']]);
    header("Location: view.php?id=" . $_POST['message_id']);
    exit;
}
?>
