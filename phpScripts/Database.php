<?php
/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 07-07-2015
 * Time: 00:18
 */

class Database {

    private $dbHost = 'jagdwatches.com.mysql';
    private $dbUser = 'jagdwatches_com';
    private $dbPass = '4T6kKfy2';
    private $dbName = 'jagdwatches_com';

    /**
     * @var mysqli
     */
    private $conn;

    /**
     * Constructor
     */
    public function Database (){
        $this->conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        if($this->conn->connect_errno > 0){
            die('Unable to connect to database [' . $this->conn->connect_error . ']');
        }
    }

    /**
     * @return mysqli
     */
    public function getConnection() {
        return $this->conn;
    }

    public function checkPromotionCode($code) {
        $validPromotionCode = false;
        $stmt = $this->conn->prepare("SELECT used FROM discount_codes WHERE code=?");

        $stmt->bind_param('s', $code);

        $stmt->execute();
        $stmt->bind_result($used);

        while($stmt->fetch()){
            if($used == 1){
                $validPromotionCode = false;
            } else if($used == 0) {
                $validPromotionCode = true;
            }
        }
        return $validPromotionCode;
    }
}