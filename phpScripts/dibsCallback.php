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
$transActionID = '1111950743';//@$_POST['transact'];
$amount = '120000';//@$_POST['amount'];
$currency = '208';//@$_POST['currency'];
$dibsAuthKey = 'c4f3385fbc1e7889c4a5715977f98730';//@$_POST['authkey'];
$orderId = '20150710HvRl';//@$_POST['orderid'];
$amount = '120000';//@$_POST['amount'];
$dial = 'Walnut';//@$_POST['dial'];
$patternRotation = '0';//@$_POST['patternRotation'];
$invertPattern = '0';//@$_POST['invertPattern'] == NULL ? 0 : @$_POST['invertPattern'];
$hands = 'black';//@$_POST['hands'];
$billingPostalCode = '2300';//@$_POST['billingsPostalCode'];
$noOfAdditionalStraps = '0';//@$_POST['noOfAdditionalStraps'];
$straps = 'Oily brown';//@$_POST['straps'];
$billingCity = 'København';//@$_POST['billingCity'];
$billingCountry = 'Danmark';//@$_POST['billingCountry'];
$index = NULL;//@$_POST['index'] == $utility->noneName ? NULL : @$_POST['index'];
$pattern = NULL;//@$_POST['pattern'] == $utility->noneName ? NULL : @$_POST['pattern'];
$billingLastName = 'Jørgensen';//@$_POST['billingLastNAME'];
$email = 'rasmuskrj@gmail.com';//@$_POST['email'];
$billingFirstName = 'Rasmus';//@$_POST['billingFirstNAME'];
$additionalStrap1 = NULL;//@$_POST['additionalStrap1'] == $utility->noneName ? NULL : @$_POST['additionalStrap1'];
$additionalStrap2 = NULL;//@$_POST['additionalStrap2'] == $utility->noneName ? NULL : @$_POST['additionalStrap2'];
$additionalStrap3 = NULL;//@$_POST['additionalStrap3'] == $utility->noneName ? NULL : @$_POST['additionalStrap3'];
$additionalStrap4 = NULL;//@$_POST['additionalStrap4'] == $utility->noneName ? NULL : @$_POST['additionalStrap4'];
$additionalStrap5 = NULL;//@$_POST['additionalStrap5'] == $utility->noneName ? NULL : @$_POST['additionalStrap5'];
$billingAddress = 'Amagerbrogade 136, 3.th';//@$_POST['billingAddress'];
$case = 'Gun metal';//@$_POST['case'];
$numerals = NULL;//@$_POST['numerals'] == $utility->noneName ? NULL : @$_POST['numerals'];
$approvalCode = '123456';//@$_POST['approvalcode'];
$statusCode = '2';//@$_POST['statuscode'];


/**
 * Check AuthKey
 */
$parameter_string = '';
$parameter_string .= 'transact=' . $transActionID;
$parameter_string .= '&amount=' . $amount;
$parameter_string .= '&currency=' . $currency;


$correctKey = $utility->generateMD5($parameter_string);

echo $dibsAuthKey . "<br>";
echo $correctKey . "<br>";

if(strcmp($correctKey, $dibsAuthKey) != 0){
    die("Authentication Key is not valid");
}

$db = new Database();
$con = $db->getConnection();

$query = $db->prepareQuery("SELECT * FROM WHERE order_id=?", $orderId);


//$result = $con->query($sql);

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
watch_case,
hands,
strap,
dial,
watch_index,
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
    //var_dump($query);
    //$con->query($query);

if ($con->query($query) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . $con->error;
}
//}
