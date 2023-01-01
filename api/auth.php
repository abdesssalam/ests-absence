<?php

require_once '../db/config.php';

if(isset($_POST['add'])){
    //$db->addAuth();
    echo 'add new authorizations';
}

if(isset($_GET['all'])){
    echo  $authorization = $db->getData('authorizations')
    ->jointure('NumRole',$db->getData('roles'),'Num')
    ->jointure('CodePermission',$db->getData('permissions'),'code')->toJson();
    
}

?>