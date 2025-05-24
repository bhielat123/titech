<?php
// Include the database connection
include_once '../../database/dbconnection.php';

// Handle the form submission for forgot password
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (!empty($email)) {
        // Check if the email exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Generate a unique reset token
            $resetToken = bin2hex(random_bytes(16));
            $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Store the token in the database
            $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $resetToken, $expiresAt);
            $stmt->execute();

            // Send the reset link via email
            $resetLink = "http://localhost/wrtclc_1/php/admin2/resetpassword.php?token=$resetToken";
            $subject = "Password Reset Request";
            $message = "Click the following link to reset your password: $resetLink\n\nThis link will expire in 1 hour.";
            $headers = "From: no-reply@yourdomain.com";

            if (mail($email, $subject, $message, $headers)) {
                $successMessage = "If the email exists in our records, a password reset link will be sent shortly.";
            } else {
                $errorMessage = "Failed to send the reset email. Please try again later.";
            }
        } else {
            $errorMessage = "No user found with this email address.";
        }
    } else {
        $errorMessage = "Please provide your email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      min-height: 100vh;
      background-color: #f8f9fa;
    }
    .forgot-password-box {
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center">

  <div class="forgot-password-box">
    <h3 class="text-center mb-4">Forgot Password</h3>

    <?php if (!empty($successMessage)): ?>
      <div class="alert alert-success"><?php echo htmlspecialchars($successMessage); ?></div>
    <?php endif; ?>

    <?php if (!empty($errorMessage)): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-3">
        <label for="email" class="form-label">Enter your email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Send Reset Link</button>
      </div>
    </form>
    <div class="d-grid mt-3">
      <a href="index.php" class="btn btn-secondary">Go Back to Login</a>
    </div>
  </div>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>