<?php

include_once "connection.php";
include_once "winkelfunctie.php";
include_once "index.php";


 if(isset($_POST['Betalen'])){

        $email = $firstname = $lastname = $adres = $postal = $city = $phone = "";
        $email_err = $firstname_err = $lastname_err = $postal_err = $city_err = $phone_err = "";
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
        }
        if(!empty($email) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($adres) && !empty($postal) && !empty($city) && empty($phone_err)) {
            $sql1 = "INSERT INTO ConsumerPrivate (email, first_name, last_name, adres, postal, city, phone) VALUES (?,?,?,?,?,?,?,?,?)";
            if ($stmt1 = mysqli_prepare($conn, $sql1)) {
                mysqli_stmt_bind_param($stmt1, "sssssssss", $param_email, $param_firstname, $param_lastname, $param_adres, $param_postal, $param_city, $param_phone);
                $param_email = $email;

                $param_firstname = $firstname;
                $param_lastname = $lastname;
                $param_adres = $adres;
                $param_postal = $postal;
                $param_city = $city;
                $param_phone = $phone;

                if (mysqli_stmt_execute($stmt1)) {
                    echo "<script type='text/javascript'> document.location = 'CheckoutPage'; </script>";
                } else {
                    echo "Fout opgetreden in het systeem.";
                }
            }
            echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
            mysqli_stmt_close($stmt1);
        }



?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        h2, h3 {
            margin-top: 0px;
            padding-top: 0px;
        }

        td {
            border-top: none !important;
        }
        p{
            color: #66afe9;
        }
        h5,h3 {
            color: #66afe9;
        }
    </style>
</head>
<body>


<div class="container well">
    <center><h2>Bestellen afronden</h2></center>
    <hr>
    <form method="post" action="" class="form-horizontal">

        <!-- <input type="hidden" name="tid" id="tid" readonly />
        <input type="hidden" name="merchant_id" value=""/>
        <input type="hidden" name="order_id" value=""/>
        <input type="hidden" name="amount" value="10.00"/> -->
        <input type="hidden" name="currency" value="INR"/>
        <input type="hidden" name="redirect_url" value="http://tutorials.lcl/cart/ccavenue/ccavResponseHandler.php"/>
        <input type="hidden" name="cancel_url" value="http://tutorials.lcl/cart/ccavenue/ccavResponseHandler.php"/>
        <input type="hidden" name="language" value="EN"/>





        <div class="row">
            <div class="col-md-7 well " style="position: relative">
                <h3>Klant Gegevens</h3>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_name" name="billing_name" placeholder="Voornaam">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_name" name="billing_name" placeholder="Achteraam">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_email" name="billing_email"
                               placeholder="Example@example.com">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-earphone"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_tel" name="billing_tel"
                               placeholder="06****">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon addon-diff-color">
                                    <span class="glyphicon glyphicon-home"></span>
                                </div>
                                <input class="form-control" type="text" id="billing_state" name="billing_state"
                                       placeholder="Postcode">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-2">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon addon-diff-color">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </div>
                                <input class="form-control" type="text" id="billing_zip" name="billing_zip"
                                       placeholder="Adres">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-home"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_country" name="billing_city"
                               placeholder="stad">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1 well">
                <div class="text-center">
                    <h3>Uw winkelmand</h3>
                </div>
                <?php

                /*
                         <div class="row">
            <div class="col-md-7 well">
                <h3>Klant Gegevens</h3>
                <div class="form-group   <?php echo  (!empty($firstname_err)) ?  'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input type="text" name="first_name" placeholder="Voornaam" class="form-control" value="<?php echo $firstname; ?>">
                        <span class="help-block"><?php echo $firstname_err; ?></span>
                    </div>
                </div>

                <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input type="text" name="last_name" placeholder="Achternaam" class="form-control" value="<?php echo $lastname; ?>">
                        <span class="help-block"><?php echo $lastname_err; ?></span>
                    </div>



                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </div>
                        <input type="email" name="email" placeholder="Emailadres" class="form-control" value="<?php echo $email; ?>">
                        <span class="help-block"><?php echo $email_err; ?></span>
                    </div>
                </div>


                    <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                        <div class="input-group">
                            <div class="input-group-addon addon-diff-color">
                                <span class="glyphicon glyphicon-earphone"></span>
                            </div>
                            <input type="text" name="phone" placeholder="Telefoonnummer" class="form-control" value="<?php echo $phone; ?>">
                            <span class="help-block"><?php echo $phone_err; ?></span>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group <?php echo (!empty($postal_err)) ? 'has-error' : ''; ?>">
                            <div class="input-group">
                                <div class="input-group-addon addon-diff-color">
                                    <span class="glyphicon glyphicon-home"></span>
                                </div>
                                <input type="text" name="postal_code" placeholder="Postcode" class="form-control" value="<?php echo $postal; ?>">
                                <span class="help-block"><?php echo $postal_err; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-2">
                        <div class="form-group <?php echo (!empty($adres_err)) ? 'has-error' : ''; ?>">
                            <div class="input-group">
                                <div class="input-group-addon addon-diff-color">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </div>
                                <input type="text" name="adres" placeholder="Adres" class="form-control" value="<?php echo $adres; ?>">
                                <span class="help-block"><?php echo $adres_err; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-home"></span>
                        </div>
                        <input type="text" name="city" placeholder="Stad" class="form-control" value="<?php echo $city; ?>">
                        <span class="help-block"><?php echo $city_err; ?></span>
                    </div>

            </div>
                 */
                $producten = $winkelwagendetails($conn);
                $total = 0;
                if(!empty($producten)){

                foreach ($producten

                as $key => $value){


                ?>
                <div class="text-left">

                    <h4>
                        Artikel Naam

                    </h4><h5>
                        </span><sup id="itemCount"><?php echo $value['Name'] ?></sup>
                    </h5>
                    <h4>
                        Prijs

                    </h4>
                    <h5>

                        </span><sup id="itemCount"><?php echo $value['Price'] ?></sup>
                    </h5>
                    <h4>
                        Hoeveelheid

                    </h4>
                    <h5>

                        </span><sup id="itemCount"><?php echo $value['Aantal'] ?> </sup>
                    </h5>
                    <?php
                    $total = $total + ($value["Aantal"] * $value["Price"]);
                    }
                    }
                    ?>
                    <table class="text-right">
                        <tbody>


                        <tr>

                            <td width="15%">
                                <strong> <?php $cartItem =(count($producten));
                                    $b=$cartItem;
                                    echo $b; ?> </strong>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                    <hr style="border: 1px solid gray;">
                    <p> <strong>
                           Totaal: <span>€ <?php echo number_format($total, 2); ?></span>
                        </strong>
                    </p>
                </div>
                <div class="text-center">
                    <button type="submit" name="Betalen" value="Veilig betalen" class="btn btn-success btn-block">Veilig betalen</button>
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>
