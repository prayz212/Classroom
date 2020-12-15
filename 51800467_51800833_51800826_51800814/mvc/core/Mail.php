<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {

//------------------------------------- Mail -----------------------------------------//
    
    public function sendMail($email, $title, $content) {
        require 'vendor/autoload.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'gakonsaxnuoc22@gmail.com';                     // SMTP username
            $mail->Password   = 'Thanhtri00';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('gakonsaxnuoc22@gmail.com', 'Tri');
            $mail->addAddress($email, 'Người dùng');     // Add a recipient
            $mail->CharSet = 'UTF-8';

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $title;
            $mail->Body = $content;
            $mail->send();

        } catch (Exception $e) {
            return "false";
        }
    }

//------------------------------------- Mail -----------------------------------------//


}