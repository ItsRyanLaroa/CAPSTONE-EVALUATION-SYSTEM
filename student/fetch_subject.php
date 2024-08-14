<?php
// Fetch data from the database
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

if (isset($_POST['T_id'])) {
    $teacher_id = $_POST['T_id'];

    // Prepare and execute SQL query to fetch subjects
    $sql = "SELECT subject_id, subject_name FROM subjects WHERE T_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $subjects = array();
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }

    // Return the subjects as a JSON response
    echo json_encode($subjects);
}

$conn->close();
?>
