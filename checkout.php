<?php
/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 08-07-2015
 * Time: 00:53
 */
include('phpScripts/checkoutPreprocessing.php');
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>JAGD Watches</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link rel="stylesheet" href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css">
    <link rel="stylesheet" href="plugins/fancybox2/jquery.fancybox.css">
    <link rel="stylesheet" href="plugins/fancybox2/helpers/jquery.fancybox-thumbs.css">
    <link rel="stylesheet" href="plugins/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->



    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="plugins/js-cookie-1.5.1/src/js.cookie.js"></script>
    <script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script src="plugins/fancybox2/jquery.fancybox.pack.js"></script>
    <script src="plugins/fancybox2/helpers/jquery.fancybox-thumbs.js"></script>
    <script src="plugins/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/jquery.poptrox.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/jquery.scrollgress.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/additional-methods.min.js"></script>
    <script src="js/watchBuilder.js"></script>
    <script src="js/checkout.js"></script>
    <script>
    </script>



    <!--<script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-53828788-1', 'auto');
        ga('send', 'pageview');

    </script>-->
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
</head>
<body>

<!-- Header -->
<header id="header">

    <!-- Logo -->
    <img src="images/JAGD logo grey white.png" alt="" name="logo" height="40" class="image logo">

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a id="backButton" href="watchBuilder.php">Back</a></li>
            <li><a href="index.php">Back To Main</a></li>
        </ul>
    </nav>

</header>

<!-- SPLASH -->
<!--<section class="main style1 fullscreen" id="splash" name="splash" style="padding-top:50px !important;">
    <div class="content container small">
        <img name="splash2" src="images/Watch-splash.gif" style="width:320px;" class="image">
        <footer>
            <a id="startButton" href="javascript: void(0)" class="button style3">Build my watch</a>
        </footer>
    </div>

