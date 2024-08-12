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
     .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            background-color: #f1f1f1;
            color: #007bff;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination a.active {
            background-color: #007bff;
            color: white;
        }

        .pagination a:hover {
            background-color: #0056b3;
            color: white;
        }



        .form-group1 {
            margin-bottom: 15px;
        }

        .rating-guidelines {
            display: flex;
            flex-direction: row-reverse;
            margin-top: 10px;
            padding: 20px 20px;
      
        }

        .rating-item {
            display: flex;
            align-items: center;
            margin: 19px;
            font-family: cursive;
        }

        .rating-symbol {
            font-size: 20px;
            margin-right: 10px;
        }

        .column4 {
            background-color: #f4f4f4;
            float: left;
            width: 450px;
            padding: 20px;
            box-sizing: border-box;
            height: 35vh;
            display: flex;
            flex-wrap: wrap;
            background-color: #f8f9fa;
            border: 2px solid rgba(0, 0, 0, 0.125);
            border-radius: 10px;
            margin-right: 20px;
        }
        .column5 {
            background-color: #f4f4f4;
            float: left;
            width: 865px;
            padding: 20px;
            box-sizing: border-box;
            height: 35vh;
            display: flex;
            flex-wrap: wrap;
            background-color: #f8f9fa;
            border: 2px solid rgba(0, 0, 0, 0.125);
            border-radius: 10px;
           
        
        }
        .form-group {
            padding: 20px;
            margin-bottom: 20px;
            border: 2px black solid;
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
            max-width: 1600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px black solid;
            /* display: flex; */
            /* flex-wrap: wrap; */
            background-color: #f8f9fa;
            border: 2px solid rgba(0, 0, 0, 0.125);
            border-radius: 10px;
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

        .evaluation-form button[type="submit"] {

            padding: 10px;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .questions{
            padding:20px;
            border-radius: 5px;
            border: 3px black solid;
            width: 300px;
            font-family: 'Poppins', sans-serif;

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
            float:right;
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
    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>

    <!-- Side navigation menu -->
    <?php include 'sidebar.php'; ?>

    <!-- Page content -->
    <div class="main content">
    
        <div class="row1"></div>
        <div class="row">
            <div class="column4">
                <div class="card4">
                <form id="questionForm" action="save_questions.php" method="post">
                    <div class="form-group1">
                    <select class="criteria" id="criteria" name="criteria" required>
                    <option value="">Select Criteria</option>
                    <option value="Teaching Effectiveness">Teaching Effectiveness</option>
                    <option value="Professionalism">Professionalism</option>
                    <option value="Classroom Management">Classroom Management</option>
                    <option value="Student Outcomes">Student Outcomes</option>
                </select>
                    </div>
                    <br>
                    <div class="form-group1">
                        <textarea name="questions" class="questions" id="questions" rows="4" placeholder="Enter questions (one per line)" required></textarea>
                    </div>
                    <button class="savebtn" type="submit">Save</button>
                </form>
                </div>
            </div>
            <div class="column5">
                <div class="card4">
                    <form>
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
                        
                    </form>
                </div>
            </div>

            <div class="evaluation-form">
                <h3>Evaluation Form</h3>
                <form id="evaluationForm" method="post">
                    <div id="dynamicFields">
                        <?php include 'fetch_questions.php'; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="editQuestionForm" method="post" action="edit_question.php">
                <input type="hidden" name="question_id" id="editQuestionId">
                <div class="form-group">
                    <label for="editCriteria">Criteria:</label>
                    <input type="text" class="input" id="editCriteria" name="criteria" required>
                </div>
                <div class="form-group">
                    <label for="editQuestion">Question:</label>
                    <textarea id="editQuestion" class="input" name="question" rows="5" required></textarea>
                </div>
                <button type="submit" class="savebtn">Save</button>
            </form>
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

        document.getElementById('questionForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch('save_questions.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Optionally show a success message
                updateEvaluationForm();
            })
            .catch(error => console.error('Error:', error));
        });

        function updateEvaluationForm() {
            fetch('fetch_questions.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('dynamicFields').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        }

        // Get the modal
        var modal = document.getElementById("editModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Function to open the modal and populate it with the question data
        function openEditModal(questionId, criteria, question) {
            document.getElementById('editQuestionId').value = questionId;
            document.getElementById('editCriteria').value = criteria;
            document.getElementById('editQuestion').value = question;
            modal.style.display = "block";
        }
    </script>
</body>
</html>
