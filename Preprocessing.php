<?php

//Define folder paths
$watchCaseFolder = "images/WatchBuilder/WatchCase/Thumbnails/";
$watchStrapFolder = "images/WatchBuilder/Straps/Thumbnails/";
$watchHandsFolder = "images/WatchBuilder/Hands/Thumbnails/";


//find all files, and put them in arrays
$watchCaseThumbnails = glob($watchCaseFolder . "*.jpg");
$watchStrapsThumbnails = glob($watchStrapFolder . "*.png");
$watchHandsThumbnails = glob($watchHandsFolder . "*.png");


?>