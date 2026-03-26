<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data safely
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $city    = htmlspecialchars($_POST['city']);
    $message = htmlspecialchars($_POST['message']);
    $captcha = $_POST['captcha'];

    // CAPTCHA validation
    if (!isset($_SESSION['captcha']) || $captcha != $_SESSION['captcha']) {
        echo "<script>alert('Invalid CAPTCHA'); window.history.back();</script>";
        exit;
    }

    // Email where you want to receive messages
    $to = "your-email@example.com"; // 👉 change this

    // Subject
    $subject = "New Contact Form Submission";

    // Email body
    $body = "
    You have received a new message:

    Name: $name
    Email: $email
    Phone: $phone
    City: $city

    Message:
    $message
    ";

    // Headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send mail
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Message sent successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Failed to send message.'); window.history.back();</script>";
    }
}
?>