<?php


require_once 'data.php';


$path = "http://localhost/absence/db/absence.xml";
$xml = simplexml_load_file($path);
$db = new Data($xml);

// var_dump($db->users);

// $data = [
//     'nom' => 'dwaee',
//     'prenom' => 'eewadrr',
//     'email' => 'ewawda@ww.com',
//     'role' => '1',

// ];
// $added = $db->add_user($data);
// var_dump($added);

?>