<?php
require_once '../../db/config.php';

?>
<div class="bg-green-200 rounded-sm shadow-md transition-all ease-in-out w-10/12 mx-auto my-5 py-1 px-2 flex flex-col ">
<span class="justify-self-center self-center text-lg font-medium capitalize">ajouter nouveau utilisateur </span>
<i id="toggle-form" class=' w-10 h-10  fas fa-angle-down font-extrabold cursor-pointer text-4xl self-end'></i>
<form  method="post" action="" id="form" class="hidden">
    <div class=" my-2 flex content-around focus:outline-none">
        <label class="font-medium text-lg capitalize  w-1/3" for="">Nom:</label>
        <input class="p-1 rounded-sm w-2/3"  type="text" id="user_nom">
    </div>
    <div class="my-2 flex content-around focus:outline-none">
        <label class="font-medium text-lg capitalize  w-1/3" for="">Prenom:</label>
        <input class="p-1 rounded-sm w-2/3" type="text" id="user_prenom">
    </div>
    <div class="my-2 flex content-around focus:outline-none">
        <label class="font-medium text-lg capitalize  w-1/3" for="">email:</label>
        <input class="p-1 rounded-sm w-2/3" type="text" id="user_email">
    </div>
    <div class="my-2 flex content-around focus:outline-none">
        
    <h3 class="font-medium text-lg capitalize  w-1/3 ">Role</h3>
    <ul class="items-center w-2/3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex sm:flex-wrap ">
        <?php  foreach($db->getData('roles') as $role): ?>
            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                <div class="flex items-center pl-3">
                    <input id="checkbox-list" name="roles" type="checkbox" value="<?php echo $role['Num'] ?>" class="roles w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 ">
                    <label for="checkbox-list" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"><?php echo $role['label'] ?></label>
                </div>
            </li>
        <?php endforeach; ?>       
    </ul>
    </div>
    
    <input id="btn_add_user" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="ajouter">
</form>
    
   
</div>
<div class="overflow-x-auto relative mt-5">
    <table id="table" class="w-11/12 mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Nom et Prenom
                </th>
                <th scope="col" class="py-3 px-6">
                    email
                </th>
                <th scope="col" class="py-3 px-6">
                    Role
                </th>
                <th scope="col" class="py-3 px-6">
                </th>
            </tr>
        </thead>
        <tbody>
        <tr class="bg-white border-b">
            <!-- <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
            </th>
            <td class="py-4 px-6"> -->

           
        </tbody>
    </table>
</div>
<script src="../js/contacts/contact.js"></script>
