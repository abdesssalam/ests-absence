<?php 
$title = 'gestion des profil';
require_once '../includes/header.php';

$root = simplexml_load_file('../db/absence.xml');

    foreach($root->users->user as $user) { 
       if(  $_SESSION['identifiant'] ==  $user->email ){
        $active = $user;
        }
    }

//don't how to control width using tailwind friend someone handle it.

?>

<div class="w-full content-center">
    <h1 class="text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Information personnel</h1>
    
    <div class="w-1/2 flex m-auto">
        <div>
            <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom :</label>
            <input value = "<?php echo $active->nom ?>"  type="text" id="nom" class="bg-gray-50 border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nom" disabled>
        </div>

        <div>
            <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom :</label>
            <input  value = "<?php echo $active->prenom ?>" type="text" id="prenom" class="bg-gray-50 border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Prenom" disabled>
        </div>
    </div>

    <div class="w-1/2 mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
        <input value = "<?php echo $active->email ?>" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required>
    </div>
</div>

    
<?php require_once '../includes/footer.php' ?>
