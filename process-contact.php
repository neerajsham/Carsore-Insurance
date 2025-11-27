<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$insurance_type = trim($_POST['insurance_type'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];

if (empty($full_name)) {
    $errors[] = 'Full name is required.';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required.';
}

if (empty($phone)) {
    $errors[] = 'Phone number is required.';
}

if (empty($insurance_type)) {
    $errors[] = 'Insurance type is required.';
}

if (empty($message)) {
    $errors[] = 'Message is required.';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your-email@gmail.com';
    $mail->Password   = 'your-app-password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('your-email@gmail.com', 'Contact Form');
    $mail->addAddress('recipient@example.com', 'Admin');
    $mail->addReplyTo($email, $full_name);

    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission - ' . $insurance_type;
    
    $mail->Body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 5px; }
            .content { background: #f9f9f9; padding: 20px; margin-top: 20px; border-radius: 5px; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #555; }
            .value { color: #333; margin-top: 5px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>New Contact Form Submission</h2>
            </div>
            <div class='content'>
                <div class='field'>
                    <div class='label'>Full Name:</div>
                    <div class='value'>" . htmlspecialchars($full_name) . "</div>
                </div>
                <div class='field'>
                    <div class='label'>Email:</div>
                    <div class='value'>" . htmlspecialchars($email) . "</div>
                </div>
                <div class='field'>
                    <div class='label'>Phone Number:</div>
                    <div class='value'>" . htmlspecialchars($phone) . "</div>
                </div>
                <div class='field'>
                    <div class='label'>Insurance Type:</div>
                    <div class='value'>" . htmlspecialchars($insurance_type) . "</div>
                </div>
                <div class='field'>
                    <div class='label'>Message:</div>
                    <div class='value'>" . nl2br(htmlspecialchars($message)) . "</div>
                </div>
            </div>
        </div>
    </body>
    </html>
    ";

    $mail->AltBody = "Full Name: $full_name\nEmail: $email\nPhone: $phone\nInsurance Type: $insurance_type\nMessage: $message";

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Thank you! Your message has been sent successfully.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Message could not be sent. Please try again later.']);
}
?>