<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\User;

echo "Testing database connection...<br>";

try {
    // Test if we can connect and query
    $testUser = User::findByEmail('demo@example.com');
    
    if ($testUser) {
        echo "✅ SUCCESS: Database connected and demo user found!<br>";
        echo "Demo user: " . $testUser['name'] . " (" . $testUser['email'] . ")<br>";
    } else {
        echo "✅ SUCCESS: Database connected but no demo user found (this is ok)<br>";
    }
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "<br>";
    echo "Make sure:<br>";
    echo "1. Database 'authboard' exists<br>";
    echo "2. Tables 'users' and 'posts' are created<br>";
    echo "3. .env file has correct DB credentials<br>";
}