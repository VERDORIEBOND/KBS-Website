<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Product Page</title>

    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif;  }
        .wrapper{ width: 350px; padding: 20px; position: absolute; }
    </style>
</head>
<body>
<?php
include "index.php";
include "functions.php";
include "connection.php";
error_reporting(0);
    if(isset($_POST['submit'])){

        $email = $password = $confirm_password = $firstname = $lastname = $adres = $postal = $city = $phone = "";
        $email_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $postal_err = $city_err = $phone_err = "";
        $newsletter=false;

        if(empty(trim($_POST['email']))){
            $email_err="Voer een emailadres in";
        } else{
            $sql= "SELECT email FROM Consumerprivate WHERE email = ?";
            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                $param_email = trim($_POST["email"]);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $email_err = "Dit emailadres is reeds in gebruik";
                    } else{
                        $email = trim($_POST["email"]);
                    }
                } else{
                    echo "Er is een fout opgetreden in het systeem";
                }
            }
            mysqli_stmt_close($stmt);
        }if(empty(trim($_POST['password']))){
            $password_err="Voer een wachtwoord in";
        } else{
            if(trim($_POST['password']) != trim($_POST['confirm_password'])){
                $password_err="De wachtwoorden komen niet over een";
            } else{
                if(strlen(trim($_POST['password'])) <= 6){
                    $password_err = "Het wachtwoord moet minimaal 7 tekens lang zijn";
                } else{
                    if(preg_match('~[A-Z]~', $_POST['password']) && preg_match('~[a-z]~', $_POST['password']) && preg_match('~\d~', $_POST['password'])){
                        $password = password_hash(trim($_POST['password']),PASSWORD_DEFAULT);
                    } else{
                        $password_err = "Het wachtwoord moet een hoofdletter, kleine letter en een cijfer bevatten";
                    }
                }
            }
        }if(empty(trim($_POST['confirm_password']))){
            $confirm_password_err="Herhaal het wachtwoord";
        } else{
            if(trim($_POST['password']) != trim($_POST['confirm_password'])){
                $confirm_password_err="De wachtwoorden komen niet over een";
            }
        }if(empty(trim($_POST['first_name']))){
            $firstname_err="Voer een voornaam in";
        } else{
            if(!ctype_alpha(str_replace(array(' ', "'", '-'),'',$_POST['first_name']))){
                $firstname_err="De voornaam mag alleen letters bevatten m.u.v. ' en -";
            } else{
                $firstname = trim($_POST['first_name']);
            }
        }if(empty(trim($_POST['last_name']))){
            $lastname_err="Voer een achternaam in";
        } else{
            if(!ctype_alpha(str_replace(array(' ', "'", '-'),'',$_POST['last_name']))){
                $lastname_err="De achternaam mag alleen letters bevatten m.u.v. ' en -";
            } else{
                $lastname = trim($_POST['last_name']);
            }
        }if(empty(trim($_POST['adres']))){
            $adres_err="Voer een adres in";
        } else{
            if(!ctype_alpha(str_replace(array(),'',$_POST['adres'])))
                $adres = trim($_POST['adres']);
        }if(empty(trim($_POST['postal_code']))){
            $postal_err="Voer een postcode in";
        } else{
            if(PostcodeCheck($_POST['postal_code']) == false){
                $postal_err="Ongeldige postcode";
            } else{
                $postal = PostcodeCheck($_POST['postal_code']);
            }
        }if(empty(trim($_POST['city']))){
            $city_err="Voer een plaatsnaam in";
        } else{
            $city = trim($_POST['city']);
        }if(trim(!ctype_digit($_POST['phone']))){
            $phone_err="Voer alleen cijfers in bijvoorbeeld 0612345678";
        } else{
            $phone = trim($_POST['phone']);
        }if(!empty($_POST['newsletter'])){
            $newsletter=true;
        }
        if(!empty($email) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($adres) && !empty($postal) && !empty($city) && empty($phone_err)){
            $sql1 = "INSERT INTO ConsumerPrivate (email, passwrd, first_name, last_name, adres, postal, city, phone, newsletter) VALUES (?,?,?,?,?,?,?,?,?)";
            if($stmt1=mysqli_prepare($conn,$sql1)){
                mysqli_stmt_bind_param($stmt1,"sssssssss",$param_email,$param_password,$param_firstname,$param_lastname,$param_adres,$param_postal,$param_city,$param_phone,$param_newsletter);
                $param_email=$email;
                $param_password=$password;
                $param_firstname=$firstname;
                $param_lastname=$lastname;
                $param_adres=$adres;
                $param_postal=$postal;
                $param_city=$city;
                $param_phone=$phone;
                $param_newsletter=$newsletter;
                if(mysqli_stmt_execute($stmt1)){
                    echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
                } else{
                    echo "Fout opgetreden in het systeem.";
                }
            }
            if($newsletter==true){
                $sql2= "INSERT INTO Nieuwsbriefinschrijving (email, has_account) VALUES (?,?)";
                if($stmt2=mysqli_prepare($conn,$sql2)){
                    mysqli_stmt_bind_param($stmt2,"si",$param1_email,$param_account);
                    $param1_email=$email;
                    $param_account=1;
                    mysqli_stmt_execute($stmt2);
                }
            }
            echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
            mysqli_stmt_close($stmt1);
        }
    }
?>
<div style="display:flex;justify-content: center;align-items: baseline;">
<div class="wrapper">
    <h2>Registreren</h2>
    <form action="" method="post">
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Emailadres</label>
            <input type="email" name="email" placeholder="Emailadres" class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Wachtwoord</label>
            <input type="password" name="password" placeholder="Wachtwoord" class="form-control" value="">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Herhaal Wachtwoord</label>
            <input type="password" name="confirm_password" placeholder="Herhaal wachtwoord" class="form-control" value="">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
            <label>Voornaam</label>
            <input type="text" name="first_name" placeholder="Voornaam" class="form-control" value="<?php echo $firstname; ?>">
            <span class="help-block"><?php echo $firstname_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
            <label>Achternaam</label>
            <input type="text" name="last_name" placeholder="Achternaam" class="form-control" value="<?php echo $lastname; ?>">
            <span class="help-block"><?php echo $lastname_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($adres_err)) ? 'has-error' : ''; ?>">
            <label>Adres</label>
            <input type="text" name="adres" placeholder="Adres" class="form-control" value="<?php echo $adres; ?>">
            <span class="help-block"><?php echo $adres_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($postal_err)) ? 'has-error' : ''; ?>">
            <label>Postcode</label>
            <input type="text" name="postal_code" placeholder="Postcode" class="form-control" value="<?php echo $postal; ?>">
            <span class="help-block"><?php echo $postal_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
            <label>Stad</label>
            <input type="text" name="city" placeholder="Stad" class="form-control" value="<?php echo $city; ?>">
            <span class="help-block"><?php echo $city_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
            <label>Telefoonnummer</label>
            <input type="text" name="phone" placeholder="Telefoonnummer" class="form-control" value="<?php echo $phone; ?>">
            <span class="help-block"><?php echo $phone_err; ?></span>
        </div>
        <div class="form-group">
            <label>Wilt u onze nieuwsbrief ontvangen?</label>
            <input type="checkbox" value="1" name="newsletter" <?=isset($_POST['newsletter'])?"checked":''; ?>>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit">Registreren</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
        <p>Heb je al een account? <a href="login.php">Login</a>.</p>
    </form>
</div>
</div>
</body>
</html>
