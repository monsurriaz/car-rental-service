<?php
  session_start();
  include '../includes/db.php';

  // Get car ID from the URL
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: cars.php?status=error');
    exit;
  }

  $car_id = $_GET['id'];

  // Fetch the car details based on the car ID
  $result = $conn->query("SELECT * FROM cars WHERE id = $car_id");
  if ($result->num_rows == 0) {
    header('Location: cars.php?status=error');
    exit;
  }

  $car = $result->fetch_assoc();
?>

<?php include '../includes/header.php'; ?>

<section class="car-details space">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <!-- Car Image -->
        <img src="<?= htmlspecialchars($car['image_path']); ?>" class="img-fluid" alt="<?= $car['category'] ?>">
      </div>
      <div class="col-md-6">
        <?php if (isset($_GET['status'])): ?>
          <?php if ($_GET['status'] == 'success'): ?>
            <div class="alert alert-success">Booking was successful!</div>
          <?php elseif ($_GET['status'] == 'error'): ?>
            <div class="alert alert-danger">An error occurred during the booking.</div>
          <?php endif; ?>
        <?php endif; ?>
        <!-- Car Info and Booking Form -->
        <h2><?= $car['category'] ?></h2>
        <p><strong>Brand:</strong> <?= $car['brand'] ?></p>
        <p><strong>Model:</strong> <?= $car['model'] ?></p>
        <p><strong>Price per day:</strong> $<?= $car['price_per_day'] ?></p>
        
        <h4>Booking Form</h4>
        <form action="book-car.php" method="POST">
          <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
          <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
          </div>
          <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
          </div>
          <div class="mb-3">
            <label for="pickup_time" class="form-label">Pickup Time</label>
            <input type="time" class="form-control" id="pickup_time" name="pickup_time" required>
          </div>
          <button type="submit" class="btn btn-success">Confirm Booking</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
