<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Login</h1>
            <nav>
                <a href="index.html" class="nav-btn">Home</a>
                <a href="about.html" class="nav-btn">About</a>
                <a href="contact.html" class="nav-btn">Contact</a>
                <a href="register.php" class="nav-btn">Register</a>
            </nav>
        </div>
    </header>
    <main>
        <section class="form-container">
            <h2>Sign In</h2>
            <?php
            session_start();
            $csrf_token = bin2hex(random_bytes(32));
            $_SESSION['csrf_token'] = $csrf_token;
            ?>
            <form action="login_submit.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="btn">Login</button>
            </form>
            <p>Don't have an account? <a href="register.html">Register here</a></p>
            <a href="index.html" class="back-btn">Back to Home</a>
        </section>
    </main>
    <footer>
        <p>© 2025 IJRASET Project | Powered by xAI</p>
    </footer>
</body>
</html>