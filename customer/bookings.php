<?php 
  include '../auth/session.php';
  include '../includes/db.php';

  // Get user's name
  $user_id = $_SESSION['user_id'];

  // Fetch bookings for the user
  $result = $conn->query("SELECT * FROM bookings WHERE user_id = $user_id");
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
              <a class="nav-link active" href="/car-rental-service/customer/bookings.php">
                <i class="bi bi-calendar-check"></i> Manage Bookings
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/car-rental-service/customer/profile.php">
                <i class="bi bi-person-fill"></i> Update Profile
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
        <?php if (isset($_GET['status'])): ?>
          <?php if ($_GET['status'] == 'success'): ?>
            <div class="alert alert-success">Operation was successful!</div>
          <?php elseif ($_GET['status'] == 'error'): ?>
            <div class="alert alert-danger">An error occurred during the operation.</div>
          <?php endif; ?>
        <?php endif; ?>
        <?php 
          // Check if any bookings are available
          if ($result->num_rows > 0) {
        ?>
            <div class="mt-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Booking List</h1>
            </div>
            <!-- Bookings Table -->
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Pickup Time</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td><?= htmlspecialchars($row['start_date']) ?></td>
                      <td><?= htmlspecialchars($row['end_date']) ?></td>
                      <td><?= htmlspecialchars($row['pickup_time']) ?></td>
                      <td>
                        <span class="badge <?php echo ($row['status'] == 'Confirmed') ? 'bg-success' : 'bg-warning'; ?>">
                          <?= htmlspecialchars($row['status']) ?>
                        </span>
                      </td>
                      <td>
                        <a href="edit-booking.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                          <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="delete-booking.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">
                          <i class="bi bi-trash"></i> Delete
                        </a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
        <?php
          } else {
        ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mt-3 border-bottom">
              <h1 class="h2">No Booking found!</h1>
            </div>
        <?php
          }
        ?>
      </main>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
