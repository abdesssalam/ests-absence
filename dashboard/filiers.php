
<?php 
$title = 'gestion des filiéres';
require_once '../includes/header.php' ?>
<div class="w-full  py-1 px-2">
    <ul class="list-none flex flex-col md:flex-row w-full justify-between bg-green-400 ">
        <li id="filier-filier" class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white w-full  md:w-1/2 text-center">les filiers</li>
        <li id="filier-group" class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white  w-full md:w-1/2 text-center">les groupes</li>
        <li id="filier-modules" class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white  w-full md:w-1/2 text-center">les modules</li>
       
    </ul>
   <div id="content">
   <div class="bg-green-200 w-10/12 mx-auto my-5 py-1 px-2">
    <div class="my-2 flex content-around focus:outline-none">
        <label class="font-medium text-lg capitalize  w-1/3" for="">labele:</label>
        <input class="p-1 rounded-sm w-2/3" type="text" placeholder="lebele de filier" id="fil_label">
    </div>

    <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">departement :</label>
             <select id="user_role"  class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                <!--  dynamique list all departement -->
                <option value="1">Super admin</option>
                <option value="2">agent scolaire</option>
                <option value="3">chef departement</option>
                <option value="4">responsable filier</option>
                <option value="5">profisseur</option>
            </select>
    </div>
    <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">responsable filier :</label>
             <select id="user_role"  class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                <!--  dynamique list all professeur -->
                <option value="1">Super admin</option>
                <option value="2">agent scolaire</option>
                <option value="3">chef departement</option>
                <option value="4">responsable filier</option>
                <option value="5">profisseur</option>
            </select>
    </div>
    
        <input id="btn_add_dpt" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="ajouter">
   
</div>
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
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6  font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Ginie Informatique
                </th>
                <td class="py-4 px-6 uppercase">
                    Informatique
                </td>
                <td class="py-4 px-6 uppercase">
                    ilham mounir
                </td>
                <td class="py-4 px-6">
                <a class="text-blue-600 w-full" href="filiers.php?edit=#">modifier</a>
                </td>
            </tr>
           
        </tbody>
    </table>
</div>
   </div>
</div>

<script src="../js/contacts/contact.js"></script>
