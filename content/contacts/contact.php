<div class="bg-green-200 w-10/12 mx-auto my-5 py-1 px-2">
    <div class="my-2 flex content-around focus:outline-none">
        <label class="font-medium text-lg capitalize  w-1/3" for="">Nom:</label>
        <input class="p-1 rounded-sm w-2/3" value="test" type="text" id="user_nom">
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
            <label class="font-medium text-lg capitalize  w-1/3" for="">Role :</label>
             <select id="user_role"  class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                <option value="1">Super admin</option>
                <option value="2">agent scolaire</option>
                <option value="3">chef departement</option>
                <option value="4">responsable filier</option>
                <option value="5">profisseur</option>
            </select>
    </div>
    
        <input id="btn_add_user" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="ajouter">
   
</div>
<div class="overflow-x-auto relative mt-5">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    abdessalam ait omar
                </th>
                <td class="py-4 px-6">
                   aitoamrabdeslam@gmail.com
                </td>
                <td class="py-4 px-6">
                supper admin
                </td>
                <td class="py-4 px-6">
                <a class="text-blue-600 w-full" href="#">modfier</a>
                </td>

            </tr>
           
        </tbody>
    </table>
</div>
<script src="../js/contacts/contact.js"></script>
