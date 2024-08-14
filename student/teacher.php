<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../Css/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
            .form-group1{
            margin-bottom: 10px;
        }
        .rating-guidelines {
            display: flex;
            flex-direction: row;
            margin-top: 10px;
            padding: 20px 20px;
            font-size: 16px;
            font-family: 'math';
      
        }

        .rating-item {
            display: flex;
            align-items: center;
            margin: 19px;

        }

        .rating-symbol {
            font-size: 20px;
            margin-right: 10px;
        }

       .questions {
            padding: 10px;
            border-radius: 5px;
            border: 2px black solid;
            width: 97%;
            margin-left: 5px;
            font-family: sans-serif;
        }
        option{
            background-color: wheat;
            
        }
        .Subject{
            text-align: center;
            width: 250px;
            height: 30px;
            font-size: 1rem;
            margin-top: 10px;
     
        }
        .fetch-subjects-btn{
            text-align: center;
            width: 100px;
            height: 30px;
            font-size: 1rem;
            background-color: #b31b1b;
            color: #fff;
        }

        .dropdown{
            text-align: center;
            width: 250px;
            height: 30px;
            font-size: 1rem;
            margin-bottom: 10px;
        }
        .form-group {
            padding: 20px;
            margin-bottom: 20px;

        }
        .form-group1 {
            padding: 10px;
            border: 1px solid;
            margin-top: 15px;
            text-align: center;
            font-size: 18px;
            font-family: 'math';
        }
        .radio-group {
            display: flex;
            gap: 10px;
        }
        /* .action-buttons {
            margin-top: 10px;
        } */
        .edit-btn, .delete-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        .edit-btn i, .delete-btn i {
            color: #007bff;
        }
        .delete-btn i {
            color: #dc3545;
        }

        .evaluation-form {
            width: 100%;
            max-width: 1700px;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px black solid;
        }

        .evaluation-form h3 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
            font-family: cursive;
        }

        .evaluation-form .form-group {
            margin-bottom: 15px;
        }

        .evaluation-form .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 1rem;
        }

        .evaluation-form .form-group input,
        .evaluation-form .form-group textarea,
        .evaluation-form .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            color: #333;
            background-color: #fff;
        }

        .evaluation-form .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .evaluation-form .form-group input[type="radio"] {
            width: auto;
            margin-right: 10px;
        }

        .evaluation-form .form-group .radio-group {
            display: flex;
            justify-content: space-between;
        }

        .evaluation-form .form-group .radio-group label {
            flex: 1;
        }

        .evaluation-form .form-group .radio-group input {
            margin-right: 5px;
        }

        
        
        .evaluation-form button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            .evaluation-form {
                padding: 15px;
            }
        }

        .savebtn{
            padding:10px;
            width: 100px;
            background-color: red;
            border-radius: 5px;

        }
        .criteria{
            font-size: 20px;
            font-family: 'math';
        }
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 100px; 
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
            margin: 65px auto;
            padding: 40px;
            border: 1px solid #888;
            width: 300px;
            height: 30vh;
            border-radius: 4px;
          
        }
        .input {
            border-radius: 4px;
            padding: 10px;
            width: 270px;
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
                /* From Uiverse.io by Satwinder04 */ 
        .input-container {
        position: relative;
        max-width: 300px;
        margin-bottom: 20px;
        }

        .input-container input[type="text"] {
        font-size: 20px;
        width: 100%;
        border: none;
        border-bottom: 2px solid black;
        padding: 5px 0;
        background-color: transparent;
        outline: none;
        }

        .input-container .label {
        position: absolute;
        top: 0;
        left: 0;
        color: gray;
        transition: all 0.3s ease;
        pointer-events: none;
        }

        

        .input-container .underline {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 2px;
        width: 100%;
        background-color: black;
        transform: scaleX(0);
        transition: all 0.3s ease;
        }

        .input-container input[type="text"]:focus ~ .underline,
        .input-container input[type="text"]:valid ~ .underline {
        transform: scaleX(1);
        }
        .btn{
            background-color: red;
            color: black;
            text-align: center;
            width: 99%;
            margin-left: 5px;
        }
        .form-group {
            padding: 20px;

            margin-bottom: 20px;
            
        }
      

    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>
    <?php include 'student_sidebar.php'; ?>

    <div class="main content">
        <div class="row">
            <div class="evaluation-form">
                <h3>Evaluation Form</h3>
                <br>
              
                <form id="evaluationForm" method="post" action="submit_evaluation.php">
                    <div class="input-container">
                        <input type="text" id="name" name="name" required>
                        <label for="name" class="label">Name</label>
                        <div class="underline"></div>
                    </div>
                    <div class="input-container">
                        <input type="text" id="department" name="department" required>
                        <label for="department" class="label">Department & Year</label>
                        <div class="underline"></div>
                    </div>

                    <!-- Teacher Dropdown -->
                    <?php include 'Teacher_list.php'; ?>

                    <button class="fetch-subjects-btn" id="fetch-subjects-btn" type="button">SELECT</button>

                    <div>
                        <select class="Subject" id="subject-dropdown" name="subject_id" required>
                            <option value="" disabled selected>Select a subject</option>
                        </select>
                    </div>
                    <div class="form-group1">
                            <label for="rating">Faculty Evaluation Rating:</label><br>
                            <div class="rating-guidelines">
                                <div class="rating-item">
                                    <!-- <span class="rating-symbol">*</span> -->
                                    <label for="rating5">5 = Excellent</label>
                                </div>
                                <div class="rating-item">
                                    <!-- <span class="rating-symbol">*</span> -->
                                    <label for="rating4">4 = Very Good</label>
                                </div>
                                <div class="rating-item">
                                    <!-- <span class="rating-symbol">*</span> -->
                                    <label for="rating3">3 = Good</label>
                                </div>
                                <div class="rating-item">
                                    <!-- <span class="rating-symbol">*</span> -->
                                    <label for="rating2">2 = Fair</label>
                                </div>
                                <div class="rating-item">
                                    <!-- <span class="rating-symbol">*</span> -->
                                    <label for="rating1">1 = Poor</label>
                                </div>
                            </div>
                        </div>
                        
                    <div id="dynamicFields"></div>

                    <textarea name="questions" class="questions" id="questions" rows="8" placeholder="Type your comments here.."></textarea>

                    <div>  
                        <button class="btn" type="submit">Submit</button>
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

            function loadQuestions() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_questions.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.getElementById('dynamicFields').innerHTML = xhr.responseText;
                    } else {
                        console.error('Failed to load questions.');
                    }
                };
                xhr.send();
            }

            window.onload = loadQuestions;

            document.getElementById('fetch-subjects-btn').addEventListener('click', function(event) {
                // Prevent the default form submission
                event.preventDefault();

                var teacherId = document.getElementById('teacher-dropdown').value;

                if (teacherId) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'fetch_subject.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var subjects = JSON.parse(xhr.responseText);
                            var subjectDropdown = document.getElementById('subject-dropdown');

                            // Clear the subject dropdown
                            subjectDropdown.innerHTML = "<option value='' disabled selected>Select a subject</option>";

                            // Populate the subject dropdown with new options
                            subjects.forEach(function(subject) {
                                var option = document.createElement('option');
                                option.value = subject.subject_id;
                                option.textContent = subject.subject_name;
                                subjectDropdown.appendChild(option);
                            });
                        }
                    };
                    xhr.send('T_id=' + teacherId);
                } else {
                    alert("Please select a teacher first.");
                }
            });
</script>
</body>
</html>