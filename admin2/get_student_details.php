<?php
require_once '../../database/dbconnection.php';

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    try {
        $query = "SELECT id, surname, firstname, middlename, gender, birthplace, email, dob, street, city, province, zipcode, parentSurname, parentFirst, parentMiddle, parentPhone, parentEmail, parentOccupation, grade, status, created_at FROM students WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$studentId]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            echo json_encode($student);
        } else {
            echo json_encode(["error" => "Student not found"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "No student ID provided"]);
}
?>