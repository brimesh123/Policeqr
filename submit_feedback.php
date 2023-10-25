<?php
// Database connection details
$host = "localhost"; // Replace with your database host
$username = "id21447361_root"; // Replace with your database username
$password = "Brimesh@07"; // Replace with your database password
$database = "id21447361_feedback"; // Replace with your database name

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $city = $_POST["city"];
    $station = $_POST["station"];
    $year = $_POST["year"];
    $month = $_POST["month"];
    $feedback = $_POST["feedback"];

    // Insert the data into a MySQL table
    $sql = "INSERT INTO feedback_sys (city, station, year, month, feedback) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $city, $station, $year, $month, $feedback);

    if ($stmt->execute()) {
        $message = "Feedback submitted successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e6e9ed;
        }

        .message-container {
            background-color: #00a6eb;
            color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php echo $message; ?>
    </div>
</body>
</html>
