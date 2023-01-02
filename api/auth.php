<?php

require_once '../db/config.php';

if(isset($_POST['add'])){
    //$db->addAuth();
    echo 'add new authorizations';
}

if(isset($_GET['all'])){
    echo   $db->getData('authorizations')
->jointure($db->getData('roles'),'NumRole','Num')
->jointure($db->getData('permissions'),'CodePermission','code')->toJson();
    
}

if(isset($_GET['delete'])){
    $delete = $db->deleteAuth($_GET);
    if(is_bool($delete)){
        echo json_encode(['message' => 'ok']);
    }else{
        echo json_encode($delete);
    }
   
}

?>