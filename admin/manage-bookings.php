<?php
  $is_admin_page = true;
  include '../auth/session.php';
  include '../includes/db.php';

  // Fetch all bookings
  $sql = "SELECT b.id, u.name AS user_name, c.model AS car_model, b.start_date, b.end_date, b.pickup_time, b.status 
  FROM bookings b
  JOIN users u ON b.user_id = u.id
  JOIN cars c ON b.car_id = c.id";
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
              <a class="nav-link active" href="/car-rental-service/admin/manage-bookings.php">
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
        <?php if (isset($_GET['status'])): ?>
          <?php if ($_GET['status'] == 'success'): ?>
            <div class="alert alert-success">Booking status updated successfully!</div>
          <?php elseif ($_GET['status'] == 'error'): ?>
            <div class="alert alert-danger">Error updating booking status.</div>
          <?php endif; ?>
        <?php endif; ?>

        <?php
          // Check if any bookings are available
          if ($result->num_rows > 0) {
            ?>
              <div class="mt-3 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Booking List</h1>
              </div>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Car Model</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Pickup Time</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['user_name']; ?></td>
                      <td><?php echo $row['car_model']; ?></td>
                      <td><?php echo $row['start_date']; ?></td>
                      <td><?php echo $row['end_date']; ?></td>
                      <td><?php echo $row['pickup_time']; ?></td>
                      <td><?php echo ucfirst($row['status']); ?></td>
                      <td>
                        <!-- Action buttons for changing status -->
                        <form action="update-booking-status.php" method="POST" style="display: inline;">
                          <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                          <select name="status" onchange="this.form.submit()">
                            <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="approved" <?php echo ($row['status'] == 'approved') ? 'selected' : ''; ?>>Approved</option>
                            <option value="cancelled" <?php echo ($row['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                          </select>
                        </form>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
        <?php
          } else {
        ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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