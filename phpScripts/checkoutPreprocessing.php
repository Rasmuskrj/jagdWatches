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
    "regionEU",
    "textUpper",
    "textLower"
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
 */
$price = 0;
$amount = 0;
$straps = 0;
$strapPrice = 0;
$deliveryPrice = 0;

$prices = $dataBase->getPrices();

if($state['index'] == $util->noneName && $state['numerals'] == $util->noneName && $state['pattern'] == $util->noneName && $state['marker'] == $util->noneName && $state['textUpper'] == '' && $state['textLower'] == '') {
    $amount = $prices['prices']['plain']['price_dkk'];
} else {
    $amount = $prices['prices']['engraved']['price_dkk'];
}

$strapPrice = $prices['prices']['singleStrap']['price_dkk'];

$deliveryPrice = $prices['prices']['shipping']['price_dkk'];

$straps = $strapPrice * $state['noOfAdditionalStraps'];

if(array_key_exists($state['dial'], $prices['dialPrices'])) {
    $dialPrice = $prices['dialPrices'][$state['dial']];
} else {
    $dialPrice = $prices['dialPrices']['standard'];
}

$price = $amount + $dialPrice + $straps + $deliveryPrice;


if($state['regionEU'] == 'true'){
    $price *= 1.25;
}

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




