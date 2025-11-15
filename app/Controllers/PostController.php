<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Post;

class PostController extends Controller {
    public function showPosts() {
        $user = Session::get('user');
        if (!$user) {
            header('Location: /metro_wb_lab/public/login');
            exit;
        }

        $posts = Post::getAllWithUsers();
        $this->view('posts/posts.php', ['user' => $user, 'posts' => $posts]);
    }

    public function showCreatePost() {
        $user = Session::get('user');
        if (!$user) {
            header('Location: /metro_wb_lab/public/login');
            exit;
        }
        $this->view('posts/create.php', ['user' => $user]);
    }

    public function createPost() {
        $user = Session::get('user');
        if (!$user) {
            header('Location: /metro_wb_lab/public/login');
            exit;
        }

        $content = trim($_POST['content'] ?? '');
        $image = $_FILES['image'] ?? null;

        if (empty($content)) {
            echo "Content cannot be empty.";
            return;
        }

        $imagePath = null;
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/assets/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileType = mime_content_type($image['tmp_name']);
            
            if (!in_array($fileType, $allowedTypes)) {
                echo "Invalid file type. Only JPEG, PNG, GIF, and WebP are allowed.";
                return;
            }

            $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $fileExtension;
            $imagePath = 'assets/uploads/' . $fileName;

            if (!move_uploaded_file($image['tmp_name'], $uploadDir . $fileName)) {
                echo "Failed to upload image.";
                return;
            }
        }

        Post::create($user['id'], $content, $imagePath);
        header('Location: /metro_wb_lab/public/posts');
        exit;
    }

    public function deletePost() {
        $user = Session::get('user');
        if (!$user) {
            header('Location: /metro_wb_lab/public/login');
            exit;
        }

        $postId = $_POST['post_id'] ?? null;
        
        if (!$postId) {
            $_SESSION['error'] = 'Post ID is required';
            header('Location: /metro_wb_lab/public/posts');
            exit;
        }

        // Verify the post belongs to the current user
        $post = Post::findById($postId);
        if (!$post) {
            $_SESSION['error'] = 'Post not found';
            header('Location: /metro_wb_lab/public/posts');
            exit;
        }

        if ($post['user_id'] != $user['id']) {
            $_SESSION['error'] = 'You can only delete your own posts';
            header('Location: /metro_wb_lab/public/posts');
            exit;
        }

        // Delete the post
        $deleted = Post::delete($postId, $user['id']);
        
        if ($deleted) {
            $_SESSION['success'] = 'Post deleted successfully';
            
            // Also delete the image file if it exists
            if ($post['image']) {
                $imagePath = __DIR__ . '/../../public/' . $post['image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $_SESSION['error'] = 'Failed to delete post';
        }

        header('Location: /metro_wb_lab/public/posts');
        exit;
    }
}