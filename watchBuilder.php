<?php
/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 02-04-2015
 * Time: 23:37
 */
include("Preprocessing.php");
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>JAGD Watches</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="plugins/js-cookie-1.5.1/src/js.cookie.js"></script>
    <script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script src="js/jquery.poptrox.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/jquery.scrollgress.min.js"></script>
    <script>
        var pricePlainOneStrap = <?php echo $prices[0]['price_dkk']; ?>;
        var pricePlainThreeStraps = <?php echo $prices[1]['price_dkk']; ?>;
        var priceEngravedOneStrap = <?php echo $prices[2]['price_dkk']; ?>;
        var priceEngravedThreeStraps = <?php echo $prices[3]['price_dkk']; ?>;
    </script>



    <script src="js/watchBuilder.js"></script>

    <link rel="stylesheet" href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
    <!--<script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-53828788-1', 'auto');
        ga('send', 'pageview');

    </script>-->
</head>
<body>

<!-- Header -->
<header id="header">

    <!-- Logo -->
    <img src="images/JAGD logo grey white.png" alt="" name="logo" height="40" class="image logo">

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a id="backButton" href="#">Back</a></li>
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
    <div class="builderInnerContainer">



        <section id="splash">
            <a id="startButton" href="javascript: void(0)" class="button style3">Build my watch</a>
        </section>

        <div class="watchContainer">
            <div class="watchElementContainer">
                <?php
                foreach($watchStrapMains as $main){
                    echo "<img src='$main' class='watchStrap watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($watchCaseMains as $main){
                    echo "<img src='$main' class='watchCase watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($watchDialMains as $main){
                    echo "<img src='$main' class='watchDial watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($watchHandsMains as $main){
                    echo "<img src='$main' class='watchHands watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($patternMains as $main){
                    echo "<img src='$main' class='watchPattern watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($watchNumeralsMains as $main){
                    echo "<img src='$main' class='watchNumerals watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
            <div class="watchElementContainer">
                <?php
                foreach($watchIndexMains as $main){
                    echo "<img src='$main' class='watchIndex watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                }
                ?>
            </div>
        </div>

        <!-- Step 1 -->
        <section id="step1" name="step1">
            <div class="builderContent">
                <div class="selectCaseColor leftSideSelector">
                    <div class="selectorHeader leftSideSelectorHeader">
                        <p class="watchBuilderText">CASE COLOR</p><!--
                        --><p class="partDescription"></p>

                    </div>
                    <div class="thumbnails thumbnailsLeft">
                        <?php
                        foreach($watchCaseThumbnails as $thumbnail){
                            echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchCaseThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                        }
                        ?>
                    </div>
                </div>
                <div class="selectStrap leftSideSelector">
                    <div class="selectorHeader leftSideSelectorHeader">
                        <p class="watchBuilderText">STRAP MATERIAL</p><p class="partDescription"></p>
                    </div>
                    <div class="thumbnails thumbnailsLeft">
                        <?php
                        foreach($watchStrapsThumbnails as $thumbnail){
                            echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchStrapThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                        }
                        ?>
                    </div>
                </div>
                <div class="selectHands leftSideSelector">
                    <div class="selectorHeader leftSideSelectorHeader">
                        <p class="watchBuilderText">HANDS COLOR</p><p class="partDescription"></p>
                    </div>
                    <div class="thumbnails thumbnailsLeft">
                        <?php
                        foreach($watchHandsThumbnails as $thumbnail){
                            echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchHandsThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                        }
                        ?>
                    </div>
                </div>
                <div class="selectDial rightSideSelector">
                    <div class="selectorHeader rightSideSelectorHeader">
                        <p class="watchBuilderText">DIAL MATERIAL</p><p class="partDescription"></p>
                    </div>
                    <div class="thumbnails thumbnailsRight">
                        <?php
                        foreach($watchDialThumbnails as $thumbnail){
                            echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchDialThumbnail thumbnail rightSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                        }
                        ?>
                    </div>
                </div>
                <div class="buttonsContainer">
                    <p class="buttonHelperText">You now have two options. To continue and design your own dial <b>or</b> buy it as it is right now.</p>
                    <div class="step1Buttons">
                        <span id="step2Button" class="cstmbtn type1">Design <b>your own dial</b></span>
                        <span class="cstmbtn type2 buyNowButton"><b>Buy it</b> now</span>
                        <!--<a id="step2Button" class="button style3">Make it your own</a>-->
                    </div>
                    <div class="priceContainer">
                        <div class="hline"></div>
                        <div class="price">
                            <span class="priceLabel">Price:</span><span class="priceValue"> 200</span> <span class="priceCurrency">DKK</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- step 2 -->
        <section id="step2" name="step2">
            <div class="content container small">
                <div class="selectIndex leftSideSelector">
                    <div class="selectorHeader leftSideSelectorHeader">
                        <p class="watchBuilderText">INDEX</p><p class="partDescription"></p>
                    </div>
                    <div class="thumbnails thumbnailsLeft">
                        <?php
                        foreach($watchIndexThumbnails as $thumbnail){
                            echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchIndexThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                        }
                        ?>
                    </div>
                </div>
                <div class="selectNumerals leftSideSelector">
                    <div class="selectorHeader leftSideSelectorHeader">
                        <p class="watchBuilderText">NUMERALS</p><p class="partDescription"></p>
                    </div>
                    <div class="thumbnails thumbnailsLeft">
                        <?php
                        foreach($watchNumeralsThumbnails as $thumbnail){
                            echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchNumeralsThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                        }
                        ?>
                    </div>
                </div>
                <div class="selectPattern rightSideSelector">
                    <div class="selectorHeader rightSideSelectorHeader">
                        <p class="watchBuilderText">PATTERN</p><p class="partDescription"></p><input type="checkbox" id="invertPattern"><label class="invertPattern" for="invertPattern">Invert Pattern</label>
                    </div>
                    <div class="thumbnails thumbnailsRight">
                        <?php
                        foreach($patternThumbnails as $thumbnail){
                            echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchPatternThumbnail thumbnail rightSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                        }
                        ?>
                    </div>
                </div>
                <div class="patternRotator">
                    <p class="watchBuilderText">Rotate pattern</p>
                    <div class="patternRotatorSlider"></div>
                </div>
                <div class="buttonsContainer">
                    <p class="buttonHelperText">You now have two options. To continue and design your own dial <b>or</b> buy it as it is right now.</p>
                    <div class="step1Buttons">
                        <span class="cstmbtn type2 buyNowButton"><b>Buy it</b> now</span>
                        <!--<a id="step2Button" class="button style3">Make it your own</a>-->
                    </div>
                    <div class="priceContainer">
                        <div class="hline"></div>
                        <div class="price">
                            <span class="priceLabel">Price:</span><span class="priceValue"> 200</span> <span class="priceCurrency">DKK</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Customer Details -->
        <section class="main style1 fullscreen" id="customerDetails">
            <div class="content container small">
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
        </section>

    </div>
</div>


<!-- Footer -->

</body>
</html>