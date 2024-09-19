<?php
// Database connection variables
$serverName = "localhost"; // or your SQL Server instance name
$username = "your_sql_username";
$password = "your_sql_password";
$dbName = "your_database_name";

// Create connection to SQL Server
$conn = new mysqli($serverName, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO Users (Name, Email, Password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
