<?php
require_once __DIR__ . '/../PHPMailer/class.phpmailer.php';
require_once __DIR__ . '/../PHPMailer/class.smtp.php';

function send_mail(string $to, string $subject, string $body): bool
{
    $mail = new PHPMailer(true);
    try {
        $mail->IsSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'davidnaumovski38@gmail.com';
        $mail->Password   = 'bxuk zynk nuft pain';  
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->SetFrom('davidnaumovski38@gmail.com', 'Chess Tournament');
        $mail->AddAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->Send();
        return true;
    } catch (Exception $e) {
        error_log('Mail error: ' . $mail->ErrorInfo);
        return false;
    }
}
