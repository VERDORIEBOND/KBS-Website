<?php
include "index.php";
include "connection.php";
include "functions.php";
error_reporting(0);



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper2{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<div style="display:flex;justify-content: center;align-items: baseline;">
<div class="wrapper2">
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Emailadres</label>
            <input type="text" name="email" class="form-control" value="<?php echo $username; ?>" placeholder="Emailadres">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Wachtwoord</label>
            <input type="password" name="password" class="form-control" placeholder="Wachtwoord">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Heb je nog geen account? <a href="Register.php">Registreer</a>.</p>
    </form>
</div>
</div>
</body>
</html>