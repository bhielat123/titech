<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit();
}

require_once '../../database/dbconnection.php';

// Fetch total students, male, and female counts
$totalStudents = 0;
$totalMale = 0;
$totalFemale = 0;

try {
    $query = "SELECT COUNT(*) AS total, SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS male, SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS female FROM students";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $totalStudents = $result['total'];
    $totalMale = $result['male'];
    $totalFemale = $result['female'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
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
          <div class="card-body" style="cursor:pointer" onclick="filterStudents('All')">
            <h5 class="card-title">Total Students</h5>
            <p class="card-text fs-4"><?php echo $totalStudents; ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="card text-white bg-success shadow">
          <div class="card-body" style="cursor:pointer" onclick="filterStudents('Male')">
            <h5 class="card-title">Male Students</h5>
            <p class="card-text fs-4"><?php echo $totalMale; ?></p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-3">
        <div class="card text-white bg-warning shadow">
          <div class="card-body" style="cursor:pointer" onclick="filterStudents('Female')">
            <h5 class="card-title">Female Students</h5>
            <p class="card-text fs-4"><?php echo $totalFemale; ?></p>
          </div>
        </div>
      </div>
    </div>


    <h3 class="mt-5">Student List</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        try {
            $query = "SELECT id, surname, firstname, middlename, gender FROM students";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['surname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                echo "<td><button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#studentModal' data-id='" . $row['id'] . "'>View Details</button></td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Modal for viewing student details -->
  <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="studentModalLabel">Student Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Name:</strong> <span id="studentName"></span></p>
          <p><strong>Gender:</strong> <span id="studentGender"></span></p>
          <p><strong>Birthplace:</strong> <span id="studentBirthplace"></span></p>
          <p><strong>Email:</strong> <span id="studentEmail"></span></p>
          <p><strong>Date of Birth:</strong> <span id="studentDob"></span></p>
          <p><strong>Address:</strong> <span id="studentAddress"></span></p>
          <p><strong>Parent Details:</strong></p>
          <ul>
            <li><strong>Name:</strong> <span id="parentName"></span></li>
            <li><strong>Phone:</strong> <span id="parentPhone"></span></li>
            <li><strong>Email:</strong> <span id="parentEmail"></span></li>
            <li><strong>Occupation:</strong> <span id="parentOccupation"></span></li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const studentModal = document.getElementById('studentModal');
    studentModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const studentId = button.getAttribute('data-id');

      // Fetch student details via AJAX
      fetch(`get_student_details.php?id=${studentId}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('studentName').textContent = `${data.surname}, ${data.firstname} ${data.middlename}`;
          document.getElementById('studentGender').textContent = data.gender;
          document.getElementById('studentBirthplace').textContent = data.birthplace;
          document.getElementById('studentEmail').textContent = data.email;
          document.getElementById('studentDob').textContent = data.dob;
          document.getElementById('studentAddress').textContent = `${data.street}, ${data.city}, ${data.province}, ${data.zipcode}`;
          document.getElementById('parentName').textContent = `${data.parentSurname}, ${data.parentFirst} ${data.parentMiddle}`;
          document.getElementById('parentPhone').textContent = data.parentPhone;
          document.getElementById('parentEmail').textContent = data.parentEmail;
          document.getElementById('parentOccupation').textContent = data.parentOccupation;
        });
    });

    function filterStudents(gender) {
      const rows = document.querySelectorAll('table.table-striped tbody tr');
      rows.forEach(row => {
        const genderCell = row.children[2]; // 3rd column is Gender
        if (gender === 'All' || genderCell.textContent.trim() === gender) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }
  </script>

</body>
</html>
