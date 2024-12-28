<?php
  session_start();
  include '../includes/db.php';
  $result = $conn->query("SELECT * FROM cars");
?>

<?php include '../includes/header.php'; ?>

<section class="collection-banner space">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Our Cars</h1>
      </div>
    </div>
  </div>
</section>

<div class="collection-car__grid space">
  <div class="container">
    <div class="row">
      <?php while ($car = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="<?= htmlspecialchars($car['image_path']); ?>" class="card-img-top" alt="<?= $car['category'] ?>">
            <div class="card-body">
              <h5 class="card-title"><?= $car['category'] ?></h5>
              <p class="card-text"><?= $car['price_per_day'] ?> BDT / per day</p>
              <!-- Check if user is logged in -->
              <?php if (isset($_SESSION['user_id'])): ?>
                <a href="car-details.php?id=<?= $car['id'] ?>" class="btn btn-primary">Book</a>
              <?php else: ?>
                <a href="../auth/login.php?redirect=/car-rental-service/cars/car-details.php&id=<?= $car['id'] ?>" class="btn btn-primary">Book</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
