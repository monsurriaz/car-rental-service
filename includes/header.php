<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Rental Service</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/car-rental-service/assets/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
    <div class="container">
      <a class="navbar-brand" href="/car-rental-service">
        <img src="/car-rental-service/assets/images/car-rent-logo.png" alt="car-rest-logo" width="auto" height="24">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="/car-rental-service">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/car-rental-service/cars/cars.php">Cars</a>
          </li>
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
            <li class="nav-item">
              <a class="nav-link" href="/car-rental-service/customer/dashboard.php">Dashboard</a>
            </li>
          <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link" href="/car-rental-service/admin/dashboard.php">Admin Panel</a>
            </li>
          <?php endif; ?>
        </ul>
        <form class="d-flex" action="/car-rental-service/cars/search.php" method="GET">
          <input class="form-control me-2" type="search" name="query" placeholder="Search Cars" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a class="btn btn-danger ms-3" href="/car-rental-service/auth/logout.php">Logout</a>
        <?php else: ?>
          <a class="btn btn-primary ms-3" href="/car-rental-service/auth/login.php">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>