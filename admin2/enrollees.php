<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit();
}

require_once '../../database/dbconnection.php';

// Fetch total enrollees, pending, and accepted counts
$totalEnrollees = 0;
$totalPending = 0;
$totalAccepted = 0;

try {
    $query = "SELECT COUNT(*) AS total, SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS pending, SUM(CASE WHEN status = 'Accepted' THEN 1 ELSE 0 END) AS accepted FROM enrollment";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $totalEnrollees = $result['total'];
    $totalPending = $result['pending'];
    $totalAccepted = $result['accepted'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function safeOutput($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Enrollees</title>
  <link rel="shortcut icon" href="../../images/wrlogo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
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
    <h2 class="mb-4">Enrollees Overview</h2>
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card text-white bg-primary shadow">
          <div class="card-body" style="cursor:pointer" onclick="filterEnrollees('All')">
            <h5 class="card-title">Total Enrollees</h5>
            <p class="card-text fs-4"><?php echo $totalEnrollees; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-warning shadow">
          <div class="card-body" style="cursor:pointer" onclick="filterEnrollees('Pending')">
            <h5 class="card-title">Pending</h5>
            <p class="card-text fs-4"><?php echo $totalPending; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-success shadow">
          <div class="card-body" style="cursor:pointer" onclick="filterEnrollees('Accepted')">
            <h5 class="card-title">Accepted</h5>
            <p class="card-text fs-4"><?php echo $totalAccepted; ?></p>
          </div>
        </div>
      </div>
    </div>

    <h3 class="mt-5">Enrollees List</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        try {
            $query = "SELECT id, CONCAT(firstname, ' ', middlename, ' ', surname) AS name, email, status FROM enrollment ORDER BY id ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . safeOutput($row['id']) . "</td>";
                echo "<td>" . safeOutput($row['name']) . "</td>";
                echo "<td>" . safeOutput($row['email']) . "</td>";
                echo "<td>" . safeOutput($row['status']) . "</td>";
                echo "<td>";
                echo "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#detailsModal' data-id='" . $row['id'] . "'>View Details</button> ";
                if ($row['status'] === 'Pending') {
                    echo "<button class='btn btn-success btn-sm' onclick='acceptEnrollee(" . $row['id'] . ")'>Accept</button> ";
                    echo "<button class='btn btn-danger btn-sm' onclick='declineEnrollee(" . $row['id'] . ")'>Decline</button>";
                } elseif ($row['status'] === 'Accepted') {
                    echo "<span class='badge bg-success'>Accepted</span>";
                } elseif ($row['status'] === 'Declined') {
                    echo "<span class='badge bg-danger'>Declined</span>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <!-- Modal for viewing enrollee details -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailsModalLabel">Enrollee Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><strong>Name:</strong> <span id="enrolleeName"></span></p>
            <p><strong>Email:</strong> <span id="enrolleeEmail"></span></p>
            <p><strong>Status:</strong> <span id="enrolleeStatus"></span></p>
            <p><strong>Gender:</strong> <span id="enrolleeGender"></span></p>
            <p><strong>Birthplace:</strong> <span id="enrolleeBirthplace"></span></p>
            <p><strong>Date of Birth:</strong> <span id="enrolleeDob"></span></p>
            <p><strong>Address:</strong> <span id="enrolleeAddress"></span></p>
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

    <script>
      const detailsModal = document.getElementById('detailsModal');
      detailsModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const enrolleeId = button.getAttribute('data-id');

        // Fetch enrollee details via AJAX
        fetch(`get_enrollee_details.php?id=${enrolleeId}`)
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              document.getElementById('enrolleeName').textContent = data.name;
              document.getElementById('enrolleeEmail').textContent = data.email;
              document.getElementById('enrolleeStatus').textContent = data.status;
              document.getElementById('enrolleeGender').textContent = data.gender;
              document.getElementById('enrolleeBirthplace').textContent = data.birthplace;
              document.getElementById('enrolleeDob').textContent = data.dob;
              document.getElementById('enrolleeAddress').textContent = `${data.street}, ${data.city}, ${data.province}, ${data.zipcode}`;
              document.getElementById('parentName').textContent = `${data.parentFirst} ${data.parentMiddle} ${data.parentSurname}`;
              document.getElementById('parentPhone').textContent = data.parentPhone;
              document.getElementById('parentEmail').textContent = data.parentEmail;
              document.getElementById('parentOccupation').textContent = data.parentOccupation;
            } else {
              alert('Error fetching enrollee details: ' + data.error);
            }
          })
          .catch(error => {
            alert('An error occurred while fetching enrollee details.');
          });
      });

      function showConfirmationModal(title, message, callback) {
        const modalHtml = `
          <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="confirmationModalLabel">${title}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ${message}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" id="confirmAction">Confirm</button>
                </div>
              </div>
            </div>
          </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHtml);
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();

        document.getElementById('confirmAction').addEventListener('click', () => {
          callback();
          modal.hide();
          document.getElementById('confirmationModal').remove();
        });

        document.getElementById('confirmationModal').addEventListener('hidden.bs.modal', () => {
          document.getElementById('confirmationModal').remove();
        });
      }

      function acceptEnrollee(id) {
        showConfirmationModal('Accept Enrollee', 'Are you sure you want to accept this enrollee?', () => {
          fetch(`accept_enrollee.php?id=${id}`, { method: 'POST' })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                alert('Enrollee accepted successfully.');
                location.reload();
              } else {
                alert('Error: ' + data.error);
              }
            })
            .catch(error => {
              alert('An error occurred while accepting the enrollee.');
            });
        });
      }

      function declineEnrollee(id) {
        showConfirmationModal(
          'Decline Enrollee',
          `<div>
            <p>Are you sure you want to decline this enrollee?</p>
            <label for="declineReason" class="form-label">Reason for declining:</label>
            <select id="declineReason" class="form-select" required>
              <option value="">-- Select reason --</option>
              <option value="Slot full for this SY">Slot full for this SY</option>
              <option value="Not Taguig resident">Not Taguig resident</option>
              <option value="Double application">Double application</option>
              <option value="Incomplete information">Incomplete information</option>
              <option value="Other">Other (please specify)</option>
            </select>
            <input type="text" id="otherReason" class="form-control mt-2" placeholder="Enter other reason" style="display:none;">
          </div>`,
          () => {
            const reasonSelect = document.getElementById('declineReason');
            let reason = reasonSelect.value;
            const otherReasonInput = document.getElementById('otherReason');
            if (!reason) {
              alert('Please select a reason for declining.');
              return;
            }
            if (reason === 'Other') {
              if (!otherReasonInput.value.trim()) {
                alert('Please specify the reason.');
                return;
              }
              reason = otherReasonInput.value.trim();
            }
            fetch(`decline_enrollee.php?id=${id}`, {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ reason })
            })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  alert('Enrollee declined and notified by email.');
                  location.reload();
                } else {
                  alert('Error: ' + data.error);
                }
              })
              .catch(error => {
                alert('An error occurred while declining the enrollee.');
              });
          }
        );

        // Show/hide the "Other" textbox based on selection
        setTimeout(() => {
          const reasonSelect = document.getElementById('declineReason');
          const otherReasonInput = document.getElementById('otherReason');
          reasonSelect.addEventListener('change', function () {
            if (this.value === 'Other') {
              otherReasonInput.style.display = '';
            } else {
              otherReasonInput.style.display = 'none';
            }
          });
        }, 200);
      }

      function filterEnrollees(status) {
        const rows = document.querySelectorAll('table.table-striped tbody tr');
        rows.forEach(row => {
          const statusCell = row.children[3]; // 4th column is Status
          if (status === 'All' || statusCell.textContent.trim() === status) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </div>
</body>
</html>