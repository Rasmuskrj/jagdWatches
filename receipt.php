<?php
    include('phpScripts/receiptPreprocessing.php');
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



    <script src="js/watchBuilder.js"></script>

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
    <div class="builderOuterContainer">
        <div class="builderInnerContainer centeredContent">

            <div class="watchContainer buyPosition">
                <div class="watchHeader">
                    <span><b>YOUR ORDER:</b></span><br>
                    <a href="watchBuilder.php"><span class="grey editButton">Edit</span></a>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($strapSrc as $main){
                        echo "<img src='$main' class='watchStrap watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($caseSrc as $main){
                        echo "<img src='$main' class='watchCase watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($dialSrc as $main){
                        echo "<img src='$main' class='watchDial watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($handsSrc as $main){
                        echo "<img src='$main' class='watchHands watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
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
                        echo "<img src='$main' class='watchNumerals watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
                <div class="watchElementContainer">
                    <?php
                    foreach($indexSrc as $main){
                        echo "<img src='$main' class='watchIndex watchElement' data-partType='" . pathinfo($main,PATHINFO_FILENAME) . "'>";
                    }
                    ?>
                </div>
            </div>

            <section class="buyStep1">
                <div class="builderContent">

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

                                    <tr><td class="caseTitle partTitle">CASE:</td><td class="partValue caseValue grey"><?php echo $state['case']?></td></tr>
                                    <tr><td class="handsTitle partTitle">HANDS:</td><td class="partValue handsValue grey"><?php echo $state['hands']?></td></tr>
                                    <tr><td class="dialTitle partTitle">DIAL:</td><td class="partValue dialValue grey"><?php echo $state['dial']?></td></tr>
                                    <tr><td class="strapsTitle partTitle">STRAP 1:</td><td class="partValue strapValue grey"><?php echo $state['straps']?></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cell rightCell">
                                <span class="priceValue"><?php echo $amount?></span><span class="priceCurrency"> DKK</span>
                            </div>
                        </div>
                        <?php
                            if($state['noOfAdditionalStraps'] > 0) {
                                echo '<div class="row additionalStrapsRowMain">
                            <div class="cell">
                                <table class="partRecapTable smallRecapText" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr><td colspan="2" class="additionalStrapRecapTitle watchRecapTitle">ADDITIONAL STRAPS</td></tr>
                                    ';
                                if($state['additionalStrap1'] != $util->noneName) {
                                    echo '<tr class="additionalStrapLine1"><td class="additionalStrap1Title partTitle">STRAP 2:</td><td class="partValue additionalStrap1Value grey">' . $state['additionalStrap1'] . '</td></tr>';
                                }
                                if($state['additionalStrap2'] != $util->noneName) {
                                    echo '<tr class="additionalStrapLine2"><td class="additionalStrap2Title partTitle">STRAP 3:</td><td class="partValue additionalStrap2Value grey">' . $state['additionalStrap2'] . '</td></tr>';
                                }
                                if($state['additionalStrap3'] != $util->noneName) {
                                    echo '<tr class="additionalStrapLine3"><td class="additionalStrap3Title partTitle">STRAP 4:</td><td class="partValue additionalStrap3Value grey">' . $state['additionalStrap3'] . '</td></tr>';
                                }
                                if($state['additionalStrap4'] != $util->noneName) {
                                    echo '<tr class="additionalStrapLine4"><td class="additionalStrap4Title partTitle">STRAP 5:</td><td class="partValue additionalStrap4Value grey">' . $state['additionalStrap4'] . '</td></tr>';
                                }
                                if($state['additionalStrap5'] != $util->noneName) {
                                    echo '<tr class="additionalStrapLine5"><td class="additionalStrap5Title partTitle">STRAP 6:</td><td class="partValue additionalStrap5Value grey">' . $state['additionalStrap5'] . '</td></tr>';
                                }


                                echo '</tbody>
                                </table>
                            </div>
                            <div class="cell rightCell">
                                <table>
                                    <tbody>
                                    <tr><td>&nbsp;</td></tr>';
                                if($state['additionalStrap1'] != $util->noneName){
                                    echo '<tr class="additionalStrapLine1"><td><span class="additionalStrapPriceValue additionalStrapPriceValue1">'.$strapPrice.'</span> <span class="priceCurrency">DKK</span></td></tr>';
                                }
                                if($state['additionalStrap2'] != $util->noneName){
                                    echo '<tr class="additionalStrapLine2"><td><span class="additionalStrapPriceValue additionalStrapPriceValue2">'.$strapPrice.'</span> <span class="priceCurrency">DKK</span></td></tr>';
                                }
                                if($state['additionalStrap3'] != $util->noneName){
                                    echo '<tr class="additionalStrapLine3"><td><span class="additionalStrapPriceValue additionalStrapPriceValue3">'.$strapPrice.'</span> <span class="priceCurrency">DKK</span></td></tr>';
                                }
                                if($state['additionalStrap4'] != $util->noneName){
                                    echo '<tr class="additionalStrapLine4"><td><span class="additionalStrapPriceValue additionalStrapPriceValue4">'.$strapPrice.'</span> <span class="priceCurrency">DKK</span></td></tr>';
                                }
                                if($state['additionalStrap5'] != $util->noneName){
                                    echo '<tr class="additionalStrapLine5"><td><span class="additionalStrapPriceValue additionalStrapPriceValue5">'.$strapPrice.'</span> <span class="priceCurrency">DKK</span></td></tr>';
                                }



                                 echo '</tbody>
                                </table>
                            </div>
                        </div>';
                                }
                        ?>
                        <div class="row bottomRow">
                            <div class="cell">
                                <div class="orderingInformation">
                                    <span>ORDERING FROM JAGD WATCHES</span>
                                    <p class="grey">Return or exchange your order wihtin 14 days<br>
                                        Return cost is 60 DKK but exchange is FREE<br>
                                    </p>
                                    <p class="grey">
                                        Read about shipping and return policies <a>here</a><br>
                                        Do you need help? Call us at +45 25 32 91 58<br>
                                    </p>
                                </div>
                            </div>
                            <div class="cell">
                                <table class="finalPriceRecapTable">
                                    <tbody>
                                    <tr class="grey smallRecapText">
                                        <td>SUBTOTAL:</td>
                                        <td class="rightCell"><span class="priceValue"><?php echo $amount + $straps ?></span><span class="priceCurrency"> DKK</span> </td>
                                    </tr>
                                    <tr class="grey smallRecapText">
                                        <td>SHIPPING:</td>
                                        <td class="rightCell"><span class="shippingCostValue"><?php echo $deliveryPrice ?></span><span class="priceCurrency"> DKK</span> </td>
                                    </tr>
                                    <tr class="grey promotionCodeRow smallRecapText">
                                        <td>PROMOTION CODE:</td>
                                        <td class="rightCell"><span class="promotionCodeDiscount"></span><span class="priceCurrency"> DKK</span> </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td><td>&nbsp;</td>
                                    </tr>
                                    <tr class="totalPriceRow watchRecapTitle">
                                        <td>
                                            TOTAL:
                                        </td>
                                        <td class="rightCell">
                                            <span class="totalPriceValue"><?php echo $price / 100 ?></span><span class="priceCurrency"> DKK</span>
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
    </div>

</body>
</html>