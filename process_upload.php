<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["data_file"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["data_file"]["tmp_name"], $targetFilePath)) {
        // Run Python script for prediction
        $command = escapeshellcmd("python3 predict_from_file.py " . escapeshellarg($targetFilePath));
        $output = shell_exec($command);

        echo "<h2>Prediction Results:</h2>";
        echo "<pre>$output</pre>";
        echo "<a href='user.html' class='btn'>Back to Home</a>";
    } else {
        echo "Error uploading file.";
    }
} else {
    header("Location: upload_predict.html");
    exit;
}
?>
