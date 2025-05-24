<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../database/dbconnection.php';
require_once __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/../PHPMailer-master/src/Exception.php';

header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$data = json_decode(file_get_contents('php://input'), true);
$reason = $data['reason'] ?? '';

if (!$id || !$reason) {
    echo json_encode(['success' => false, 'error' => 'Missing enrollee ID or reason.']);
    exit;
}

try {
    // Get enrollee info
    $stmt = $pdo->prepare("SELECT email, firstname FROM enrollment WHERE id = ?");
    $stmt->execute([$id]);
    $enrollee = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$enrollee) {
        echo json_encode(['success' => false, 'error' => 'Enrollee not found.']);
        exit;
    }

    // Update status to Declined
    $stmt = $pdo->prepare("UPDATE enrollment SET status = 'Declined' WHERE id = ?");
    $stmt->execute([$id]);

    // Prepare and send email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hannahbalite178@gmail.com'; // Your Gmail
        $mail->Password = 'efyx nwju nzfy cvpt'; // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('hannahbalite178@gmail.com', 'West Rembo Learning Center');
        $mail->addAddress($enrollee['email'], $enrollee['firstname']);

        $mail->isHTML(false);
        $mail->Subject = "Enrollment Declined - West Rembo Learning Center";
        $mail->Body = "Dear " . htmlspecialchars($enrollee['firstname']) . ",\n\nWe regret to inform you that your enrollment has been declined.\n\nReason: $reason\n\nIf you have questions, please contact us.\n\nThank you.";

        $mail->send();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Status updated, but failed to send email. Mailer Error: ' . $mail->ErrorInfo]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>