<?php

$db = mysqli_connect('jagdwatches.com.mysql','jagdwatches_com','4T6kKfy2','jagdwatches_com');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

//Define folder paths
/*************************************************************/
//Watch Case
$watchCaseFolder = "images/WatchBuilder/WatchCase/Thumbnails/";
$watchCaseMainFolder = "images/WatchBuilder/WatchCase/Main/";
//Watch Straps
$watchStrapFolder = "images/WatchBuilder/Straps/Thumbnails/";
$watchStrapMainFolder = "images/WatchBuilder/Straps/Main/";
//Watch Hands
$watchHandsFolder = "images/WatchBuilder/Hands/Thumbnails/";
$watchHandsMainFolder = "images/WatchBuilder/Hands/Main/";
//Watch Dial
$watchDialFolder = "images/WatchBuilder/DialMaterial/Thumbnails/";
$watchDialMainFolder = "images/WatchBuilder/DialMaterial/Main/";
//Watch Pattern
$patternFolder = "images/WatchBuilder/Patterns/Thumbnails/";
$patternMainFolder = "images/WatchBuilder/Patterns/Standard/";
//Watch Numerals
$watchNumeralsFolder = "images/WatchBuilder/Numerals/";
//Watch Index
$watchIndexFolder = "images/WatchBuilder/Index/Thumbnails/";
$watchIndexMainFolder = "images/WatchBuilder/Index/Main/";

//find all files, and put them in arrays
$watchCaseThumbnails = glob($watchCaseFolder . "*.jpg");
$watchCaseMains = glob($watchCaseMainFolder . "*.png");
$watchStrapsThumbnails = glob($watchStrapFolder . "*.png");
$watchStrapMains = glob($watchStrapMainFolder . "*.png");
$watchHandsThumbnails = glob($watchHandsFolder . "*.png");
$watchHandsMains = glob($watchHandsMainFolder . "*.png");
$watchDialThumbnails = glob($watchDialFolder . "*.png");
$watchDialMains = glob($watchDialMainFolder . "*.png");
$patternThumbnails = glob( $patternFolder . "*.png");
$patternMains = glob($patternMainFolder . "*.png");
$watchNumeralsThumbnails = glob($watchNumeralsFolder . "*.png");
$watchNumeralsMains = glob($watchNumeralsFolder . "*.png");
$watchIndexThumbnails = glob($watchIndexFolder . "*.png");
$watchIndexMains = glob($watchIndexMainFolder . "*.png");

/**
 * 1: Plain dial, one strap
 * 2: Plain dial, three straps
 * 3: Engraved dial, one strap
 * 4: Engraged dial, three straps
 */
$sql =
    "SELECT *
    FROM prices;";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

$prices = array();
while($row = $result->fetch_assoc()){
    $prices[] = $row;
}

?>