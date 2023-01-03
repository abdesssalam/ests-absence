<?php 
$title = 'gestion des modules et filier';
require_once '../includes/header.php'

// role : chef filier

?>
<div class="w-full  py-1 px-2">
    <ul class="list-none flex flex-col md:flex-row w-full justify-between  ">
        <li id="module-module" class="cursor-pointer my-1 md:my-0 text-lg bg-green-400 text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white w-full  md:w-1/2 text-center">les modules</li>
        <li id="module-matier" class="cursor-pointer my-1 md:my-0 text-lg bg-green-400 text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white  w-full md:w-1/2 text-center">les matiers</li>
    </ul>
    <div class="w-11/12 mx-auto  mt-3 bg-green-300 py-3 px-2 rounded shadow flex md:flex-row flex-col justify-start items-center">
        <div class="md:w-1/3 w-full  md:mx-2 my-1 md:my-0 flex   justify-between items-center" >
            <label  class="block w-1/4 md:w-auto mx-1 text-md font-medium text-gray-900 dark:text-white">departement</label>
            <select id="departement" class="w-3/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block md:w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser departement</option>
                
            </select>
        </div>
        
        <div class="md:w-1/3 w-full  md:mx-2 my-1 md:my-0 flex justify-between items-center" >
            <label  class="block w-1/4 md:w-auto mx-1 text-md font-medium text-gray-900 dark:text-white">filier</label>
            <select id="filier" class="w-3/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block md:w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser filier</option>
                
            </select>
        </div>
        <div class="md:w-1/3 w-full  md:mx-2 my-1 md:my-0 flex justify-between items-center" >
            <label  class="block w-1/4 md:w-auto mx-1 text-md font-medium text-gray-900 dark:text-white">Année</label>
            <select id="numAnnee" class="w-3/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block md:w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser l'année</option>
                <option value="1">1er</option>
                <option value="2">2eme</option>
               
            </select>
        </div>
    </div>
   <div id="content">
   
   </div>
</div>
<script src="../js/modules.js"></script>
