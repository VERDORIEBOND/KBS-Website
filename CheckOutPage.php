<?php

include_once "connection.php";

include_once "index.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add to cart functionality in php and mysql</title>
    <link rel="stylesheet" href="../library/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <style>
        h2, h3 {
            margin-top: 0px;
            padding-top: 0px;
        }

        td {
            border-top: none !important;
        }
    </style>
</head>
<body>


<div class="container well">
    <center><h2>Bestellen afronden</h2></center>
    <hr>
    <form method="post" action="ccavenue/ccavRequestHandler.php" class="form-horizontal">

        <!-- <input type="hidden" name="tid" id="tid" readonly />
        <input type="hidden" name="merchant_id" value=""/>
        <input type="hidden" name="order_id" value=""/>
        <input type="hidden" name="amount" value="10.00"/> -->
        <input type="hidden" name="currency" value="INR"/>
        <input type="hidden" name="redirect_url" value="http://tutorials.lcl/cart/ccavenue/ccavResponseHandler.php"/>
        <input type="hidden" name="cancel_url" value="http://tutorials.lcl/cart/ccavenue/ccavResponseHandler.php"/>
        <input type="hidden" name="language" value="EN"/>

        <div class="row">
            <div class="col-md-7 well">
                <h3>Klant Gegevens</h3>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_name" name="billing_name"
                               placeholder="Naam">
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

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-home"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_address" name="billing_address"
                               placeholder="1234AB">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-home"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_city" name="billing_city"
                               placeholder="Stad">
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
                                       placeholder="Huisnummer">
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
                                       placeholder="StraatNaam">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-home"></span>
                        </div>
                        <input class="form-control" type="text" id="billing_country" name="billing_country"
                               placeholder="Land">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1 well">
                <div class="text-right">
                    <h3>Uw winkelmand</h3>
                    <h4><span class="glyphicon glyphicon-shopping-cart"></span><sup id="itemCount">Item count1</sup>
                    </h4>
                    <table class="table">
                        <tbody>


                        <tr>
                            <td align="right" width="85%">
                                <a href="#">Cart Item</a>
                            </td>
                            <td width="15%">
                                <strong><span></span> the quantity * itemPrice</strong>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <hr style="border: 1px dotted gray;">
                    <p>Total: <strong>
                            <span></span>Total
                        </strong>
                    </p>
                </div>
                <div class="text-right">
                    <input type="submit" value="Veilig betalen" class="btn btn-success btn-block">
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>
