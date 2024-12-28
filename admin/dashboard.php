<?php
  $is_admin_page = true;
  include '../auth/session.php';
  include '../includes/header.php';

  // Get admin's name
  $adminName = $_SESSION['name'] ?? 'Admin';
?>

<section class="admin__dashboard">
  <div class="container-fluid">
    <div class="row min-height">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="/car-rental-service/admin/dashboard.php">
                <i class="bi bi-house-door-fill"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/car-rental-service/admin/manage-cars.php">
                <i class="bi bi-car-front-fill"></i> Manage Cars
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/car-rental-service/admin/manage-bookings.php">
                <i class="bi bi-calendar-check"></i> Manage Bookings
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/car-rental-service/admin/manage-customers.php">
                <i class="bi bi-people-fill"></i> Manage Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="/car-rental-service/auth/logout.php">
                <i class="bi bi-box-arrow-right"></i> Logout
              </a>
            </li>
          </ul>
        </div>
      </nav>
  
      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Welcome, <?php echo htmlspecialchars($adminName); ?>!</h1>
        </div>
        <p>This is your admin dashboard. Use the sidebar to navigate through the management sections.</p>
      </main>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>