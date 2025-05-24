<?php
require_once '../../database/dbconnection.php';

header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("SELECT name, email, phone, message, status, created_at FROM contactus WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    echo json_encode($row);
} else {
    echo json_encode([]);
}
?>

