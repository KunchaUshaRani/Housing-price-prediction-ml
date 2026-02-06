<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

// ✅ CSRF Token Check
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo "<script>alert('❌ CSRF token validation failed'); window.history.back();</script>";
    exit;
}

$role = $_POST['role'];
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];
$aadhaar = isset($_POST['aadhaar']) ? filter_var($_POST['aadhaar'], FILTER_SANITIZE_STRING) : null;

// ✅ Validate role
if (!in_array($role, ['Admin', 'User'])) {
    echo "<script>alert('❌ Invalid role'); window.history.back();</script>";
    exit;
}

// ✅ Aadhaar check for Users only
if ($role === 'User' && (!preg_match('/^\d{12}$/', $aadhaar))) {
    echo "<script>alert('❌ Invalid Aadhaar number. It must be 12 digits.'); window.history.back();</script>";
    exit;
}

// ✅ Check password strength
if (strlen($password) < 8) {
    echo "<script>alert('❌ Password must be at least 8 characters long'); window.history.back();</script>";
    exit;
}

$password_hash = password_hash($password, PASSWORD_BCRYPT);

try {
    // ✅ Check if an admin already exists
    if ($role === 'Admin') {
        $checkAdmin = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'Admin'");
        if ($checkAdmin->fetchColumn() > 0) {
            echo "<script>alert('❌ Only one admin is allowed. Please register as a user instead.'); window.history.back();</script>";
            exit;
        }
    }

    // ✅ Check if email already registered
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        echo "<script>alert('❌ Email already registered. Please use a different email.'); window.history.back();</script>";
        exit;
    }

    // ✅ Insert the user
    $stmt = $pdo->prepare('INSERT INTO users (role, name, email, password, aadhaar) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$role, $name, $email, $password_hash, $role === 'User' ? $aadhaar : null]);

    // ✅ Show success & redirect
    $_SESSION['success_message'] = '✅ Registration successful! Please log in.';
    header('Location: login.php');
    exit;

} catch (PDOException $e) {
    $error = htmlspecialchars($e->getMessage());
    echo "<script>alert('❌ Registration failed: $error'); window.history.back();</script>";
    exit;
}
?>
