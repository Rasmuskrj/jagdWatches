<?php
/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 09-07-2015
 * Time: 02:31
 */

include('Database.php');
include('JagdUtility.php');
$utility = new JagdUtility();


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
$straps = @$_POST['straps'];//'Oily brown';
$billingCity = @$_POST['billingCity'];//'København';
$billingCountry = @$_POST['billingCountry'];//'Danmark';
$index = @$_POST['index'] == $utility->noneName ? NULL : @$_POST['index'];//NULL;
$pattern = @$_POST['pattern'] == $utility->noneName ? NULL : @$_POST['pattern'];//NULL;
$billingLastName = @$_POST['billingLastNAME'];//'Jørgensen';
$email = @$_POST['email'];//'rasmuskrj@gmail.com';
$billingFirstName = @$_POST['billingFirstNAME'];//'Rasmus';
$additionalStrap1 = @$_POST['additionalStrap1'] == $utility->noneName ? NULL : @$_POST['additionalStrap1'];//NULL;
$additionalStrap2 = @$_POST['additionalStrap2'] == $utility->noneName ? NULL : @$_POST['additionalStrap2'];//NULL;
$additionalStrap3 = @$_POST['additionalStrap3'] == $utility->noneName ? NULL : @$_POST['additionalStrap3'];//NULL;
$additionalStrap4 = @$_POST['additionalStrap4'] == $utility->noneName ? NULL : @$_POST['additionalStrap4'];//NULL;
$additionalStrap5 = @$_POST['additionalStrap5'] == $utility->noneName ? NULL : @$_POST['additionalStrap5'];//NULL;
$billingAddress = @$_POST['billingAddress'];//'Amagerbrogade 136, 3.th';
$case = @$_POST['case'];//'Gun metal';
$numerals = @$_POST['numerals'] == $utility->noneName ? NULL : @$_POST['numerals'];//NULL;
$approvalCode = @$_POST['approvalcode'];//'123456';
$statusCode = @$_POST['statuscode'];//'2';


/**
 * Check AuthKey
 */
$parameter_string = '';
$parameter_string .= 'transact=' . $transActionID;
$parameter_string .= '&amount=' . $amount;
$parameter_string .= '&currency=' . $currency;


$correctKey = $utility->generateMD5($parameter_string);


if(strcmp($correctKey, $dibsAuthKey) != 0){
    die("Authentication Key is not valid");
}

$db = new Database();
$con = $db->getConnection();

/**
 * Check if the order exists
 */

$stmtOrderId = $con->prepare("SELECT order_id FROM orders WHERE order_id=?;");

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

if($statusCode != 1 && $statusCode != 4 && $statusCode != 17) {
    if($orderIdExists) {
        $stmt = $con->prepare("UPDATE orders SET amount=?, currency=?, DIBS_transact=?, DIBS_approvalcode=?, DIBS_statuscode=?, first_name=?, last_name=?, address=?, postalcode=?, city=?,
                                      email=?, country=?, watch_case=?, hands=?, strap=?, dial=?, watch_index=?, numerals=?, pattern=?, invert_pattern=?, pattern_rotation=?, additional_strap_1=?,
                                       additional_strap_2=?, additional_strap_3=?, additional_strap_4=?, additional_strap_5=? WHERE order_id=?;");
        echo $stmt->error;
        echo $con->error;
        $stmt->bind_param('isiiissssssssssssssiissssss', $amount, $currency, $transActionID, $approvalCode, $statusCode, $billingFirstName, $billingLastName, $billingAddress, $billingPostalCode, $billingCity, $email,
            $billingCountry, $case, $hands, $straps, $dial, $index, $numerals, $pattern, $invertPattern, $patternRotation, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $orderId);
    } else {
        $stmt = $con->prepare("INSERT INTO orders (order_id,amount,currency,DIBS_transact,DIBS_approvalcode,DIBS_statuscode,first_name,last_name,address,postalcode,city,email,country,watch_case,
                                hands,strap,dial,watch_index,numerals,pattern,invert_pattern,pattern_rotation,additional_strap_1,additional_strap_2,additional_strap_3,additional_strap_4,additional_strap_5)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


        $stmt->bind_param('sisiiissssssssssssssiisssss', $orderId, $amount, $currency, $transActionID, $approvalCode, $statusCode, $billingFirstName, $billingLastName, $billingAddress, $billingPostalCode, $billingCity, $email,
            $billingCountry, $case, $hands, $straps, $dial, $index, $numerals, $pattern, $invertPattern, $patternRotation, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5);

        $message = "Hi $billingFirstName $billingLastName
Thank you for choosing Jagd Watches.
You should receive your order within 10 working days from today.
If you have any questions about your order please send us an email and we will get back to you as soon as we can

ORDER INFORMATION
----------------------------------------------------------------------------------------------------------------

Order Id: $orderId

Watch:
Case:\t\t\t\t$case
Hands:\t\t\t\t$hands
Strap:\t\t\t\t$straps
Dial:\t\t\t\t$dial
Index:\t\t\t\t" . ($index == null ? $utility->noneName : $index) . "
Numerals:\t\t\t\t" . ($numerals == null ? $utility->noneName : $numerals) . "
Pattern:\t\t\t\t" . ($pattern == null ? $utility->noneName : $pattern) . "
Pattern inverted:\t\t\t\t" . ($invertPattern == 0 ? 'No' : 'Yes') . "
Pattern rotation:\t\t\t\t$patternRotation

Extra strap 1:\t\t\t\t" . ($additionalStrap1 == null ? $utility->noneName : $additionalStrap1) . "
Extra strap 2:\t\t\t\t" . ($additionalStrap2 == null ? $utility->noneName : $additionalStrap2) . "
Extra strap 3:\t\t\t\t" . ($additionalStrap3 == null ? $utility->noneName : $additionalStrap3) . "
Extra strap 4:\t\t\t\t" . ($additionalStrap4 == null ? $utility->noneName : $additionalStrap4) . "
Extra strap 5:\t\t\t\t" . ($additionalStrap5 == null ? $utility->noneName : $additionalStrap5) . "


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
    echo $con->error;

} else {
    echo "Transaction was not authorized ";
}




