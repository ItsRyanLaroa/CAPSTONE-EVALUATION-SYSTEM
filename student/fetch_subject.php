<?php
// Database connection
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

// Get the teacher ID from the request
$teacher_id = isset($_GET['T_id']) ? intval($_GET['T_id']) : 0;

// Prepare the SQL statement to fetch subjects
$sql = "SELECT subject_name FROM subjects WHERE T_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the subjects and encode them as JSON
$subjects = array();
while ($row = $result->fetch_assoc()) {
    $subjects[] = $row['subject_name'];
}

echo json_encode($subjects);

$stmt->close();
$conn->close();
?>


