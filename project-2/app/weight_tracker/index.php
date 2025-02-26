<!DOCTYPE html>
<html>
<head>
    <title>Weight Log</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Log Weight</h1>
    <form action="save.php" method="post">
        Weight (Pounds): <input type="number" name="weight" required><br><br>
        <input type="submit" value="Save">
    </form>

    <h2>Previous Entries</h2>
    <?php
    $conn = new mysqli("mysql-service", "root", "password", "cardb");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    
    $result = $conn->query("SELECT * FROM entries ORDER BY created_at DESC");
    
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Weight (Pounds)</th><th>Date</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['weight']}</td>
                <td>{$row['created_at']}</td>
                <td><a href='delete.php?id={$row['id']}'>Delete</a></td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No entries found</p>";
    }
    $conn->close();
    ?>
</body>
</html>
