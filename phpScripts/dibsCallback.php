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
$transActionID = @$_POST['transact'];
$amount = @$_POST['amount'];
$currency = @$_POST['currency'];
$dibsAuthKey = @$_POST['authkey'];
$orderId = @$_POST['orderid'];
$amount = @$_POST['amount'];
$amount = @$_POST['transact'];
$dial = @$_POST['dial'];
$patternRotation = @$_POST['patternRotation'];
$invertPattern = @$_POST['invertPattern'] == NULL ? 0 : @$_POST['invertPattern'];
$hands = @$_POST['hands'];
$billingPostalCode = @$_POST['billingsPostalCode'];
$noOfAdditionalStraps = @$_POST['noOfAdditionalStraps'];
$straps = @$_POST['straps'];
$billingCity = @$_POST['billingCity'];
$billingCountry = @$_POST['billingCountry'];
$index = @$_POST['index'] == $utility->noneName ? NULL : @$_POST['index'];
$pattern = @$_POST['pattern'] == $utility->noneName ? NULL : @$_POST['pattern'];
$billingLastName = @$_POST['billingLastNAME'];
$email = @$_POST['email'];
$billingFirstName = @$_POST['billingFirstNAME'];
$additionalStrap1 = @$_POST['additionalStrap1'] == $utility->noneName ? NULL : @$_POST['additionalStrap1'];
$additionalStrap2 = @$_POST['additionalStrap2'] == $utility->noneName ? NULL : @$_POST['additionalStrap2'];
$additionalStrap3 = @$_POST['additionalStrap3'] == $utility->noneName ? NULL : @$_POST['additionalStrap3'];
$additionalStrap4 = @$_POST['additionalStrap4'] == $utility->noneName ? NULL : @$_POST['additionalStrap4'];
$additionalStrap5 = @$_POST['additionalStrap5'] == $utility->noneName ? NULL : @$_POST['additionalStrap5'];
$billingAddress = @$_POST['billingAddress'];
$case = @$_POST['case'];
$numerals = @$_POST['numerals'] == $utility->noneName ? NULL : @$_POST['numerals'];
$approvalCode = @$_POST['approvalcode'];
$statusCode = @$_POST['statuscode'];


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

$query = $db->prepareQuery("SELECT * FROM WHERE order_id=?", $orderId);


$result = $con->query($sql);

//if($result->num_rows < 1 && $orderId != NULL) {
    $query = $db->prepareQuery("INSERT INTO orders (
order_id,
amount,
currency,
DIBS_transact,
DIBS_approvalcode,
DIBS_statuscode,
first_name,
last_name,
address,
postalcode,
city,
email,
country,
case,
hands,
strap,
dial,
index,
numerals,
pattern,
invert_pattern,
pattern_rotation,
additional_strap_1,
additional_strap_2,
additional_strap_3,
additional_strap_4,
additional_strap_5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        $orderId, $amount, $currency, $transActionID, $approvalCode, $statusCode, $billingFirstName, $billingLastName, $billingAddress, $billingPostalCode, $billingCity, $email,
        $billingCountry, $case, $hands, $straps, $dial, $index, $numerals, $pattern, $invertPattern, $patternRotation, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5);

    $con->query($query);
//}
