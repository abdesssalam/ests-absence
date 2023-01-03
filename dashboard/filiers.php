
<?php 
$title = 'gestion des filières';
require_once '../includes/header.php';

$fils = $db->getData('filiers')
    ->jointure($db->getData('departements'), 'codeDep', 'NumDept')
    ->jointure($db->getData('users'),'responsable','id');

$fils = $fils->clean();

$fil;
if(isset($_GET['edit'])){
    $fil = $fils->firstWhere('codeFil', $_GET['edit']);
}

//mise a jour
$bg = 'text-green-700 bg-green-200 ';
if(isset($_POST['ajouter'])){
    $added=$db->add_filier($_POST);
    if($added){
        //pop up after
        $message='filier bien ajouter';
    }else{
        $message = 'error';
        $bg = 'text-red-700 bg-red-100';
    }
}

if(isset($_POST['modifier'])){
    $update = $db->updateFilier($_GET['edit'], $_POST);
    if($update){
        $message='departement bien modifier';
    }else{
        $message = 'error';
        $bg = 'text-red-700 bg-red-100';
    }
}

?>
<?php if(isset($message)): ?>
<div class="p-4 w-1/2 text-center mx-auto mb-4 text-sm <?php echo $bg;?>  rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
         <span class="font-medium"><?php echo $message; ?></span> 
</div>
<?php endif;?>
<div class="w-full  py-1 px-2">
    
    <div class="bg-green-200 rounded-sm shadow-md transition-all ease-in-out w-10/12 mx-auto my-5 py-1 px-2 flex flex-col ">
        <span class="justify-self-center self-center text-lg font-medium capitalize">mise a jour filiers </span>
        <form method="post" action="" id="form" class=" w-10/12 mx-auto my-5 py-1 px-2">
            <div class="my-2 flex content-around focus:outline-none">
                <label class="font-medium text-lg capitalize  w-1/3" for="">labele:</label>
                <input name="intituleFil" value="<?php echo isset($fil) ? $fil['intituleFil'] : ''; ?>" class="p-1 rounded-sm w-2/3" type="text" placeholder="lebele de filier" id="fil_label">
            </div>

    <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">departement :</label>
             <select id="user_role" name="codeDep" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                <!--  dynamique list all departement -->
                <?php foreach($db->getData('departements') as $dep){
                    if($dep['NumDept']==$fil['codeDep']){
                        echo '<option selected value="'.$dep['NumDept'].'">'.$dep['intituleDep'].'</option>';
                    }
                    echo '<option value="'.$dep['NumDept'].'">'.$dep['intituleDep'].'</option>';
                } ?>
            </select>
    </div>
    <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">responsable filier :</label>
             <select id="user_role" name="responsable" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                <!--  dynamique list all chef filier -->
                <?php foreach($db->getUsersByRole(4) as $chef){
                    if(isset($fil) && $fil['responsable']==$chef['id']){
                        echo '<option selected value="'.$chef['id'].'">'.$chef['nom'].' '.$chef['prenom'].'</option>';
                    }else{
                        echo '<option  value="'.$chef['id'].'">'.$chef['nom'].' '.$chef['prenom'].'</option>';
                    }
                    
                } ?>
               
            </select>
    </div>
    
        <input id="btn_add_fil" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" name="<?php echo isset($fil) ? 'modifier' : 'ajouter' ?>" value="<?php echo isset($fil) ? 'modifier' : 'ajouter' ?>">
   
</form>
</div>
<!-- end supper admin part  -->
<div class="overflow-x-auto relative mt-5 px-3">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Labele de filier
                </th>
                <th scope="col" class="py-3 px-6">
                    departement
                </th>
                <th scope="col" class="py-3 px-6">
                    responsable
                </th>
                <th scope="col" class="py-3 px-6">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($fils as $fl) : ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6  font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?php echo $fl['intituleFil']; ?>
                </th>
                <td class="py-4 px-6 uppercase">
                <?php echo $fl['intituleDep']; ?>
                </td>
                <td class="py-4 px-6 uppercase">
                <?php echo $fl['nom'].' '.$fl['nom']; ?>
                </td>
                <td class="py-4 px-6">
                <a class="text-blue-600 w-full" href="?edit=<?php echo $fl['codeFil'];  ?>">modifier</a>
                </td>
            </tr>
           <?php endforeach;?>
        </tbody>
    </table>
</div>
</div>

<script src="../js/filiers/main.js"></script>
