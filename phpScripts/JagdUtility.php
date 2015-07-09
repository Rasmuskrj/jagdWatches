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
}