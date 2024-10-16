<?php
use PHPMailer\PHPMailer\PHPMailer;

/**
 * @author: LoveDoLove
 */
const SENDER_NAME   = 'no-reply';
const SENDER_EMAIL  = 'no-reply@kqyl.uk';
const SMTP_HOST     = 'smtp-relay.brevo.com';
const SMTP_PORT     = 587;
const SMTP_USERNAME = '7d61c3001@smtp-brevo.com';
const SMTP_PASSWORD = '03wzjRNE7yBLFVxZ';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host     = SMTP_HOST;
$mail->Port     = SMTP_PORT;
$mail->Username = SMTP_USERNAME;
$mail->Password = SMTP_PASSWORD;
$mail->CharSet  = 'utf-8';

function sendEmail($to, $subject, $body, $from = SENDER_EMAIL, $attachments = null)
{
    global $mail;
    $mail->setFrom(SENDER_EMAIL, $from);
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    if ($attachments) {
        $mail->addAttachment($attachments);
    }
    $mail->send();
    return true;
}
?>
