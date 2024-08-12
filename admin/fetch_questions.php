<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "faculty_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$limit = 4;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

$sql = "SELECT criteria, COUNT(*) as total 
        FROM questions 
        GROUP BY criteria";
$criteriaResult = $conn->query($sql);

if ($criteriaResult->num_rows > 0) {
    while ($criteriaRow = $criteriaResult->fetch_assoc()) {
        $criteria = $criteriaRow['criteria'];
        $totalQuestions = $criteriaRow['total'];

        // Fetch paginated questions for this criteria
        $questionsSql = "SELECT id, question 
                         FROM questions 
                         WHERE criteria = '$criteria' 
                         LIMIT $limit OFFSET $offset";
        $questionsResult = $conn->query($questionsSql);

        if ($questionsResult->num_rows > 0) {
            echo '<div class="criteria-group">';
            echo "<h4>$criteria</h4>";

            while ($questionRow = $questionsResult->fetch_assoc()) {
                $question = $questionRow['question'];
                $questionId = $questionRow['id'];

                echo '<div class="form-group">';
                echo "<label>{$question}</label>";
                echo '<div class="radio-group">';
                for ($i = 1; $i <= 5; $i++) {
                    echo '<label>';
                    echo "<input type=\"radio\" name=\"{$criteria}-rating-{$question}\" value=\"$i\" required> $i";
                    echo '</label>';
                }
                echo '<div class="action-buttons">';
                echo '<button class="edit-btn" onclick="openEditModal(' . $questionId . ', \'' . addslashes($criteria) . '\', \'' . addslashes($question) . '\')"><i class="fas fa-edit"></i></button>';
                echo '<form method="post" action="delete_question.php" style="display:inline;">';
                echo '<input type="hidden" name="question_id" value="' . $questionId . '">';
                echo '<button class="delete-btn" type="submit"><i class="fas fa-trash-alt"></i></button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';

            // Pagination controls for each criteria group
            echo '<div class="pagination">';
            if ($offset > 0) {
                echo '<a href="?offset=' . max(0, $offset - $limit) . '">&laquo; Previous</a>';
            }
            if ($offset + $limit < $totalQuestions) {
                echo '<a href="?offset=' . ($offset + $limit) . '">Next &raquo;</a>';
            }
            echo '</div>';
        } else {
            echo "<p>No questions found for $criteria.</p>";
        }
    }
} else {
    echo "No criteria found.";
}

$conn->close();
?>
