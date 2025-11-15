<?php
$title = 'Register | Tamgram';
ob_start();
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <i class="fas fa-camera"></i> Tamgram
        </div>
        <p class="auth-subtitle">Create your account to get started</p>
        
        <form method="POST" action="/metro_wb_lab/public/register">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Create a password (min. 6 characters)" required minlength="6">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 1.5rem;">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
            
            <div style="text-align: center;">
                <p style="color: var(--gray); margin: 0;">
                    Already have an account? 
                    <a href="/metro_wb_lab/public/login" style="color: var(--primary); text-decoration: none; font-weight: 600;">
                        Login here
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

include __DIR__ . '/../layout.php';