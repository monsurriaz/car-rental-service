<?php
  $is_admin_page = true;
  include '../auth/session.php';
  include '../includes/db.php';

  $result = $conn->query("SELECT * FROM cars");
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
              <a class="nav-link active" href="/car-rental-service/admin/manage-cars.php">
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

          <!-- Car List Table -->
          <div class="row justify-content-center mb-5">
            <div class="col-md-10">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title text-center mb-4">All Cars</h3>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Seats</th>
                        <th>Price per Day</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                          <td><img src="<?= htmlspecialchars($row['image_path']); ?>" alt="Car Image" width="100"></td>
                          <td><?= htmlspecialchars($row['category']); ?></td>
                          <td><?= htmlspecialchars($row['brand']); ?></td>
                          <td><?= htmlspecialchars($row['model']); ?></td>
                          <td><?= htmlspecialchars($row['seat']); ?></td>
                          <td><?= htmlspecialchars($row['price_per_day']); ?> BDT</td>
                          <td>
                            <!-- You can add Edit or Delete buttons here -->
                            <a href="edit-car.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete-car.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Car insert form -->
          <div class="row justify-content-center">
            <div class="col-md-10">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title text-center mb-4">Car Information Form</h3>
                  <form method="POST" action="insert-car.php" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="category" class="form-label">Category</label>
                      <input type="text" class="form-control" id="category" name="category" placeholder="Enter category" required>
                    </div>
                    <div class="mb-3">
                      <label for="brand" class="form-label">Brand</label>
                      <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter brand" required>
                    </div>
                    <div class="mb-3">
                      <label for="model" class="form-label">Model</label>
                      <input type="text" class="form-control" id="model" name="model" placeholder="Enter model" required>
                    </div>
                    <div class="mb-3">
                      <label for="seat" class="form-label">Seats</label>
                      <input type="number" class="form-control" id="seat" name="seat" placeholder="Enter number of seats" required>
                    </div>
                    <div class="mb-3">
                      <label for="car_image" class="form-label">Car Image</label>
                      <input type="file" class="form-control" id="car_image" name="car_image" required>
                    </div>
                    <div class="mb-3">
                      <label for="price_per_day" class="form-label">Price per Day</label>
                      <input type="number" class="form-control" id="price_per_day" name="price_per_day" placeholder="Enter price per day" required>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>