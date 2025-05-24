<?php
session_start();
include_once '../../database/dbconnection.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch totals
$totalStudents = $pdo->query("SELECT COUNT(*) AS count FROM students")->fetch(PDO::FETCH_ASSOC)['count'];
$totalEnrollees = $pdo->query("SELECT COUNT(*) AS count FROM enrollment")->fetch(PDO::FETCH_ASSOC)['count'];
$totalFeedback = $pdo->query("SELECT COUNT(*) AS count FROM contactus")->fetch(PDO::FETCH_ASSOC)['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      color: white;
      position: fixed;
      width: 250px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .sidebar a {
      color: white;
      padding: 15px;
      display: block;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .main-content {
      margin-left: 250px;
      padding: 30px;
    }
    .logo {
      font-size: 24px;
      font-weight: bold;
      padding: 20px;
      text-align: center;
      border-bottom: 1px solid #495057;
    }
    .logout {
      padding: 15px;
      border-top: 1px solid #495057;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div>
      <div class="logo">
        <img src="../../images/wrlogo.png" alt="Logo" width="40"><br>
        Admin
      </div>
      <a href="dashboard.php">🏠 Dashboard</a>
      <a href="students.php">👨‍🎓 Students</a>
      <a href="enrollees.php">📝 Enrollees</a>
      <a href="news.php">📰 News</a>
      <a href="gallery.php">🖼️ Gallery</a>
      <a href="aboutus.php">ℹ️ About Us</a>
      <a href="faculty.php">👩‍🏫 Faculty</a>
      <a href="emails.php">✉️ Emails</a>
    </div>
    <div class="logout">
      <a href="logout.php" class="text-danger">🚪 Logout</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h2 class="mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>

    <div class="row">
      <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary shadow">
          <div class="card-body" style="cursor:pointer" onclick="window.location.href='emails.php'">
            <h5 class="card-title">Feedback</h5>
            <p class="card-text fs-4"><?php echo $totalFeedback; ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="card text-white bg-success shadow">
          <div class="card-body" style="cursor:pointer" onclick="window.location.href='enrollees.php'">
            <h5 class="card-title">Enrollees</h5>
            <p class="card-text fs-4"><?php echo $totalEnrollees; ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="card text-white bg-warning shadow">
          <div class="card-body" style="cursor:pointer" onclick="window.location.href='students.php'">
            <h5 class="card-title">Students</h5>
            <p class="card-text fs-4"><?php echo $totalStudents; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
