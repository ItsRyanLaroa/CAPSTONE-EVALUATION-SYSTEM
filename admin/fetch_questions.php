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

// Query to fetch criteria and their associated questions
$sql = "SELECT id, criteria, GROUP_CONCAT(question ORDER BY id SEPARATOR '||') as questions FROM questions GROUP BY criteria";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="criteria-group">';
        echo "<h4>{$row['criteria']}</h4>";
        
        // Split the concatenated questions
        $questions = explode('||', $row['questions']);
        foreach ($questions as $index => $question) {
            echo '<div class="form-group">';
            echo "<label>{$question}</label>";
            echo '<div class="radio-group">';
            for ($i = 1; $i <= 5; $i++) {
                echo '<label>';
                echo "<input type=\"radio\" name=\"{$row['criteria']}-rating-{$question}\" value=\"$i\" required> $i";
                echo '</label>';
            }
            echo '<div class="action-buttons">';
            echo '<button class="edit-btn" onclick="openEditModal(' . $row['id'] . ', \'' . addslashes($row['criteria']) . '\', \'' . addslashes($question) . '\')"><i class="fas fa-edit"></i></button>';
            echo '<form method="post" action="delete_question.php" style="display:inline;">';
            echo '<input type="hidden" name="question_id" value="' . $row['id'] . '">';
            echo '<button class="delete-btn" type="submit"><i class="fas fa-trash-alt"></i></button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
    }
} else {
    echo "No questions found.";
}

$conn->close();
?>
