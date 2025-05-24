<?php
require_once '../../database/dbconnection.php';

// --- Mission & Vision CRUD ---
if (isset($_POST['add_mv'])) {
    $type = $_POST['type'];
    $content = trim($_POST['content']);
    if ($type && $content) {
        $stmt = $pdo->prepare("INSERT INTO about_mission_vision (type, content) VALUES (?, ?)");
        $stmt->execute([$type, $content]);
    }
}
if (isset($_POST['edit_mv'])) {
    $id = intval($_POST['mv_id']);
    $content = trim($_POST['content']);
    $stmt = $pdo->prepare("UPDATE about_mission_vision SET content=? WHERE id=?");
    $stmt->execute([$content, $id]);
}
if (isset($_GET['delete_mv'])) {
    $id = intval($_GET['delete_mv']);
    $stmt = $pdo->prepare("DELETE FROM about_mission_vision WHERE id=?");
    $stmt->execute([$id]);
}

// --- Calendar Events CRUD ---
if (isset($_POST['add_event'])) {
    $title = trim($_POST['title']);
    $event_date = $_POST['event_date'];
    $desc = trim($_POST['description']);
    if ($title && $event_date) {
        $stmt = $pdo->prepare("INSERT INTO about_calendar_events (title, event_date, description) VALUES (?, ?, ?)");
        $stmt->execute([$title, $event_date, $desc]);
    }
}
if (isset($_POST['edit_event'])) {
    $id = intval($_POST['event_id']);
    $title = trim($_POST['title']);
    $event_date = $_POST['event_date'];
    $desc = trim($_POST['description']);
    $stmt = $pdo->prepare("UPDATE about_calendar_events SET title=?, event_date=?, description=? WHERE id=?");
    $stmt->execute([$title, $event_date, $desc, $id]);
}
if (isset($_GET['delete_event'])) {
    $id = intval($_GET['delete_event']);
    $stmt = $pdo->prepare("DELETE FROM about_calendar_events WHERE id=?");
    $stmt->execute([$id]);
}

// Fetch data
$missions = $pdo->query("SELECT * FROM about_mission_vision WHERE type='mission'")->fetchAll(PDO::FETCH_ASSOC);
$visions = $pdo->query("SELECT * FROM about_mission_vision WHERE type='vision'")->fetchAll(PDO::FETCH_ASSOC);
$events = $pdo->query("SELECT * FROM about_calendar_events ORDER BY event_date ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin About Us Management</title>
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
    .main-content {
  margin-left: 250px;
  padding: 30px;
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

<!-- Main content with margin to avoid sidebar overlap -->
<div class="main-content">
    <div class="container my-4">
        <h2>Mission & Vision Management</h2>
        <div class="row">
            <div class="col-md-6">
                <h4>Missions</h4>
                <form method="post" class="mb-3">
                    <input type="hidden" name="type" value="mission">
                    <textarea name="content" class="form-control mb-2" placeholder="Add new mission..." required></textarea>
                    <button type="submit" name="add_mv" class="btn btn-primary btn-sm">Add Mission</button>
                </form>
                <?php foreach ($missions as $mv): ?>
                <form method="post" class="mb-2 d-flex align-items-center">
                    <input type="hidden" name="mv_id" value="<?= $mv['id'] ?>">
                    <textarea name="content" class="form-control me-2" required><?= htmlspecialchars($mv['content']) ?></textarea>
                    <button type="submit" name="edit_mv" class="btn btn-success btn-sm me-1">Save</button>
                    <a href="?delete_mv=<?= $mv['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this mission?')">Delete</a>
                </form>
                <?php endforeach; ?>
            </div>
            <div class="col-md-6">
                <h4>Visions</h4>
                <form method="post" class="mb-3">
                    <input type="hidden" name="type" value="vision">
                    <textarea name="content" class="form-control mb-2" placeholder="Add new vision..." required></textarea>
                    <button type="submit" name="add_mv" class="btn btn-primary btn-sm">Add Vision</button>
                </form>
                <?php foreach ($visions as $mv): ?>
                <form method="post" class="mb-2 d-flex align-items-center">
                    <input type="hidden" name="mv_id" value="<?= $mv['id'] ?>">
                    <textarea name="content" class="form-control me-2" required><?= htmlspecialchars($mv['content']) ?></textarea>
                    <button type="submit" name="edit_mv" class="btn btn-success btn-sm me-1">Save</button>
                    <a href="?delete_mv=<?= $mv['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this vision?')">Delete</a>
                </form>
                <?php endforeach; ?>
            </div>
        </div>

        <hr class="my-4">

        <h2>Calendar Events Management</h2>
        <form method="post" class="mb-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="title" class="form-control" placeholder="Event Title" required>
                </div>
                <div class="col-md-3">
                    <input type="date" name="event_date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="description" class="form-control" placeholder="Description">
                </div>
                <div class="col-md-2">
                    <button type="submit" name="add_event" class="btn btn-primary w-100">Add Event</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <form method="post">
                        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                        <td><input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" class="form-control" required></td>
                        <td><input type="date" name="event_date" value="<?= $event['event_date'] ?>" class="form-control" required></td>
                        <td><input type="text" name="description" value="<?= htmlspecialchars($event['description']) ?>" class="form-control"></td>
                        <td>
                            <button type="submit" name="edit_event" class="btn btn-success btn-sm">Save</button>
                            <a href="?delete_event=<?= $event['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this event?')">Delete</a>
                        </td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>