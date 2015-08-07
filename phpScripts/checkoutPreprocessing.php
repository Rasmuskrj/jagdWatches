<?php
/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 08-07-2015
 * Time: 00:58
 */

include('Database.php');
include('JagdUtility.php');

$util = new JagdUtility();

$util->getFolderPaths($watchCaseFolder, $watchCaseMainFolder, $watchStrapFolder, $watchStrapMainFolder, $watchHandsFolder, $watchHandsMainFolder, $watchDialFolder, $watchDialMainFolder, $patternFolder, $patternMainFolder, $watchNumeralsFolder, $watchNumeralsMainFolder, $watchIndexFolder, $watchIndexMainFolder, $watchMarkerFolder, $watchMarkerMainFolder);

$imgType = "png";
$noneName = $util->noneName;

$merchantId = '90197001';

$stateKeys = array(
    "case",
    "hands",
    "straps",
    "dial",
    "index",
    "numerals",
    "marker",
    "pattern",
    "currentScreen",
    "lastScreen",
    "invertPattern",
    "patternRotation",
    "noOfAdditionalStraps",
    "additionalStrap1",
    "additionalStrap2",
    "additionalStrap3",
    "additionalStrap4",
    "additionalStrap5",
    "validPromotionCodeAdded",
    "totalPrice",
    "addedPromotionCode",
    "regionEU"
);

$dataBase = new Database();

$db = $dataBase->getConnection();

$state = array();

foreach($stateKeys as $key){
    $state[$key] = @$_POST[$key];
}

/**
 * Find correct images for watch
 */
$caseSrc = glob($watchCaseMainFolder . $state['case']. "." . $imgType);
$handsSrc = glob($watchHandsMainFolder . $state['hands']. "." . $imgType);
$strapSrc = glob($watchStrapMainFolder . $state['straps']. "." . $imgType);
$dialSrc = glob($watchDialMainFolder  . $state['dial']. "." . $imgType);
if($state['invertPattern'] == 'true'){
    $patternSrc = glob($patternMainFolder  . $state['pattern']. " INV." . $imgType);
} else {
    $patternSrc = glob($patternMainFolder  . $state['pattern']. "." . $imgType);
}
$numeralsSrc = glob($watchNumeralsMainFolder  . $state['numerals']. "." . $imgType);
$indexSrc = glob($watchIndexMainFolder  . $state['index']. "." . $imgType);
$markerSrc = glob($watchMarkerMainFolder . $state['marker'] . "." . $imgType);

/**
 * Find the correct price
 * NOTE: possible change the way rows are fetched. Hard coded IDs are hard to maintain.
 */
$price = 0;
$amount = 0;
$straps = 0;
$strapPrice = 0;
$deliveryPrice = 0;

$sql = "SELECT * FROM prices WHERE id=";

if($state['index'] == 'None' && $state['numerals'] == 'None' && $state['pattern'] == 'None'){
    $id = 1;
    $sql .= $id;
} else  {
    $id = 2;
    $sql .= $id;
}

$result = $db->query($sql);

while($row = $result->fetch_assoc()){
    $amount = $row['price_dkk'];
}

$sql2 = "SELECT * FROM prices WHERE id=4";

$result = $db->query($sql2);

while($row = $result->fetch_assoc()){
    $strapPrice = $row['price_dkk'];
}

$sql3 = "SELECT * FROM prices WHERE id=3";

$result = $db->query($sql3);

while($row = $result->fetch_assoc()){
    $deliveryPrice = $row['price_dkk'];
}

$straps = $strapPrice * $state['noOfAdditionalStraps'];

$price = $amount + $straps + $deliveryPrice;

$price *= 100; //multiply by 100 to get price with sub-currency;

/**
 * Find new orderID
 */
$orderID = $util->generateOrderId();

/**
 * Check potential promotionCode
 */
$validPromotionCode = $dataBase->checkPromotionCode($state['addedPromotionCode']);

if($validPromotionCode != false) {
    $price -= $validPromotionCode;
}

/**
 * Generate MD5 key for DIBS validation
 */
$parameter_string = '';
$parameter_string .= 'merchant=' . $merchantId;
$parameter_string .= '&orderid=' . $orderID;
$parameter_string .= '&currency=' . "DKK";
$parameter_string .= '&amount=' . $price;
$md5 = $util->generateMD5($parameter_string );




