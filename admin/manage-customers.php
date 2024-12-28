<?php
  $is_admin_page = true;
  include '../auth/session.php';
  include '../includes/db.php';

  // Fetch all users with the role of 'customer'
  $sql = "SELECT * FROM users WHERE role = 'customer'";
  $result = $conn->query($sql);
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
              <a class="nav-link active" href="/car-rental-service/admin/manage-customers.php">
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
        <div class="container mt-5">
          <div class="row justify-content-center mb-3">
            <div class="col-md-7">
              <?php if (isset($_GET['status'])): ?>
                <?php if ($_GET['status'] == 'success'): ?>
                  <div class="alert alert-success">Operation was successful!</div>
                <?php elseif ($_GET['status'] == 'error'): ?>
                  <div class="alert alert-danger">An error occurred during the operation.</div>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-5">
            <div class="col-md-12">
              <h3 class="text-center mb-4">Customer List</h3>

              <?php if ($result->num_rows > 0): ?>
                <div class="list-group">
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                        <!-- Profile Image -->
                        <?php
                          if ($row['profile_image']) {
                        ?>
                        <img src="<?= htmlspecialchars($row['profile_image']); ?>" alt="Profile Image" class="rounded-circle" width="50" height="50">
                        <?php
                          }
                        ?>
                        <div class="ms-3">
                          <h5 class="mb-1"><?= htmlspecialchars($row['name']); ?></h5>
                          <p class="mb-0"><?= htmlspecialchars($row['email']); ?></p>
                        </div>
                      </div>
                      
                      <!-- Action Button to promote to Admin -->
                      <form method="POST" action="promote-to-admin.php" class="d-inline">
                        <input type="hidden" name="user_id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Promote to Admin</button>
                      </form>
                    </div>
                  <?php endwhile; ?>
                </div>
              <?php else: ?>
                <div class="alert alert-info">No customers found.</div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>