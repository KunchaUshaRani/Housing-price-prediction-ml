<!DOCTYPE html>
<html>
<head>
    <title>Available Homes for Sale</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .header-container {
            width: 90%;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .nav-btn {
            margin-left: 20px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav .nav-btn:hover {
            color: #ffd700;
        }

        .main-container {
            flex: 1;
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .homes-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
        }

        .home-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: 0.3s ease;
        }

        .home-card:hover {
            transform: translateY(-5px);
        }

        .home-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .home-details {
            padding: 15px;
        }

        .home-details h3 {
            margin: 0 0 10px;
            color: #222;
        }

        .info {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .price {
            font-size: 20px;
            color: #007BFF;
            font-weight: bold;
        }

        footer {
            background-color: #222;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            font-size: 14px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <h2 style="margin: 0;">Contact Us</h2>
            <nav>
                <a href="index.html" class="nav-btn">Home</a>
                <a href="about.html" class="nav-btn">About Us</a>
                <a href="login.php" class="nav-btn">Login</a>
                <a href="register.php" class="nav-btn">Register</a>
            </nav>
        </div>
    </header>

    <div class="main-container">
        <h1>🏠 Homes Available for Sale</h1>

        <div class="homes-container">
            <!-- Home 1 -->
            <div class="home-card">
                <img src="img/high.avif" alt="Home 1">
                <div class="home-details">
                    <h3>Tirupati - Srikalahasti Road — 1350 sq ft</h3>
                    <p class="info">
                        🛏️ 3 BHK |
                        🏫 Nearby Schools: Yes |
                        🚨 Crime Rate: Low<br>
                        🛣️ 4.2 km to City Center |
                        🛠️ Built in 2019 |
                        🚗 Garage: Yes
                    </p>
                    <p class="price">₹47,90,000</p>
                </div>
            </div>

            <!-- Home 2 -->
            <div class="home-card">
                <img src="img/high.avif" alt="Home 2">
                <div class="home-details">
                    <h3>Renigunta Road — 980 sq ft</h3>
                    <p class="info">
                        🛏️ 2 BHK |
                        🏫 Nearby Schools: Yes |
                        🚨 Crime Rate: Moderate<br>
                        🛣️ 3.0 km to City Center |
                        🛠️ Built in 2015 |
                        🚗 Garage: No
                    </p>
                    <p class="price">₹34,90,000</p>
                </div>
            </div>

            <!-- Home 3 -->
            <div class="home-card">
                <img src="img/high.avif" alt="Home 3">
                <div class="home-details">
                    <h3>SVU Layout — 1750 sq ft</h3>
                    <p class="info">
                        🛏️ 4 BHK |
                        🏫 Nearby Schools: Yes |
                        🚨 Crime Rate: Very Low<br>
                        🛣️ 2.5 km to City Center |
                        🛠️ Built in 2022 |
                        🚗 Garage: Yes
                    </p>
                    <p class="price">₹65,90,000</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 IJRASET Project | Powered by xAI | All Rights Reserved.</p>
    </footer>
</body>
</html>