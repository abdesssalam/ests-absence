<?php

require_once '../db/config.php';

if(isset($_POST['add'])){
    if($db->add_authorization($_POST)){
        echo json_encode(['message'=>'ok']);
    }
   
}

if(isset($_GET['all'])){
    $data = $db->getData('authorizations')
    ->jointure($db->getData('roles'),'NumRole','Num')
    ->jointure($db->getData('permissions'),'CodePermission','code');

    $data = array_values($data->toArray());
    $data = new Columns($data);

    $data = $data->map(function ($u) use($data) {
        if($data->count()>1){
            $u = array_values($u);
           
            if(!isset($u[0][0])){
                $u = array_values($u[0]);
                $u = $u[0];
            }else{
                $u = array_values($u[0]);
                $u = $u[0];
            }


        }else{
            $u = $u[0];
        }
        return $u;
    });  
    echo json_encode($data);
    
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