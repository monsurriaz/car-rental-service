<?php
  session_start();
  include '../includes/db.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in
    $car_id = $_POST['car_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $pickup_time = $_POST['pickup_time'];

    // Insert booking into the database
    $query = "INSERT INTO bookings (user_id, car_id, start_date, end_date, pickup_time, status) 
              VALUES ($user_id, $car_id, '$start_date', '$end_date', '$pickup_time', 'Pending')";

    if ($conn->query($query) === TRUE) {
      header('Location: car-details.php?id=' . $car_id . '&status=success');
    } else {
      header('Location: car-details.php?id=' . $car_id . '&status=error');
    }
  } else {
    header('Location: cars.php');
  }
?>
