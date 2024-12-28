<?php 
  session_start();
  include '../includes/db.php';
  $query = isset($_GET['query']) ? trim($_GET['query']) : '';

  $searchResults = [];
  if ($query !== '') {
    $stmt = $conn->prepare("SELECT * FROM cars WHERE 
      category LIKE ? OR 
      brand LIKE ? OR
      model LIKE ? OR 
      price_per_day LIKE ?");
    $likeQuery = "%$query%";
    $stmt->bind_param("ssss", $likeQuery, $likeQuery, $likeQuery, $likeQuery); // Pass 4 parameters
    $stmt->execute();
    $result = $stmt->get_result();
    $searchResults = $result->fetch_all(MYSQLI_ASSOC);
  }
?>

<?php include '../includes/header.php'; ?>

<section class="collection-banner space">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">Search Results for: "<?= htmlspecialchars($query) ?>"</h1>
      </div>
    </div>
  </div>
</section>

<section class="car-search-result">
  <div class="container my-4">
    <?php if (empty($searchResults)): ?>
      <div class="alert alert-warning" role="alert">
        No cars found matching your search criteria.
      </div>
    <?php else: ?>
      <div class="row">
        <?php foreach ($searchResults as $car): ?>
          <div class="col-md-4">
            <div class="card mb-4">
              <img src="<?= htmlspecialchars($car['image_path']); ?>" class="card-img-top" alt="<?= $car['category'] ?>">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($car['model']); ?></h5>
                <p class="card-text">
                  Category: <?= htmlspecialchars($car['category']); ?><br>
                  Price/Day: <?= htmlspecialchars($car['price_per_day']); ?>
                </p>
                <a href="car-details.php?id=<?= $car['id']; ?>" class="btn btn-primary">Book Now</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
