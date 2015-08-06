<?php
require('Database.php');
require('JagdUtility.php');


$dataBase = new Database();
$util = new JagdUtility();

$db = $dataBase->getConnection();


$util->getFolderPaths($watchCaseFolder, $watchCaseMainFolder, $watchStrapFolder, $watchStrapMainFolder, $watchHandsFolder, $watchHandsMainFolder, $watchDialFolder, $watchDialMainFolder, $patternFolder, $patternMainFolder, $watchNumeralsFolder, $watchNumeralsMainFolder, $watchIndexFolder, $watchIndexMainFolder, $watchMarkerFolder, $watchMarkerMainFolder);
//Watch back folder paths
$watchCaseBackMainFolder = "images/WatchBuilder/WatchCaseBacks/";
$watchStrapEndingsMainFolder = "images/WatchBuilder/StrapEndings/";

//find all files, and put them in arrays
$watchCaseThumbnails = glob($watchCaseFolder . "*.png");
$watchCaseMains = glob($watchCaseMainFolder . "*.png");
$watchStrapsThumbnails = glob($watchStrapFolder . "*.png");
$watchStrapMains = glob($watchStrapMainFolder . "*.png");
$watchHandsThumbnails = glob($watchHandsFolder . "*.png");
$watchHandsMains = glob($watchHandsMainFolder . "*.png");
$watchDialThumbnails = glob($watchDialFolder . "*.png");
$watchDialMains = glob($watchDialMainFolder . "*.png");
$patternThumbnails = glob( $patternFolder . "*.png");
$patternThumbnails = moveValueByIndex($patternThumbnails, $patternFolder . "None.png");
$patternMains = glob($patternMainFolder . "*.png");
$watchNumeralsThumbnails = glob($watchNumeralsFolder . "*.png");
$watchNumeralsThumbnails = moveValueByIndex($watchNumeralsThumbnails, $watchNumeralsFolder . "None.png");
$watchNumeralsMains = glob($watchNumeralsMainFolder . "*.png");
$watchIndexThumbnails = glob($watchIndexFolder . "*.png");
$watchIndexThumbnails = moveValueByIndex($watchIndexThumbnails, $watchIndexFolder . "None.png");
$watchIndexMains = glob($watchIndexMainFolder . "*.png");
$watchMarkerThumbnails = glob($watchMarkerFolder . "*.png");
$watchMarkerThumbnails = moveValueByIndex($watchMarkerThumbnails, $watchMarkerFolder . "None.png");
$watchMarkerMains = glob($watchMarkerMainFolder . "*.png");
$watchCaseBackMains = glob($watchCaseBackMainFolder . "*.png");
$watchStrapEndingsMains = glob($watchStrapEndingsMainFolder . "*.png");

/**
 * 1: Plain dial
 * 2: Engraved dial
 * 3: Shipping Cost
 * 4: Single Strap Cost
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


function moveValueByIndex( array $array, $from )
{
    $index = array_search($from, $array);

    if ( $index === false )
    {
        die( "Offset $from does not exist" );
    }


    $value = $array[$index];
    unset( $array[$index] );

    $tail = array_splice( $array, 0 );
    array_push( $array, $value );
    $array = array_merge( $array, $tail );


    return $array;
}

?>