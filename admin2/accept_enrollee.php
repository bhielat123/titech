<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../database/dbconnection.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'error' => 'No enrollee ID provided.']);
    exit;
}

$id = intval($_GET['id']);

try {
    // Get enrollee info
    $stmt = $pdo->prepare("SELECT email, firstname FROM enrollment WHERE id = ?");
    $stmt->execute([$id]);
    $enrollee = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$enrollee) {
        echo json_encode(['success' => false, 'error' => 'Enrollee not found.']);
        exit;
    }

    // Update status to Accepted
    $stmt = $pdo->prepare("UPDATE enrollment SET status = 'Accepted' WHERE id = ?");
    $stmt->execute([$id]);

    // Prepare email
    $to = $enrollee['email'];
    $subject = "Enrollment Accepted - West Rembo Learning Center";
    $message = "Dear " . htmlspecialchars($enrollee['firstname']) . ",\n\nCongratulations! Your enrollment has been accepted. Please wait for further instructions from the school.\n\nThank you!";

    // PHPMailer
    require_once __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
    require_once __DIR__ . '/../PHPMailer-master/src/SMTP.php';
    require_once __DIR__ . '/../PHPMailer-master/src/Exception.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hannahbalite178@gmail.com'; // Your Gmail address
        $mail->Password = 'efyx nwju nzfy cvpt';   // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('hannahbalite178@gmail.com', 'West Rembo Learning Center');
        $mail->addAddress($to, $enrollee['firstname']);

        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Status updated, but failed to send email. Mailer Error: ' . $mail->ErrorInfo]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>