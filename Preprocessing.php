<?php

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
$patternFolder = "images/WatchBuilder/Patterns/Thumbnails";
$patternMainFolder = "images/WatchBuilder/Patterns/Standard";
//Watch Numerals
$watchNumeralsFolder = "images/WatchBuilder/Numerals";
//Watch Index
$watchIndexFolder = "images/WatchBuilder/Index/Thumbnails";
$watchIndexMainFolder = "images/WatchBuilder/Index/Main";

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

var_dump($watchCaseMains);
die();
?>