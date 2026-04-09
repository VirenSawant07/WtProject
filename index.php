<?php
require 'db.php';

$result = $conn->query("SELECT * FROM posts WHERE status='published' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
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
        header h1 { font-size: 24px; letter-spacing: 1px; }
        header a { color: #e94560; text-decoration: none; font-weight: bold; }
        header a:hover { text-decoration: underline; }

        .container { max-width: 900px; margin: 40px auto; padding: 0 20px; }

        .post-card {
            background: white;
            border-radius: 8px;
            padding: 28px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            transition: transform 0.2s;
        }
        .post-card:hover { transform: translateY(-2px); }

        .post-card .category {
            display: inline-block;
            background: #e94560;
            color: white;
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .post-card h2 { font-size: 22px; margin-bottom: 10px; }
        .post-card h2 a { color: #1a1a2e; text-decoration: none; }
        .post-card h2 a:hover { color: #e94560; }
        .post-card p { color: #666; line-height: 1.6; margin-bottom: 14px; }
        .post-card .meta { font-size: 13px; color: #999; }

        .read-more {
            display: inline-block;
            margin-top: 12px;
            color: #e94560;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }
        .read-more:hover { text-decoration: underline; }

        .no-posts { text-align: center; padding: 60px; color: #999; font-size: 18px; }

        footer {
            text-align: center;
            padding: 30px;
            color: #999;
            font-size: 13px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <h1>📝 My Blog</h1>
    <a href="admin/login.php">Admin Login</a>
</header>

<div class="container">
    <?php if ($result->num_rows === 0): ?>
        <div class="no-posts">No posts yet. <a href="admin/login.php">Create one!</a></div>
    <?php else: ?>
        <?php while ($post = $result->fetch_assoc()): ?>
            <div class="post-card">
                <span class="category"><?= htmlspecialchars($post['category']) ?></span>
                <h2><a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                <p><?= htmlspecialchars(substr(strip_tags($post['content']), 0, 200)) ?>...</p>
                <div class="meta">🗓 <?= date('d M Y', strtotime($post['created_at'])) ?></div>
                <a href="post.php?id=<?= $post['id'] ?>" class="read-more">Read More →</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<footer>Built with PHP + MySQL &nbsp;|&nbsp; Blog CMS</footer>

</body>
</html>
