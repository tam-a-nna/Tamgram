<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Mailer;
use App\Models\User;

class AuthController extends Controller {
    public function showLogin() {
        $this->view('auth/login.php');
    }

    public function showRegister() {
        $this->view('auth/register.php');
    }

    public function register() {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email address.";
            return;
        }
        if (strlen($password) < 6) {
            echo "Password must be at least 6 characters.";
            return;
        }

        $hashed = password_hash($password, PASSWORD_BCRYPT);
        User::create($name, $email, $hashed);

        // Send welcome email (optional - comment out if not needed)
        // Mailer::send($email, 'Welcome to Tamgram', "Hello $name,\n\nThanks for registering at Tamgram.");

        header('Location: /metro_wb_lab/public/login');
        exit;
    }

    public function login() {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            Session::set('user', ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']]);
            header('Location: /metro_wb_lab/public/posts');
            return;
        }

        echo 'Invalid credentials.';
    }

    public function logout() {
        Session::destroy();
        header('Location: /metro_wb_lab/public/login');
        exit;
    }
}