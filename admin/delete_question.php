<?php
$servername = "localhost";
$username = "root"; // Change this if your MySQL user is different
$password = ""; // Change this if you have a MySQL password
$dbname = "faculty_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = $_POST['question_id'];

    // Delete query
    $sql = "DELETE FROM questions WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $question_id);

    if ($stmt->execute()) {
        // Redirect or return success message
        header("Location: questionnaire.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
