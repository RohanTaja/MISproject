<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from the 'bikes' table
$sql = "SELECT model_name, price_inr, price_npr FROM bikes";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    // Fetch rows
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Output JSON
echo json_encode($data);

// Close connection
$conn->close();
?>
