<?php
require_once '../db/config.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    

    $added=$db->add_user($_POST);
    if($added==true){
        echo json_encode(array("message" => "ok"));
    }else{
        echo json_encode(
            array(
                "message" => "non",
                "error" => $added['error'],
                "line" => $added['line']
            )
        );
    };
}

?>