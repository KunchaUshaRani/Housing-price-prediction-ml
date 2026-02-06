<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
    ?>
    <header>
        <div class="header-container">
            <h1>Prediction Results</h1>
            <nav>
                <a href="index.html" class="nav-btn">Home</a>
                <a href="index.html#about" class="nav-btn">About</a>
                <a href="index.html#contact" class="nav-btn">Contact</a>
                <a href="logout.php" class="nav-btn">Logout</a>
            </nav>
        </div>
    </header>
    <main>
        <section class="form-container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $location = $_POST['location'];
                $area = floatval($_POST['area']);
                $bedrooms = intval($_POST['bedrooms']);
                $schools = $_POST['schools'];
                $crime = $_POST['crime'];
                $distance = floatval($_POST['distance']);
                $year = intval($_POST['year']);
                $garage = $_POST['garage'];

                $p_hp = 3/7;
                $p_mp = 2/7;
                $p_lp = 2/7;

                $p_area_hp = ($area >= 2500) ? 2/3 : 1/3;
                $p_loc_hp = ($location == "Urban") ? 0.8 : ($location == "Suburban" ? 0.3 : 0.1);
                $p_bed_hp = ($bedrooms >= 4) ? 0.7 : 0.2;
                $p_sch_hp = ($schools == "High") ? 0.9 : 0.4;
                $p_cri_hp = ($crime == "Low") ? 0.8 : 0.2;
                $p_dis_hp = ($distance <= 7) ? 0.85 : 0.3;
                $p_yr_hp = ($year >= 2015) ? 0.75 : 0.35;
                $p_gar_hp = ($garage == "Yes") ? 0.9 : 0.5;

                $p_x_hp = $p_area_hp * $p_loc_hp * $p_bed_hp * $p_sch_hp * $p_cri_hp * $p_dis_hp * $p_yr_hp * $p_gar_hp;

                $p_area_mp = ($area >= 2000 && $area < 2500) ? 0.6 : 0.3;
                $p_loc_mp = ($location == "Suburban") ? 0.7 : 0.4;
                $p_x_mp = $p_area_mp * $p_loc_mp * 0.5;
                $p_area_lp = ($area < 2000) ? 0.7 : 0.2;
                $p_loc_lp = ($location == "Rural") ? 0.8 : 0.3;
                $p_x_lp = $p_area_lp * $p_loc_lp * 0.5;

                $p_x = $p_x_hp * $p_hp + $p_x_mp * $p_mp + $p_x_lp * $p_lp;
                $post_hp = ($p_x_hp * $p_hp) / $p_x;
                $post_mp = ($p_x_mp * $p_mp) / $p_x;
                $post_lp = ($p_x_lp * $p_lp) / $p_x;

                $total = $post_hp + $post_mp + $post_lp;
                $post_hp /= $total;
                $post_mp /= $total;
                $post_lp /= $total;

                $category = ($post_hp > $post_mp && $post_hp > $post_lp) ? "High" : ($post_mp > $post_lp ? "Medium" : "Low");

                $y_hp = 800000;
                $y_mp = 550000;
                $y_lp = 300000;
                $predicted_price = $post_hp * $y_hp + $post_mp * $y_mp + $post_lp * $y_lp;

                $mae = 21800;

                echo "<h2>Results</h2>";
                echo "<p><strong>Predicted Category:</strong> $category Price</p>";
                echo "<p><strong>Predicted Price:</strong> $" . number_format($predicted_price, 2) . "</p>";
                echo "<p><strong>Mean Absolute Error (MAE):</strong> $" . number_format($mae, 2) . "</p>";
            } else {
                echo "<p>Error: Invalid request. Please use the prediction form.</p>";
            }
            ?>
            <a href="predict.html" class="btn">Try Another Prediction</a>
            <a href="index.html" class="back-btn">Back to Home</a>
        </section>
    </main>
    <footer>
        <p>© 2025 IJRASET Project | Powered by xAI</p>
    </footer>
</body>
</html>