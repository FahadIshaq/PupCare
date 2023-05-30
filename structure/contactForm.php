<?php
if (isset($_POST['email'])) {

    // REPLACE THIS 2 LINES AS YOU DESIRE
    $email_to = "ruslandurrani907@gmail.com";
    $email_subject = "Looking for your services!!";

    function problem($error)
    {
        echo "Oops! There seems to be a problem with your form data: <br><br>";
        echo $error . "<br><br>";
        echo "Please fix the errors to proceed.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['fname']) ||
        !isset($_POST['lname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])
    ) {
        problem('Oops! There seems to be a problem with your form data.');
    }

    $name = $_POST['fname'].' '.$_POST['lname']; // required
    $email = $_POST['email']; // required
    $message = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'The email address you entered does not appear to be valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'The name you entered does not appear to be valid.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'The message should not be less than 2 characters.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details:\n\n";
    $email_message .= "Name: " . $name . "\n";
    $email_message .= "Email: " . $email . "\n";
    $email_message .= "Message: " . $message . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- Replace this as your success message -->

    Thanks for contacting us! We will get back to you as soon as possible.

<?php
}
?>
