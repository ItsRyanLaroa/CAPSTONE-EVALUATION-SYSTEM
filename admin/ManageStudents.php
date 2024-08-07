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
    <title>Document</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
       .view{
            display: inline-block;
            border-radius: 7px;
            border: none;
            background: #1875FF;
            color: white;
            font-family: inherit;
            text-align: center;
            font-size: 13px;
            box-shadow: 0px 14px 56px -11px #1875FF;
            width: 3em;
            padding: 1em;
            transition: all 0.4s;
            cursor: pointer;
            text-decoration: none;
        }
        .row3 {
        display: flex;
        flex-wrap: wrap;
        background-color: #f8f9fa;
        border: 2px solid rgba(0, 0, 0, 0.125);
        border-radius: 10px;
        }
        .card3 table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .card3 th, .card3 td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .card3 th {
            background-color: #f2f2f2;
        }
        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
            margin-right: 5px;
        }
        .icon-btn .fa-edit {
            color: blue;
        }
        .icon-btn .fa-trash {
            color: red;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #ffff;
            margin: 0px auto;
            padding: 40px;
            border: 1px solid #888;
            width: 500px;
            height: 76vh;
            border-radius: 4px;
            overflow: hidden;
           
        }
        .close {
            color: red;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
       
        .input{
            border-radius: 4px;
            padding: 10px;
            width: 270px;
            margin-bottom: 10px;
            overflow: hidden;
     
        }
  

        /* .button span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.4s;
        }

        .button span:after {
        content: 'for free';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.7s;
        }

        .button:hover span {
        padding-right: 3.55em;
        }

        .button:hover span:after {
        opacity: 4;
        right: 0;
        } */
        .text{
            margin-bottom:5px;
        }
        .pagination {
            display: flex;
            justify-content: right;
            margin-top: 20px;
        }
        .pagination a {
            margin: 0 5px;
            padding: 10px 20px;
            border: 1px solid rgb(0,0,0) ;
            text-decoration: none;
            color: #333;
        }
        .pagination a.active {
            background-color: #1875FF;
            color: white;
            border: 1px solid #1875FF;
        }
        .pagination a:hover {
            background-color: #ddd;
        }
        .regContainer {
            display: flex;
            height: 486px;
            padding: 25px 30px;
            margin: auto;
            color: black;
            background-color: #f8f9fa;
            border: 2px solid rgba(0, 0, 0, 0.125);
        }
        
        form h2 {
        font-size: 2rem;
        text-align: center;
        }

        form h5 {
        font-size: 1rem;
        text-align: center;
        margin-top: 10px;
        }

        .regContainer form .user-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        }

        form .user-details .input-field {
        margin-bottom: 15px;
        margin: 18px 0 10px 0;
        width: calc(100% / 2 - 20px);
        }
        .user-details .input-field .details {
        display: block;
        font-weight: 500;
        margin-bottom: 5px;
        }
        .user-details .input-field input,
        .user-details .input-field select {
        height: 45px;
        width: 91%;
        outline: none;
        padding-left: 15px;
        border-radius: 5px;
        }

        .input-field label {
        display: block;
        font-weight: 500;
        margin-bottom: 5px;
        }

        .form .button {
        height: 45px;
        margin: 10px 0;
        }

        .form .button input {
        height: 100%;
        width: 100%;
        outline: none;
        font-weight: 500;
        letter-spacing: 1px;
        color: #fff;
        background-color: black;
        }

        .form .button input:hover {
        background-color: #ff4242;
        }

        @media (max-width: 960px) {
        .regContainer {
            max-width: 100%;
        }

        form .user-details .input-field {
            width: 100%;
            margin-bottom: 15px;
        }

        .regContainer form .user-details {
            max-height: 430px;
            overflow-y: scroll;
        }
        .user-details::-webkit-scrollbar {
            width: 0;
        }
        }

        @media (max-width: 600px) {
        .regContainer {
            max-width: 100%;
        }
        }

        @media (max-width: 400px) {
        form h5 {
            font-size: 0.8rem;
        }
        }

        @media (max-width: 250px) {
        form h5 {
            font-size: 0.5rem;
        }
        }
    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>

    <!-- Side navigation menu -->
 
    <?php include 'sidebar.php'; ?>
    <!-- Page content -->
    <div class="main content">
         <h2>Class List</h2>
         <hr>
        <div class="row3">
            <div class="column3">
                <div class="card3">
                    <button class="btn" onclick="document.getElementById('addStudentModal').style.display='block'">+Add New</button>
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for classes..">
                        <button onclick="searchTable()"><i class="fas fa-search"></i></button>
                    </div>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Teacher_id</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>Action</th>
                        </tr>
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

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $name = $_POST['name'];
                            $identifier = $_POST['identifier'];
                            $email = $_POST['email'];
                            $phone = $_POST['phone'];
                         
                            

                            $sql = "INSERT INTO student (name, identifier, email, phone) VALUES (?, ?, ?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ssss", $name, $identifier, $email, $phone);

                            if ($stmt->execute()) {
                                echo "<script>alert('Student added successfully!');</script>";
                            } else {
                                echo "<script>alert('Error: " . $stmt->error . "');</script>";
                            }

                            $stmt->close();
                        }

                        $sql = "SELECT id, name, identifier, email, phone FROM student";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row["id"]. "</td>
                                    <td>" . $row["name"]. "</td>
                                     <td>" . $row["identifier"]. "</td>
                                    <td>" . $row["email"]. "</td>
                                    <td>" . $row["phone"]. "</td>
                                    <td>
                                        <button class='icon-btn'><i class='fas fa-edit'></i></button>
                                        <button class='icon-btn'><i class='fas fa-trash'></i></button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No students found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </table>
                    <div class="pagination" id="pagination">
                        <a href="#" id="prevPage" onclick="prevPage()">Prev</a>
                        <span id="pageInfo"></span>
                        <a href="#" id="nextPage" onclick="nextPage()">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('addStudentModal').style.display='none'">&times;</span>
            <h2>Add New Student</h2>
            <div class="regContainer">
            <form action="register.php" method="post" class="form">
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
                    <input type="submit" value="Submit" />
                </div>
            </form>
        </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var x = document.getElementById("mySidenav");
            if (x.style.width === "250px") {
                x.style.width = "0";
            } else {
                x.style.width = "250px";
            }
        }

        function searchTable() {
            // Function to filter table rows based on search input
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector(".card3 table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
</body>
</html>
