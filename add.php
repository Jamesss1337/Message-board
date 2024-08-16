<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO messages (title, author, short_content, full_content) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['author'], $_POST['short_content'], $_POST['full_content']]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить сообщение</title>
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
    <h1>Добавить сообщение</h1>
    <form action="add.php" method="post">
        <input type="text" name="title" placeholder="Заголовок" required>
        <input type="text" name="author" placeholder="Автор" required>
        <textarea name="short_content" placeholder="Краткое содержание" required></textarea>
        <textarea name="full_content" placeholder="Полное содержание" required></textarea>
        <button type="submit">Добавить</button>
    </form>
    <a href="index.php">Назад к списку сообщений</a>
</body>
</html>
