<?php
session_start();
require 'db_connect.php';

// Check if user is logged in as admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
}

$adminName = $_SESSION['user']['name'];

// Fetch user data from the users table
$stmt_users = $pdo->query("SELECT id, name, email, role, aadhaar, created_at FROM users");
$users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

// Fetch home price prediction data
$stmt_predictions = $pdo->query("SELECT id, location, area, bedrooms, schools, crime, distance_to_city_center, year_built, garage, predicted_price, predicted_at FROM predictions");


$predictions = $stmt_predictions->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Welcome, Admin - <?php echo htmlspecialchars($adminName); ?></h1>
            <nav>
                <a href="index.html" class="nav-btn">Home</a>
                <a href="logout.php" class="nav-btn">Logout</a>
            </nav>
        </div>
    </header>
    
    <main>
        <section class="dashboard-section">
            <h2>Registered Users</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aadhaar</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['role']); ?></td>
                                <td><?php echo htmlspecialchars($user['aadhaar']); ?></td>
                                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
         
            <div class="table-container">     
                <h2>Home Price Prediction Records</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Location</th>
                            <th>Area (sqft)</th>
                            <th>Bedrooms</th>
                            <th>Schools</th>
                            <th>Crime Level</th>
                            <th>Distance to City Center</th>
                            <th>Year Built</th>
                            <th>Garage</th>
                            <th>Predicted Price</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($predictions as $prediction): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($prediction['id']); ?></td>
                                <td><?php echo htmlspecialchars($prediction['location']); ?></td>
                                <td><?php echo htmlspecialchars($prediction['area']); ?></td>
                                <td><?php echo htmlspecialchars($prediction['bedrooms']); ?></td>
                                <td><?php echo htmlspecialchars($prediction['schools']); ?></td>
                                <td><?php echo htmlspecialchars($prediction['crime']); ?></td>
                                <td><?php echo htmlspecialchars($prediction['distance_to_city_center']); ?></td>
                                <td><?php echo htmlspecialchars($prediction['year_built']); ?></td>
                                <td><?php echo htmlspecialchars($prediction['garage']); ?></td>
                                <td><?php echo htmlspecialchars($prediction['predicted_price']); ?></td>
                                <!-- Ensure 'predicted_at' column exists in the database -->
                                <td><?php echo htmlspecialchars($prediction['predicted_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    
    <footer>
        <p>© 2025 Home Price Prediction | Powered by xAI</p>
    </footer>
</body>
</html>
