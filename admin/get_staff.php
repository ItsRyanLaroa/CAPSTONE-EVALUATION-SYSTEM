<?php
// Database connection details
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "faculty_db";
$itemsPerPage = 6; // Number of items per page

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current page number from the URL, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Fetch data with limit and offset
$sql = "SELECT S_id, role, firstname, lastname FROM staff LIMIT $itemsPerPage OFFSET $offset";
$result = $conn->query($sql);

$staff = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $staff[] = $row;
    }
}

// Get the total number of items
$totalItemsResult = $conn->query("SELECT COUNT(*) as count FROM staff");
$totalItems = $totalItemsResult->fetch_assoc()['count'];
$totalPages = ceil($totalItems / $itemsPerPage);

$conn->close();

// Send the data back as JSON
echo json_encode(['staff' => $staff, 'totalPages' => $totalPages]);
?>
