<?php

require_once '../db/config.php';

if(isset($_GET['filiers'])){
    $data= $db->getData('filiers')->where('codeDep',$_GET['filiers']);
    $data = array_values($data->toArray());
    echo json_encode($data);
}

if(isset($_GET['modules']) && isset($_GET['filier']) && isset($_GET['annee'])){
    $data = $db->getData('modules')
        ->where('filier', $_GET['filier'])
        ->where('annee', $_GET['annee']);
        $data = array_values($data->toArray());
        echo json_encode($data);       
}
if( isset($_GET['matiers']) && isset($_GET['filier']) && isset($_GET['annee'])){
    $data = $db->getData('matieres')
        ->where('filier', $_GET['filier'])
        ->where('annee', $_GET['annee']);
        $data = array_values($data->toArray());
        echo json_encode($data);       
}


?>