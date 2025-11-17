<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "ranzeedchemicals@gmail.com"; // <-- change to your email
    $subject = "New Contact Message from Ranzeed Website";
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // basic validation
    if ( empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        echo "<script>alert('Please complete all fields with a valid email.');window.location='about.html#contact';</script>";
        exit;
    }

    $body  = "You have received a new message from your website contact form.\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Thank you — your message has been sent.');window.location='about.html#contact';</script>";
    } else {
        // If mail() fails, consider logging or using SMTP
        echo "<script>alert('Sorry — we could not send your message at this time.');window.location='about.html#contact';</script>";
    }
} else {
    header("Location: index.html");
    exit;
}
?>
