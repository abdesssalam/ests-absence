<?php 
$title = 'gestion des profil';
require_once '../includes/header.php';


//reading
$root = simplexml_load_file('../db/absence.xml');

    foreach($root->users->user as $user) { 
       if(  $_SESSION['identifiant'] ==  $user->email ){
        $active = $user;
        }
    }

    //updating
    if(isset($_POST['update'])) {

        foreach($root->users->user as $user) { 
            if(  $_SESSION['identifiant'] ==  $user->email ){
                $user->email = $_POST['email'];
                $user->password = $_POST['pass'];
                break;
            }
         }
         file_put_contents('../db/absence.xml', $root->asXML());

         // to talk about : using of header meaning operation have succeded ;
         header('location:../index.php');
    }

?>

<div class="w-full content-center">
    <h1 class="text-center text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Information personnel</h1>
    

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <div style="border:2px solid black;padding:2em;width:80%;margin:2em auto;">
                <div class="flex justify-between w-2/3" style="margin-top:2vh;">
                    <label style="position:relative;top:10px;" for="nom" class=" font-extrabold tracking-tight block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom </label>
                    <div class="w-1/12"></div>
                    <input style="border:1px solid red;" value = "<?php echo $active->nom ?>"  type="text" id="nom" class="w-2/3 bg-gray-50 border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nom" disabled>
                </div>

                <div class="mt-8 flex justify-between w-2/3" style="margin-top:2vh;">
                    <label style="position:relative;top:10px;" for="prenom" class=" font-extrabold tracking-tight block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom </label>
                    <div class="w-1/12"></div>
                    <input  style="border:1px solid red;" value = "<?php echo $active->prenom ?>" type="text" id="prenom" class="w-2/3 bg-gray-50 border border-black text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Prenom" disabled>
                </div>

            <div class="flex justify-between w-2/3" style="margin-top:2vh;">
                <label style="position:relative;top:10px;" for="email" class=" font-extrabold tracking-tight block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                <div class="w-1/12"></div>
                <input name="email" value = "<?php echo $active->email ?>" type="email" id="email" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required>
            </div>

            <div class="flex justify-between w-2/3" style="margin-top:2vh;">
                <label style="position:relative;top:10px;" for="password" class=" font-extrabold tracking-tight block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mot De Pass</label>
                <div class="w-1/12"></div>
                <input name="pass" value = "<?php echo $active->password ?>" type="text" id="password" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required>
            </div>
            <button name="update" type="submit" style="width:60%; margin:30px 20%;padding:5px;border-radius:10px;;cursor:pointer;color:white;background-color:black;">Modifier</button>


        </div>
    </form>


</div>

    
<?php require_once '../includes/footer.php' ?>