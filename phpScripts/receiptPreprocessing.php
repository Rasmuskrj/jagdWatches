<?php
/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 10-07-2015
 * Time: 20:19
 */
include('Database.php');
include('JagdUtility.php');

$dataBase = new Database();
$db = $dataBase->getConnection();
$util = new JagdUtility();

$util->getFolderPaths($watchCaseFolder, $watchCaseMainFolder, $watchStrapFolder, $watchStrapMainFolder, $watchHandsFolder, $watchHandsMainFolder, $watchDialFolder, $watchDialMainFolder, $patternFolder, $patternMainFolder, $watchNumeralsFolder, $watchNumeralsMainFolder, $watchIndexFolder, $watchIndexMainFolder, $watchMarkerFolder, $watchMarkerMainFolder);
$imgType = "png";

$orderId = @$_POST['orderid'];
$promotionCode = @$_POST['addedPromotionCode'];
$regionEU = @$_POST['regionEU'] == 'true' ? true : false;
$textUpper = @$_POST['textUpper'] == '' ? null : @$_POST['textUpper'];
$textLower = @$_POST['textLower'] == '' ? null : @$_POST['textLower'];
/**
 * If paid by promotion code, then inset order into database
 */

$validPromotionCode = $dataBase->checkPromotionCode($promotionCode);

