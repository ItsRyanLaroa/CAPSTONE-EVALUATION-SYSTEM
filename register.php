<?php
$id_error = false;
$email_error = false;
$phone_error = false;
$password_error = false;
$confirm_password_error = false;
$errors = [];
$registration_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $id = $_POST['identifier'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation logic
    if (empty($id)) {
        $id_error = true;
        $errors['identifier'] = "School ID is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = true;
        $errors['email'] = "Invalid email format.";
    }
    if (empty($phone)) {
        $phone_error = true;
        $errors['phone'] = "Phone number is required.";
    }
    if (empty($password) || strlen($password) < 6) {
        $password_error = true;
        $errors['password'] = "Password must be at least 6 characters.";
    }
    if ($password !== $confirm_password) {
        $confirm_password_error = true;
        $errors['confirm_password'] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // Database connection
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

        $sql = "INSERT INTO student (name, identifier, email, phone, dob, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("sssssss", $name, $id, $email, $phone, $dob, $gender, $hashed_password);

        if ($stmt->execute()) {
            $registration_success = true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="Css/registration.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <style>
        .invalid-input {
            border: 1px solid red;
        }
        .error-message {
            color: red;
            font-size: 0.8em;
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
        body {
            background: #e3f2fd;
        }
        button {
            font-size: 18px;
            font-weight: 400;
            color: #fff;
            padding: 14px 22px;
            border: none;
            background: #4070f4;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #265df2;
        }
        button.show-modal,
        .modal-box {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        .overlay {
            position: fixed;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .overlay.active {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 380px;
            width: 100%;
            padding: 30px 20px;
            border-radius: 24px;
            background-color: #fff;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            transform: translate(-50%, -50%) scale(1.2);
        }
        .modal-box.active {
            opacity: 1;
            pointer-events: auto;
            transform: translate(-50%, -50%) scale(1);
        }
        .modal-box i {
            font-size: 70px;
            color: #75d479;
        }
        .modal-box h2 {
            margin-top: 20px;
            font-size: 25px;
            font-weight: 500;
            color: #333;
        }
        .modal-box h3 {
            font-size: 16px;
            font-weight: 400;
            color: #333;
            text-align: center;
        }
        .modal-box .buttons {
            margin-top: 25px;
        }
        .modal-box button {
            font-size: 14px;
            padding: 6px 12px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <main>
        <header>
            <nav class="nav container">
                <div class="title">
                    <h2 class="nav_logo"><a href="#">Faculty Evaluation System</a></h2>
                </div>
                <ul class="menu_items">
                    <li><a href="index.php" class="nav_link">Login</a></li>
                    <li><a href="register.php" class="nav_link">Register</a></li>
                </ul>
                <img src="images/bars.svg" alt="timesicon" id="menu_toggle" />
            </nav>
        </header>
        <div class="regContainer">
            <form action="register.php" method="post" class="form">
                <h2>Registration</h2>
                <div class="user-details">
                    <div class="input-field">
                        <span class="details">Full Name</span>
                        <input type="text" name="name" placeholder="Enter your name" required />
                    </div>
                    <div class="input-field">
                        <span class="details">School Id</span>
                        <input type="text" name="identifier" placeholder="School ID" class="<?= $id_error ? 'invalid-input' : '' ?>" required />
                        <?php if ($id_error): ?>
                        <span class="error-message">School ID is required.</span>
                        <?php endif; ?>
                    </div>
                    <div class="input-field">
                        <span class="details">Email</span>
                        <input type="text" name="email" placeholder="Enter your email" class="<?= $email_error ? 'invalid-input' : '' ?>" required />
                        <?php if ($email_error): ?>
                        <span class="error-message">Invalid email format.</span>
                        <?php endif; ?>
                    </div>
                    <div class="input-field">
                        <span class="details">Phone Number</span>
                        <input type="text" name="phone" placeholder="Enter your phone number" class="<?= $phone_error ? 'invalid-input' : '' ?>" required />
                        <?php if ($phone_error): ?>
                        <span class="error-message">Phone number is required.</span>
                        <?php endif; ?>
                    </div>
                    <div class="input-field">
                        <span class="details">Date of Birth</span>
                        <input type="date" name="dob" placeholder="Enter your birthday" required />
                    </div>
                    <div class="input-field">
                        <label>Gender</label>
                        <select name="gender" required>
                            <option disabled selected>Select gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Others</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter your password" class="<?= $password_error ? 'invalid-input' : '' ?>" required />
                        <?php if ($password_error): ?>
                        <span class="error-message">Password must be at least 6 characters.</span>
                        <?php endif; ?>
                    </div>
                    <div class="input-field">
                        <span class="details">Confirm Password</span>
                        <input type="password" name="confirm_password" placeholder="Confirm your password" class="<?= $confirm_password_error ? 'invalid-input' : '' ?>" required />
                        <?php if ($confirm_password_error): ?>
                        <span class="error-message">Passwords do not match.</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Register" />
                </div>
            </form>
        </div>
        <?php if ($registration_success): ?>    
        <div class="modal-box active">
            <i class="fa-regular fa-circle-check"></i>
            <h2>Completed</h2>
            <h3>You have successfully registered.</h3>
            <div class="buttons">
                <button class="close-btn">Ok, Close</button>
            </div>
        </div>
        <?php endif; ?>
    </main>
    <script>
        const overlay = document.querySelector(".overlay"),
            closeBtn = document.querySelector(".close-btn"),
            modalBox = document.querySelector(".modal-box");

        if (modalBox) {
            overlay.addEventListener("click", () => {
                overlay.classList.remove("active");
                modalBox.classList.remove("active");
            });
            closeBtn.addEventListener("click", () => {
                overlay.classList.remove("active");
                modalBox.classList.remove("active");
            });
        }
    </script>
</body>
</html>

