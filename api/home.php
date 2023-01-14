<?php

require_once '../db/config.php';

if(isset($_GET['filiers'])){
    $data= $db->getData('filiers')->where('codeDep',$_GET['filiers']);

    $data = $data->map(function ($item) use ($db){
        
        $grps = $db->getData('groups')
        ->where('filier', $item['codeFil'])
        ->where('annee', $item['numAnnee']);
        
        $grps = $grps->map(function ($grp) use ($item) {
          

            return [
                'filier' => $item['codeFil'],
                'intituleFil' => $item['intituleFil'],
                'annee' => $item['numAnnee'],
                'group' => $grp['codeGrp']
            ];
        }
        );
        
         return array_values($grps->toArray()) ;
        
    });

    $data = collect($data)->filter(function ($item) {
        if(count($item)>0){
            return $item;
        }
    });
    $data = array_values($data->toArray());
    $x = 0;
    $res = [];
    for ($i = 0; $i < count($data);$i++){
        $item = $data[$i];
        for ($j = 0; $j < count($item);$j++){
            $res[$x] = $item[$j];
            $x++;
        }
        
    }
    echo json_encode($res);
}

if(isset($_GET['groups']) && isset($_GET['filier']) && isset($_GET['annee'])){
    $data = $db->getData('groups')
        ->where('filier', $_GET['filier'])
        ->where('annee', $_GET['annee']);
        $data = array_values($data->toArray());
        echo json_encode($data);       
}
if( isset($_GET['matiers']) && isset($_GET['filier']) && isset($_GET['annee'])){
    $data = $db->getData('matieres')
        ->where('filier', $_GET['filier'])
        ->where('annee', $_GET['annee']);
        $data = array_values($data->toArray());
        echo json_encode($data);       
}


?>