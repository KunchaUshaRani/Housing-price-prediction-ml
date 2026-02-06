<?php
session_start();
header('Content-Type: application/json');

// Check session properly — don't send a redirect, return a JSON error
if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

// DB config
$host = 'localhost';
$dbname = 'house_price_prediction';
$username = 'root';
$password = 'root';

// Connect to database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'DB connection failed']);
    exit;
}

// Validate POST inputs
$required = ['location', 'area', 'bedrooms', 'schools', 'crime', 'distance', 'year', 'garage'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['status' => 'error', 'message' => "Missing field: $field"]);
        exit;
    }
}

// Collect POST values
$location = $_POST['location'];
$area = (int)$_POST['area'];
$bedrooms = (int)$_POST['bedrooms'];
$schools = $_POST['schools'];
$crime = $_POST['crime'];
$distance = (float)$_POST['distance'];
$year = (int)$_POST['year'];
$garage = $_POST['garage'];

try {
    // Simple prediction logic
    $base_price = 50000000;
    $price = $base_price + ($area * 500) + ($bedrooms * 100000);

    if ($location === "Urban") $price += 200000;
    elseif ($location === "Suburban") $price += 100000;

    if ($schools === "High") $price += 1500000;
    elseif ($schools === "Medium") $price += 800000;

    if ($crime === "High") $price -= 1000000;
    if ($garage === "Yes") $price += 1000000;

    $price -= ($distance * 10000);
    $price -= ((2025 - $year) * 20000);

    $predicted_price = round($price, 2);

    // Store in database
    $stmt = $conn->prepare("INSERT INTO predictions (location, area, bedrooms, schools, crime, distance_to_city_center, year_built, garage, predicted_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siisssisd", $location, $area, $bedrooms, $schools, $crime, $distance, $year, $garage, $predicted_price);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'price' => $predicted_price]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Insert failed: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()]);
}
?>
