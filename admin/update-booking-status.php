<?php
  // Include the database connection
  include '../includes/db.php';

  // Check if form data is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $status = $_POST['status'];

    // Update the booking status
    $sql = "UPDATE bookings SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $booking_id);

    if ($stmt->execute()) {
      // Redirect back to the bookings page with a success message
      header("Location: manage-bookings.php?status=success");
      exit;
    } else {
      // Redirect back with an error message
      header("Location: manage-bookings.php?status=error");
      exit;
    }
  }
?>
