<?php
  include '../includes/db.php';  // Include the DB connection

  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get car details from the form
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $seat = $_POST['seat'];
    $price = $_POST['price_per_day'];
    $imagePath = "";

    // Handle image upload
    if (isset($_FILES['car_image'])) {
      $targetDir = "../uploads/cars/";
      $fileName = basename($_FILES['car_image']['name']);
      $targetFilePath = $targetDir . $fileName;

      // Check file type
      $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
      $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

      if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['car_image']['tmp_name'], $targetFilePath)) {
          // Save file path in the database
          $imagePath = $targetFilePath;
        } else {
          // Redirect with error if file upload fails
          header("Location: manage-cars.php?status=error");
          exit;
        }
      } else {
        // Redirect with error if file type is invalid
        header("Location: manage-cars.php?status=error");
        exit;
      }
    } else {
      // Redirect with error if no image uploaded
      header("Location: manage-cars.php?status=error");
      exit;
    }

    // Insert car data into the database
    $stmt = $conn->prepare("INSERT INTO cars (category, brand, model, seat, image_path, price_per_day) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdss", $category, $brand, $model, $seat, $imagePath, $price);

    if ($stmt->execute()) {
      // Redirect with success message
      header("Location: manage-cars.php?status=success");
      exit;
    } else {
      // Redirect with error if insertion fails
      header("Location: manage-cars.php?status=error");
      exit;
    }
  }
?>
