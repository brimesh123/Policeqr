<?php
// Database connection detailsini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$host = "sql209.infinityfree.com";
$username = "if0_35299397";
$password = "Brimesh@07";
$database = "if0_35299397_feedback";

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Base SQL query
$sql = "SELECT * FROM feedback_sys";

// Filter conditions array
$conditions = [];
$params = [];
$types = "";




// Check for city filter
if (isset($_GET['city']) && !empty($_GET['city'])) {
    $conditions[] = "city = ?";
    $params[] = $_GET['city'];
    $types .= "s";
}

// Check for station filter
if (isset($_GET['station']) && !empty($_GET['station'])) {
    $conditions[] = "station = ?";
    $params[] = $_GET['station'];
    $types .= "s";
}

// Check for year filter
if (isset($_GET['year']) && !empty($_GET['year'])) {
    $conditions[] = "year = ?";
    $params[] = $_GET['year'];
    $types .= "s";
}

// Check for month filter
if (isset($_GET['month']) && !empty($_GET['month'])) {
    $conditions[] = "month = ?";
    $params[] = $_GET['month'];
    $types .= "s";
}

// Append conditions to SQL query
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $conn->prepare($sql);
if ($types !== "") {
    $stmt->bind_param($types, ...$params);
}

// Execute the prepared statement
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to store feedback data
$feedbackData = [];

while ($row = $result->fetch_assoc()) {
    $feedbackData[] = $row;
}

// Close the database connection
$conn->close();

// Return the feedback data as JSON
header('Content-Type: application/json');
echo json_encode($feedbackData);
?>
