<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../database/dbconnection.php';
require_once __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/../PHPMailer-master/src/Exception.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';
$name = $data['name'] ?? '';
$message = $data['message'] ?? '';

if (!$email || !$message) {
    echo json_encode(['success' => false, 'error' => 'Missing email or message.']);
    exit;
}

// Remove this block if you want to allow all domains
// if (!preg_match('/@umak\.edu\.ph$/i', $email)) {
//     echo json_encode(['success' => false, 'error' => 'Only @umak.edu.ph email addresses are accepted.' ]);
//     exit;
// }

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'hannahbalite178@gmail.com'; // Your Gmail
    $mail->Password = 'efyx nwju nzfy cvpt';   // Your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('hannahbalite178@gmail.com', 'West Rembo Learning Center');
    $mail->addAddress($email, $name);

    $mail->isHTML(false);
    $mail->Subject = "Reply to your feedback - West Rembo Learning Center";
    $mail->Body = $message;

    $mail->send();
    // Update status to 'Replied'
    $stmt = $pdo->prepare("UPDATE contactus SET status = 'Replied' WHERE email = ? AND name = ?");
    $stmt->execute([$email, $name]);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Mailer Error: ' . $mail->ErrorInfo]);
}