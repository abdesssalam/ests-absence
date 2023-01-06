<?php
require_once '../db/config.php';

if(isset($_GET['groups'])){
    $groups = $db->getData('groups')->where('filier',$_GET['groups']);
    echo $groups->toJson();
}
if(isset($_GET['profs'])){
    $profs = $db->getData('professeurs')->where('departement', $_GET['profs']);
    $profsAll = $db->getData('professeurs')->where('etat',0);
    $profs = $profs->merge($profsAll);
    $users = $db->getUsersByRole(5);
    $profs = $profs->map(function ($prof) use ($users){
        $user = $users->firstWhere('id',$prof['id']);
        $prof = array_merge($user->toArray(), $prof->toArray());
        return $prof;
        
    });
    echo json_encode($profs);
}

?>