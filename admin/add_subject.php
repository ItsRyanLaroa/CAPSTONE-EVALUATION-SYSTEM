<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject_name = $_POST['subject_name'];
    $T_id = $_POST['T_id']; // This is the teacher's ID

    $sql = "INSERT INTO subjects (subject_name, T_id) VALUES ('$subject_name', '$T_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Subject added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
