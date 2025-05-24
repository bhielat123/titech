<?php
session_start();
include_once '../../database/dbconnection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Hardcoded email and password for testing
    $predefinedEmail = 'admin@example.com';
    $predefinedPassword = 'adminmasarap';

    if (!empty($email) && !empty($password)) {
        if ($email === $predefinedEmail && $password === $predefinedPassword) {
            // Set session variables for the predefined user
            $_SESSION['user_id'] = 1; // Example ID
            $_SESSION['user_email'] = $predefinedEmail;
            $_SESSION['user_role'] = 'admin';
            $_SESSION['user_name'] = 'Admin User';

            header("Location: dashboard.php");
            exit();
        } else {
            // Database check for other users
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ($password === $user['password']) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_role'] = $user['role'];
                    $_SESSION['user_name'] = $user['name'];

                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "User not found.";
            }
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
  <title>Admin Sign In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
  <style>
    body {
      min-height: 100vh;
      background-color: #f8f9fa;
    }
    .login-box {
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
    .password-wrapper {
      position: relative;
    }
    .toggle-password {
      cursor: pointer;
    }
    .admin-nav {
      margin-bottom: 30px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.04);
      padding: 10px 0;
      display: flex;
      justify-content: center;
      gap: 30px;
    }
    .admin-nav a {
      color: #0d6efd;
      font-weight: 500;
      text-decoration: none;
      font-size: 1.1rem;
      transition: color 0.2s;
    }
    .admin-nav a:hover {
      color: #0056b3;
      text-decoration: underline;
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center">

  <div class="login-box">
    <h3 class="text-center mb-4">Admin Login</h3>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" required>
      </div>

      <div class="mb-3 password-wrapper">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" name="password" class="form-control" id="password" required>
          <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePassword()">
            <i class="bi bi-eye"></i>
          </button>
        </div>
      </div>

      <div class="mb-3 text-end">
        <a href="forgotpassword.php" class="text-decoration-none">Forgot Password?</a>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Sign In</button>
      </div>
    </form>
  </div>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById('password');
      const toggleButton = document.querySelector('.toggle-password i');
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      toggleButton.classList.toggle('bi-eye');
      toggleButton.classList.toggle('bi-eye-slash');
    }
  </script>

</body>
</html>
