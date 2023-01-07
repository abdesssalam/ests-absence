<?php

require_once '../db/config.php';

if(isset($_POST['add_abs'])){
    $i = 0;
    do {
        $data = $_POST;
        $data['NumEtd'] = $_POST['NumsEtds'][$i];
        $added = $db->add_absence($data);
        $i++;
    } while ($i < count($_POST['NumsEtds']));
    
    echo json_encode(['message'=> $added ? 'ok' : 'non']);
    exit;
}
?>