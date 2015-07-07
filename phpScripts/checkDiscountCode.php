<?php
/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 07-07-2015
 * Time: 01:05
 */
require('Database.php');


$dataBase = new Database();

$db = $dataBase->getConnection();


$code = $_POST['string'];

$sql = "SELECT * FROM discount_codes WHERE code = '$code';";

$result = $db->query($sql);

$res = array();
while($row = $result->fetch_assoc()){
    $res[] = $row;
}

foreach($res as $r) {
    if($r['used'] == 0) {
        echo json_encode(array("response" => true));
        exit;
    }
}

echo json_encode(array("response" => false));