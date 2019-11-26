<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Product Page</title>

    <link rel="stylesheet" type="text/css" href="Style.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<?php
include "index.php";
include "functions.php";
include "connection.php";


?>
<div class="wrapper">
    <h2>Registreren</h2>
    <form action="" method="post">
        <div class="form-group">
            <label>Emailadres</label>
            <input type="text" name="email" placeholder="Emailadres" class="form-control" value="">
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label>Wachtwoord</label>
            <input type="password" name="password" placeholder="Wachtwoord" class="form-control" value="">
            <span class="help-block"></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Herhaal Wachtwoord</label>
            <input type="password" name="confirm_password" placeholder="Herhaal wachtwoord" class="form-control" value="">
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label>Voornaam</label>
            <input type="text" name="first_name" placeholder="Voornaam" class="form-control">
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label>Achternaam</label>
            <input type="text" name="last_name" placeholder="Achternaam" class="form-control">
        </div>
        <div class="form-group">
            <label>Adres</label>
            <input type="text" name="adres" placeholder="Adres" class="form-control">
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label>Postcode</label>
            <input type="text" name="postal_code" placeholder="Postcode" class="form-control">
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label>Stad</label>
            <input type="text" name="city" placeholder="Stad" class="form-control">
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label>Telefoonnummer</label>
            <input type="text" name="telefoon" placeholder="Telefoonnummer" class="form-control">
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Registreren">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Heb je al een account? <a href="#">Login</a>.</p>
    </form>
</body>
</html>
