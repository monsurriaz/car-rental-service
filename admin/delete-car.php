<?php
  include '../auth/session.php';
  include '../includes/db.php';

  // Check if 'id' is passed in the URL
  if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Delete car from the database
    $sql = "DELETE FROM cars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $car_id);

    if ($stmt->execute()) {
      header('Location: manage-cars.php?status=success');
      exit();
    } else {
      header('Location: manage-cars.php?status=error');
      exit();
    }
  } else {
    header('Location: manage-cars.php?status=error');
    exit();
  }
?>
