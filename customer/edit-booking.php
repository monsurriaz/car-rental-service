<?php 
  include '../auth/session.php';
  include '../includes/db.php';

  // Check if booking ID is provided in the URL
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: bookings.php?status=error');
    exit;
  }

  $booking_id = $_GET['id'];

  // Fetch the booking details from the database
  $result = $conn->query("SELECT * FROM bookings WHERE id = $booking_id");
  if ($result->num_rows == 0) {
    header('Location: bookings.php?status=error');
    exit;
  }

  $booking = $result->fetch_assoc();

  // Handle form submission for editing booking
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Only allow changes to start_date, end_date, and pickup_time
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $pickup_time = $_POST['pickup_time'];

    // Update the booking in the database
    $updateQuery = "UPDATE bookings SET start_date = '$start_date', end_date = '$end_date', pickup_time = '$pickup_time' WHERE id = $booking_id";
    if ($conn->query($updateQuery) === TRUE) {
      header('Location: bookings.php?status=success');
      exit;
    } else {
      header('Location: bookings.php?status=error');
      exit;
    }
  }
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
        <div class="container mt-5">
          <h1>Edit Booking</h1>
          <form method="POST" action="">
            <div class="mb-3">
              <label for="start_date" class="form-label">Start Date</label>
              <input type="date" class="form-control" id="start_date" name="start_date" value="<?= htmlspecialchars($booking['start_date']) ?>" required>
            </div>
            <div class="mb-3">
              <label for="end_date" class="form-label">End Date</label>
              <input type="date" class="form-control" id="end_date" name="end_date" value="<?= htmlspecialchars($booking['end_date']) ?>" required>
            </div>
            <div class="mb-3">
              <label for="pickup_time" class="form-label">Pickup Time</label>
              <input type="time" class="form-control" id="pickup_time" name="pickup_time" value="<?= htmlspecialchars($booking['pickup_time']) ?>" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
