<?php


require_once 'data.php';


$path ="http://localhost/ests-absence/db/abs_dev.xml";
$xml = simplexml_load_file($path);
$db = new Data($xml);

?>