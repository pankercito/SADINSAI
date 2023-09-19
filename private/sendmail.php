<?php

$to_email = "sr.pankuwu@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi,nn This is test email send by PHP Script";
$headers = "From: rodriguezeiker08@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to admin...";
} else {
    echo "Email sending failed...";
}