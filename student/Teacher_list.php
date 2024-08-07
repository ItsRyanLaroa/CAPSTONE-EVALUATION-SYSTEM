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

// Start building the dropdown
echo "<select name='teacher' class='dropdown' id='teacher-dropdown'>";

// Add a placeholder option
echo "<option value='' disabled selected>Select a teacher</option>";

$sql = "SELECT T_id, firstname, lastname FROM teachers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Format each option with teacher's ID and full name
        echo "<option value='" . $row["T_id"] . "'>" . $row["lastname"] . ", " . $row["firstname"] . "</option>";
    }
} else {
    echo "<option value=''>No teachers available</option>";
}

// End the dropdown
echo "</select>";

$conn->close();
?>
