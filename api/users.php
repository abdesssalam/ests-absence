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

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    if($_POST['submit']=='add'){
        $id = $db->add_user($_POST);
        if(is_array($id)){
            echo json_encode($id);
        }else{
            $roles = $_POST['roles'];
            $i=0;
            do {
                $roleAdded = $db->addRoleUsers(['id' => $id, 'NumRole'=>$roles[$i]]);
                if(is_array($roleAdded)){
                    echo json_encode($roleAdded);
                    return;
                }
                $i++;
            }while ($i < count($roles) && $roleAdded==true);
            echo json_encode(['message' => 'ok']);
        }
    }

    if($_POST['submit']=='edit'){
        
        echo json_encode($_POST);
    }
    
    // if($added==true){
    //     echo json_encode(array("message" => "ok"));
    // }else{
    //     echo json_encode(
    //         array(
    //             "message" => "non",
    //             "error" => $added['error'],
    //             "line" => $added['line']
    //         )
    //     );
    // };
}

?>