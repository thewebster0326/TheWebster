<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

$honeypot = trim($_POST['website'] ?? '');
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($honeypot !== '' || $name === '' || $email === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: contact.html?error=1');
    exit;
}

$to = 'info@thewebster.net';
$subject = 'New enquiry from thewebster.net';

$body = "New contact form enquiry:\n\n";
$body .= "Name: {$name}\n";
$body .= "Email: {$email}\n\n";
$body .= "Message:\n{$message}\n";

$safeEmail = str_replace(["\r", "\n"], '', $email);
$headers = "From: The Webster Website <info@thewebster.net>\r\n";
$headers .= "Reply-To: {$safeEmail}\r\n";

mail($to, $subject, $body, $headers);

header('Location: contact.html?sent=1');
exit;
