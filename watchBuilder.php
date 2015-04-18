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
    <script src="js/jquery.poptrox.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/jquery.scrollgress.min.js"></script>
    <script src="js/watchBuilder.js"></script>

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
            <li><a href="index.php">Back To Main</a></li>
        </ul>
    </nav>

</header>
<!-- SPLASH -->
<section class="main style1 fullscreen" id="splash" name="splash" style="padding-top:50px !important;">
    <div class="content container small">
        <img name="splash2" src="images/Watch-splash.gif" style="width:320px;" class="image">
        <footer>
            <a id="startButton" href="javascript: void(0)" class="button style3">Build my watch</a>
        </footer>
    </div>

</section>

<!-- Step 1 -->
<section class="main style1 fullscreen" id="step1" name="step1">
    <div class="content container small">
        <div class="watchContainer">
            <img src="images/WatchBuilder/Straps/Main/Oily%20brown.png" class="watchElement watchStraps">
            <img src="images/WatchBuilder/WatchCase/Main/Stainless%20steel.png" class="watchElement watchCase" >
            <img src="images/WatchBuilder/DialMaterial/Main/Dial%20bamboo.png" class="watchElement watchDial">
            <img src="images/WatchBuilder/Hands/Main/Hands%20silver.png" class="watchElement watchHands">
        </div>
        <div class="selectCaseColor leftSideSelector">
            <div class="selectCaseColorHeader leftSideSelectorHeader">
                <p>Case Color</p>
            </div>
            <div class="thumbnails">
                <?php
                foreach($watchCaseThumbnails as $thumbnail){
                    echo "<img src='$thumbnail' class='watchCaseThumbnail thumbnail leftSideThumbnail'>";
                }
                ?>
            </div>
        </div>
        <div class="selectStrap leftSideSelector">
            <div class="selectStrapHeader leftSideSelectorHeader">
                <p>Strap</p>
            </div>
            <div class="thumbnails">
                <?php
                foreach($watchStrapsThumbnails as $thumbnail){
                    echo "<img src='$thumbnail' class='watchStrapThumbnail thumbnail leftSideThumbnail'>";
                }
                ?>
            </div>
        </div>
        <div class="selectHands leftSideSelector">
            <div class="selectHandsHeader leftSideSelectorHeader">
                <p>Hands Color</p>
            </div>
            <div class="thumbnails">
                <?php
                foreach($watchHandsThumbnails as $thumbnail){
                    echo "<img src='$thumbnail' class='watchHandsThumbnail thumbnail leftSideThumbnail'>";
                }
                ?>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<?php include("Partials/footer.php"); ?>

</body>
</html>