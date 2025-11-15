<?php
$title = 'Posts | Tamgram';
ob_start();

if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h1 style="color: var(--dark);">Community Posts</h1>
    <a href="/metro_wb_lab/public/posts/create" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Post
    </a>
</div>

<div class="posts-grid">
    <?php if (empty($posts)): ?>
        <div class="card" style="text-align: center; padding: 40px;">
            <i class="fas fa-camera" style="font-size: 3rem; color: var(--secondary); margin-bottom: 15px;"></i>
            <h3 style="color: var(--dark); margin-bottom: 10px;">No Posts Yet</h3>
            <p style="color: var(--secondary); margin-bottom: 20px;">Be the first to share something with the community!</p>
            <a href="/metro_wb_lab/public/posts/create" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Create First Post
            </a>
        </div>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <div class="post-header">
                    <div class="post-avatar">
                        <?= strtoupper(substr($post['user_name'], 0, 1)) ?>
                    </div>
                    <div class="post-user"><?= htmlspecialchars($post['user_name']) ?></div>
                    <div class="post-time"><?= date('M j, Y g:i A', strtotime($post['created_at'])) ?></div>
                    
                    <?php if ($post['user_id'] == ($_SESSION['user']['id'] ?? null)): ?>
                        <div class="dropdown">
                            <button class="btn" style="background: none; border: none; color: var(--secondary); padding: 5px;">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-content">
                                <form method="POST" action="/metro_wb_lab/public/posts/delete">
                                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">
                                        <i class="fas fa-trash"></i> Delete Post
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="post-content">
                    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    
                    <?php if ($post['image']): ?>
                        <div class="post-image">
                            <img src="/metro_wb_lab/public/<?= htmlspecialchars($post['image']) ?>" alt="Post image">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="post-stats">
                    <div class="post-stat like-stat">
                        <i class="far fa-heart"></i>
                        <span class="like-count">0</span>
                    </div>
                    <div class="post-stat">
                        <i class="far fa-comment"></i>
                        <span class="comment-count">0</span>
                    </div>
                    <div class="post-stat">
                        <i class="far fa-share-square"></i>
                        <span>Share</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';