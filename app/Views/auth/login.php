<?php
$title = 'Login | Tamgram';
ob_start();
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <i class="fas fa-camera"></i> Tamgram
        </div>
        <p class="auth-subtitle">Sign in to your account to continue</p>
        
        <form method="POST" action="/metro_wb_lab/public/login">
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 1.5rem;">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
            
            <div style="text-align: center;">
                <p style="color: var(--gray); margin: 0;">
                    Don't have an account? 
                    <a href="/metro_wb_lab/public/register" style="color: var(--primary); text-decoration: none; font-weight: 600;">
                        Register here
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

include __DIR__ . '/../layout.php';