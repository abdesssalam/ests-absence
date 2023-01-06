<?php

require_once '../db/config.php';

    if(isset($_GET['departement'])){
        if(isset($_GET['all'])){
            echo $db->getData('departements')->toJson();
    }
   
    }
    if(isset($_GET['filiers'])){
        $data = $db->getData('filiers')->where('codeDep', $_GET['filiers']);
        $data = array_values($data->toArray());
        // $data = collect($data)->unique('codeFil');
        $data = array_values($data);
        echo json_encode($data);
    }

    if(isset($_GET['by']) && isset($_GET['filier']) && isset($_GET['annee'])){
        $data = $db->getData('modules')->where('filier', $_GET['filier'])
            ->where('annee', $_GET['annee']);
        if($data->count()>0){
            $data = $data->jointure($db->getData('users'), 'coordonnateur','id');
            $data = array_values($data->toArray());
            $data = array_filter($data, function ($item) {
                return $item != [];
            });
            $data = array_values($data);
            $data = array_map(function ($item) {
                $item = array_values($item);
                return $item[0];
            }, $data);
            $data = new Columns($data);
            
         $filiers = $db->getData('filiers');
            $data = $data->map(function ($item) use ($filiers) {
            $item = collect($item);
            $fl = $filiers
                ->where('codeFil', $item->get('filier'))
                ->firstWhere('numAnnee', $item->get('annee'));
                $item = $item->merge($fl);
                return $item;
            });
           
            echo json_encode($data);
        }else{
            echo json_encode(['message' => 'no data exsits']);
        }
        
    }
    
    if(isset($_POST['add_mod'])){
        $added = $db->add_module($_POST);
        if($added){
            echo json_encode(['message' => 'ok']);
        }else{
            echo json_encode(['message' => 'non']);
        }
    }
    if(isset($_POST['add_mat'])){
        $added = $db->add_matiere($_POST);
        if($added){
            echo json_encode(['message' => 'ok']);
        }else{
            echo json_encode(['message' => 'non']);
        }
    }

    if(isset($_GET['matiers'])){
        if($_GET['filier'] && $_GET['annee']){
        $data = $db->getData('matieres')
            ->where('filier', $_GET['filier'])
            ->where('annee', $_GET['annee']);
        $data = array_values($data->toArray());
            
        echo json_encode($data);   
        }
    }
?>