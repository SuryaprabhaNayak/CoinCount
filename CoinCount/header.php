<?php
   include('config.php');
   include('functions.php');

   // Check if user is logged in
   if (isset($_SESSION['UID'])) {
   // Fetch username from database
   $username = "";
   $res = mysqli_query($con, "SELECT username FROM users WHERE id = " . $_SESSION['UID']);
   if ($row = mysqli_fetch_assoc($res)) {
       $username = $row['username'];
   }
}
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags-->
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="au theme template">
      <meta name="author" content="Hau Nguyen">
      <meta name="keywords" content="au theme template">
      <!-- Title Page-->
      <title>Dashboard</title>
      <!-- Fontfaces CSS-->
      <link href="css/font-face.css" rel="stylesheet" media="all">
      <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
      <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
      <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
      <!-- Bootstrap CSS-->
      <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
      <!-- Vendor CSS-->
      <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
      <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
      <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
      <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
      <!-- Main CSS-->
      <link href="css/theme.css" rel="stylesheet" media="all">
      <script>
         function setTitle(title){
         	document.title=title;
         }
         function selectLink(id){
         	document.getElementById(id).classList.add('active');
         }
      </script>
   </head>
   <body class="animsition">
      <div class="page-wrapper">
      <!-- HEADER MOBILE-->
      <header class="header-mobile d-block d-lg-none">
         <div class="header-mobile__bar">
            <div class="container-fluid">
               <div class="header-mobile-inner">
                  <a class="logo" href="index.html">
                  <img src="images/icon/logo.png" alt="CoolAdmin" />
                  </a>
                  <button class="hamburger hamburger--slider" type="button">
                  <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                  </span>
                  </button>
               </div>
            </div>
         </div>
         <nav class="navbar-mobile">
            <div class="container-fluid">
               <ul class="navbar-mobile__list list-unstyled">
                  <li class="has-sub">
                     <a class="js-arrow" href="#">
                     <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      <!-- END HEADER MOBILE-->
      <!-- MENU SIDEBAR-->
      <aside class="menu-sidebar d-none d-lg-block">
         <div class="logo">
            <a href="#">
            <img src="images/icon/logo.png" alt="Cool Admin" />
            </a>
         </div>
         <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
               <ul class="list-unstyled navbar__list">
                  <?php
                     if($_SESSION['UROLE']=='User'){
                     ?>
                  <li id="dashboard_link">
                     <a class="js-arrow" href="dashboard.php">
                     <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                  </li>
                  <li id="expense_link">
                     <a href="expense.php">
                     <i class="fas  fa-rupee"></i>Expense</a>
                  </li>
                  <li id="reports_link">
                     <a href="reports.php">
                     <i class="fas fa-chart-bar"></i>Reports</a>
                  </li>
                  <li id="income_link">
                     <a href="income.php">
                     <i class="fas fa-rupee"></i>Income</a>
                  </li>
                  <li id="monthlybudget_link">
                     <a href="monthlybudget.php">
                     <i class="fas fa-rupee"></i>Monthly Budget</a>
                  </li>
                  <li id="graph_link">
                     <a href="graph2.php">
                     <i class="fas fa-chart-bar"></i>Graph</a>
                     <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="index.html">Expense By Category</a>
                                </li>
                                <li>
                                    <a href="index2.html">Monthly Expenses</a>
                                </li>
                                <li>
                                    <a href="index3.html">Expense Vs Income</a>
                                </li>
                            </ul>
                  </li>
                  <?php } else {?>
                  <li id="category_link">
                     <a href="category.php">
                     <i class="fas  fa-list-alt"></i>Category</a>
                  </li>
                  <li id="users_link">
                     <a href="users.php">
                     <i class="fas fa-user-md"></i>Users</a>
                  </li>
                 

                  <?php } ?>
                  <li>
                     <a href="logout.php">
                     <i class="fas fa-power-off"></i>Logout</a>
                  </li>
               </ul>
            </nav>
         </div>
      </aside>
      <!-- END MENU SIDEBAR-->
      <!-- PAGE CONTAINER-->
      <div class="page-container">
      <!-- HEADER DESKTOP-->
      <header class="header-desktop">
         <div class="section__content section__content--p30">
         </div>
      </header>
      <!-- HEADER DESKTOP-->
      <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php if (isset($_SESSION['UID'])) { ?>
                                    <h2>Hello, <?php echo $username; ?></h2>
                                <?php } ?>
                            </div>
                            <div class="col-lg-6">
                                <!-- Other content of the header -->
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->