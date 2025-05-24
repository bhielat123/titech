<?php
require_once '../../database/dbconnection.php';

// Add Faculty
if (isset($_POST['add_faculty'])) {
    $name = trim($_POST['name']);
    $imagePath = '';
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../../images/Faculty/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "images/Faculty/" . $imageName;
        }
    }
    if ($name && $imagePath) {
        $stmt = $pdo->prepare("INSERT INTO faculty (name, image) VALUES (?, ?)");
        $stmt->execute([$name, $imagePath]);
        echo "<script>alert('Faculty added!');window.location='faculty.php';</script>";
        exit();
    }
}

// Edit Faculty
if (isset($_POST['edit_faculty'])) {
    $id = intval($_POST['faculty_id']);
    $name = trim($_POST['name']);
    $imagePath = $_POST['existing_image'];
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../../images/Faculty/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "images/Faculty/" . $imageName;
        }
    }
    $stmt = $pdo->prepare("UPDATE faculty SET name=?, image=? WHERE id=?");
    $stmt->execute([$name, $imagePath, $id]);
    echo "<script>alert('Faculty updated!');window.location='faculty.php';</script>";
    exit();
}

// Delete Faculty
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM faculty WHERE id=?");
    $stmt->execute([$id]);
    echo "<script>alert('Faculty deleted!');window.location='faculty.php';</script>";
    exit();
}

// Fetch all faculty
$facultyList = $pdo->query("SELECT * FROM faculty ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Faculty Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
      top: 0;
      left: 0;
      z-index: 1000;
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
<body class="p-4">

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

  <div class="main-content">
    <h2>Faculty Management</h2>
    <div class="card p-4 mb-4">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-2">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Photo</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" name="add_faculty" class="btn btn-primary">Add Faculty</button>
        </form>
    </div>
    <div class="card p-4">
        <h4 class="mb-3">Faculty List</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($facultyList as $faculty): ?>
                <tr>
                    <td>
                        <img src="../../<?= htmlspecialchars($faculty['image']) ?>" alt="Faculty Photo" style="max-width:80px;max-height:80px;">
                    </td>
                    <td><?= htmlspecialchars($faculty['name']) ?></td>
                    <td>
                        <!-- Edit Form (inline) -->
                        <form method="post" enctype="multipart/form-data" style="display:inline;">
                            <input type="hidden" name="faculty_id" value="<?= $faculty['id'] ?>">
                            <input type="text" name="name" value="<?= htmlspecialchars($faculty['name']) ?>" style="width:120px;" required>
                            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($faculty['image']) ?>">
                            <input type="file" name="image" accept="image/*" style="width:120px;">
                            <button type="submit" name="edit_faculty" class="btn btn-success btn-sm">Edit</button>
                        </form>
                        <!-- Delete Button -->
                        <a href="?delete=<?= $faculty['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this faculty?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>