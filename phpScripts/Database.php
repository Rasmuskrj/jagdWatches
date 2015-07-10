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

    function prepareQuery()
    {
        $Query = "";
        $ParameterNumber = 0;

        if (func_num_args() && $Query = func_get_arg($ParameterNumber++))
        {
            while ($ParameterNumber < func_num_args())
            {
                $NextParameter = func_get_arg($ParameterNumber++);
                $PlaceToInsertParameter = strpos($Query, '?');
                if ($PlaceToInsertParameter !== false)
                {
                    $QuerySafeString = '';

                    if (is_bool($NextParameter))
                    {
                        $QuerySafeString = $NextParameter ? 'TRUE' : 'FALSE';
                    }
                    else if (is_float($NextParameter) || is_int($NextParameter))
                    {
                        $QuerySafeString = $NextParameter;
                    }
                    else if (is_null($NextParameter))
                    {
                        $QuerySafeString = 'NULL';
                    }
                    else
                    {
                        $QuerySafeString = "'" . mysqli_escape_string($NextParameter) . "'";
                    }

                    $Query = substr_replace($Query, $QuerySafeString, $PlaceToInsertParameter, 1);
                }
            }
        }

        return $Query;
    }
}