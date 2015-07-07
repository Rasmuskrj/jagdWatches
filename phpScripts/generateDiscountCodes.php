<?php
require('Database.php');

/**
 * Created by PhpStorm.
 * User: RasmusKrøyer
 * Date: 07-07-2015
 * Time: 00:15
 */

$dataBase = new Database();

$db = $dataBase->getConnection();

$codesToCreate = 300;

$i = 0;

while($i < $codesToCreate) {

    $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ' . '0123456789');

    shuffle($seed);

    $rand = "";

    foreach (array_rand($seed, 8) as $k) {
        $rand .= $seed[$k];
    }

    $sql = "INSERT INTO discount_codes (code) VALUES ('$rand')";

    if ($db->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    echo "Hello";

    $i++;
}