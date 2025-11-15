<?php
$title = 'Profile | Tamgram';
ob_start();
?>

<div class="user-info">
    <div class="avatar" style="background: linear-gradient(135deg, var(--primary), var(--accent)); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: 600;">
        <?= strtoupper(substr($user['name'], 0, 1)) ?>
    </div>
    <div class="user-details">
        <div class="username"><?= htmlspecialchars($user['name']) ?></div>
        <div class="handle"><?= htmlspecialchars($user['email']) ?></div>
        <div class="stats">
            <div class="stat">
                <div class="stat-value">0</div>
                <div class="stat-label">Posts</div>
            </div>
            <div class="stat">
                <div class="stat-value">0</div>
                <div class="stat-label">Followers</div>
            </div>
            <div class="stat">
                <div class="stat-value">0</div>
                <div class="stat-label">Following</div>
            </div>
        </div>
    </div>
</div>

<div class="tabs">
    <div class="tab active">Posts</div>
    <div class="tab">Media</div>
    <div class="tab">Likes</div>
    <div class="tab">About</div>
</div>

<div class="card">
    <div style="text-align: center; padding: 20px;">
        <h3 style="margin-bottom: 15px; color: var(--dark);">Welcome to Tamgram</h3>
        <p style="color: var(--secondary); margin-bottom: 20px;">Share your moments with the world</p>
        
        <div style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
            <a href="/metro_wb_lab/public/posts/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create Post
            </a>
            <a href="/metro_wb_lab/public/posts" class="btn btn-outline">
                <i class="fas fa-stream"></i> View Posts
            </a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';