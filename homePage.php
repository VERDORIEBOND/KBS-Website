<?php
include 'HTML Emails.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);



?>



<!doctype html>
<html lang="en">
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php
include "index.php";

?>
<section class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="content">
                    <form>
                        <h2>SCHRIJF JE IN VOOR DE NIEUWSLETTER</h2>
                        <h4>En mis nooit meer aanbiedingen en coupons!</h4>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="E-mail adress" name="emailin">
                            <span class="input-group-btn">
                                    <input type="submit" name="button1" value="Nu Inschrijven!">Nu Inschrijven</button>
                                </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php


ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', '587');
if(isset($_GET['button1']))
{
    $email = $_GET['emailin'];
    $subject = "Je bent ingeschreven voor de nieuwsbrief!";
    $headers = "From: sender\'s email";
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'wideworldimporters.5@gmail.com';                     // SMTP username
    $mail->Password   = 'aardappel';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
   //Recipients
    $mail->setFrom('lucasdegruijter@gmail.com', 'Lucas');
    $mail->addAddress($email);     // Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $signupEmail;                                    //for html clients
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';        //for non html clients

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>


</body>