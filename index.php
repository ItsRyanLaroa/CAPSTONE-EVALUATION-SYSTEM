<?php
session_start();

$servername = "localhost";
$username = "root"; // Use your database username
$password = ""; // Use your database password
$dbname = "faculty_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";
$id_error = false;
$password_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST['identifier'];
    $pass = $_POST['password'];

    $roles = ['admin', 'faculty_list', 'student'];
    $user_found = false;

    foreach ($roles as $role) {
        if ($role == 'admin' || $role == 'faculty_list') {
            $sql = "SELECT * FROM $role WHERE email = ?";
        } else { // For student
            $sql = "SELECT * FROM $role WHERE identifier = ?";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify password
            if (password_verify($pass, $row['password'])) {
                $_SESSION['identifier'] = $identifier;
                $_SESSION['role'] = $role;
                if ($role == 'faculty_list') {
                    $_SESSION['f_id'] = $row['f_id']; // Save f_id for faculty
                } elseif ($role == 'student') {
                    $_SESSION['identifier'] = $row['identifier'];
                }
                // Redirect based on role
                if ($role == 'admin') {
                    header("Location: admin/admin.php");
                } elseif ($role == 'faculty_list') {
                    header("Location: teacherDesign.php");
                } else {
                    header("Location: student/dashboard.php");
                }
                $user_found = true;
                exit;
            } else {
                $error_message = "Invalid password.";
                $password_error = true;
                $user_found = true;
                break;
            }
        }
        $stmt->close();
    }

    if (!$user_found) {
        $error_message = "No user found.";
        $id_error = true;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Faculty Evaluation</title>
    <link rel="stylesheet" href="Css/login.css" />
    <script src="../custom-scripts.js" defer></script>
    <style>
        .invalid-input {
            border: 1px solid red;
        }
        .title {
            position: relative;
            background-color: rgba(189, 169, 169, 0.5);
            height: 10vh;
            padding: 10px;
            overflow: hidden;
            color: yellow;
            border-radius: 40px 0px 40px 0;
        }

        .title a {
            color: yellow;
        }
    </style>
</head>
<body>
    <main>
        <header>
            <nav class="nav container">
                <div class="title"><h2 class="nav_logo"><a href="#">Faculty Evaluation System</a></h2></div>
                <ul class="menu_items">
                    <li><a href="index.php" class="nav_link">Login</a></li>
                    <li><a href="register.php" class="nav_link">Register</a></li>
                </ul>
                <img src="images/bars.svg" alt="timesicon" id="menu_toggle" />
            </nav>
        </header>
        <div class="logContainer">
            <form action="index.php" method="POST" class="form">
                <img class="logo" src="images/file.png" width="150px" />
                <h2>FACULTY EVALUATION SYSTEM</h2>
                <input
                    type="text"
                    name="identifier"
                    placeholder="School ID or Email"
                    class="<?= $id_error ? 'invalid-input' : '' ?>"
                />

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="<?= $password_error ? 'invalid-input' : '' ?>"
                />
                <input type="submit" class="btn" value="Log in" />
            </form>
            <div class="side">
                <img src="images/assessment1.jpg" alt="" />
            </div>
        </div>
    </main>

    <script src="javascript/login.js"></script>
</body>
</html>
