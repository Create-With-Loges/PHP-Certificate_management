<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college_event";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    $conn->select_db($dbname);
} else {
    die("Error creating database: " . $conn->error);
}

// Function to sanitize input
function sanitize($conn, $input) {
    return htmlspecialchars(strip_tags(trim($conn->real_escape_string($input))));
}
?>
