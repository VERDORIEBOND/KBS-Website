<?php
include_once "functions.php";
$mail_err=$firstname_err=$lastname_err=$city_err=$phone_err=$postal_err=$adres_err="";
if(isset($_POST['Betalen'])) {
    if(empty(trim($_POST['firstname']))){
        $firstname_err = "Voer een voornaam in";
    } else{
        if(!ctype_alpha(str_replace(array(' ', "'", '-'),'',$_POST['firstname']))){
            $firstname_err="De voornaam mag alleen letters bevatten m.u.v. ' en -";
        } else{

        }
    }
    if(empty(trim($_POST['lastname']))){
        $lastname_err = "Voer een achternaam in";
    } else{
        if(!ctype_alpha(str_replace(array(' ', "'", '-'),'',$_POST['lastname']))){
            $lastname_err="De achternaam mag alleen letters bevatten m.u.v. ' en -";
        } else{

        }
    }
    if(empty(trim($_POST['mail']))){
        $mail_err = "Voer een emailadres in";
    } else{

    }
    if(empty(trim($_POST['city']))){
        $city_err = "Voer een stad in";
    } else{

    }
    if(empty(trim($_POST['adres']))){
        $adres_err = "Voer een adres in";
    } else{

    }
    if(empty(trim($_POST['postcode']))){
        $postal_err = "Voer een postcode in";
    } else{
        if(PostcodeCheck($_POST['postcode']) == false){
            $postal_err="Ongeldige postcode";
        } else{

        }
    }
    if(trim(!ctype_digit($_POST['phone']))){
        $phone_err="Voer alleen cijfers in bijvoorbeeld 0612345678";
    } else{

    }
    if(empty($mail_err) && empty($firstname_err) && empty($lastname_err) && empty($city_err) && empty($phone_err) && empty($postal_err) && empty($adres_err)) {
        try {
            /*
             * Initialize the Mollie API library with your API key.
             *
             * See: https://www.mollie.com/dashboard/developers/api-keys
             */
            require "initialize.php";

            /*
             * Generate a unique order id for this example. It is important to include this unique attribute
             * in the redirectUrl (below) so a proper return page can be shown to the customer.
             */
            $orderId = time();
            $total = $_POST['total'];
            /*
             * Determine the url parts to these example files.
             */
            $protocol = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
            $hostname = $_SERVER['HTTP_HOST'];
            $path = dirname(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF']);

            /*
             * Payment parameters:
             *   amount        Amount in EUROs. This example creates a € 10,- payment.
             *   description   Description of the payment.
             *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
             *   webhookUrl    Webhook location, used to report when the payment changes state.
             *   metadata      Custom metadata that is stored with the payment.
             */
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "$total" // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => "Order #{$orderId}",
                "redirectUrl" => "{$protocol}://{$hostname}{$path}/return.php?order_id={$orderId}",
                "webhookUrl" => "{$protocol}://{$hostname}{$path}/payments/webhook.php",
                "metadata" => [
                    "order_id" => $orderId,
                ],
            ]);

            /*
             * In this example we store the order with its payment status in a database.
             */
            database_write($orderId, $payment->status);

            /*
             * Send the customer off to complete the payment.
             * This request should always be a GET, thus we enforce 303 http response code
             */
            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }
}
include_once "connection.php";
include_once "winkelfunctie.php";
include_once "index.php";



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
        .container.well{
            width: 90%;
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
                <div class="form-group <?php echo  (!empty($firstname_err)) ?  'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_name" name="firstname" placeholder="Voornaam" value="<?php echo $_SESSION['name'] ?>">
                    </div>
                    <span class="help-block"><?php echo $firstname_err; ?></span>
                </div>
                <div class="form-group <?php echo  (!empty($lastname_err)) ?  'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_name" name="lastname" placeholder="Achteraam" value="<?php echo $_SESSION['lastname'] ?>">
                    </div>
                    <span class="help-block"><?php echo $lastname_err; ?></span>
                </div>

                <div class="form-group <?php echo  (!empty($mail_err)) ?  'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </div>
                        <input class="form-control" type="email" id="billing_email" name="mail"
                               placeholder="Example@example.com" value="<?php echo $_SESSION['username'] ?>">
                    </div>
                    <span class="help-block"><?php echo $mail_err; ?></span>
                </div>

                <div class="form-group <?php echo  (!empty($phone_err)) ?  'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-earphone"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_tel" name="phone"
                               placeholder="06****" value="<?php echo $_SESSION['telefoonnummer'] ?>">
                    </div>
                    <span class="help-block"><?php echo $phone_err; ?></span>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group <?php echo  (!empty($postal_err)) ?  'has-error' : ''; ?>">
                            <div class="input-group">
                                <div class="input-group-addon addon-diff-color">
                                    <span class="glyphicon glyphicon-home"></span>
                                </div>
                                <input class="form-control" type="text" id="billing_state" name="postcode"
                                       placeholder="Postcode" value="<?php echo $_SESSION['postcode'] ?>">
                            </div>
                            <span class="help-block"><?php echo $postal_err; ?></span>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-2">
                        <div class="form-group <?php echo  (!empty($adres_err)) ?  'has-error' : ''; ?>">
                            <div class="input-group">
                                <div class="input-group-addon addon-diff-color">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                </div>
                                <input class="form-control" type="text" id="billing_zip" name="adres"
                                       placeholder="Adres" value="<?php echo $_SESSION['adres'] ?>">
                            </div>
                            <span class="help-block"><?php echo $adres_err; ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group <?php echo  (!empty($city_err)) ?  'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-home"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_country" name="city"
                               placeholder="stad" value="<?php echo $_SESSION['stad'] ?>">
                    </div>
                    <span class="help-block"><?php echo $city_err; ?></span>
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
                    <input type="hidden" value="<?php echo number_format($total, 2); ?>" name="total">
                    <button type="submit" name="Betalen" value="Veilig betalen" class="btn btn-success btn-block">Veilig betalen</button>
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>
