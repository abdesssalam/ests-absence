<?php
require_once '../../db/config.php';

?>
    <button id="show_model" class="block text-white w-1/3 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600">ajouter nouveau authorizations</button>
    <div id="model" class="fixed justify-center items-center hidden z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60 ">
    
    <div class="bg-green-400   w-11/12 mx-auto my-5 py-8 px-5 rounded-md shadow-sm ">
    <div id="alertS" class="p-4 hidden w-1/2 mx-auto text-center mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span id="label-success-add-auth" class="font-medium">les authorizations sont bien ajoutée</span> 
    </div>
        <div class="my-2 flex content-around focus:outline-none">
                <label class="font-medium text-lg capitalize  w-1/5" for="">Role :</label>
                 <select id="role" name="role" class="w-4/5 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                 <?php foreach($db->getData('roles') as $role ){
                        echo '<option value="'.$role['Num'].'" >' . $role['label'] . '</option>';
                    } ?>
                </select>
            </div>
            <div class="my-2 flex content-around focus:outline-none">
                <label class="font-medium text-lg capitalize  w-1/5" for="">Permission :</label>
                 <select id="action" name="action" class="w-4/5 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                    <option>update</option>
                    <option>select</option>
                </select>
            </div>
            <div class="my-2 flex content-around focus:outline-none">
                <label class="font-medium text-lg capitalize  w-1/5" for="">table :</label>
                <ul class="flex  items-center w-4/5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex flex-wrap ">
                    <?php foreach($db->get_tables() as $table ):?>
                        <li class="w-auto mx-3 border-b border-gray-200  dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="table-<?php echo $table?> " name="roles" type="checkbox" value="<?php echo  $table  ?>" class="tables w-8 h-8 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 ">
                                <label for="checkbox-list" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300"><?php echo  $table  ?></label>
                            </div>
                        </li>
                        <!-- //echo '<option>' . $table . '</option>'; -->
                    <?php endforeach; ?>   
                    </ul>
            </div>
            <div class="md:w-1/2 w-full flex mx-auto">
                <input id="btn_add_auth" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" name="add_auth" value="ajouter">
                <button id="btn_cancel" class="block text-white w-1/4 mx-auto bg-red-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-300">annuler</button>
            </div>
            
        </div>
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



<script>
    $('#show_model').click(function(){
        $('#model').removeClass('hidden');
        $('#model').addClass('flex');
    })

    $('#btn_cancel').click(function(){
        $('#model').removeClass('flex');
        $('#model').addClass('hidden');
    })
</script>