<?php

require_once '../db/config.php';

if(isset($_POST['add_abs'])){
    $i = 0;
    do {
        $data = $_POST;
        $data['NumEtd'] = $_POST['NumsEtds'][$i];
        $added = $db->add_absence($data);
        $i++;
    } while ($i < count($_POST['NumsEtds']));
    
    echo json_encode(['message'=> $added ? 'ok' : 'non']);
    exit;
}

if(isset($_GET['departement'])){

    $data = $db->getData('absences')
            ->where('departement', $_GET['departement']);

    $data = $data->map(function ($item) use ($db) {
        $etd = $db->getData('etudiants')
            ->where('filier',$item['NumFilier'])
            ->where('annee',$item['NumAnnee'])
            ->where('group',$item['NumGroupe'])
            ->firstWhere('numEtd',$item['NumEtd']);
        $item['nomEtd'] = $etd['nom'];
        $item['prenomEtd'] = $etd['prenom'];
        $mat = $db->getData('matieres')
            ->where('filier', $item['NumFilier'])
            ->where('annee', $item['NumAnnee'])
            ->firstWhere('codeMat',$item['matier']);
        $item['nomMatier'] = $mat['nomMatier'];    
        return $item;
    });
    $data = array_values($data->toArray());
    echo json_encode($data);        
}

if(isset($_GET['prof'])){
    $data = $db->getData('absences')
            ->where('prof', $_GET['prof']);

    $data = $data->map(function ($item) use ($db) {
        $etd = $db->getData('etudiants')
            ->where('filier',$item['NumFilier'])
            ->where('annee',$item['NumAnnee'])
            ->where('group',$item['NumGroupe'])
            ->firstWhere('numEtd',$item['NumEtd']);
        $item['nomEtd'] = $etd['nom'];
        $item['prenomEtd'] = $etd['prenom'];
        $mat = $db->getData('matieres')
            ->where('filier', $item['NumFilier'])
            ->where('annee', $item['NumAnnee'])
            ->firstWhere('codeMat',$item['matier']);
        $item['nomMatier'] = $mat['nomMatier'];    
        return $item;
    });
    $data = array_values($data->toArray());
    echo json_encode($data);        
}
?>