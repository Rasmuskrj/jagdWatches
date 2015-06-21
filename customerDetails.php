<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<FORM ACTION="https://payment.architrade.com/paymentweb/start.action" METHOD="POST" CHARSET="UTF-8">
    <INPUT TYPE="hidden" NAME="test" value="1">
    <INPUT TYPE="hidden" NAME="accepturl" VALUE="https://www.jagdwatches.local/paymentValidated.php">
    <INPUT TYPE="hidden" NAME="amount" VALUE="10000">
    <INPUT TYPE="hidden" NAME="currency" VALUE="DKK">
    <INPUT TYPE="hidden" NAME="merchant" VALUE="90197001">
    <INPUT TYPE="hidden" NAME="orderid" VALUE="00001">

    <INPUT TYPE="hidden" NAME="billingAddress" VALUE="Amagerbrogade 136">
    <INPUT TYPE="hidden" NAME="billingFirstNAME" VALUE="Rasmus">
    <INPUT TYPE="hidden" NAME="billingLastNAME" VALUE="Jørgensen">
    <INPUT TYPE="hidden" NAME="billingPostalCode" VALUE="2300">

    <INPUT TYPE="hidden" NAME="cardholder_NAME" VALUE="Rasmus Jørgensen">
    <INPUT TYPE="hidden" NAME="cardholder_address1" VALUE="Amagerbrogade 136">
    <INPUT TYPE="hidden" NAME="cardholder_zipcode" VALUE="2100">
    <Input type="submit">
</FORM>
</body>
</html>