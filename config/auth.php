<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/database.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

try {
    $db = DatabaseConfig::getConnection();
    $stmt = $db->prepare("SELECT password_hash FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['admin'] = true;
        $_SESSION['username'] = $username;
        header('Location: ' . url('pages/admin.php'));
    } else {
        header('Location: ' . url('?error=1'));
    }
    exit;
} catch (Exception $e) {
    header('Location: ' . url('?error=1'));
    exit;
}