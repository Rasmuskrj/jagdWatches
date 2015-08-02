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
     * @param $billingFirstName
     * @param $billingLastName
     * @param $orderId
     * @param $case
     * @param $hands
     * @param $strap
     * @param $dial
     * @param $index
     * @param $util
     * @param $numerals
     * @param $marker
     * @param $pattern
     * @param $invertPattern
     * @param $patternRotation
     * @param $additionalStrap1
     * @param $additionalStrap2
     * @param $additionalStrap3
     * @param $additionalStrap4
     * @param $additionalStrap5
     * @param $billingAddress
     * @param $billingPostalCode
     * @param $billingCity
     * @param $billingCountry
     * @param $email
     */
    function sendConfirmationMail($billingFirstName, $billingLastName, $orderId, $case, $hands, $strap, $dial, $index, $util, $numerals, $marker, $pattern, $invertPattern, $patternRotation, $additionalStrap1, $additionalStrap2, $additionalStrap3, $additionalStrap4, $additionalStrap5, $billingAddress, $billingPostalCode, $billingCity, $billingCountry, $email)
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
Index:              " . ($index == null ? $util->noneName : $index) . "
Numerals:           " . ($numerals == null ? $util->noneName : $numerals) . "
Marker:             " . ($marker == null ? $util->noneName : $marker) . "
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
        mail($email, "JAGD Watches receipt", $message, "From: noreply@jagdwatches.com" . "\r\n");
    }
}