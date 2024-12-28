<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  // Redirect if not logged in
  if (!isset($_SESSION['user_id'])) {
    header('Location: /car-rental-service/auth/login.php');
    exit();
  }

  // Check if the page is admin-specific and user is not admin
  if (isset($is_admin_page) && $is_admin_page === true && $_SESSION['role'] !== 'admin') {
    header('Location: /car-rental-service/index.php'); // Redirect to homepage
    exit();
  }
?>
