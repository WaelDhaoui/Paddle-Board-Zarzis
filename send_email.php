<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer\src\Exception.php';
require 'phpmailer\src\PHPMailer.php';
require 'phpmailer\src\SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $num_of_person = $_POST['num_of_person'];
    $phone = $_POST['phone'];

    // Compose email message
    $to = 'wael.dhaoui.2001@gmail.com'; // Admin's email address
    $subject = "New Reservation from $name";

    // Create a professional-looking email body
    $message = "
        <!DOCTYPE html>
        <html>
        <head>
            <title>New Reservation</title>
        </head>
        <body>
            <div style='background-color: #f9f9f9; padding: 20px;'>
                <h2 style='color: #0056b3;'>New Reservation</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Number of Persons:</strong> $num_of_person</p>
                <p><strong>Phone Number:</strong> <a href=tel:+216$phone>$phone</a></p>
            </div>
        </body>
        </html>
    ";

    // Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $to; // Replace with your Gmail email address
        $mail->Password   = 'oidkcdummxooyjte'; // Wael2001@ oidkcdummxooyjte
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender and recipient
        $mail->setFrom($to, 'New Reservation'); // Replace with your Gmail email address and your name
        $mail->addAddress("gamerwael090@gmail.com");

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo "Reservation submitted successfully!";
    } catch (Exception $e) {
        echo "Failed to submit the reservation. Please try again. Error: {$mail->ErrorInfo}";
    }
}
?>
