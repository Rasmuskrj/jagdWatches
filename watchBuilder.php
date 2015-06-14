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
    <script src="plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <script src="js/jquery.poptrox.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/jquery.scrollgress.min.js"></script>
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
<section class="main style1 fullscreen" id="step1" name="step1">
    <div class="content container small">
        <div class="selectCaseColor leftSideSelector">
            <div class="selectorHeader leftSideSelectorHeader">
                <p class="watchBuilderText">Case Color</p><!--
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
                <p class="watchBuilderText">Strap</p><p class="partDescription"></p>
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
                <p class="watchBuilderText">Hands Color</p><p class="partDescription"></p>
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
                <p class="watchBuilderText">Dial</p><p class="partDescription"></p>
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
            <p class="watchBuilderText">Design your own dial?</p>
            <a id="step2Button" class="button style3">Make it your own</a>
        </div>
    </div>
</section>

<!-- step 2 -->
<section class="main style1 fullscreen" id="step2" name="step2">
    <div class="content container small">
        <div class="selectIndex leftSideSelector">
            <div class="selectorHeader leftSideSelectorHeader">
                <p class="watchBuilderText">Index</p><p class="partDescription"></p>
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
                <p class="watchBuilderText">Numerals</p><p class="partDescription"></p>
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
                <p class="watchBuilderText">Pattern</p><p class="partDescription"></p><input type="checkbox" id="invertPattern"><label class="invertPattern" for="invertPattern">Invert Pattern</label>
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
    </div>
</section>


<!-- Footer -->
<?php include("Partials/footer.php"); ?>

</body>
</html>