</section>-->
<div class="builderOuterContainer">
    <div class="builderInnerContainer centeredContent">


        <div class="watchContainer buyPosition">
            <div class="watchElementContainer">
                <?php
                foreach($strapSrc as $main){
                    echo "<img src='$main' class='watchStrap watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($caseSrc as $main){
                    echo "<img src='$main' class='watchCase watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($dialSrc as $main){
                    echo "<img src='$main' class='watchDial watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($handsSrc as $main){
                    echo "<img src='$main' class='watchHands watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($patternSrc as $main){
                    echo "<img src='$main' class='watchPattern watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "' style='transform: rotate(" . $state['patternRotation'] . "deg); -webkit-transform: rotate(" . $state['patternRotation'] . "deg);-moz-transform: rotate(" . $state['patternRotation'] . "deg);-ms-transform: rotate(" . $state['patternRotation'] . "deg);-o-transform: rotate(" . $state['patternRotation'] . "deg)'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($numeralsSrc as $main){
                    echo "<img src='$main' class='watchNumerals watchElement step2WatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($indexSrc as $main){
                    echo "<img src='$main' class='watchIndex watchElement step2WatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($markerSrc as $main){
                    echo "<img src='$main' class='watchMarker watchElement step2WatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
        </div>


        <!-- Customer Details OLD-->
        <section id="customerDetailsOLD" style="display: none;">
            <div class="builderContent">
                <div class="watchRecap">
                    <span class="caseTitle partTitle"><b>Case:</b></span><span class="caseValue"></span><br>
                    <span class="handsTitle partTitle"><b>Hands:</b></span><span class="handsValue"></span><br>
                    <span class="strapsTitle partTitle"><b>Strap:</b></span><span class="strapValue"></span><br>
                    <span class="dialTitle partTitle"><b>Dial:</b></span><span class="dialValue"></span><br>
                    <span class="indexTitle partTitle"><b>Index:</b></span><span class="indexValue"></span><br>
                    <span class="numeralsTitle partTitle"><b>Numerals:</b></span><span class="numeralsValue"></span><br>
                    <span class="patternTitle partTitle"><b>Pattern:</b></span><span class="patternValue"></span>
                    <span class="invertedTitle partTitle"><b>Inverted:</b></span><span class="invertedValue">No</span>
                    <span class="rotationTitle partTitle"><b>Rotation:</b></span><span class="rotationValue">0 degrees</span>
                    <span class="additionalStrap1Title partTitle"><b>Additional Strap:</b></span><span class="additionalStrap1Value">None</span>
                    <span class="additionalStrap2Title partTitle"><b>Additional Strap:</b></span><span class="additionalStrap2Value">None</span>
                </div>
                <div class="formContent">
                    <FORM ACTION="https://payment.architrade.com/paymentweb/start.action" METHOD="POST" CHARSET="UTF-8">
                        <INPUT TYPE="hidden" NAME="test" value="1">
                        <INPUT TYPE="hidden" NAME="accepturl" VALUE="http://www.jagdwatches.local/paymentValidated.php">
                        <INPUT TYPE="hidden" NAME="amount" VALUE="10000">
                        <INPUT TYPE="hidden" NAME="currency" VALUE="DKK">
                        <INPUT TYPE="hidden" NAME="merchant" VALUE="90197001">
                        <INPUT TYPE="hidden" NAME="orderid" VALUE="00001">
                        <input type="hidden" name="decorator" value="responsive">

                        <label for="billingAddress">Billings Address</label><INPUT TYPE="text" NAME="billingAddress" VALUE="Amagerbrogade 136">
                        <label for="billingFirstNAME">First Name</label><INPUT TYPE="text" NAME="billingFirstNAME" VALUE="Rasmus">
                        <label for="billingLastNAME">LastName</label><INPUT TYPE="text" NAME="billingLastNAME" VALUE="Jørgensen">
                        <label for="billingPostalCode">Postal Code</label><INPUT TYPE="text" NAME="billingPostalCode" VALUE="2300">

                        <label for="cardholder_NAME">Cardholder Name</label><INPUT TYPE="text" NAME="cardholder_NAME" VALUE="Rasmus Jørgensen">
                        <label for="cardholder_address1">Cardholder Address</label><INPUT TYPE="text" NAME="cardholder_address1" VALUE="Amagerbrogade 136">
                        <label for="cardholder_zipcode">Cardholder Postal Code</label><INPUT TYPE="text" NAME="cardholder_zipcode" VALUE="2100">
                        <Input type="submit">
                    </FORM>
                </div>
            </div>
        </section>

        <section class="buyStep1">
            <div class="builderContent">
                <div class="watchHeader">
                    <span><b>YOUR ORDER:</b></span><br>
                    <a href="watchBuilder.php"><span class="grey editButton">Edit</span></a>
                </div>
                <div class="buyStepContent checkoutForm">
                    <form class="paymentForm" <?php if(!$validPromotionCode) {echo 'action="https://payment.architrade.com/paymentweb/start.action"';} else {echo 'action="receipt.php"';} ?> method="POST" charset="UTF-8">
                        <div>
                            <div class="cell">
                                <b>SHIPPING ADDRESS:</b>
                            </div>
                            <div class="cell">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="cell ">
                                <label for="billingFirstNAME">First Name</label><span class="errorMsg"></span><br>
                                <input type="text" name="billingFirstNAME" required>
                            </div>
                            <div class="cell  rightCell">
                                <label for="billingLastNAME">Last Name</label><span class="errorMsg"></span><br>
                                <input name="billingLastNAME" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="cell">
                                <label for="billingAddress">Address</label><span class="errorMsg"></span><br>
                                <input name="billingAddress" type="text" required>
                            </div>
                            <div class="cell rightCell">
                                <label for="billingPostalCode">Postal Code</label><span class="errorMsg"></span><br>
                                <input name="billingPostalCode" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="cell">
                                <label for="billingCity">City</label><span class="errorMsg"></span><br>
                                <input name="billingCity" type="text" required>
                            </div>
                            <div class="cell rightCell">
                                <label for="billingCountry">Country</label><span class="errorMsg"></span><br>
                                <input name="billingCountry" type="text" required>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="cell">
                                <label for="email">Email</label><span class="errorMsg"></span><br>
                                <input name="email" type="email" required>
                            </div>
                            <div class="cell newsletterCell">
                                &nbsp;<br>
                                <input type="checkbox" name="sendNewsletters"><span>Sign up for our newsletter</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="cell">
                                <span class="cardLogo"><img src="images/logo-pack/dankort_35.gif"></span>
                                <span class="cardLogo"><img src="images/logo-pack/visa-35.gif"></span>
                                <span class="cardLogo"><img src="images/logo-pack/master_35.gif"></span>
                                <span class="cardLogo"><img src="images/logo-pack/amex_35.gif"></span>
                            </div>
                            <div class="cell">
                                <span class="paymentButton"><?php if(!$validPromotionCode) {echo 'TO SECURE PAYMENT';} else {echo 'PLACE ORDER';} ?></span>
                            </div>
                        </div>
                        <div>
                            <br><br><br>
                        </div>
                        <div>
                            <span class="policyText">By proceeding I accept the <a href="info/Privacy%20Policy.pdf">Privacy Policy</a> and the <a href="info/Terms%20and%20Conditions.pdf">Terms and Conditions</a></span>
                        </div>
                        <INPUT TYPE="hidden" NAME="test" value="1">
                        <INPUT TYPE="hidden" NAME="accepturl" VALUE="http://www.jagdwatches.com/newsite/receipt.php">
                        <input type="hidden" name="decorator" value="responsive">
                        <input type="hidden" name="callbackurl" value="http://www.jagdwatches.com/newsite/phpScripts/dibsCallback.php">
                        <?php
                            foreach($state as $k=>$s){
                                echo "<input type='hidden' name='$k' value='$s'>\n";
                            }

                            echo "<input type='hidden' name='merchant'  value='$merchantId'>\n" .
                                 "<input type='hidden' name='orderid'  value='$orderID'>\n" .
                                 "<input type='hidden' name='amount'  value='$price'>\n" .
                                 "<input type='hidden' name='currency'  value='DKK'>\n" .
                                 "<input type='hidden' name='md5key'  value='$md5'>\n";

                        ?>
                    </form>
                </div>

            </div>
        </section>

    </div>

</div>

<div class="footer">
    <div class="innerFooter">
        <span class="footerElement"><a href="info/Terms%20and%20Conditions.pdf">Terms and Conditions</a></span>
        <span class="footerElement"><a href="about.html">About Us</a></span>
        <span class="footerElement lastFooterElement"><a href="contact.html">Contact Us</a></span>
    </div>
</div>



<!-- Footer -->

</body>
</html>