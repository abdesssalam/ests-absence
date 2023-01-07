<?php
require_once 'db/config.php';


$data = ['filier' => '3', 'annee' => '1'];
$code = $db->auto_increment2('codeMat','matieres','filier',$data['filier'],'annee',$data['annee']);
var_dump($code);


// ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/output.css">
    <title>Document</title>
</head>
<body class="bg-blue-300">
    
    <div class="w-1/2 mx-auto mt-5">
       <form action="" method="post" class="flex flex-col ">
            <div class="my-2 flex ">
                <span class="w-1/3">nom :</span> 
                <input class="w-2/3 focus:outline-none py-1 " type="text" name="nom">
            </div>
           <div class="my-2 flex ">
                <span class="w-1/3">Prenom:</span>
                <input class="w-2/3 focus:outline-none py-1 " type="text" name="prenom">
           </div>
           <input type="submit" name="add" value="add">
            <!-- <input id="btn_add_person" name="add_person" type="submit" value="add" class="bg-green-500 w-1/3 mx-auto cursor-pointer hover:bg-green-700 text-white"> -->
        </form> 
    </div>
    


    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>