if($validPromotionCode != false) {
    /**
     * save POST vars
     */
    $transActionID = @$_POST['transact'];//'1111950743';
    $amount = @$_POST['amount'];//'120000';
    $currency = '208';
    $dibsAuthKey = @$_POST['authkey'];//'c4f3385fbc1e7889c4a5715977f98730';
    $orderId = @$_POST['orderid'];//'20150710HvRl';
    $dial = @$_POST['dial'];//'Walnut';
    $patternRotation = @$_POST['patternRotation'];//'0';
    $invertPattern = (@$_POST['invertPattern'] == NULL || @$_POST['invertPattern'] == 'false' ? 0 : 1);//'0';
    $hands = @$_POST['hands'];//'black';
    $billingPostalCode = @$_POST['billingPostalCode'];//'2300';
    $noOfAdditionalStraps = @$_POST['noOfAdditionalStraps'];//'0';
    $strap = @$_POST['straps'];//'Oily brown';
    $billingCity = @$_POST['billingCity'];//'København';
    $billingCountry = @$_POST['billingCountry'];//'Danmark';
    $index = @$_POST['index'] == $util->noneName ? NULL : @$_POST['index'];//NULL;
    $pattern = @$_POST['pattern'] == $util->noneName ? NULL : @$_POST['pattern'];//NULL;
    $billingLastName = @$_POST['billingLastNAME'];//'Jørgensen';
    $email = @$_POST['email'];//'rasmuskrj@gmail.com';
    $billingFirstName = @$_POST['billingFirstNAME'];//'Rasmus';
    $additionalStrap1 = @$_POST['additionalStrap1'] == $util->noneName ? NULL : @$_POST['additionalStrap1'];//NULL;
    $additionalStrap2 = @$_POST['additionalStrap2'] == $util->noneName ? NULL : @$_POST['additionalStrap2'];//NULL;
    $additionalStrap3 = @$_POST['additionalStrap3'] == $util->noneName ? NULL : @$_POST['additionalStrap3'];//NULL;
    $additionalStrap4 = @$_POST['additionalStrap4'] == $util->noneName ? NULL : @$_POST['additionalStrap4'];//NULL;
    $additionalStrap5 = @$_POST['additionalStrap5'] == $util->noneName ? NULL : @$_POST['additionalStrap5'];//NULL;
    $billingAddress = @$_POST['billingAddress'];//'Amagerbrogade 136, 3.th';
    $case = @$_POST['case'];//'Gun metal';
    $numerals = @$_POST['numerals'] == $util->noneName ? NULL : @$_POST['numerals'];//NULL;
    $marker = @$_POST['marker'] == $util->noneName ? NULL : @$_POST['marker'];
    $approvalCode = @$_POST['approvalcode'];//'123456';
    $statusCode = @$_POST['statuscode'];//'2';
    $sendNewsletters = @$_POST['sendNewsletters'] == 'on' ? true : false;
    $billingFirstName = $util->checkEncoding($billingFirstName);
    $billingLastName = $util->checkEncoding($billingLastName);
    $billingCity = $util->checkEncoding($billingCity);
    $billingAddress = $util->checkEncoding($billingAddress);
    $billingCountry = $util->checkEncoding($billingCountry);
    /**
     * Check if the order exists
     */
     

    /*check encodings*/
    $billingFirstName = utf8_decode($billingFirstName);
    $billingLastName = utf8_decode($billingLastName);
    $billingCity = utf8_decode($billingCity);
    $billingAddress = utf8_decode($billingAddress);
    $billingCountry = utf8_decode($billingCountry);

    $stmtOrderId = $db->prepare("SELECT order_id FROM orders WHERE order_id=?;");

    $stmtOrderId->bind_param('s', $orderId);

    $stmtOrderId->execute();
    $stmtOrderId->bind_result($return);

    echo $stmtOrderId->error;

    $orderIdExists = false;

    while($stmtOrderId->fetch()){
        if($return != null){
            $orderIdExists = true;
        }
    }
    $stmtOrderId->close();


    if($orderIdExists) {
        $stmt = $db->prepare("UPDATE orders SET amount=?, currency=?, DIBS_transact=?, DIBS_approvalcode=?, DIBS_statuscode=?, first_name=?, last_name=?, address=?, postalcode=?, city=?,
                                      email=?, country=?, watch_case=?, hands=?, strap=?, dial=?, watch_index=?, numerals=?, marker=?, pattern=?, invert_pattern=?, pattern_rotation=?, text_upper=?, text_lower=?, additional_strap_1=?,
                                       additional_strap_2=?, additional_strap_3=?, additional_strap_4=?, additional_strap_5=?, send_newsletters=?, promotion_code=? WHERE order_id=?;");
        echo $stmt->error;
        echo $db->error;
        $stmt->bind_param('isiiisssssssssssssssiisssssssiss', $amount, $currency, $transActionID, $approvalCode, $statusCode, $billingFirstName, $billingLastName, $billingAddress, $billingPostalCode, $billingCity, $email,
            $billingCountry, $case, $hands, $strap, $dial, $index, $numerals, $marker, $pattern, $invertPattern, $patternRotation, $textUpper, $textLower, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $promotionCode, $sendNewsletters, $orderId);
    } else {
        $stmt = $db->prepare("INSERT INTO orders (order_id,amount,currency,DIBS_transact,DIBS_approvalcode,DIBS_statuscode,first_name,last_name,address,postalcode,city,email,country,watch_case,
                                hands,strap,dial,watch_index,numerals,marker,pattern,invert_pattern,pattern_rotation,text_upper,text_lower, additional_strap_1,additional_strap_2,additional_strap_3,additional_strap_4,additional_strap_5, send_newsletters, promotion_code)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


        $stmt->bind_param('sisiiisssssssssssssssiisssssssis', $orderId, $amount, $currency, $transActionID, $approvalCode, $statusCode, $billingFirstName, $billingLastName, $billingAddress, $billingPostalCode, $billingCity, $email,
            $billingCountry, $case, $hands, $strap, $dial, $index, $numerals, $marker, $pattern, $invertPattern, $patternRotation, $textUpper, $textLower, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $sendNewsletters, $promotionCode);

        $util->sendConfirmationMail($billingFirstName, $billingLastName, $orderId, $case, $hands, $strap, $dial, $index, $numerals, $marker, $pattern, $invertPattern, $patternRotation, $textUpper, $textLower, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $billingAddress, $billingPostalCode, $billingCity, $billingCountry, $email);
    }
    $stmt->execute();
    $stmt->reset();
    $stmt->close();
    echo $db->error;

    //Set promo code as spent
    $stmt = $db->prepare("UPDATE discount_codes SET used=?, used_by=? WHERE code=?");
    $newVal = 1;
    $usedBy = $billingFirstName . " " . $billingLastName;
    $stmt->bind_param('iss', $newVal, $usedBy, $promotionCode);
    $stmt->execute();
    $stmt->reset();
    $stmt->close();
}

/**
 * Check if the order exists
 */

$stmt2 = $db->prepare("SELECT * FROM orders WHERE order_id=?;");

$stmt2->bind_param('s', $orderId);

$stmt2->execute();
$stmt2->bind_result($id, $orderId, $amountTotal, $currency, $transActionID, $approvalCode, $statusCode, $billingFirstName, $billingLastName, $billingAddress, $billingPostalCode, $billingCity, $email,
    $billingCountry, $case, $hands, $strap, $dial, $index, $numerals, $marker, $pattern, $invertPattern, $patternRotation, $textUpper, $textLower, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $sendNewsletters, $promoCode, $shipped, $received);

echo $stmt2->error;

echo $db->error;

$stmt2->store_result();

if($stmt2->num_rows < 1 ) {
    die("Order does not exist. Please contact custommer support");
}

while($stmt2->fetch()){

}

$noOfAdditionalStraps = 0;

for($i = 1; $i <= 5; $i++) {
    $noOfAdditionalStraps = ${'additionalStrap' . $i} == $util->noneName || ${'additionalStrap' . $i} == null ? $noOfAdditionalStraps  : $noOfAdditionalStraps + 1;
}

/**
 * Find correct images for watch
 */
$caseSrc = glob($watchCaseMainFolder . $case. "." . $imgType);
$handsSrc = glob($watchHandsMainFolder . $hands. "." . $imgType);
$strapSrc = glob($watchStrapMainFolder . $strap. "." . $imgType);
$dialSrc = glob($watchDialMainFolder  . $dial. "." . $imgType);
if($invertPattern == 1){
    $patternSrc = glob($patternMainFolder  . $pattern. " INV." . $imgType);
} else {
    $patternSrc = glob($patternMainFolder  . $pattern. "." . $imgType);
}
$numeralsSrc = glob($watchNumeralsMainFolder  . $numerals. "." . $imgType);
$indexSrc = glob($watchIndexMainFolder  . $index. "." . $imgType);
$markerSrc = glob($watchMarkerMainFolder . $marker . "." . $imgType);


/**
 * Find the correct price
 * NOTE: possible change the way rows are fetched. Hard coded IDs are hard to maintain.
 */
$price = 0;
$subtotal= 0;
$straps = 0;
$strapPrice = 0;
$deliveryPrice = 0;

$prices = $dataBase->getPrices();


if($index == null && $numerals == null && $pattern == null && $marker == null && $textUpper == null && $textLower == null) {
    $subtotal = $prices['prices']['plain']['price_dkk'];
    $jagdTitle = "JAGD WATCH - PLAIN DIAL";
} else {
    $subtotal = $prices['prices']['engraved']['price_dkk'];
    $jagdTitle = "JAGD WATCH - ENGRAVED DIAL";
}

$strapPrice = $prices['prices']['singleStrap']['price_dkk'];

$deliveryPrice = $prices['prices']['shipping']['price_dkk'];


$straps = $strapPrice * $noOfAdditionalStraps;

if(array_key_exists($dial, $prices['dialPrices'])) {
    $dialPrice = $prices['dialPrices'][$dial];
} else {
    $dialPrice = $prices['dialPrices']['standard'];
}

$price = $subtotal + $dialPrice + $straps + $deliveryPrice;

$price *= 100; //multiply by 100 to get price with sub-currency;

/**
 * check encodings
 */
$billingFirstName = $util->checkEncoding($billingFirstName);
$billingLastName = $util->checkEncoding($billingLastName);
$billingCity = $util->checkEncoding($billingCity);
$billingAddress = $util->checkEncoding($billingAddress);
$billingCountry = $util->checkEncoding($billingCountry);

$promotionCodeValue = $dataBase->getPromotionCodeValue($promotionCode);
