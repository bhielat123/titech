<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit();
}
require_once '../../database/dbconnection.php';

// Handle Add
if (isset($_POST['add_gallery'])) {
    $section = trim($_POST['section']);
    $caption = trim($_POST['caption']);
    $imagePath = null;

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../../images/$section/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "images/$section/" . $imageName;
        }
    }

    if ($section && $caption && $imagePath) {
        $stmt = $pdo->prepare("INSERT INTO gallery (section, image, caption) VALUES (?, ?, ?)");
        $stmt->execute([$section, $imagePath, $caption]);
        echo "<script>alert('Image added!');window.location='gallery.php';</script>";
        exit();
    }
}

// Handle Edit
if (isset($_POST['edit_gallery'])) {
    $id = intval($_POST['gallery_id']);
    $section = trim($_POST['section']);
    $caption = trim($_POST['caption']);
    $imagePath = $_POST['existing_image'];

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../../images/$section/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "images/$section/" . $imageName;
        }
    }

    $stmt = $pdo->prepare("UPDATE gallery SET section=?, image=?, caption=? WHERE id=?");
    $stmt->execute([$section, $imagePath, $caption, $id]);
    echo "<script>alert('Image updated!');window.location='gallery.php';</script>";
    exit();
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->execute([$id]);
    echo "<script>alert('Image deleted!');window.location='gallery.php';</script>";
    exit();
}

// Handle Add Batch
if (isset($_POST['add_gallery_batch'])) {
    $section = trim($_POST['section']);
    $captions = $_POST['captions'];
    $images = $_FILES['images'];

    for ($i = 0; $i < 3; $i++) {
        if (!empty($images['name'][$i])) {
            $caption = trim($captions[$i]);
            $targetDir = "../../images/$section/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $imageName = time() . '_' . basename($images['name'][$i]);
            $targetFile = $targetDir . $imageName;
            if (move_uploaded_file($images['tmp_name'][$i], $targetFile)) {
                $imagePath = "images/$section/" . $imageName;
                if ($caption && $imagePath) {
                    $stmt = $pdo->prepare("INSERT INTO gallery (section, image, caption) VALUES (?, ?, ?)");
                    $stmt->execute([$section, $imagePath, $caption]);
                }
            }
        }
    }
    echo "<script>alert('Images added!');window.location='gallery.php';</script>";
    exit();
}

// Rename Section
if (isset($_POST['rename_section'])) {
    $old = trim($_POST['old_section']);
    $new = trim($_POST['new_section']);
    if ($old && $new) {
        $stmt = $pdo->prepare("UPDATE gallery SET section=? WHERE section=?");
        $stmt->execute([$new, $old]);
        echo "<script>alert('Section renamed!');window.location='gallery.php';</script>";
        exit();
    }
}

// Add Section
if (isset($_POST['add_section'])) {
    $newSection = trim($_POST['new_section_name']);
    if ($newSection !== '') {
        // Only add if it doesn't already exist
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM gallery WHERE section=?");
        $stmt->execute([$newSection]);
        if ($stmt->fetchColumn() == 0) {
            // Insert a dummy row so the section appears (with no image/caption)
            $stmt = $pdo->prepare("INSERT INTO gallery (section, image, caption) VALUES (?, '', '')");
            $stmt->execute([$newSection]);
        }
        echo "<script>alert('Section added!');window.location='gallery.php';</script>";
        exit();
    }
}

// Fetch all unique sections (including renamed ones)
$sections = [];
$stmt = $pdo->query("SELECT DISTINCT section FROM gallery WHERE section != '' ORDER BY section ASC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sections[] = $row['section'];
}
if (empty($sections)) {
    $sections = ['1', '2', '3', '4']; // fallback if no images yet
}

// Fetch all gallery images for these sections
$gallery = $pdo->query("SELECT * FROM gallery WHERE section IN ('" . implode("','", $sections) . "') ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Gallery Management</title>
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
<body>

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
    <div class="card p-4">
        <h4 class="mb-3">Gallery List</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Section</th>
                    <th>Image</th>
                    <th>Caption</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gallery as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['section']) ?></td>
                    <td>
                        <img src="../../<?= htmlspecialchars($item['image']) ?>" alt="Gallery Image" style="max-width:80px;max-height:60px;">
                    </td>
                    <td><?= htmlspecialchars($item['caption']) ?></td>
                    <td>
                        <!-- Edit Form (inline) -->
                        <form method="post" enctype="multipart/form-data" style="display:inline;">
                            <input type="hidden" name="gallery_id" value="<?= $item['id'] ?>">
                            <input type="text" name="section" value="<?= htmlspecialchars($item['section']) ?>" style="width:80px;" required>
                            <input type="text" name="caption" value="<?= htmlspecialchars($item['caption']) ?>" style="width:120px;">
                            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($item['image']) ?>">
                            <input type="file" name="image" accept="image/*" style="width:120px;">
                            <button type="submit" name="edit_gallery" class="btn btn-success btn-sm">Edit</button>
                        </form>
                        <!-- Delete Button -->
                        <a href="?delete=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this image?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php foreach ($sections as $section): ?>
    <div class="card p-4 mb-4">
        <h4 class="mb-3">Section: <?= htmlspecialchars($section) ?></h4>
        <!-- Rename Section Form -->
        <form method="post" class="mb-3 d-flex align-items-center gap-2">
            <input type="hidden" name="old_section" value="<?= htmlspecialchars($section) ?>">
            <input type="text" name="new_section" class="form-control" placeholder="New section title" required style="max-width:200px;">
            <button type="submit" name="rename_section" class="btn btn-warning btn-sm">Rename Section</button>
        </form>
        <!-- Add Images Form -->
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="section" value="<?= htmlspecialchars($section) ?>">
            <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="mb-2 border rounded p-2">
                <label class="form-label">Image <?= $i ?></label>
                <input type="file" name="images[]" class="form-control mb-1" accept="image/*">
                <label class="form-label">Caption <?= $i ?></label>
                <input type="text" name="captions[]" class="form-control" placeholder="Caption for image <?= $i ?>">
            </div>
            <?php endfor; ?>
            <button type="submit" name="add_gallery_batch" class="btn btn-primary">Add Images to Section <?= htmlspecialchars($section) ?></button>
        </form>
    </div>
    <?php endforeach; ?>

    <!-- Add Section Form -->
    <div class="card p-4 mb-4">
        <h4 class="mb-3">Add New Section</h4>
        <form method="post" class="d-flex align-items-center gap-2">
            <input type="text" name="new_section_name" class="form-control" placeholder="Section name (e.g. Graduation)" required style="max-width:250px;">
            <button type="submit" name="add_section" class="btn btn-success btn-sm">Add Section</button>
        </form>
    </div>
</div>
</body>
</html>