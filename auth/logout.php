<?php
  session_start();
  session_unset(); // Unset all session variables
  session_destroy(); // Destroy the session
  header('Location: /car-rental-service/index.php'); // Redirect to homepage
  exit();
?>
