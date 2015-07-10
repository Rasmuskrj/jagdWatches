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
$amount = @$_POST['amount'];//'120000';
$dial = @$_POST['dial'];//'Walnut';
$patternRotation = @$_POST['patternRotation'];//'0';
$invertPattern = @$_POST['invertPattern'] == NULL ? 0 : @$_POST['invertPattern'];//'0';
$hands = @$_POST['hands'];//'black';
$billingPostalCode = @$_POST['billingsPostalCode'];//'2300';
$noOfAdditionalStraps = @$_POST['noOfAdditionalStraps'];//'0';
$straps = @$_POST['straps'];//'Oily brown';
$billingCity = @$_POST['billingCity'];//'København';
$billingCountry = @$_POST['billingCountry'];//'Danmark';
$index = @$_POST['index'] == $utility->noneName ? NULL : @$_POST['index'];//NULL;
$pattern = @$_POST['pattern'] == $utility->noneName ? NULL : @$_POST['pattern'];//NULL;
$billingLastName = @$_POST['billingLastNAME'];//'Jørgensen';
$email = //@$_POST['email'];//'rasmuskrj@gmail.com';
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

$query = $db->prepareQuery("SELECT * FROM WHERE order_id=?", $orderId);

$stmt = $con->prepare("INSERT INTO orders (
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
additional_strap_5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

echo $con->error;

$stmt->bind_param('sisiiissssssssssssssiisssss', $orderId, $amount, $currency, $transActionID, $approvalCode, $statusCode, $billingFirstName, $billingLastName, $billingAddress, $billingPostalCode, $billingCity, $email,
    $billingCountry, $case, $hands, $straps, $dial, $index, $numerals, $pattern, $invertPattern, $patternRotation, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5);


//$stmt->execute();

