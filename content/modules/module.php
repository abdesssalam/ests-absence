<?php
require_once '../../db/config.php';


?>
<div class="w-full mt-5">
    <!-- menu : lister et mise a jour  -->
    <div id="alertS" class="hidden p-4 mb-4 text-center w-1/2 mx-auto text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span id="msg" class="font-medium"></span> 
    </div>
    <div id="alertD" class="hidden text-center w-1/2 mx-auto p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        <span class="font-medium">Selectioner filier | l'année et replaire tout les champs</span> 
    </div>
    <div class="bg-green-200 w-10/12 mx-auto my-5 py-1 px-2">
    <div class="my-2 flex content-around focus:outline-none">
        <label class="font-medium text-lg capitalize  w-1/3" for="">Nom de module:</label>
        <input id="nomModule" class="p-1 rounded-sm w-2/3" type="text" id="dept_label">
    </div>

    <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">coordinateur :</label>
            <select id="coordonnateur" name="coordonnateur" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                <!--  dynamique list all chef filier -->
                <?php foreach($db->getUsersByRole(5) as $prof){
                        echo '<option  value="'.$prof['id'].'">'.$prof['nom'].' '.$prof['prenom'].'</option>';
                   
                    
                } ?>
               
            </select>
    </div>
    
        <input id="btn_add_module" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="ajouter">
   
</div>
    
<h1 class="text-center text-xl font-semibold ">list des modules de filier GI_1  </h1>

<!-- todo add table table -->

<div class="overflow-x-auto relative">
    <table id="table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Nom de Module
                </th>
                <th scope="col" class="py-3 px-6">
                        coordonnateur
                </th>
                <th scope="col" class="py-3 px-6">
                    filier
                </th>
                <th scope="col" class="py-3 px-6">
                    année
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b ">
                
            </tr>
          
        </tbody>
    </table>
</div>
</div>