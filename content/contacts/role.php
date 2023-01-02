<?php
require_once '../../db/config.php';

?>
<div class="bg-green-200 w-10/12 mx-auto my-5 py-1 px-2">
        <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">Role :</label>
             <select id="role" name="role" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
             <?php foreach($db->getData('roles') as $role ){
                    echo '<option value="'.$role['Num'].'" >' . $role['label'] . '</option>';
                } ?>
            </select>
        </div>
        <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">table :</label>
             <select id="table" name="table" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                <?php foreach($db->get_tables() as $table ){
                    echo '<option>' . $table . '</option>';
                } ?>   
            </select>
        </div>
        <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">Permission :</label>
             <select id="action" name="action" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                <option>update</option>
                <option>select</option>
            </select>
        </div>
        <input id="btn_add_auth" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" name="add_auth" value="ajouter">
</div>

<div class="w-11/12 mx-auto py-3 overflow-hidden ">
 <h2 class="text-center font-bold text-xl capitalize">Liste des Authorizations </h2>
 <div class="overflow-x-auto  relative mt-3 w-full h-1/3 ">
    <table id="table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Role
                </th>
                <th scope="col" class="py-3 px-6">
                    Action
                </th>
                <th scope="col" class="py-3 px-6">
                    Table
                </th>
                
                <th scope="col" class="py-3 px-6">
                     
                </th>
            </tr>
        </thead>
        <tbody >
           
           
           
        </tbody>
    </table>
</div>
</div>
