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
                                    <input type="submit" name="button1">Nu Inschrijven</button>
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
    $message = "Je bent nu ingeschreven voor de nieuwsbrief, gefeliciteerd!";
    $headers = "From: sender\'s email";
    if (mail($email, $subject, $message,$headers)) {
        echo "Email successfully sent to $email...";
    } else {
        echo "Email sending failed...";
    }
}
?>


</body>