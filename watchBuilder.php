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
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link rel="stylesheet" href="plugins/jquery-ui-1.11.4.custom/jquery-ui.css">
    <link rel="stylesheet" href="plugins/fancybox2/jquery.fancybox.css">
    <link rel="stylesheet" href="plugins/fancybox2/helpers/jquery.fancybox-thumbs.css">
    <link rel="stylesheet" href="css/style.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->



    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="plugins/js-cookie-1.5.1/src/js.cookie.js"></script>
    <script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script src="plugins/fancybox2/jquery.fancybox.pack.js"></script>
    <script src="plugins/fancybox2/helpers/jquery.fancybox-thumbs.js"></script>
    <script src="js/jquery.poptrox.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/jquery.scrollgress.min.js"></script>
    <script>
        var pricePlainOneStrap = <?php echo $prices[0]['price_dkk']; ?>;
        var pricePlainThreeStraps = <?php echo $prices[1]['price_dkk']; ?>;
        var priceEngravedOneStrap = <?php echo $prices[2]['price_dkk']; ?>;
        var priceEngravedThreeStraps = <?php echo $prices[3]['price_dkk']; ?>;

        var cases = [],
            straps = [],
            hands = [],
            dials = [],
            indices = [],
            numerals = [],
            patterns = [];
        <?php
            foreach($watchCaseThumbnails as $thumbnail) {
                echo "cases.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
        ?>
        <?php
            foreach($watchStrapsThumbnails as $thumbnail) {
                echo "straps.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
        ?>
        <?php
            foreach($watchHandsThumbnails as $thumbnail) {
                echo "hands.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
        ?>
        <?php
            foreach($watchDialThumbnails as $thumbnail) {
                echo "dials.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
        ?>
        <?php
            foreach($patternThumbnails as $thumbnail) {
                echo "patterns.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
        ?>
        <?php
            foreach($watchNumeralsThumbnails as $thumbnail) {
                echo "numerals.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
        ?>
        <?php
            foreach($watchIndexThumbnails as $thumbnail) {
                echo "indices.push('" . pathinfo($thumbnail,PATHINFO_FILENAME) . "');\n\t\t";
            }
        ?>
    </script>



    <script src="js/watchBuilder.js"></script>

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
    <div class="builderInnerContainer centeredContent">



        <section class="splash">
            <!--<a id="startButton" href="javascript: void(0)" class="button style3">Build my watch</a>-->
            <span id="startButton" class="cstmbtn type2"><span><b>Build my watch</b></span></span>
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
            <div class="chooseArrowLeft">
                <img src="images/WatchBuilder/Misc/Arrow%20main.png">
            </div>
            <div class="chooseArrowRight">
                <img src="images/WatchBuilder/Misc/Arrow%20main.png">
            </div>
        </div>

        <!-- Step 1 -->
        <section class="step1" name="step1">
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
                        <span class="additionalStrapModalButton">+<b>ADD</b> MORE</span>
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
                        <span id="step2Button" class="cstmbtn type1"><span>Design <b>your own dial</b></span></span>
                        <span class="cstmbtn type2 buyNowButton"><span><b>Buy it</b> now</span></span>
                        <!--<a id="step2Button" class="button style3">Make it your own</a>-->
                    </div>
                    <div class="priceContainer">
                        <div class="hline"></div>
                        <div class="price">
                            <span class="priceLabel">Price:</span><span class="priceValue"> 200</span> <span class="priceCurrency">DKK</span>
                        </div>
                    </div>
                </div>
                <div class="galleryTextContainer">
                    <span class="openGalleryText"><b>Gallery</b></span><span> - See examples of real JAGD Watches</span>
                </div>
            </div>
            <div class="hline endline"></div>
        </section>

        <!-- step 2 -->
        <section class="step2" name="step2">
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
                        <p class="watchBuilderText">PATTERN</p><p class="partDescription"></p><input type="checkbox" id="invertPattern"><label id="invertPatternLabel" class="invertPattern" for="invertPattern">Invert Pattern</label>
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
                    <p class="patternRotatorText">Rotate pattern</p>
                    <div class="patternRotatorSlider"></div>
                </div>
                <div class="buttonsContainer">
                    <p class="step2ButtonHelperText">Looking good!</p>
                    <div class="step2Buttons">
                        <span class="cstmbtn type2 buyNowButton"><span><b>Buy it</b> now</span></span>
                        <!--<a id="step2Button" class="button style3">Make it your own</a>-->
                    </div>
                    <div class="priceContainer">
                        <div class="hline"></div>
                        <div class="price">
                            <span class="priceLabel">Price:</span><span class="priceValue"> 200</span> <span class="priceCurrency">DKK</span>
                        </div>
                    </div>
                </div>
                <div class="galleryTextContainer">
                    <span class="openGalleryText"><b>Gallery</b></span><span> - See examples of real JAGD Watches</span>
                </div>
            </div>
            <div class="hline endline"></div>
        </section>

        <!-- Customer Details -->
        <section id="customerDetails">
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

    </div>
    <div class="bottomGalleryContainer centeredContent">
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

<div id="additionalStrapDialog" title="ADDITIONAL STRAP SELECTION">
    <p>You can add <b>2 additional straps</b> for 100 DKK.</p>
    <div class="modalSelector">
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
    <div class="modalRecap">
        <span class="strapLine"><span class="strap1Title strapTitle">>Strap 1:</span><span class="strapModalValue strap1Value unselectedStrap">Please select</span><span class="clearButton"></span></span><br>
        <span class="strapLine"><span class="strap2Title strapTitle">>Strap 2:</span><span class="strapModalValue strap2Value unselectedStrap">Please select</span><span class="clearButton"></span></span>
    </div>
</div>






<!-- Footer -->

</body>
</html>