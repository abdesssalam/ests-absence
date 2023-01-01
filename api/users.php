<?php
require_once '../db/config.php';

$users = $db->get_users();

if(isset($_GET['all'])){
    $users = $users->map(function ($user) use ($db) {

        $user['roles'] = $db->getRolesByUser($user['id']);
        return $user;
    });

    echo $users->toJson();
}

if(isset($_GET['id'])){
    echo $users->firstWhere('id', $_GET['id'])->toJson();
}

if(isset($_POST['add_user'])){
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