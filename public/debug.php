<?php
require_once __DIR__ . '/../vendor/autoload.php';

echo "Debug Test - Checking if controllers work:<br>";

use App\Controllers\AuthController;

try {
    $controller = new AuthController();
    echo "✓ AuthController loaded successfully<br>";
    
    $controller->showRegister();
    echo "✓ showRegister() method executed<br>";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "<br>";
}