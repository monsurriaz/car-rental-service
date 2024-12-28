<?php 
  include '../auth/session.php';
  include '../includes/db.php';

  // Get user's name
  $userName = $_SESSION['name'] ?? 'Customer';
?>

<?php include '../includes/header.php'; ?>

<section class="admin__dashboard">
  <div class="container-fluid">
    <div class="row min-height">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="/car-rental-service/admin/dashboard.php">
                <i class="bi bi-people-fill"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/car-rental-service/customer/bookings.php">
                <i class="bi bi-calendar-check"></i> Manage Bookings
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/car-rental-service/customer/profile.php">
                <i class="bi bi-calendar-check"></i> Update Profile
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
          <h1 class="h2">Welcome, <?php echo htmlspecialchars($userName); ?>!</h1>
        </div>
        <p>This is your user dashboard. Use the sidebar to navigate through the management sections.</p>
      </main>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>