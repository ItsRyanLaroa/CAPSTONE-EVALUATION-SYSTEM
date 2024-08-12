<?php
$servername = "localhost";
$username = "root"; // Adjust if different
$password = ""; // Adjust if a password is set
$dbname = "faculty_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the selected criteria text
    $criteria = $_POST['criteria'];
    $questions = $_POST['questions'];

    // Ensure that both criteria and questions are provided
    if (!empty($criteria) && !empty($questions)) {
        // Split the questions by new line and remove empty lines
        $questionsArray = array_filter(array_map('trim', explode("\n", $questions)));

        // Prepare the insert statement
        $stmt = $conn->prepare("INSERT INTO questions (criteria, question) VALUES (?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("ss", $criteria, $question);

        // Execute insert statements for each question
        foreach ($questionsArray as $question) {
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();

    // Redirect to questionnaire.php (or another appropriate page)
    header("Location: questionnaire.php");
    exit;
} else {
    die("Invalid request method or missing data.");
}
?>
