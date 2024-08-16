<?php
require 'db.php';

$limit = 5; 
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $limit;

$stmt = $pdo->prepare("SELECT * FROM messages LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$messages = $stmt->fetchAll();
$totalMessages = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
$totalPages = ceil($totalMessages / $limit);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список сообщений</title>
    <link rel="stylesheet" href="styles.css">
</head> 
<body>
    <h1>Сообщения</h1>
    <ul>
        <?php foreach ($messages as $message): ?>
            <li>
                <a href="view.php?id=<?= $message['id'] ?>"><?= htmlspecialchars($message['title']) ?></a> 
                <p><?= htmlspecialchars($message['short_content']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>

    <a href="add.php" class="add-message">Добавить сообщение</a>
</body>
</html>
