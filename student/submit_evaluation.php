<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faculty_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$student_id = isset($_POST['student_id']) ? intval($_POST['student_id']) : 1;
$student_name = isset($_POST['student_name']) ? $_POST['student_name'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';
$teacher_id = isset($_POST['teacher-dropdown']) ? intval($_POST['teacher-dropdown']) : 0;
$subject_id = isset($_POST['subject-dropdown']) ? intval($_POST['subject-dropdown']) : 0;
$comments = isset($_POST['comments']) ? $_POST['comments'] : '';

echo "Teacher ID: " . $teacher_id . "<br>";
echo "Subject ID: " . $subject_id . "<br>";

// Check if teacher and subject exist in the database
$teacher_check = $conn->prepare("SELECT T_id FROM teachers WHERE T_id = ?");
$teacher_check->bind_param("i", $teacher_id);
$teacher_check->execute();
$teacher_check->store_result();

$subject_check = $conn->prepare("SELECT subject_id FROM subjects WHERE subject_id = ?");
$subject_check->bind_param("i", $subject_id);
$subject_check->execute();
$subject_check->store_result();

if ($teacher_check->num_rows == 0) {
    die("Error: Teacher ID does not exist.");
}

if ($subject_check->num_rows == 0) {
    die("Error: Subject ID does not exist.");
}

// Prepare SQL for inserting ratings
$stmt = $conn->prepare("INSERT INTO evaluations (student_id, student_name, department, T_id, subject_id, comments, ratings) VALUES (?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

foreach ($_POST as $key => $value) {
    if (preg_match('/(.+)-rating-(.+)/', $key, $matches)) {
        $rating = intval($value);

        // Bind parameters and execute statement
        $stmt->bind_param("isisisi", $student_id, $student_name, $department, $teacher_id, $subject_id, $comments, $rating);
        $stmt->execute();

        if ($stmt->error) {
            die("Execute failed: " . $stmt->error);
        }
    }
}

$stmt->close();
$conn->close();

echo "Evaluation submitted successfully.";
?>
