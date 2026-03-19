<!-- includes/header.php -->
 <?php
 session_start();
 $currentPage = basename($_SERVER['PHP_SELF']);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bakery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <!-- Google Font: MonteCarlo -->
  <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&display=swap" rel="stylesheet">
  <!-- Google Fonts: MonteCarlo and Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- Main CSS -->
  <link rel="stylesheet" href="./css/style.css">
  <!-- Bootstrap 5 JS (Bundle with Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>


</head>
<body>
<!-- header.php -->
<header>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: #472949;">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="../index.php">
        <img src="img/logo.png" alt="Bakery Logo">
      </a>
      <!-- Toggler/collapse button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Navbar links -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
          <!-- Add active class to current page -->
          <li class="nav-item"><a class="nav-link <?= ($currentPage == 'dashboard.php' ? 'active' : '') ?>" href="dashboard.php">Products</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage == 'categories.php' ? 'active' : '') ?>" href="categories.php">Categories</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage == 'addCategory.php' ? 'active' : '') ?>" href="addCategory.php">Add Category</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage == 'addItem.php' ? 'active' : '') ?>" href="addItem.php">Add Product</a></li>
          <li class="nav-item"><a class="nav-link <?= ($currentPage == 'feedbacks.php' ? 'active' : '') ?>" href="feedbacks.php">Feedbacks</a></li>
          <li class="nav-item">
            <!-- Check if admin logged in. If user logged in show Logout link instead of Admin Sign In-->
            <?php 
              if(isset($_SESSION['admin'])) {
                echo' <a class="nav-link" href="logout.php"><i class="bi bi-person-fill"></i> Logout</a>';
              } else {
                echo' <a class="nav-link" href="login.php"><i class="bi bi-person-fill"></i> Admin Sign In</a>';
              }
              ?>
            </li>
        </ul>
      </div>
    </div>
  </nav>
</header>


