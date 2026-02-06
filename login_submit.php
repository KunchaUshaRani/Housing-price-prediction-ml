<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

// ✅ CSRF Token Check
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo "<script>alert('❌ CSRF token validation failed'); window.location.href = 'login.html';</script>";
    exit;
}

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // ✅ Store user session
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'email' => $user['email'],
            'role'  => $user['role'],
            'name'  => $user['name']
        ];

        // ✅ Redirect based on role
        if ($user['role'] === 'Admin') {
            header('Location: admin_dashboard.php');
        } else {
            header('Location: user.html');
        }
        exit;
    } else {
        echo "<script>alert('❌ Invalid email or password'); window.location.href = 'login.html';</script>";
        exit;
    }
} catch (PDOException $e) {
    $error = htmlspecialchars($e->getMessage());
    echo "<script>alert('❌ Login failed: $error'); window.location.href = 'login.php';</script>";
    exit;
}
?>
