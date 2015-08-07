<?php
/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 02-04-2015
 * Time: 23:37
 */
include("phpScripts/Preprocessing.php");
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
    <script>
        var pricePlainOneStrap = <?php echo $prices[0]['price_dkk']; ?>;
        var priceEngravedOneStrap = <?php echo $prices[1]['price_dkk']; ?>;
        var shippingCost = <?php echo $prices[2]['price_dkk']; ?>;
        var singleStrapCost = <?php echo $prices[3]['price_dkk']; ?>;

        var cases = [],
            straps = [],
            hands = [],
            dials = [],
            indices = [],
            numerals = [],
            patterns = [],
            markers = [];
        <?php
            foreach($watchCaseThumbnails as $thumbnail) {
                echo "cases.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
            foreach($watchStrapsThumbnails as $thumbnail) {
                echo "straps.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
            foreach($watchHandsThumbnails as $thumbnail) {
                echo "hands.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
            foreach($watchDialThumbnails as $thumbnail) {
                echo "dials.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
            foreach($patternThumbnails as $thumbnail) {
                echo "patterns.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
            foreach($watchNumeralsThumbnails as $thumbnail) {
                echo "numerals.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
            foreach($watchIndexThumbnails as $thumbnail) {
                echo "indices.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
            foreach($watchMarkerThumbnails as $thumbnail) {
                echo "markers.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
        ?>
    </script>



    <script src="js/watchBuilder.js"></script>
    <script src="js/builder.js"></script>

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
        <div class="builderInnerContainer centeredContent">



            <section class="splash">
                <!--<a id="startButton" href="javascript: void(0)" class="button style3">Build my watch</a>-->
                <span id="startButton"><span><b>Build my watch</b></span></span>
            </section>

            <div class="watchContainer watchIntro">
                <div class="watchElementContainer">
                    <?php
                    foreach($watchStrapMains as $main){
                        echo "<img src='$main' class='watchStrap watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($watchCaseMains as $main){
                        echo "<img src='$main' class='watchCase watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($watchDialMains as $main){
                        echo "<img src='$main' class='watchDial watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($watchHandsMains as $main){
                        echo "<img src='$main' class='watchHands watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
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
                        echo "<img src='$main' class='watchNumerals watchElement step2WatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($watchIndexMains as $main){
                        echo "<img src='$main' class='watchIndex watchElement step2WatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($watchMarkerMains as $main){
                        echo "<img src='$main' class='watchMarker watchElement step2WatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="chooseArrowLeft">
                    <img src="images/WatchBuilder/Misc/Arrow%20main.png">
                </div>
                <div class="chooseArrowRight">
                    <img src="images/WatchBuilder/Misc/Arrow%20main.png">
                </div>
                <span id="fullViewButton" class="step1 step2 type2">Full view</span>
            </div>

            <!-- Step 1 -->
            <section class="step1" name="step1">
                <div class="builderContent">
                    <div class="selectCaseColor leftSideSelector">
                        <div class="selectorHeader leftSideSelectorHeader">
                            <p class="watchBuilderText">CASE COLOR</p><!--
                            --><p class="partDescription grey">Outline</p>

                        </div>
                        <div class="thumbnails thumbnailsLeft">
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchCaseThumbnail arrow leftArrow thumbnail leftSideThumbnail'></span></span>
                            <?php
                            foreach($watchCaseThumbnails as $thumbnail){
                                echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchCaseThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                            }
                            ?>
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchCaseThumbnail arrow rightArrow thumbnail leftSideThumbnail'></span></span>
                        </div>
                    </div>
                    <div class="selectStrap leftSideSelector">
                        <div class="selectorHeader leftSideSelectorHeader">
                            <p class="watchBuilderText">STRAP MATERIAL</p><p class="partDescription grey">Outline</p>
                            <span class="additionalStrapModalButton">+<b>ADD MORE</b></span>
                        </div>
                        <div class="thumbnails thumbnailsLeft hScrollable">
                            <?php
                            foreach($watchStrapsThumbnails as $thumbnail){
                                echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchStrapThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="selectHands leftSideSelector">
                        <div class="selectorHeader leftSideSelectorHeader">
                            <p class="watchBuilderText">HANDS COLOR</p><p class="partDescription grey"></p>
                        </div>
                        <div class="thumbnails thumbnailsLeft">
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchHandsThumbnail arrow leftArrow thumbnail leftSideThumbnail'></span></span>
                            <?php
                            foreach($watchHandsThumbnails as $thumbnail){
                                echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchHandsThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                            }
                            ?>
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchHandsThumbnail arrow rightArrow thumbnail leftSideThumbnail'></span></span>
                        </div>
                    </div>
                    <div class="selectDial rightSideSelector">
                        <div class="selectorHeader rightSideSelectorHeader">
                            <p class="watchBuilderText">DIAL MATERIAL</p><p class="partDescription grey"></p>
                        </div>
                        <div class="thumbnails thumbnailsRight vScrollable">
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
                            <span id="step2Button" class="type2 lowerRightButton twoLines"><span>Design <b>your own dial</b></span></span>
                            <span class="buyNowButton lowerRightButton"><span><b>Buy it</b> now</span></span>
                            <!--<a id="step2Button" class="button style3">Make it your own</a>-->
                        </div>
                        <div class="priceContainer">
                            <div class="hline"></div>
                            <div class="price">
                                <span class="priceLabel">Price:</span><span class="setRegionButton">Set Region to see price</span><span class="priceValueContainer"><span class="totalPriceValue priceValueBuilder"> 200</span> <span class="priceCurrency priceCurrencyBuilder">DKK</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="galleryTextContainer">
                        <span class="openGalleryText"><img src="images/WatchBuilder/Misc/Arrow%20main.png" class="galleryArrow"><b>Gallery</b></span><span> - See examples of real JAGD Watches</span>
                    </div>
                </div>
                <div class="hline endline"></div>
            </section>

            <!-- step 2 -->
            <section class="step2" name="step2">
                <div class="content container small">
                    <div class="selectIndex leftSideSelector">
                        <div class="selectorHeader leftSideSelectorHeader">
                            <p class="watchBuilderText">INDEX</p><p class="partDescription grey"></p>
                        </div>
                        <div class="thumbnails thumbnailsLeft">
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchIndexThumbnail arrow leftArrow thumbnail leftSideThumbnail'></span></span>
                            <?php
                            foreach($watchIndexThumbnails as $thumbnail){
                                echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchIndexThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                            }
                            ?>
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchIndexThumbnail arrow rightArrow thumbnail leftSideThumbnail'></span></span>
                        </div>
                    </div>
                    <div class="selectNumerals leftSideSelector">
                        <div class="selectorHeader leftSideSelectorHeader">
                            <p class="watchBuilderText">NUMERALS</p><p class="partDescription grey"></p>
                        </div>
                        <div class="thumbnails thumbnailsLeft ">
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchNumeralsThumbnail arrow leftArrow thumbnail leftSideThumbnail'></span></span>
                            <?php
                            foreach($watchNumeralsThumbnails as $thumbnail){
                                echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchNumeralsThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                            }
                            ?>
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchNumeralsThumbnail arrow rightArrow thumbnail leftSideThumbnail'></span></span>
                        </div>
                    </div>
                    <div class="selectMarker leftSideSelector">
                        <div class="selectorHeader leftSideSelectorHeader">
                            <p class="watchBuilderText">MARKER</p><p class="partDescription grey"></p>
                        </div>
                        <div class="thumbnails thumbnailsLeft">
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchNumeralsThumbnail arrow leftArrow thumbnail leftSideThumbnail'></span></span>
                            <?php
                            foreach($watchMarkerThumbnails as $thumbnail){
                                echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchMarkerThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                            }
                            ?>
                            <span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='images/WatchBuilder/Misc/Arrow%20main.png' class='watchNumeralsThumbnail arrow rightArrow thumbnail leftSideThumbnail'></span></span>
                        </div>
                    </div>
                    <div class="selectPattern rightSideSelector">
                        <div class="selectorHeader rightSideSelectorHeader">
                            <p class="watchBuilderText">PATTERN</p><p class="partDescription grey"></p><input type="checkbox" id="invertPattern"><label id="invertPatternLabel" class="invertPattern type2" for="invertPattern">Invert Pattern</label>
                        </div>
                        <div class="thumbnails thumbnailsRight vScrollable">
                            <?php
                            foreach($patternThumbnails as $thumbnail){
                                echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchPatternThumbnail thumbnail rightSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="patternRotator">
                        <p class="patternRotatorText">Rotate pattern</p>
                        <div class="patternRotatorSlider"></div>
                    </div>
                    <div class="buttonsContainer">
                        <p class="step2ButtonHelperText">Looking good!</p>
                        <div class="step2Buttons">
                            <span class="buyNowButton lowerRightButton"><span><b>Buy it</b> now</span></span>
                            <!--<a id="step2Button" class="button style3">Make it your own</a>-->
                        </div>
                        <div class="priceContainer">
                            <div class="hline"></div>
                            <div class="price">
                                <span class="priceLabel">Price:</span><span class="setRegionButton">Set Region to see price</span><span class="priceValueContainer"><span class="totalPriceValue priceValueBuilder"> 200</span> <span class="priceCurrency priceCurrencyBuilder">DKK</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="galleryTextContainer">
                        <span class="openGalleryText"><img src="images/WatchBuilder/Misc/Arrow%20main.png" class="galleryArrow"><b>Gallery</b></span><span> - See examples of real JAGD Watches</span>
                    </div>
                </div>
                <div class="hline endline"></div>
            </section>

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
                        <span class="markerTitle partTitle"><b>Numerals:</b></span><span class="markerValue"></span><br>
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
                        <span class="grey editButton">Edit</span>
                    </div>

                    <div class="watchRecap buyStepContent">
                        <div class="row">
                            <div class="cell watchRecapTitle">
                                ITEM
                            </div>
                            <div class="cell watchRecapTitle rightCell">
                                PRICE
                            </div>
                        </div>
                        <div class="row">
                            <div class="cell">
                                <table class="partRecapTable smallRecapText" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr><td colspan="2" class="step1RecapTitle watchRecapTitle">JAGD WATCH - PLAIN DIAL</td></tr>

                                    <tr><td class="caseTitle partTitle">CASE:</td><td class="partValue caseValue grey"></td></tr>
                                    <tr><td class="handsTitle partTitle">HANDS:</td><td class="partValue handsValue grey"></td></tr>
                                    <tr><td class="dialTitle partTitle">DIAL:</td><td class="partValue dialValue grey"></td></tr>
                                    <tr><td class="strapsTitle partTitle">STRAP 1:</td><td class="partValue strapValue grey"></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cell rightCell">
                                <span class="priceValue">950</span><span class="priceCurrency"> DKK</span>
                            </div>
                        </div>
                        <div class="row additionalStrapsRowMain">
                            <div class="cell">
                                <table class="partRecapTable smallRecapText" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr><td colspan="2" class="additionalStrapRecapTitle watchRecapTitle">ADDITIONAL STRAPS</td></tr>
                                        <tr class="additionalStrapLine1"><td class="additionalStrap1Title partTitle">STRAP 2:</td><td class="partValue additionalStrap1Value grey">None</td></tr>
                                        <tr class="additionalStrapLine2"><td class="additionalStrap2Title partTitle">STRAP 3:</td><td class="partValue additionalStrap2Value grey">None</td></tr>
                                        <tr class="additionalStrapLine3"><td class="additionalStrap3Title partTitle">STRAP 4:</td><td class="partValue additionalStrap3Value grey">None</td></tr>
                                        <tr class="additionalStrapLine4"><td class="additionalStrap4Title partTitle">STRAP 5:</td><td class="partValue additionalStrap4Value grey">None</td></tr>
                                        <tr class="additionalStrapLine5"><td class="additionalStrap5Title partTitle">STRAP 6:</td><td class="partValue additionalStrap5Value grey">None</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cell rightCell">
                                <table>
                                    <tbody>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr class="additionalStrapLine1"><td><span class="additionalStrapPriceValue additionalStrapPriceValue1">0</span> <span class="priceCurrency">DKK</span></td></tr>
                                        <tr class="additionalStrapLine2"><td><span class="additionalStrapPriceValue additionalStrapPriceValue2">0</span> <span class="priceCurrency">DKK</span></td></tr>
                                        <tr class="additionalStrapLine3"><td><span class="additionalStrapPriceValue additionalStrapPriceValue3">0</span> <span class="priceCurrency">DKK</span></td></tr>
                                        <tr class="additionalStrapLine4"><td><span class="additionalStrapPriceValue additionalStrapPriceValue4">0</span> <span class="priceCurrency">DKK</span></td></tr>
                                        <tr class="additionalStrapLine5"><td><span class="additionalStrapPriceValue additionalStrapPriceValue5">0</span> <span class="priceCurrency">DKK</span></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row bottomRow">
                            <div class="cell">
                                <div>
                                    <label class="promotionCodeLabel" for="promotionCode"><b>Enter promotion code</b></label><br>
                                    <input class="promotionCodeInput addPromotionCodeLine" type="text" for="promotionCode">
                                    <a class="addPromotionCodeBtn addPromotionCodeLine">ADD</a>
                                </div>
                                <div class="orderingInformation">
                                    <span>ORDERING FROM JAGD WATCHES</span>
                                    <p class="grey">Return or exchange your order wihtin 14 days<br>
                                        Return cost is 60 DKK but exchange is FREE<br>
                                    </p>
                                    <p class="grey">
                                        Read about shipping and return policies <a href="info/Shipping%20and%20return%20policies.pdf">here</a><br>
                                        Do you need help? Call us at +45 25 32 91 58<br>
                                    </p>
                                </div>
                            </div>
                            <div class="cell">
                                <table class="finalPriceRecapTable">
                                    <tbody>
                                        <tr class="grey smallRecapText">
                                            <td>SUBTOTAL:</td>
                                            <td class="rightCell"><span class="subtotalValue"></span><span class="priceCurrency"> DKK</span> </td>
                                        </tr>
                                        <tr class="grey smallRecapText">
                                            <td>SHIPPING:</td>
                                            <td class="rightCell"><span class="shippingCostValue">60</span><span class="priceCurrency"> DKK</span> </td>
                                        </tr>
                                        <tr class="grey promotionCodeRow smallRecapText">
                                            <td>PROMOTION CODE:</td>
                                            <td class="rightCell"><span class="promotionCodeDiscount"></span><span class="priceCurrency"> DKK</span> </td>
                                        </tr>
                                        <tr class="grey vatRow smallRecapText">
                                            <td>VAT</td>
                                            <td class="rightCell"><span class="vatValue"></span><span class="priceCurrency"> DKK</span></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td><td>&nbsp;</td>
                                        </tr>
                                        <tr class="totalPriceRow watchRecapTitle">
                                            <td>
                                                TOTAL:
                                            </td>
                                            <td class="rightCell">
                                                <span class="totalPriceValue"></span><span class="priceCurrency"> DKK</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="buyStep2Button watchRecapTitle">GO TO CHECKOUT</div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>
        <div class="bottomGalleryContainer centeredContent hScrollable">
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/01.jpg" title="Image 1">
                <img src="images/fulls/01.jpg" alt="" />
            </a>
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/02.jpg" title="Image 2">
                <img src="images/fulls/02.jpg" alt="" />
            </a>
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/03.jpg" title="Image 3">
                <img src="images/fulls/03.jpg" alt="" />
            </a>
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/04.jpg" title="Image 4">
                <img src="images/fulls/04.jpg" alt="" />
            </a>
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/05.jpg" title="Image 5">
                <img src="images/fulls/05.jpg" alt="" />
            </a>
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/06.jpg" title="Image 6">
                <img src="images/fulls/06.jpg" alt="" />
            </a>
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/07.jpg" title="Image 7">
                <img src="images/fulls/07.jpg" alt="" />
            </a>
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/08.jpg" title="Image 8">
                <img src="images/fulls/08.jpg" alt="" />
            </a>
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/09.jpg" title="Image 9">
                <img src="images/fulls/09.jpg" alt="" />
            </a>
            <a class="fancybox bottomGallery" rel="bottomGallery" href="images/fulls/10.jpg" title="Image 10">
                <img src="images/fulls/10.jpg" alt="" />
            </a>
        </div>
    </div>

<div class="footer">
    <div class="innerFooter">
        <span class="footerElement"><a href="info/Terms%20and%20Conditions.pdf">Terms and Conditions</a></span>
        <span class="footerElement"><a href="about.html">About Us</a></span>
        <span class="footerElement lastFooterElement"><a href="contact.html">Contact Us</a></span>
    </div>
</div>

<div class="cookieNotice">
    <div class="noticeContainer">
        <p><b>This site uses cookies.</b> We use cookies to save your design and to ensure that we give you the best experience.</p><p class="redText">Find out more about cookies <a href="info/AboutCookies.pdf">here</a>.</p>
        <span class="closeCookieNotice">Continue</span>
    </div>
</div>



<!-- Footer -->
<div id="additionalStrapDialog" title="ADDITIONAL STRAP SELECTION">
    <p>You can add up to <b>5 additional straps</b> for 100 DKK each.</p>
    <div class="modalSelector">
        <div class="selectorHeader leftSideSelectorHeader">
            <p class="watchBuilderText">STRAP MATERIAL</p><p class="partDescription"></p>
        </div>
        <div class="thumbnails thumbnailsLeft hScrollable">
            <?php
            foreach($watchStrapsThumbnails as $thumbnail){
                echo "<span class='thumbnailContainer'><span class='thumbnailInnerContainer'><img src='$thumbnail' class='watchStrapThumbnail thumbnail leftSideThumbnail' data-partType='" . pathinfo($thumbnail,PATHINFO_FILENAME) . "'></span></span>";
            }
            ?>
        </div>
    </div>
    <div class="modalRecap">
        <span class="strapLine"><span class="strap1Title strapTitle">>Strap 1:</span><span class="strapModalValue strap1Value unselectedStrap">Please select</span><span class="clearButton"></span></span><br>
        <span class="strapLine"><span class="strap2Title strapTitle">>Strap 2:</span><span class="strapModalValue strap2Value unselectedStrap">Please select</span><span class="clearButton"></span></span><br>
        <span class="strapLine"><span class="strap3Title strapTitle">>Strap 3:</span><span class="strapModalValue strap3Value unselectedStrap">Please select</span><span class="clearButton"></span></span><br>
        <span class="strapLine"><span class="strap4Title strapTitle">>Strap 4:</span><span class="strapModalValue strap4Value unselectedStrap">Please select</span><span class="clearButton"></span></span><br>
        <span class="strapLine"><span class="strap5Title strapTitle">>Strap 5:</span><span class="strapModalValue strap5Value unselectedStrap">Please select</span><span class="clearButton"></span></span>
    </div>
</div>

<div id="fullViewDialog" title="FULL VIEW">
    <div class="fullViewContainer">
        <div class="watchElementContainer">
            <?php
            foreach($watchStrapMains as $main){
                echo "<img src='$main' class='watchStrap watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
            }
            ?>
        </div>
        <div class="watchElementContainer">
            <?php
            foreach($watchCaseMains as $main){
                echo "<img src='$main' class='watchCase watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
            }
            ?>
        </div>
        <div class="watchElementContainer">
            <?php
            foreach($watchDialMains as $main){
                echo "<img src='$main' class='watchDial watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
            }
            ?>
        </div>
        <div class="watchElementContainer">
            <?php
            foreach($watchHandsMains as $main){
                echo "<img src='$main' class='watchHands watchElement largeWatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
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
                echo "<img src='$main' class='watchNumerals watchElement step2WatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
            }
            ?>
        </div>
        <div class="watchElementContainer">
            <?php
            foreach($watchIndexMains as $main){
                echo "<img src='$main' class='watchIndex watchElement step2WatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
            }
            ?>
        </div>
        <div class="watchElementContainer">
            <?php
            foreach($watchMarkerMains as $main){
                echo "<img src='$main' class='watchMarker watchElement step2WatchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
            }
            ?>
        </div>
        <div class="watchElementContainer">
            <?php
            foreach($watchCaseBackMains as $main){
                echo "<img src='$main' class='watchCase watchElement largeWatchElement backElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
            }
            ?>
        </div>
        <div class="watchElementContainer">
            <?php
            foreach($watchStrapEndingsMains as $main){
                echo "<img src='$main' class='watchStrap watchElement largeWatchElement backElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
            }
            ?>
        </div>
        <div class="watchElementContainer">
            <?php
            foreach($watchStrapMains as $main){
                echo "<img src='$main' class='watchStrap watchElement largeWatchElement backElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
            }
            ?>
        </div>
    </div>

</div>

<div id="invalidPromotionCodeModal" title="PROMOTION CODE NOT FOUND">
    <p>The promotion code you have entered was not found. Please make sure that the code is correct.</p>
</div>

<div id="invalidSelectionsModal" title="INVALID SELECTIONS">
    <p>You must choose a <b>strap</b> and a <b>watch casing</b> in order to continue</p>
</div>

<div id="cover">
</div>

<div id="chooseRegionModal" title="CHOOSE A REGION">
    <p>Please choose EU or rest of the world</p>
    <div class="regionRadioContainer">
        <div id="chooseRegionRadio">
            <input type="radio" id="chooseRegionEU" name="radio" value="EU" checked="checked"><label for="chooseRegionEU">EU</label>
            <input type="radio" id="chooseRegionNon_EU" name="radio" value="non-EU"><label for="chooseRegionNon_EU">Rest of world</label>
        </div>
    </div>
</div>

<div id="noRegionSelectedModal" TITLE="NO REGION SELECTED">
    <p>Before you can continue, you must first select a region by clicking the button 'Set region to see price'.</p>
</div>
</body>
</html>