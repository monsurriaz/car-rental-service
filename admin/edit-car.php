<?php
  include '../auth/session.php';
  include '../includes/db.php';

  // Check if 'id' is passed in the URL
  if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    
    // Fetch car details from the database
    $sql = "SELECT * FROM cars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $car_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      $car = $result->fetch_assoc();
    } else {
      header('Location: manage-cars.php?status=error');
      exit();
    }
  } else {
    header('Location: manage-cars.php?status=error');
    exit();
  }

  // Handle form submission for updating car details
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $seat = $_POST['seat'];
    $price_per_day = $_POST['price_per_day'];
    $car_image = $_FILES['car_image']['name'];
    
    // Check if a new image is uploaded
    if ($car_image) {
      $target_dir = "../uploads/cars/";
      $target_file = $target_dir . basename($car_image);
      move_uploaded_file($_FILES['car_image']['tmp_name'], $target_file);
    } else {
      $target_file = $car['image_path']; // Retain the old image if no new image is uploaded
    }
    
    // Update car data in the database
    $update_sql = "UPDATE cars SET category = ?, brand = ?, model = ?, seat = ?, price_per_day = ?, image_path = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param('sssiisi', $category, $brand, $model, $seat, $price_per_day, $target_file, $car_id);
    
    if ($update_stmt->execute()) {
      header('Location: manage-cars.php?status=success');
      exit();
    } else {
      header('Location: manage-cars.php?status=error');
      exit();
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
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title text-center mb-4">Edit Car Details</h3>
                <form method="POST" action="edit-car.php?id=<?= $car_id; ?>" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?= htmlspecialchars($car['category']); ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" class="form-control" id="brand" name="brand" value="<?= htmlspecialchars($car['brand']); ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="<?= htmlspecialchars($car['model']); ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="seat" class="form-label">Seats</label>
                    <input type="number" class="form-control" id="seat" name="seat" value="<?= htmlspecialchars($car['seat']); ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="car_image" class="form-label">Car Image</label>
                    <input type="file" class="form-control" id="car_image" name="car_image">
                    <img src="<?= htmlspecialchars($car['image_path']); ?>" alt="Car Image" width="100" class="mt-2">
                  </div>
                  <div class="mb-3">
                    <label for="price_per_day" class="form-label">Price per Day</label>
                    <input type="number" class="form-control" id="price_per_day" name="price_per_day" value="<?= htmlspecialchars($car['price_per_day']); ?>" required>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
