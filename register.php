<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Register</h1>
            <nav>
                <a href="index.html" class="nav-btn">Home</a>
                <a href="about.html" class="nav-btn">About</a>
                <a href="contact.html" class="nav-btn">Contact</a>
                <a href="login.php" class="nav-btn">Login</a>
            </nav>
        </div>
    </header>
    <main>
        <section class="form-container">
            <h2>Create Account</h2>
            <?php
            session_start();
            $csrf_token = bin2hex(random_bytes(32));
            $_SESSION['csrf_token'] = $csrf_token;
            ?> 
            <form id="register-form" action="register_submit.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <label for="role">Role:</label>
                <select id="role" name="role" required onchange="toggleAadhaar()">
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                </select>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div id="aadhaar-field" style="display: none;">
                    <label for="aadhaar">Aadhaar Number:</label>
                    <input type="text" id="aadhaar" name="aadhaar" pattern="\d{12}" placeholder="12-digit Aadhaar">
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
            <p>Already have an account? <a href="login.html">Login here</a></p>
            <a href="index.html" class="back-btn">Back to Home</a>
        </section>
    </main>
    <footer>
        <p>© 2025 IJRASET Project | Powered by xAI</p>
    </footer>
    <script>
        function toggleAadhaar() {
            const role = document.getElementById('role').value;
            const aadhaarField = document.getElementById('aadhaar-field');
            aadhaarField.style.display = role === 'User' ? 'block' : 'none';
            document.getElementById('aadhaar').required = role === 'User';
        }
    </script>
</body>
</html>