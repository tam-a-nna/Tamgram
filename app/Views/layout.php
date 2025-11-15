<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Tamgram' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/metro_wb_lab/public/assets/style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">Tamgram</div>
            <?php if (!empty($_SESSION['user'])): ?>
                <div class="nav-links">
                    <a href="/metro_wb_lab/public/dashboard">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <a href="/metro_wb_lab/public/posts">
                        <i class="fas fa-stream"></i> Posts
                    </a>
                    <a href="/metro_wb_lab/public/posts/create">
                        <i class="fas fa-plus"></i> Create
                    </a>
                    <a href="/metro_wb_lab/public/logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            <?php endif; ?>
        </header>

        <main>
            <?php echo $content; ?>
        </main>
    </div>

    <script>
        // Tab switching functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
            });
        });
        
        // Like functionality
        document.querySelectorAll('.post-stat').forEach(stat => {
            if (stat.classList.contains('like-stat')) {
                stat.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const count = this.querySelector('.like-count');
                    let currentCount = parseInt(count.textContent) || 0;
                    
                    if (this.classList.contains('liked')) {
                        // Unlike
                        this.classList.remove('liked');
                        icon.className = 'far fa-heart';
                        count.textContent = Math.max(0, currentCount - 1);
                    } else {
                        // Like
                        this.classList.add('liked');
                        icon.className = 'fas fa-heart';
                        count.textContent = currentCount + 1;
                    }
                });
            }
        });
        
        // Button hover effects
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>