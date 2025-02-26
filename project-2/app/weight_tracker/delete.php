<?php
$conn = new mysqli("mysql-service", "root", "password", "cardb");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$stmt = $conn->prepare("DELETE FROM entries WHERE id = ?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$stmt->close();

header("Location: index.php");
exit();
?>
