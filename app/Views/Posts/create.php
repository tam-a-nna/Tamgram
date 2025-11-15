<?php
$title = 'Create Post | Tamgram';
ob_start();
?>

<div class="card">
    <div style="display: flex; align-items: center; margin-bottom: 2rem;">
        <a href="/metro_wb_lab/public/posts" class="btn btn-outline" style="margin-right: 1rem;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 style="color: var(--dark); margin: 0;">Create New Post</h1>
    </div>

    <form method="POST" action="/metro_wb_lab/public/posts/create" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label">What's on your mind?</label>
            <textarea name="content" class="form-control" rows="4" required 
                      placeholder="Share your thoughts with the community..." maxlength="255"></textarea>
            <div style="text-align: right; margin-top: 0.5rem; color: var(--gray); font-size: 0.9rem;">
                <span id="charCount">0</span>/255 characters
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Add an image (optional)</label>
            <div class="file-upload" onclick="document.getElementById('image').click()">
                <i class="fas fa-cloud-upload-alt"></i>
                <p style="color: var(--gray); margin: 0.5rem 0;">Click to upload or drag and drop</p>
                <p style="color: var(--gray-light); font-size: 0.9rem; margin: 0;">
                    JPEG, PNG, GIF, WebP • Max 5MB
                </p>
                <input type="file" name="image" id="image" class="d-none" accept="image/*">
            </div>
            <div id="fileName" style="margin-top: 0.5rem; color: var(--success); font-weight: 500;"></div>
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">
                <i class="fas fa-share"></i> Share Post
            </button>
            <a href="/metro_wb_lab/public/posts" class="btn btn-outline">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
// Simple character counter
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.querySelector('textarea[name="content"]');
    const charCount = document.getElementById('charCount');
    const fileInput = document.getElementById('image');
    const fileName = document.getElementById('fileName');
    
    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });
    }
    
    if (fileInput && fileName) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = 'Selected: ' + this.files[0].name;
            }
        });
    }
});
</script>

<?php
$content = ob_get_clean();

include __DIR__ . '/../layout.php';