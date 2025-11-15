<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Core\Session;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\PostController;

// Start session
Session::start();

// Create router
$router = new Router();

// Define all routes WITH THE FULL PATH
$router->get('/metro_wb_lab/public/', function() {
    if (Session::get('user')) {
        header('Location: /metro_wb_lab/public/posts');
    } else {
        header('Location: /metro_wb_lab/public/login');
    }
    exit;
});

// Auth routes
$router->get('/metro_wb_lab/public/register', function() {
    $controller = new AuthController();
    $controller->showRegister();
});

$router->get('/metro_wb_lab/public/login', function() {
    $controller = new AuthController();
    $controller->showLogin();
});

$router->post('/metro_wb_lab/public/register', function() {
    $controller = new AuthController();
    $controller->register();
});

$router->post('/metro_wb_lab/public/login', function() {
    $controller = new AuthController();
    $controller->login();
});

$router->get('/metro_wb_lab/public/logout', function() {
    $controller = new AuthController();
    $controller->logout();
});

// Dashboard
$router->get('/metro_wb_lab/public/dashboard', function() {
    $controller = new DashboardController();
    $controller->index();
});

// Post routes
$router->get('/metro_wb_lab/public/posts', function() {
    $controller = new PostController();
    $controller->showPosts();
});

$router->get('/metro_wb_lab/public/posts/create', function() {
    $controller = new PostController();
    $controller->showCreatePost();
});

$router->post('/metro_wb_lab/public/posts/create', function() {
    $controller = new PostController();
    $controller->createPost();
});

$router->post('/metro_wb_lab/public/posts/delete', function() {
    $controller = new PostController();
    $controller->deletePost();
});

// Dispatch request
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);