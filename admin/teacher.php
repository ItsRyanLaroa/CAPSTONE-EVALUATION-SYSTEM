<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <style>
        .row3 {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }
        .card3 {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 10px;
        }
        .card3 h3 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }
        .card3 p {
            margin: 5px 0;
            font-size: 1em;
            color: #666;
        }
        .card3 .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
        }
        .icon-btn .fa-edit {
            color: blue;
        }
        .icon-btn .fa-trash {
            color: red;
        }
        .icon-btn .fa-plus {
            color: green;
        }
        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }
        .search-container input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 300px;
        }
        .search-container button {
            padding: 10px;
            border: none;
            background-color: #1875FF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1000; /* Ensure it appears above other content */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        }
        
        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
            position: relative;
            top: 50%;
            transform: translateY(-50%); 
            height: 20vh;
        }
        
        .close {
            color: #aaa;
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
        
        .input {
            border-radius: 4px;
            padding: 10px;
            width: 93%;
            margin-bottom: 10px;
        }
        
        .button {
            border-radius: 7px;
            border: none;
            background: #1875FF;
            color: white;
            padding: 10px 20px;
            cursor: pointer;
            width: 30%;
            float: right;
        }
    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>
    <?php include 'sidebar.php'; ?>
    <div class="main content">
        <h2>Teacher List</h2>
        <hr>
        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="searchCards()" placeholder="Search for teachers..">
            <button onclick="searchCards()"><i class="fas fa-search"></i></button>
        </div>
        <div class="row3" id="teacherCards">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "faculty_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT T_id, firstname, lastname FROM teachers";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='card3'>
                            <h3>" . $row["lastname"] . ", " . $row["firstname"] . "</h3>
                            <p>ID: " . $row["T_id"] . "</p>
                            <div class='action-buttons'>
                                <button class='icon-btn'><i class='fas fa-edit'></i></button>
                                <button class='icon-btn'><i class='fas fa-trash'></i></button>
                                <button class='icon-btn add-subject-btn' data-teacher-id='" . $row["T_id"] . "'><i class='fas fa-plus'></i> Add Subject</button>
                            </div>
                          </div>";
                }
            } else {
                echo "<p>No teachers found</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Modal for adding a subject -->
    <div id="addSubjectModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Subject</h2>
            <hr>
            <form id="addSubjectForm">
                <input type="hidden" id="teacherId" name="teacherId">
                <input class="input" type="text" id="subjectName" name="subjectName" placeholder="Subject Name" required>
                <button class="button" type="submit">Save</button>
            </form>
        </div>
    </div>

    <script>
        // Modal elements
        var addSubjectModal = document.getElementById("addSubjectModal");
        var addSubjectForm = document.getElementById("addSubjectForm");
        var subjectModalClose = document.getElementsByClassName("close")[0];
        var teacherIdInput = document.getElementById("teacherId");

        // Event listener for "Add Subject" buttons
        document.querySelectorAll(".add-subject-btn").forEach(function(button) {
            button.addEventListener("click", function() {
                var teacherId = this.getAttribute("data-teacher-id");
                teacherIdInput.value = teacherId; // Set the teacher ID in the hidden input
                addSubjectModal.style.display = "block"; // Show the modal
            });
        });

        // Close the modal when the user clicks the close button
        subjectModalClose.onclick = function() {
            addSubjectModal.style.display = "none";
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function(event) {
            if (event.target == addSubjectModal) {
                addSubjectModal.style.display = "none";
            }
        }

        // Handle the form submission for adding a subject
        addSubjectForm.onsubmit = function(event) {
            event.preventDefault();
            var teacherId = document.getElementById("teacherId").value;
            var subjectName = document.getElementById("subjectName").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_subject.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    addSubjectModal.style.display = "none";
                    addSubjectForm.reset();
                    alert("Subject added successfully");
                }
            }
            xhr.send("T_id=" + teacherId + "&subject_name=" + subjectName);
        }

        // Function to search for teachers in the card layout
        function searchCards() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toLowerCase();
            var cards = document.getElementById("teacherCards").getElementsByClassName("card3");

            for (var i = 0; i < cards.length; i++) {
                var card = cards[i];
                var h3 = card.getElementsByTagName("h3")[0];
                if (h3.innerHTML.toLowerCase().indexOf(filter) > -1) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
