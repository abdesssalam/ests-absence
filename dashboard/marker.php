<?php 
$title = 'gestion des absences';



require_once '../includes/header.php'; 



?>

<div class="w-11/12 mx-auto bg-blue-500 flex flex-wrap justify-start rounded-md shadow-md cursor-pointer " >
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-1/2 ">Profisseur : <span class="text-gray-100">Abderrahmen Chekry</span>  </h3>
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-1/2 ">Filier : <span class="text-gray-100">Ginie Informatique</span>  </h3>
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-1/4 ">annee : <span class="text-gray-100">1</span>  </h3>
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-1/4 ">groupe : <span class="text-gray-100">2</span>  </h3>
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-2/4 ">Module : <span class="text-gray-100"> languge C++ </span>  </h3>
</div>

<!-- list des etudiants -->


<div class="overflow-x-auto relative mt-5">
    <table id="table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Numero
                </th>
                <th scope="col" class="py-3 px-6">
                    Nom 
                </th>
                <th scope="col" class="py-3 px-6">
                     Prenom
                </th>
                <th scope="col" class="py-3 px-6">
                    absences
                </th>
                
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   1
                </th>
                <td class="py-4 px-6">
                    ait omar
                </td>
                <td class="py-4 px-6">
                    abdessalam
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-3" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-3" class="sr-only">checkbox</label>
                    </div>
                </td>

            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   1
                </th>
                <td class="py-4 px-6">
                    ait omar
                </td>
                <td class="py-4 px-6">
                    abdessalam
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-3" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-3" class="sr-only">checkbox</label>
                    </div>
                </td>

            </tr>
           
           
        </tbody>
    </table>
    <input id="btn_add_abs" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="sauvgarder">
</div>
