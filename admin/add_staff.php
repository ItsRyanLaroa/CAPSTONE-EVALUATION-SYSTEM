<?php
// Database connection details
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "faculty_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data and sanitize input
$role = $conn->real_escape_string($_POST['role']);
$firstname = $conn->real_escape_string($_POST['firstname']);
$lastname = $conn->real_escape_string($_POST['lastname']);
$id = $conn->real_escape_string($_POST['id']);

// Prepare SQL statement to prevent SQL injection
$sql = "INSERT INTO staff (S_id, role, firstname, lastname) VALUES ('$id', '$role', '$firstname', '$lastname')";

if ($conn->query($sql) === TRUE) {

    header("Location: staff.php");
    exit();
} else {
    // Handle error and display message
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
