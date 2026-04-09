<?php
require 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ? AND status = 'published'");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    header("Location: 404.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?> | My Blog</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; color: #333; }

        header {
            background: #1a1a2e;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a { color: #e94560; text-decoration: none; font-weight: bold; }

        .container { max-width: 800px; margin: 50px auto; padding: 0 20px; }

        .post {
            background: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        .category {
            display: inline-block;
            background: #e94560;
            color: white;
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .post h1 { font-size: 30px; margin-bottom: 10px; color: #1a1a2e; }
        .meta { font-size: 13px; color: #999; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #eee; }
        .content { line-height: 1.9; font-size: 16px; color: #444; white-space: pre-wrap; }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            color: #e94560;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<header>
    <h1>📝 My Blog</h1>
    <a href="index.php">← Back to Home</a>
</header>

<div class="container">
    <div class="post">
        <span class="category"><?= htmlspecialchars($post['category']) ?></span>
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <div class="meta">🗓 Published on <?= date('d M Y, h:i A', strtotime($post['created_at'])) ?></div>
        <div class="content"><?= htmlspecialchars($post['content']) ?></div>
        <a href="index.php" class="back-link">← Back to all posts</a>
    </div>
</div>

</body>
</html>
