<?php
/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 09-07-2015
 * Time: 01:50
 */

class JagdUtility {
    private $DIBS_MD5_CONTROL_KEY_1 = "JO4p}?^(uF)vqe-KnMtp@kFLl](o_l4t";

    private $DIBS_MD5_CONTROL_KEY_2 = "~v2d9a8A6ao_pjA7ym!rLkw#FlpZB{z:";

    public $noneName = "None";

    public function generateMD5($parameterString){
        return md5($this->DIBS_MD5_CONTROL_KEY_2 . md5($this->DIBS_MD5_CONTROL_KEY_1 . $parameterString));
    }

    function generateOrderId(){
        $date = new DateTime();

        $dateStr = $date->format("Ymd");
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            .'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        shuffle($seed);
        $rand = '';
        foreach (array_rand($seed, 4) as $k){
            $rand .= $seed[$k];
        }
        return $dateStr . $rand;
    }

    function getFolderPaths(&$watchCaseFolder, &$watchCaseMainFolder, &$watchStrapFolder, &$watchStrapMainFolder, &$watchHandsFolder, &$watchHandsMainFolder, &$watchDialFolder, &$watchDialMainFolder, &$patternFolder, &$patternMainFolder, &$watchNumeralsFolder, &$watchNumeralsMainFolder, &$watchIndexFolder, &$watchIndexMainFolder, &$watchMarkerFolder, &$watchMarkerMainFolder){
        //Watch Case
        $watchCaseFolder = "images/WatchBuilder/WatchCase/Thumbnails/";
        $watchCaseMainFolder = "images/WatchBuilder/WatchCase/Main/";
        //Watch Straps
        $watchStrapFolder = "images/WatchBuilder/Straps/Thumbnails/";
        $watchStrapMainFolder = "images/WatchBuilder/Straps/Main/";
        //Watch Hands
        $watchHandsFolder = "images/WatchBuilder/Hands/Thumbnails/";
        $watchHandsMainFolder = "images/WatchBuilder/Hands/Main/";
        //Watch Dial
        $watchDialFolder = "images/WatchBuilder/DialMaterial/Thumbnails/";
        $watchDialMainFolder = "images/WatchBuilder/DialMaterial/Main/";
        //Watch Pattern
        $patternFolder = "images/WatchBuilder/Patterns/Thumbnails/";
        $patternMainFolder = "images/WatchBuilder/Patterns/Standard/";
        //Watch Numerals
        $watchNumeralsFolder = "images/WatchBuilder/Numerals/Thumbnails/";
        $watchNumeralsMainFolder = "images/WatchBuilder/Numerals/Main/";
        //Watch Index
        $watchIndexFolder = "images/WatchBuilder/Index/Thumbnails/";
        $watchIndexMainFolder = "images/WatchBuilder/Index/Main/";
        //Watch Markers
        $watchMarkerFolder = "images/WatchBuilder/Markers/Thumbnails/";
        $watchMarkerMainFolder = "images/WatchBuilder/Markers/Main/";
    }

    public function checkEncoding($string) {
        if (preg_match('!!u', $string))
        {
            return $string;
        }
        else
        {
            return utf8_encode($string);
        }
    }

    /**
     * @param string $billingFirstName
     * @param string $billingLastName
     * @param string $orderId
     * @param string $case
     * @param string $hands
     * @param string $strap
     * @param string $dial
     * @param string $index
     * @param string $numerals
     * @param string $marker
     * @param string $pattern
     * @param boolean $invertPattern
     * @param integer $patternRotation
     * @param string $textUpper
     * @param string $textLower
     * @param string $additionalStrap1
     * @param string $additionalStrap2
     * @param string $additionalStrap3
     * @param string $additionalStrap4
     * @param string $additionalStrap5
     * @param string $billingAddress
     * @param string $billingPostalCode
     * @param string $billingCity
     * @param string $billingCountry
     * @param string $email
     */
    function sendConfirmationMail($billingFirstName, $billingLastName, $orderId, $case, $hands, $strap, $dial, $index, $numerals, $marker, $pattern, $invertPattern, $patternRotation, $textUpper, $textLower, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $billingAddress, $billingPostalCode, $billingCity, $billingCountry, $email)
    {
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
Index:              " . ($index == null ? $this->noneName : $index) . "
Numerals:           " . ($numerals == null ? $this->noneName : $numerals) . "
Marker:             " . ($marker == null ? $this->noneName : $marker) . "
Pattern:            " . ($pattern == null ? $this->noneName : $pattern) . "
Pattern inverted:   " . ($invertPattern == 0 ? 'No' : 'Yes') . "
Pattern rotation:   $patternRotation

Extra strap 1:      " . ($additionalStrap1 == null ? $this->noneName : $additionalStrap1) . "
Extra strap 2:      " . ($additionalStrap2 == null ? $this->noneName : $additionalStrap2) . "
Extra strap 3:      " . ($additionalStrap3 == null ? $this->noneName : $additionalStrap3) . "
Extra strap 4:      " . ($additionalStrap4 == null ? $this->noneName : $additionalStrap4) . "
Extra strap 5:      " . ($additionalStrap5 == null ? $this->noneName : $additionalStrap5) . "


Address:
$billingFirstName $billingLastName
$billingAddress
$billingPostalCode $billingCity
$billingCountry

We hope you will enjoy your purchase.

Sincerely,
Jagd Watches";
        mail($email, "JAGD Watches receipt", $message, "From: noreply@jagdwatches.com" . "\r\n");
    }
}