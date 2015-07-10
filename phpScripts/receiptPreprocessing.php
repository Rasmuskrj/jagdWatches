<?php
/**
 * Created by PhpStorm.
 * User: RasmusKr�yer
 * Date: 10-07-2015
 * Time: 20:19
 */
include('Database.php');
include('JagdUtility.php');

$dataBase = new Database();
$db = $dataBase->getConnection();
$util = new JagdUtility();

$util->getFolderPaths($watchCaseFolder, $watchCaseMainFolder, $watchStrapFolder, $watchStrapMainFolder, $watchHandsFolder, $watchHandsMainFolder, $watchDialFolder, $watchDialMainFolder, $patternFolder, $patternMainFolder, $watchNumeralsFolder, $watchIndexFolder, $watchIndexMainFolder);
$imgType = "png";

$orderId = @$_POST['orderid'];
$promotionCode = @$_POST['addedPromotionCode'];

/**
 * If paid by promotion code, then inset order into database
 */

$validPromotionCode = $dataBase->checkPromotionCode($promotionCode);


if($validPromotionCode) {
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
    $billingCity = @$_POST['billingCity'];//'K�benhavn';
    $billingCountry = @$_POST['billingCountry'];//'Danmark';
    $index = @$_POST['index'] == $util->noneName ? NULL : @$_POST['index'];//NULL;
    $pattern = @$_POST['pattern'] == $util->noneName ? NULL : @$_POST['pattern'];//NULL;
    $billingLastName = @$_POST['billingLastNAME'];//'J�rgensen';
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
    $approvalCode = @$_POST['approvalcode'];//'123456';
    $statusCode = @$_POST['statuscode'];//'2';
    $billingFirstName = $util->checkEncoding($billingFirstName);
    $billingLastName = $util->checkEncoding($billingLastName);
    $billingCity = $util->checkEncoding($billingCity);
    $billingAddress = $util->checkEncoding($billingAddress);
    $billingCountry = $util->checkEncoding($billingCountry);
    /**
     * Check if the order exists
     */

    /**
     * check encodings
     */
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
                                      email=?, country=?, watch_case=?, hands=?, strap=?, dial=?, watch_index=?, numerals=?, pattern=?, invert_pattern=?, pattern_rotation=?, additional_strap_1=?,
                                       additional_strap_2=?, additional_strap_3=?, additional_strap_4=?, additional_strap_5=? promotion_code=? WHERE order_id=?;");
        echo $stmt->error;
        echo $db->error;
        $stmt->bind_param('isiiissssssssssssssiisssssss', $amount, $currency, $transActionID, $approvalCode, $statusCode, $billingFirstName, $billingLastName, $billingAddress, $billingPostalCode, $billingCity, $email,
            $billingCountry, $case, $hands, $strap, $dial, $index, $numerals, $pattern, $invertPattern, $patternRotation, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $promotionCode, $orderId);
    } else {
        $stmt = $db->prepare("INSERT INTO orders (order_id,amount,currency,DIBS_transact,DIBS_approvalcode,DIBS_statuscode,first_name,last_name,address,postalcode,city,email,country,watch_case,
                                hands,strap,dial,watch_index,numerals,pattern,invert_pattern,pattern_rotation,additional_strap_1,additional_strap_2,additional_strap_3,additional_strap_4,additional_strap_5, promotion_code)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


        $stmt->bind_param('sisiiissssssssssssssiissssss', $orderId, $amount, $currency, $transActionID, $approvalCode, $statusCode, $billingFirstName, $billingLastName, $billingAddress, $billingPostalCode, $billingCity, $email,
            $billingCountry, $case, $hands, $strap, $dial, $index, $numerals, $pattern, $invertPattern, $patternRotation, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $promotionCode);

        $message = "Hi $billingFirstName $billingLastName
Thank you for choosing Jagd Watches.
You should receive your order within 10 working days from today.
If you have any questions about your order please send us an email and we will get back to you as soon as we can

ORDER INFORMATION
----------------------------------------------------------------------------------------------------------------

Order Id: $orderId

Watch:
Case:               $case
Hands:              $hands
Strap:              $strap
Dial:               $dial
Index:              " . ($index == null ? $util->noneName : $index) . "
Numerals:           " . ($numerals == null ? $util->noneName : $numerals) . "
Pattern:            " . ($pattern == null ? $util->noneName : $pattern) . "
Pattern inverted:   " . ($invertPattern == 0 ? 'No' : 'Yes') . "
Pattern rotation:   $patternRotation

Extra strap 1:      " . ($additionalStrap1 == null ? $util->noneName : $additionalStrap1) . "
Extra strap 2:      " . ($additionalStrap2 == null ? $util->noneName : $additionalStrap2) . "
Extra strap 3:      " . ($additionalStrap3 == null ? $util->noneName : $additionalStrap3) . "
Extra strap 4:      " . ($additionalStrap4 == null ? $util->noneName : $additionalStrap4) . "
Extra strap 5:      " . ($additionalStrap5 == null ? $util->noneName : $additionalStrap5) . "


Address:
$billingFirstName $billingLastName
$billingAddress
$billingPostalCode $billingCity
$billingCountry

We hope you will enjoy your purchase.

Sincerely,
Jagd Watches";
        mail($email,"JAGD Watches receipt",$message, "From: noreply@jagdwatches.com" . "\r\n");
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
    $billingCountry, $case, $hands, $strap, $dial, $index, $numerals, $pattern, $invertPattern, $patternRotation, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $promoCode, $shipped, $received);

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
$numeralsSrc = glob($watchNumeralsFolder  . $numerals. "." . $imgType);
$indexSrc = glob($watchIndexMainFolder  . $index. "." . $imgType);

/**
 * Find the correct price
 * NOTE: possible change the way rows are fetched. Hard coded IDs are hard to maintain.
 */
$price = 0;
$subtotal= 0;
$straps = 0;
$strapPrice = 0;
$deliveryPrice = 0;

$sql = "SELECT * FROM prices WHERE id=";

if($index == $util->noneName && $numerals == $util->noneName && $pattern == $util->noneName){
    $id = 1;
    $sql .= $id;
    $jagdTitle = "JAGD WATCH - PLAIN DIAL";
} else  {
    $id = 2;
    $sql .= $id;
    $jagdTitle = "JAGD WATCH - ENGRAVED DIAL";
}

$result = $db->query($sql);

while($row = $result->fetch_assoc()){
    $subtotal = $row['price_dkk'];
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


$straps = $strapPrice * $noOfAdditionalStraps;


$price = $subtotal + $straps + $deliveryPrice;

$price *= 100; //multiply by 100 to get price with sub-currency;

/**
 * check encodings
 */
$billingFirstName = $util->checkEncoding($billingFirstName);
$billingLastName = $util->checkEncoding($billingLastName);
$billingCity = $util->checkEncoding($billingCity);
$billingAddress = $util->checkEncoding($billingAddress);
$billingCountry = $util->checkEncoding($billingCountry);