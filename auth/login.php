<?php
  include '../includes/db.php';
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
        
        if ($user['role'] === 'admin') {
          header("Location: ../admin/dashboard.php");
        }
        else if (isset($_GET['redirect'])) {
          // Redirect to the car details page with the car ID
          header('Location: ' . $_GET['redirect'] . '?id=' . $_GET['id']);
          exit;
        } else {
          header("Location: ../customer/dashboard.php");
        }
      } else {
        echo "Invalid credentials";
      }
    } else {
      echo "No user found";
    }
  }
?>

<?php include '../includes/header.php'; ?>

<section class="login space min-height">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title text-center">Login</h3>
            <form method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
              </div>
              <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
            <p class="text-center">Don't have an account? <a href="signup.php">Sign up here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
