<?php 
  include '../auth/session.php';
  include '../includes/db.php';

  // Check if booking ID is provided in the URL
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: bookings.php?status=error');
    exit;
  }

  $booking_id = $_GET['id'];

  // Delete the booking from the database
  $deleteQuery = "DELETE FROM bookings WHERE id = $booking_id";
  if ($conn->query($deleteQuery) === TRUE) {
    header('Location: bookings.php?status=success');
    exit;
  } else {
    header('Location: bookings.php?status=error');
    exit;
  }
?>
