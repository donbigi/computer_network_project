<?php
$conn = new mysqli("mysql-service", "root", "password", "cardb");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Create table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    weight DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$stmt = $conn->prepare("INSERT INTO entries (weight) VALUES (?)");
$stmt->bind_param("d", $_POST['weight']); // 'd' for decimal (float/double)
$stmt->execute();
$stmt->close();

header("Location: index.php");
exit();
?>
