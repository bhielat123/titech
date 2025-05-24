<?php
require_once '../../database/dbconnection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $query = "SELECT CONCAT(firstname, ' ', middlename, ' ', surname) AS name, email, status, gender, birthplace, dob, street, city, province, zipcode, parentSurname, parentFirst, parentMiddle, parentPhone, parentEmail, parentOccupation FROM enrollment WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $enrollee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($enrollee) {
            echo json_encode(['success' => true] + $enrollee);
        } else {
            echo json_encode(['success' => false, 'error' => 'Enrollee not found']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>