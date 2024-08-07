<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="../Css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <style>
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
            background-color: #fff;
            margin: 65px auto;
            padding: 40px;
            border: 1px solid #888;
            width: 300px;
            height: 45vh;
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
        .input {
            border-radius: 4px;
            padding: 10px;
            width: 270px;
            margin-bottom: 10px;
            overflow: hidden;
        }
        .button {
            display: inline-block;
            border-radius: 7px;
            border: none;
            background: #1875FF;
            color: white;
            font-family: inherit;
            text-align: center;
            font-size: 13px;
            box-shadow: 0px 14px 56px -11px #1875FF;
            width: 10em;
            padding: 1em;
            transition: all 0.4s;
            cursor: pointer;
            float: right;
            margin: 10px;
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
        .row3 {
        display: flex;
        flex-wrap: wrap;
        background-color: #f8f9fa;
        border: 2px solid rgba(0, 0, 0, 0.125);
        border-radius: 10px;
        }
    </style>
</head>
<body>
    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>
    <?php include 'sidebar.php'; ?>
    <div class="main content">
        <h2>Staff List</h2>
        <hr>
        <div class="row3">
            <div class="column3">
                <div class="card3">
                    <button class="btn" id="addStaffBtn">+Add New</button>
                    <div class="search-container">
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for staff..">
                        <button onclick="searchTable()"><i class="fas fa-search"></i></button>
                    </div>
                    <table id="staffTable">
                        <thead>
                            <tr style="border: 3px black solid;">
                                <th>No.</th>
                                <th>Role</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="staffTableBody">
                            <!-- Data will be loaded here via AJAX -->
                        </tbody>
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

    <!-- Modal for adding new staff -->
    <div id="addStaffModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Staff</h2>
            <hr>
            <form id="addStaffForm">
                <input class="input" type="text" id="role" name="role" placeholder="Role" required>
                <input class="input" type="text" id="firstname" name="firstname" placeholder="First Name" required>
                <input class="input" type="text" id="lastname" name="lastname" placeholder="Last Name" required>
                <input class="input" type="text" id="id" name="id" placeholder="ID" required>
                <button class="button" type="submit" style="vertical-align:middle"><span>Save</span></button>
            </form>
        </div>
    </div>

    <script>
        var currentPage = 1;
        var totalPages = 1;

        document.addEventListener('DOMContentLoaded', function () {
            loadStaff(currentPage); // Load first page of staff on page load
        });

        var modal = document.getElementById("addStaffModal");
        var btn = document.getElementById("addStaffBtn");
        var span = document.getElementsByClassName("close")[0];
        var form = document.getElementById("addStaffForm");

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        form.onsubmit = function(event) {
            event.preventDefault();
            var role = document.getElementById("role").value;
            var firstname = document.getElementById("firstname").value;
            var lastname = document.getElementById("lastname").value;
            var id = document.getElementById("id").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_staff.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var newStaff = JSON.parse(xhr.responseText);
                    addStaffToTable(newStaff.id, newStaff.role, newStaff.firstname, newStaff.lastname);
                    modal.style.display = "none";
                    form.reset();
                }
            }
            xhr.send("role=" + role + "&firstname=" + firstname + "&lastname=" + lastname + "&id=" + id);
        }

        function loadStaff(page) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_staff.php?page=" + page, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    var staffTableBody = document.getElementById("staffTableBody");
                    var pageInfo = document.getElementById("pageInfo");

                    // Clear existing table rows
                    staffTableBody.innerHTML = "";

                    // Add new rows to the table
                    response.staff.forEach(function (staff) {
                        var row = staffTableBody.insertRow();
                        row.insertCell(0).innerHTML = staff.S_id;
                        row.insertCell(1).innerHTML = staff.role;
                        row.insertCell(2).innerHTML = staff.lastname;
                        row.insertCell(3).innerHTML = staff.firstname;
                        row.insertCell(4).innerHTML = '<button class="icon-btn"><i class="fas fa-edit"></i></button><button class="icon-btn"><i class="fas fa-trash"></i></button>';
                    });

                    // Update pagination info
                    currentPage = page;
                    totalPages = response.totalPages;
                    pageInfo.innerHTML = `Page ${currentPage} of ${totalPages}`;

                    // Enable/disable prev/next buttons
                    document.getElementById("prevPage").style.display = (currentPage > 1) ? 'inline' : 'none';
                    document.getElementById("nextPage").style.display = (currentPage < totalPages) ? 'inline' : 'none';
                }
            }
            xhr.send();
        }

        function prevPage() {
            if (currentPage > 1) {
                loadStaff(currentPage - 1);
            }
        }

        function nextPage() {
            if (currentPage < totalPages) {
                loadStaff(currentPage + 1);
            }
        }
    </script>
</body>
</html>
