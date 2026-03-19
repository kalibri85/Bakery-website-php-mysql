<!-- includes/header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bakery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Font: MonteCarlo -->
  <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&display=swap" rel="stylesheet">
  <!-- Google Fonts: MonteCarlo and Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- Main CSS -->
  <link rel="stylesheet" href="./css/style.css">
  <!-- Bootstrap 5 JS (Bundle with Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- header.php -->
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="index.php">
        <img src="img/logo.png" alt="Bakery Logo">
      </a>
      <!-- Toggler/collapse button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Navbar links -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#menu">Daily Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#feedback">Testimonials</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#about">About Us</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php#footer">Contact</a></li>
          <li class="nav-item">
            <a class="nav-link" href="admin/login.php"><i class="bi bi-person-fill"></i> Admin Sign In</a> <!-- Bootstrap Icon -->
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="hero-section d-flex align-items-center">
    <div class="container text-center text-white">
      <h1 class="display-4 fw-bold">Sweet Treat Bakery In London</h1>
      <p class="lead">Our Fresh Delights Turn Every Day Into a Small Celebration!</p>
      <a href="index.php#menu" class="btn btn-pink mt-3">ORDER NOW</a>
    </div>
      <!--Waves Container-->
<div class="position-absolute w-100 wave">
<svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L80,128C160,160,320,224,480,224C640,224,800,160,960,154.7C1120,149,1280,203,1360,229.3L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
</div>
<!--Waves end-->
  </div>

</header>


