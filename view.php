<?php
require 'db.php';

$messageId = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM messages WHERE id = ?");
$stmt->execute([$messageId]);
$message = $stmt->fetch();

$commentsStmt = $pdo->prepare("SELECT * FROM comments WHERE message_id = ?");
$commentsStmt->execute([$messageId]);
$comments = $commentsStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($message['title']) ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
        p {
            background: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
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
    <h1><?= htmlspecialchars($message['title']) ?></h1>
    <p><?= htmlspecialchars($message['full_content']) ?></p>

    <h2>Комментарии</h2>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li><?= htmlspecialchars($comment['content']) ?> (от: <?= htmlspecialchars($comment['author']) ?>)</li>
        <?php endforeach; ?>
    </ul>

    <h3>Добавить комментарий</h3>
    <form action="add_comment.php" method="post">
        <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
        <input type="text" name="author" placeholder="Ваше имя" required>
        <textarea name="content" placeholder="Ваш комментарий" required></textarea>
        <button type="submit">Добавить</button>
    </form>

    <a href="edit.php?id=<?= $message['id'] ?>">Редактировать сообщение</a>
    <a href="index.php">Назад к списку сообщений</a>
</body>
</html>
