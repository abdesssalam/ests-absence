<?php

require_once '../db/config.php';

if(isset($_POST['add'])){
    //$db->addAuth();
    echo 'add new authorizations';
}

if(isset($_GET['auth'])){
    //$db->getData('authorizarions')
    echo 'all auth';
}
?>