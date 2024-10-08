<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sidebar</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="sidenav" id="mySidenav">
        <img class="logo" src="../img/logo.png">
        <a href="admin.php"><i class="fas fa-desktop"></i> Dashboard</a>
        <a href="classes.php"><i class="fas fa-users"></i> Student</a>
        <a href="year.php"><i class="fas fa-calendar"></i> Academic Year</a>
        <a href="questionnaire.php"><i class="fas fa-question-circle"></i> Questioner</a>
        <a href="teacher.php"><i class="fas fa-check-circle"></i> Teacher</a>
        <a href="staff.php"><i class="fas fa-user-tie"></i> Staff</a>
        <a href="reports.php"><i class="fas fa-folder-open"></i> Reports</a>
        <hr>
        <a href="confirmLogout.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
    </div>

    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
</body>
</html>
