<?php
include "index.php";
include "connection.php";
include "functions.php";
error_reporting(0);
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

$email = $password = "";
$email_err = $password_err = "";

if(isset($_POST['submit'])){
    if (empty(trim($_POST['email']))) {
        $email_err = "Voer een emailadres in";
    } else {
        $email = trim($_POST['email']);
    }
    if (empty(trim($_POST['password']))) {
        $password_err = "Voer een wachtwoord in";
    } else {
        $password = trim($_POST['password']);
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT Consumerid, email, passwrd, first_name FROM Consumerprivate WHERE email = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $name);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $email;
                            $_SESSION["name"] = $name;
                            echo "<script type='text/javascript'> document.location = 'homePage.php'; </script>";
                        } else{
                            $password_err = "Verkeerd wachtwoord";
                        }
                    }
                } else{
                    $email_err = "Er is geen account met dit emailadres";
                }
            } else{
                $email_err= "Er is een fout in het syteem opgetreden";
            }
        }
        mysqli_stmt_close($stmt);
    }
}
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
        <form action="" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Emailadres</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Emailadres">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Wachtwoord</label>
                <input type="password" name="password" class="form-control" placeholder="Wachtwoord">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit">Login</button>
            </div>
            <p>Heb je nog geen account? <a href="Register.php">Registreer</a>.</p>
        </form>
    </div>

</div>
</body>
</html>