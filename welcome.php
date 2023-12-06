
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);

    if (empty($firstname) || empty($lastname) || empty($email) || empty($subject)) {
        die("Please fill out all fields.");
    }

    $admin_email = "tengakoi4@gmail.com";
    $headers = "From: " . $email;
    $subject = "Contact Form Submission from " . $firstname . " " . $lastname;
    $body = "Email: " . $email . "\n";
    $body .= "Message: \n" . $subject;

    if (mail($admin_email, $subject, $body, $headers)) {
        // Redirect to the contact page
        header('Location: contact.php?success=true');
        exit();
    } else {
        // If the mail could not be sent, redirect to the contact page with an error message
        header('Location: contact.php?success=false');
        exit();
    }
} else {
    die('Error: Form submission failed.');
}
?>
