<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../Css/index.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <style>
      .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
      }
      .row1 {
        display: flex;
        flex-wrap: wrap;
        margin-top: 15px;
      }
      .rowCol {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
      }
      .cardsColumn {
        position: relative;
        width: 97%;
        padding-right: 15px;
        padding-left: 15px;
        padding-top: 50px;
      }
      .card {
        background-color: #f8f9fa;
        border: 2px solid rgba(0, 0, 0, 0.125);
        border-radius: 10px;
      }
      .cardBody {
        padding: 20px;
      }
      .cardBody i {
        font-size: 54px;
        margin-right: 10px; 
      }
      .card > hr {
        margin-right: 0;
        margin-left: 0;
      }
     
      .colCard {
        flex: 0 0 25%;
        max-width: 22%;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 20px;
      }
      .payments {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .text {
        color: black;
        font-size: 16px;
      }
      .totalPayment {
        font-size: 18px;
        font-weight: bold;
      }
      .cardFooter {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 20px;
        background-color: rgba(0, 0, 0, 0.03);
        border-top: 1px solid rgba(0, 0, 0, 0.125);
      }
      .view {
        font-size: 12px;
        color: #ffffff;
        position: relative;
        width: 100%;
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
      }
      .right {
        text-align: center;
      }
      .right img {
        font-size: inherit;
        height: 18px;
        margin-top: 11px;
      }
      .card1 {
        position: relative;
        margin-bottom: 15px;
        padding: 0px 15px;
        display: flex;
        color: black;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.301);
        border-radius: 10px;
      }
      .card2 {
        background-color: #f8f9fa;
        border: 2px solid rgba(0, 0, 0, 0.125);
        border-radius: 10px;
        width: 100%;
      }
      .card4 {
        background-color: #f8f9fa;
        border: 2px solid rgba(0, 0, 0, 0.125);
        border-radius: 10px;
        max-width: 1303px;
        height: 10vh;
        overflow: hidden;
        text-align: center;
        font-family: 'Poppins', sans-serif;
      }
      @media (max-width: 768px) {
        .colCard {
          flex: 0 0 50%;
          max-width: 50%;
        }
      }
      @media (max-width: 576px) {
        .colCard {
          flex: 0 0 100%;
          max-width: 89%;
        }
      }
      p{
        font-size: 20px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      }
    </style>
  </head>
  <body>
    <!-- Include top bar -->
    <!-- <div class="topnav">
      <a href="#home">Profile</a>
      <a href="#about">Log out</a>
    </div> -->

    <button class="menu-btn" onclick="toggleMenu()">&#9776;</button>

    <!-- Side navigation menu -->
    <?php include 'student_sidebar.php'; ?>
    <!-- Page content -->
    <div class="main content">
      <h2>Dashboard</h2>
      <hr />
      <div class="row1">
        <div class="column1">
          <div class="card4">
            <p>
              Academic Year: 2020-2021 1st Semester
              Evaluation Status: On-going
            </p>
          </div>
        </div>
      </div>
      <div class="cardsContainer">
        <div class="cardsColumn">
          <div class="card">
            <div class="row1">
              <div class="colCard">
                <div class="card1">
                  <div class="cardBody">
                    <div class="payments">
                      <div class="payments1">
                        <span class="text">Evaluation</span>
                      </div>
                      <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                  </div>
                  <div class="cardFooter">
                    <!-- <a class="view" href=" "> View Payments</a> -->
                    <span class="text">View Evaluation </span>
                    <div class="right">
                      <a href="payments.php">
                        <i
                          class="fas fa-chevron-right"
                          style="color: white"
                        ></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="colCard">
                <div class="card1">
                  <div class="cardBody">
                    <div class="payments">
                      <div class="payments1">
                        <span class="text">Teacher</span>
                        <div class="totalPayment"></div>
                      </div>
                      <i class="fas fa-user-graduate"></i>
                    </div>
                  </div>
                  <div class="cardFooter">
                    <!-- <a class="view" href=" "> View Payments</a> -->
                    <span class="text">View Teacher </span>
                    <div class="right">
                      <a href="borrowers.php">
                        <i
                          class="fas fa-chevron-right"
                          style="color: white"
                        ></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="colCard">
                <div class="card1">
                  <div class="cardBody">
                    <div class="payments">
                      <div class="payments1">
                        <span class="text">Profile</span>
                        <div class="totalPayment"></div>
                      </div>
                      <i class="fas fa-question-circle"></i>
                    </div>
                  </div>
                  <div class="cardFooter">
                    <!-- <a class="view" href=" "> View Payments</a> -->
                    <span class="text">View Profile</span>
                    <div class="right">
                      <a href="loans.php">
                        <i
                          class="fas fa-chevron-right"
                          style="color: white"
                        ></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="colCard">
                <div class="card1">
                  <div class="cardBody">
                    <div class="payments">
                      <div class="payments1">
                        <span class="text">Staff</span>
                        <div class="totalPayment"></div>
                      </div>
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                  <div class="cardFooter">
                    <!-- <a class="view" href=" "> View Payments</a> -->
                    <span class="text">View Staff </span>
                    <div class="right">
                      <a href="savings.php">
                        <i
                          class="fas fa-chevron-right"
                          style="color: white"
                        ></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function toggleMenu() {
        var x = document.getElementById('mySidenav')
        if (x.style.width === '250px') {
          x.style.width = '0'
        } else {
          x.style.width = '250px'
        }
      }

      var dropdown = document.getElementsByClassName('dropdown-btn')
      var i

      for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener('click', function () {
          this.classList.toggle('active')
          var dropdownContent = this.nextElementSibling
          if (dropdownContent.style.display === 'block') {
            dropdownContent.style.display = 'none'
          } else {
            dropdownContent.style.display = 'block'
          }
        })
      }
    </script>
  </body>
</html>
