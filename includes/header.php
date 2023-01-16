<?php 
require_once('session.php');
require_once('../db/config.php');

$active;
if(isset($_SESSION['ID'])){
  $active = $db->getLoggedUser($_SESSION['ID']);  
}
else{
    header('location:../index.php');
}
$full_name = isset($active) ? $active['nom']." ".$active['prenom'] : 'first last';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all.css">
    <!-- <link rel="stylesheet" href="../css/dashboard.css"> -->
    <link rel="stylesheet" href="../css/output.css">
    <!-- <link rel="stylesheet" href="../css/header.css"> -->
    <title><?php echo isset($title) ? $title : 'dashboard' ?></title>
    <style>
        input:focus,select:focus{
            outline: none;
        }
    </style>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script> 
    const BASE_URL="<?php echo "http://localhost/ests-absence/api/" ?>";
    $(document).ready(function(){
            $.ajax({
                type: "GET",
                url: "http://localhost/ests-absence/db/translations.xml",
                dataType: "xml",
                success: function(xml) {
                    var currentLanguageCode = 'fr';
                    $(xml).find('language').each(function(){
                        if($(this).attr('code') == currentLanguageCode){
                            $(this).find('string').each(function(){
                                var id = $(this).attr('id');
                                var text = $(this).text();
                                var htmlElt=$("#"+id);
                                if($("#"+id).length){
                                   
                                    $("span#"+id).text(text)
                                }
                            });
                        }
                    });
                }
            });

        }) 
        
    </script>
   
</head>
<body class="md:flex bg-gray-100 ">
    <span id="welcome"></span>    
    <div class="md:hidden bg-blue-500 text-center text-3xl  w-full">
    
        <i id="menu" class="fas fa-bars cursor-pointer "></i>
    </div>
    
    <nav class="bg-blue-500 py-1 md:fixed flex flex-col items-center cursor-pointer h-screen w-screen   md:w-3/12 md:h-screen">
        <div class="bg-blue-900 py-2  w-11/12 rounded-md h-1/6 my-2 text-center text-white uppercase md:block sm:flex-none  ">
            <a  href="../dashboard/profile.php" class="h-1/2">
                <div class="flex items-center mx-auto text-center justify-center w-10/12 border border-gray-100 py-1 rounded-md hover:text-gray-400 ">
                    <i class="fas fa-user text-3xl mx-2"></i>
                    <span><?php echo $full_name; ?> </span>
                </div>
            </a>
            <div class="flex items-center  mx-auto text-center h-1/2 justify-center w-10/12  py-3 rounded-md hover:text-gray-400">
            <label for="countries" class="w-1/3 cursor-pointer block text-sm font-medium text-gray-50 dark:text-white">language :</label>
                <select id="countries" class="w-2/3 bg-gray-50 cursor-pointer border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="FR">Francais</option>
                    <option value="EN">Anglais</option>
                </select>
            </div>
           
        </div>
        <ul class="w-11/12   my-1 text-white font-bold text-lg uppercase ">
            <!-- only for super admin -->
            <?php if(in_array(1,$_SESSION['roles'])): ?>
                <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                    <i class="fas fa-user text-3xl mx-3"></i>
                    <a class="w-full" href="../dashboard/contacts.php">les comptes et les roles</a>
                </li>
            <?php endif; ?>
            <!-- only for supper admin -->
            <?php if(in_array(1,$_SESSION['roles'])): ?>
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-table-list text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/departements.php">les départements</a>
            </li>
            <?php endif; ?>
            <!-- supper admin + chef departement -->
            
           <?php if(in_array(1,$_SESSION['roles'])  ): ?>
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-graduation-cap text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/filiers.php">les  filiers</a> 
            </li>
             <?php endif; ?>
            <!-- chef filier + agent scolaire -->
           <?php if(in_array(4,$_SESSION['roles']) || in_array(3,$_SESSION['roles'])): ?>
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-graduation-cap text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/modules.php">modules et matieres</a> 
            </li>
             <?php endif; ?>
            <!-- agent scolaire -->
            <?php if(in_array(2,$_SESSION['roles'])): ?>
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-building text-3xl mx-3"></i>
                <a class="w-full" href="etudiants.php">les etudiants</a> 
            </li>
             <?php endif; ?>
            <?php if(in_array(2,$_SESSION['roles'])): ?> 
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-hourglass-end text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/emplois.php">les emploit de tepms</a> 
            </li>
             <?php endif; ?>
            <!-- all but there is traitement inside
               supper admin + agenet scolaire =>lister par : depatrement + filers + annee + modules + matiers
               chef departement => lister par : filers + annee + modules + matiers
               chef filier => lister par : annee + modules + matiers
               prof => marker absence + lister par matiers 
            -->
            <?php if(isset($_SESSION['roles'])): ?>
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-building text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/absences.php">les absences</a> 
            </li>
             <?php endif; ?>
            <!-- only for prof -->
            <?php if(in_array(5,$_SESSION['roles'])): ?>
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-building text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/marker.php">marker</a> 
            </li>
             <?php endif; ?>
            
        </ul>
        
        <div class="w-full  text-white  h-1/5 self-end">
            <div class="flex items-center bg-red-500 w-11/12 mx-auto py-2 uppercase">
                <i class="fa-solid fa-right-to-bracket text-3xl mx-3"></i>
                <a class="w-full"  href="../controllers/logout.php">déconnection</a> 
            </div>
        
        </div>
       
    </nav>
    <div class="content  md:w-9/12 md:mb-5 py-3 md:absolute right-0  md:top-0  ">
      <div class="w-9/12 text-center cursor-pointer bg-green-500 mx-auto my-2 py-4 rounded-md shadow-md hover:bg-green-700">
        <h3 class="text-lg uppercase font-semibold text-white"><?php echo $title ?></h3>
      </div>

