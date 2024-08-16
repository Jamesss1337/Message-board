<?php
require 'db.php';

$messageId = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM messages WHERE id = ?");
$stmt->execute([$messageId]);
$message = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE messages SET title = ?, author = ?, short_content = ?, full_content = ? WHERE id = ?");
    $stmt->execute([$_POST['title'], $_POST['author'], $_POST['short_content'], $_POST['full_content'], $messageId]);
    header("Location: view.php?id=$messageId");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать сообщение</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px;
            background: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        a:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <h1>Редактировать сообщение</h1>
    <form action="edit.php?id=<?= $messageId ?>" method="post">
        <input type="text" name="title" value="<?= htmlspecialchars($message['title']) ?>" required>
        <input type="text" name="author" value="<?= htmlspecialchars($message['author']) ?>" required>
        <textarea name="short_content" required><?= htmlspecialchars($message['short_content']) ?></textarea>
        <textarea name="full_content" required><?= htmlspecialchars($message['full_content']) ?></textarea>
        <button type="submit">Сохранить</button>
    </form>
    <a href="view.php?id=<?= $messageId ?>">Назад к сообщению</a>
</body>
</html>
