<?php 
$title = 'gestion des emploit de tepms';
require_once '../includes/header.php' ?>
<!-- assoiating matier to prof and groupe  -->

<!-- mise a jour : matier : prof ,semain debut , semain fin , jr,seance , annegroup , group ,   -->
<!-- listing : filter by  -->

<!-- TODO: dynamic departements and filiers for menu -->
<div class="w-full  py-1 px-2">
    <ul id="department" class="list-none flex flex-col md:flex-row w-full justify-between  ">    
       <?php foreach($db->getData('departements') as $dep): ?>
        <li id="<?php echo $dep['NumDept']?>"  class="dep bg-green-400  cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white w-full md:mx-1 md:my-0 my-1  md:w-1/2 text-center" "><?php echo $dep['intituleDep']?> </li>
        <?php endforeach;?>
    </ul>
    <!-- display after GET Method -->
   
    <div class="w-full mt-5 mx-auto  bg-green-300 py-3 px-2 rounded shadow  flex flex-wrap justify-start items-center">
        <div class="md:w-1/3 w-full px-1 my-1 flex justify-between items-center " >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 dark:text-white">filiers</label>
            <select disabled id="filier" class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </select>
        </div>
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block md:w-1/3 w-full text-sm font-medium text-gray-900 dark:text-white">Année</label>
            <select disabled id="annee" class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <!-- <option selected>choiser l'année</option>
                <option value="1">1er</option>
                <option value="2">2eme</option> -->
               
            </select>
        </div>
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 dark:text-white">semestre</label>
            <select id="semester" class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser semestre</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 dark:text-white">groupe</label>
            <select disabled id="group" class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                
            </select>
        </div>
        
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 dark:text-white">matier</label>
            <select disabled id="matier" class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                
            </select>
        </div>
        
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 dark:text-white">professeur</label>
            <select id="professeur" class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                
            </select>
        </div>
        
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 ">semaine debut </label>
            <input id="debut" class=" p-2.5 md:p-2 rounded-md md:w-2/3 w-full " type="number" >
        </div>
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 ">semaine fin </label>
            <input id="fin" class=" p-2.5 md:p-2 rounded-md md:w-2/3 w-full " type="number" >
        </div>
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 dark:text-white">jour</label>
            <select id="jour"  class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser jour</option>
                <option value="1">lundi</option>
                <option value="2">Mardi</option>
                <option value="3">Mercredi</option>
                <option value="4">Jeudi</option>
                <option value="5">Vendreder</option>
            </select>
        </div>
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 dark:text-white">seance</label>
            <select id="seance" class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser seance</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div class="md:w-1/3 w-full px-1 my-1  flex justify-end items-center" >
            
            <input class="cursor-pointer text-white font-semibold   rounded-md justify-self-end  md:w-2/3 w-full p-2.5 bg-green-600 hover:bg-green-500 hover:text-gray-50" type="submit" value="ajouter" >
        </div>
        
    </div>
    
    <!-- table -->
</div>

<script src="../js/emploi.js"></script>