<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Change to your MySQL username
$password = "";     // Change to your MySQL password
$dbname = "mysql"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if it doesn't exist
$tableCreationQuery = "CREATE TABLE IF NOT EXISTS bikes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    model_name VARCHAR(255) UNIQUE,
    price_inr INT,
    price_npr INT
)";

if ($conn->query($tableCreationQuery) === TRUE) {
    echo "Table 'bikes' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Data to insert
$data = [
    ["model_name" => "Dominar 400", "price_inr" => 222385, "price_npr" => 609900],
    ["model_name" => "Dominar 250", "price_inr" => 183756, "price_npr" => 559900],
    ["model_name" => "Pulsar N150", "price_inr" => 124096, "price_npr" => 359900],
    ["model_name" => "Pulsar N250", "price_inr" => 143239, "price_npr" => 457900],
    ["model_name" => "Pulsar 220", "price_inr" => 136550, "price_npr" => 405900],
    ["model_name" => "Pulsar NS 200", "price_inr" => 185000, "price_npr" => 393900],
    ["model_name" => "Pulsar N160", "price_inr" => 139795, "price_npr" => 399900],
    ["model_name" => "Pulsar 160", "price_inr" => 122790, "price_npr" => 330900],
    ["model_name" => "NS160", "price_inr" => 145621, "price_npr" => 392900],
    ["model_name" => "Pulsar 150", "price_inr" => 105802, "price_npr" => 304900],
    ["model_name" => "Pulsar 125", "price_inr" => 83245, "price_npr" => 263900],
    ["model_name" => "Discover 125", "price_inr" => 63091, "price_npr" => 244900],
    ["model_name" => "Avenger 220", "price_inr" => 136972, "price_npr" => 420900],
    ["model_name" => "Avenger 160", "price_inr" => 117079, "price_npr" => 376900],
    ["model_name" => "Platina 100", "price_inr" => 53120, "price_npr" => 208900],
];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bikes (model_name, price_inr, price_npr) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE price_inr = VALUES(price_inr), price_npr = VALUES(price_npr)");

foreach ($data as $row) {
    $stmt->bind_param("sii", $row['model_name'], $row['price_inr'], $row['price_npr']);
    $stmt->execute();
}

// Close the statement and connection
$stmt->close();
$conn->close();

echo "Data inserted successfully!";
?>
