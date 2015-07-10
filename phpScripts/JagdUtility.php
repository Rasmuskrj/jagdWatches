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

    function getFolderPaths(&$watchCaseFolder, &$watchCaseMainFolder, &$watchStrapFolder, &$watchStrapMainFolder, &$watchHandsFolder, &$watchHandsMainFolder, &$watchDialFolder, &$watchDialMainFolder, &$patternFolder, &$patternMainFolder, &$watchNumeralsFolder, &$watchIndexFolder, &$watchIndexMainFolder){
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
        $watchNumeralsFolder = "images/WatchBuilder/Numerals/";
        //Watch Index
        $watchIndexFolder = "images/WatchBuilder/Index/Thumbnails/";
        $watchIndexMainFolder = "images/WatchBuilder/Index/Main/";
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
}