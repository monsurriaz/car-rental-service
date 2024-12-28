<?php
  include '../auth/session.php';
  include '../includes/db.php';

  // Check if the form is submitted
  if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Update the user role to 'admin'
    $sql = "UPDATE users SET role = 'admin' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
      header('Location: manage-customers.php?status=success');
      exit();
    } else {
      header('Location: manage-customers.php?status=error');
      exit();
    }
  } else {
    header('Location: manage-customers.php?status=error');
    exit();
  }
?>
