<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit();
}
require_once '../../database/dbconnection.php';

// Handle Add News
if (isset($_POST['add_news'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $imagePath = null;

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../../uploads/news/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "uploads/news/" . $imageName;
        }
    }

    if ($title && $content) {
        $stmt = $pdo->prepare("INSERT INTO news (title, content, image, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$title, $content, $imagePath]);
        echo "<script>alert('News added!');window.location='news.php';</script>";
    }
}

// Handle Delete News
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
    $stmt->execute([$id]);
    echo "<script>alert('News deleted!');window.location='news.php';</script>";
}

// Handle Edit News
if (isset($_POST['edit_news'])) {
    $id = intval($_POST['news_id']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Handle image update
    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../../uploads/news/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "uploads/news/" . $imageName;
        }
    }

    if ($imagePath) {
        $stmt = $pdo->prepare("UPDATE news SET title=?, content=?, image=? WHERE id=?");
        $stmt->execute([$title, $content, $imagePath, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE news SET title=?, content=? WHERE id=?");
        $stmt->execute([$title, $content, $id]);
    }
    echo "<script>alert('News updated!');window.location='news.php';</script>";
}

// Handle Edit Main News
if (isset($_POST['edit_main_news'])) {
    $id = intval($_POST['main_news_id']);
    $title = trim($_POST['main_title']);
    $content = trim($_POST['main_content']);
    $imagePath = $_POST['existing_image'] ?? null;

    if (!empty($_FILES['main_image']['name'])) {
        $targetDir = "../../uploads/main_news/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = time() . '_' . basename($_FILES['main_image']['name']);
        $targetFile = $targetDir . $imageName;
        if (move_uploaded_file($_FILES['main_image']['tmp_name'], $targetFile)) {
            $imagePath = "uploads/main_news/" . $imageName;
        }
    }

    $stmt = $pdo->prepare("UPDATE main_news SET title=?, content=?, image=? WHERE id=?");
    $stmt->execute([$title, $content, $imagePath, $id]);
    echo "<script>alert('Main news updated!');window.location='news.php';</script>";
    exit();
}

// Handle Delete Main News
if (isset($_GET['delete_main'])) {
    $id = intval($_GET['delete_main']);
    $stmt = $pdo->prepare("DELETE FROM main_news WHERE id = ?");
    $stmt->execute([$id]);
    echo "<script>alert('Main news deleted!');window.location='news.php';</script>";
    exit();
}

// Handle Add Main News (from the form)
if (isset($_POST['save_main_news'])) {
    $title = trim($_POST['main_title']);
    $content = trim($_POST['main_content']);
    $imagePath = null;

    if (!empty($_FILES['main_image']['name'])) {
        $targetDir = "../../uploads/main_news/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = time() . '_' . basename($_FILES['main_image']['name']);
        $targetFile = $targetDir . $imageName;
        if (move_uploaded_file($_FILES['main_image']['tmp_name'], $targetFile)) {
            $imagePath = "uploads/main_news/" . $imageName;
        }
    }

    $stmt = $pdo->prepare("INSERT INTO main_news (title, content, image, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$title, $content, $imagePath]);
    echo "<script>alert('Main news added!');window.location='news.php';</script>";
    exit();
}

// Fetch all news
$news = $pdo->query("SELECT * FROM news ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Fetch current main news (only one row)
$mainNews = $pdo->query("SELECT * FROM main_news ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);

// Fetch all main news for listing
$mainNewsList = $pdo->query("SELECT * FROM main_news ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

function safeOutput($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin News</title>
  <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      
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
    .card {
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }
    .table {
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }
    .news-form input[type="text"], .news-form textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 8px;
      border: 1px solid #bbb;
      border-radius: 5px;
      font-family: inherit;
      font-size: 1rem;
    }
    .news-form button {
      background: #3498db;
      color: #fff;
      border: none;
      padding: 8px 18px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
      transition: background 0.2s;
    }
    .news-form button:hover {
      background: #217dbb;
    }
    .news-actions form {
      display: inline;
    }
    .news-actions button {
      background: #27ae60;
      color: #fff;
      border: none;
      padding: 4px 10px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.95rem;
      margin-right: 4px;
    }
    .news-actions button:hover {
      background: #219150;
    }
    .news-actions .delete-btn {
      background: #e74c3c;
    }
    .news-actions .delete-btn:hover {
      background: #c0392b;
    }
    @media (max-width: 900px) {
      .main-content { margin-left: 0; }
      .sidebar { position: static; width: 100%; }
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
    <h2 class="mb-4">Manage News</h2>
    <div class="card p-4 mb-4">
      <form method="post" class="news-form" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="News Title" required>
        <textarea name="content" placeholder="News Content" required rows="3"></textarea>
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="add_news">Add News</button>
      </form>
    </div>
    <div class="card p-4">
      <h4 class="mb-3">News List</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($news as $i => $item): ?>
          <tr>
            <td><?= $i+1 ?></td>
            <td><?= safeOutput($item['title']) ?></td>
            <td><?= safeOutput($item['content']) ?></td>
            <td>
              <?php if (!empty($item['image'])): ?>
                <img src="../../<?= safeOutput($item['image']) ?>" alt="News Image" style="max-width:80px;max-height:60px;">
              <?php else: ?>
                <span>No image</span>
              <?php endif; ?>
            </td>
            <td><?= safeOutput($item['created_at']) ?></td>
            <td class="news-actions">
              <!-- Edit Form -->
              <form method="post" style="display:inline;">
                <input type="hidden" name="news_id" value="<?= $item['id'] ?>">
                <input type="text" name="title" value="<?= safeOutput($item['title']) ?>" required style="width:100px;">
                <input type="text" name="content" value="<?= safeOutput($item['content']) ?>" required style="width:120px;">
                <?php if (!empty($item['image'])): ?>
                    <img src="../../<?= safeOutput($item['image']) ?>" alt="News Image" style="max-width:60px;max-height:40px;vertical-align:middle;">
                <?php endif; ?>
                <button type="submit" name="edit_news">Edit</button>
              </form>
              <!-- Delete Button -->
              <form method="get" style="display:inline;">
                <input type="hidden" name="delete" value="<?= $item['id'] ?>">
                <button type="submit" class="delete-btn" onclick="return confirm('Delete this news?')">Delete</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Main News Section -->
    <div class="card p-4 mb-4">
      <h4 class="mb-3">Main Highlighted News (Student Main Content)</h4>
      <form method="post" enctype="multipart/form-data">
        <div class="mb-2">
          <label class="form-label">Title</label>
          <input type="text" name="main_title" class="form-control" value="<?= htmlspecialchars($mainNews['title'] ?? '') ?>" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Content</label>
          <textarea name="main_content" class="form-control" rows="3" required><?= htmlspecialchars($mainNews['content'] ?? '') ?></textarea>
        </div>
        <div class="mb-2">
          <label class="form-label">Image</label>
          <input type="file" name="main_image" class="form-control" accept="image/*">
          <?php if (!empty($mainNews['image'])): ?>
            <div class="mt-2">
              <img src="../../<?= htmlspecialchars($mainNews['image']) ?>" alt="Main News Image" style="max-width:180px;">
            </div>
          <?php endif; ?>
        </div>
        <button type="submit" name="save_main_news" class="btn btn-primary">Save Main News</button>
      </form>
    </div>

    <!-- Main News List Section -->
    <div class="card p-4 mb-4">
      <h4 class="mb-3">Main News List</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($mainNewsList)) { echo "<div class='alert alert-warning'>No main news found.</div>"; } ?>
          <?php foreach ($mainNewsList as $i => $item): ?>
          <tr>
            <td><?= $i+1 ?></td>
            <td><?= safeOutput($item['title']) ?></td>
            <td><?= safeOutput($item['content']) ?></td>
            <td>
              <?php if (!empty($item['image'])): ?>
                <img src="../../<?= safeOutput($item['image']) ?>" alt="Main News Image" style="max-width:80px;max-height:60px;">
              <?php else: ?>
                <span>No image</span>
              <?php endif; ?>
            </td>
            <td><?= safeOutput($item['created_at']) ?></td>
            <td class="news-actions">
              <!-- Edit Form -->
              <form method="post" enctype="multipart/form-data" style="display:inline;">
                <input type="hidden" name="main_news_id" value="<?= $item['id'] ?>">
                <input type="text" name="main_title" value="<?= safeOutput($item['title']) ?>" required style="width:100px;">
                <input type="text" name="main_content" value="<?= safeOutput($item['content']) ?>" required style="width:120px;">
                <input type="hidden" name="existing_image" value="<?= safeOutput($item['image']) ?>">
                <input type="file" name="main_image" accept="image/*" style="width:120px;">
                <button type="submit" name="edit_main_news">Edit</button>
              </form>
              <!-- Delete Button -->
              <form method="get" style="display:inline;">
                <input type="hidden" name="delete_main" value="<?= $item['id'] ?>">
                <button type="submit" class="delete-btn" onclick="return confirm('Delete this main news?')">Delete</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>