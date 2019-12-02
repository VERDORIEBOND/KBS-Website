<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="Style.css" media="screen" />

<link rel="stylesheet" type="text/css" href="Style.css" media="screen" />

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<?php
include 'HTML Emails.php';
include 'connection.php';
include 'index.php';
include 'functions.php';

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
<!--Carousel Wrapper-->
<div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel" style="width: 1000px; height:600px; margin-left: auto; margin-right: auto; margin-bottom: 20px; margin-top: 20px">
    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-2" data-slide-to="1"></li>
        <li data-target="#carousel-example-2" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="view">
                <img class="d-block w-100" src="images/SliderImg/img-1.png"
                     alt="First slide">
                <div class="mask rgba-black-light"></div>
            </div>
            <div class="carousel-caption">
                <h3 class="h3-responsive">Light mask</h3>
                <p>Furry Footwear</p>
            </div>
        </div>
        <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="images/SliderImg/img-2.png"
                     alt="Second slide">
                <div class="mask rgba-black-strong"></div>
            </div>
            <div class="carousel-caption">
                <h3 class="h3-responsive">Strong mask</h3>
                <p>Clothing</p>
            </div>
        </div>
        <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="images/SliderImg/img-3.png"
                     alt="Third slide">
                <div class="mask rgba-black-slight"></div>
            </div>
            <div class="carousel-caption">
                <h3 class="h3-responsive">Slight mask</h3>
                <p>Toys</p>
            </div>
        </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->






<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-9">
                <h3>
                    Hot Items</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"
                       data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"
                                                data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <?php
                        $result = mysqli_query($conn,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID ORDER BY RAND() LIMIT 1;");
                        while ($row = mysqli_fetch_assoc($result))
                        {
                        ?>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $imgCategory($row['StockGroupName']) ?>" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                <?php echo $row['stockitem'] ?></h5>
                                            <h5 class="price-text-color">
                                                <?php echo $row['RecommendedRetailPrice'] ?></h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        $result = mysqli_query($conn,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID ORDER BY RAND() LIMIT 1;");                        while ($row = mysqli_fetch_assoc($result))
                        {
                        ?>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $imgCategory($row['StockGroupName']) ?>" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                <?php echo $row['stockitem'] ?></h5>
                                            <h5 class="price-text-color">
                                                <?php echo $row['RecommendedRetailPrice'] ?></h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php
                        }
                        $result = mysqli_query($conn,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID ORDER BY RAND() LIMIT 1;");                        while ($row = mysqli_fetch_assoc($result))
                        {
                        ?>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $imgCategory($row['StockGroupName']) ?>" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                <?php echo $row['stockitem'] ?></h5>
                                            <h5 class="price-text-color">
                                                <?php echo $row['RecommendedRetailPrice'] ?></h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php
                        }
                        $result = mysqli_query($conn,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID ORDER BY RAND() LIMIT 1;");                        while ($row = mysqli_fetch_assoc($result))
                        {
                        ?>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $imgCategory($row['StockGroupName']) ?>" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                <?php echo $row['stockitem'] ?></h5>
                                            <h5 class="price-text-color">
                                                <?php echo $row['RecommendedRetailPrice'] ?></h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                $result = mysqli_query($conn,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID ORDER BY RAND() LIMIT 1;");                while ($row = mysqli_fetch_assoc($result))
                {
                ?>
                <div class="item">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $imgCategory($row['StockGroupName']) ?>" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                <?php echo $row['stockitem'] ?></h5>
                                            <h5 class="price-text-color">
                                                <?php echo $row['RecommendedRetailPrice'] ?></h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        $result = mysqli_query($conn,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID ORDER BY RAND() LIMIT 1;");                        while ($row = mysqli_fetch_assoc($result))
                        {
                        ?>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $imgCategory($row['StockGroupName']) ?>" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                <?php echo $row['stockitem'] ?></h5>
                                            <h5 class="price-text-color">
                                                <?php echo $row['RecommendedRetailPrice'] ?></h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php
                        }
                        $result = mysqli_query($conn,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID ORDER BY RAND() LIMIT 1;");                        while ($row = mysqli_fetch_assoc($result))
                        {
                        ?>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $imgCategory($row['StockGroupName']) ?>" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                <?php echo $row['stockitem'] ?></h5>
                                            <h5 class="price-text-color">
                                                <?php echo $row['RecommendedRetailPrice'] ?></h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php
                        }
                        $result = mysqli_query($conn,"SELECT distinct regexp_substr(StockItemName, '[a-z ]+') as stockitem, RecommendedRetailPrice, MarketingComments, o.StockGroupName, i.StockItemID FROM stockitems i JOIN stockitemstockgroups g on i.StockItemID = g.StockItemID JOIN stockgroups o on g.StockGroupID = o.StockGroupID ORDER BY RAND() LIMIT 1;");                        while ($row = mysqli_fetch_assoc($result))
                        {
                        ?>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="<?php echo $imgCategory($row['StockGroupName']) ?>" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                <?php echo $row['stockitem'] ?></h5>
                                            <h5 class="price-text-color">
                                                <?php echo $row['RecommendedRetailPrice'] ?></h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="ProductDetails.php?productId=<?php echo $row["StockItemID"] ?>" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>






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
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'wideworldimporters.5@gmail.com';                     // SMTP username
    $mail->Password   = 'aardappel';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
   //Recipients
    $mail->setFrom('wideworldimporters.5@gmail.com', 'Wide World Importers');
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

    //echo 'Message has been sent';
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>


</body>