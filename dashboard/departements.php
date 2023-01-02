<?php
$title = 'gestion des departements';
require_once '../includes/header.php';


$deps = $db->getData('departements')->jointure($db->getData('users'), 'chef', 'id');
$deps = $deps->map(function ($item) {
    $item = array_values($item->toArray());
    $item = $item[0];
    return $item;
});

$dep;
if(isset($_GET['edit'])){
    $dep = $deps->firstWhere('NumDept', $_GET['edit']);
}
if(isset($_POST['ajouter'])){
    $added=$db->add_departement($_POST);
    if($added){
        //pop up after
        echo 'add';
    }
}
?>
<div class="bg-green-200 w-10/12 mx-auto my-5 py-1 px-2">
    <form action="" method="post">
    <div class="my-2 flex content-around focus:outline-none">
        <label class="font-medium text-lg capitalize  w-1/3" for="">labele:</label>
        <input name="intitule" value="<?php echo isset($dep) ? $dep['intitule'] : '' ?>" class="p-1 rounded-sm w-2/3" type="text" id="dept_label">
    </div>
    <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">Chef departement :</label>
             <select name="chef"  class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                <!-- @abdessalam: dynamique list all professeur -->
                <?php foreach($db->getUsersByRole(3) as $chef){
                    if(isset($dep) && $dep['chef']==$chef['id']){
                        echo '<option selected value="'.$chef['id'].'">'.$chef['nom'].' '.$chef['prenom'].'</option>';
                    }else{
                        echo '<option  value="'.$chef['id'].'">'.$chef['nom'].' '.$chef['prenom'].'</option>';
                    }
                    
                } ?>
            </select>
    </div>
        <input id="btn_add_dpt" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" name="<?php echo isset($dep) ? 'modifier' : 'ajouter' ?>" value="<?php echo isset($dep) ? 'modifier' : 'ajouter' ?>" >
    </form>
    </div>
<div class="overflow-x-auto relative mt-5 px-3">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                   Labele de departement
                </th>
                <th scope="col" class="py-3 px-6">
                    chef departement
                </th>
                <th scope="col" class="py-3 px-6">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($deps as $dep): ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6  font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   <?php echo $dep['intitule']; ?>
                </th>
                <td class="py-4 px-6 uppercase">
                    <?php echo $dep['prenom'].' '.$dep['nom']; ?>
                </td>
                <td class="py-4 px-6">
                <a class="text-blue-600 w-full" href="?edit=<?php echo $dep['NumDept'] ?>">modifier</a>
                </td>
            </tr>
           <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="../js/contacts/contact.js"></script>
