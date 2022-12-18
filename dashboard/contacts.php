<?php require_once '../includes/header.php' ?>

<div class="w-full  py-1 px-2">
    <ul class="list-none flex w-full justify-between bg-green-400 ">
        <li class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white w-1/4 text-center">agent scolaire</li>
        <li class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white w-1/4 text-center">chef departement</li>
        <li class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white w-1/4 text-center">chef filiers</li>
        <li class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white  w-1/4 text-center">professeur</li>
    </ul>
    <div class="overflow-x-auto relative mt-5">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Nom et Prenom
                </th>
                <th scope="col" class="py-3 px-6">
                    Role
                </th>
                <th scope="col" class="py-3 px-6">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   Abdessalam ait omar
                </th>
                <td class="py-4 px-6">
                    <select >
                        <option >agent scolaire</option>
                        <option>chef departement</option>
                        <option selected>chef filier</option>
                        <option>professeur</option>
                    </select>
                </td>
                <td class="py-4 px-6">
                <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5   ">sauvgarder</button>
                </td>
            </tr>
           
        </tbody>
    </table>
</div>
</div>