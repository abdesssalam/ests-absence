<?php 
require_once('session.php');
require_once('../db/config.php');

if(isset($_SESSION['identifiant'])){
  $active = $db->getLoggedUser($_SESSION['identifiant']);  
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
    <title><?php echo $title ?></title>
    <style>
        input:focus{
            outline: none;
        }
    </style>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script> const BASE_URL="<?php echo "http://localhost/ests-absence/api/" ?>"; </script>
</head>
<body class="md:flex bg-gray-100 ">

    <div class="md:hidden bg-blue-500 text-center text-3xl  w-full">
    
        <i id="menu" class="fas fa-bars cursor-pointer "></i>
    </div>
    
    <nav class="bg-blue-500 py-2 md:fixed flex flex-col items-center cursor-pointer w-screen   md:w-3/12 md:h-screen">
        <div class="bg-blue-900 w-11/12 rounded-md  my-2 text-center text-white uppercase py-2 md:block sm:flex-none  ">
            <a  href="../dashboard/profile.php">
                <div class="flex items-center mx-auto text-center justify-center w-10/12 border border-gray-100 py-1 rounded-md hover:text-gray-400 ">
                    <i class="fas fa-user text-3xl mx-2"></i>
                    <span><?php echo $full_name; ?> </span>
                </div>
            </a>
            
        </div>
        <ul class="w-11/12 h-4/5 my-1 text-white font-bold text-lg uppercase ">
            <?php 
            //only super admin can manage acount&roles
            //ga3ma khdamna 3ab bsesseioin role rir katjiv les  donne dyal khona kamlin fda9a bham hak nadi.
            // exemple super admin : login : test@gmail.com && pass :12345
            /**
             * @author abdessalam 
             * andir lhad test comment bach n9ad design bla ma kola mra ndir login
             * nsali design d les role kamlin w ghadi n7yd les cemmentaires
             */
           // if($active->role == "SuperAdmin"){
            ?>
            <!-- only for super admin -->
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fas fa-user text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/contacts.php">les comptes et les roles</a>
            </li>
            <?php //} ?>
            <!-- only for supper admin -->
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-table-list text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/departements.php">les départements</a>
            </li>
            <!-- supper admin + chef departement -->
           <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-graduation-cap text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/filiers.php">les  filiers</a> 
            </li>
            <!-- chef filier + agent scolaire -->
           <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-graduation-cap text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/modules.php">modules et matieres</a> 
            </li>
            <!-- agent scolaire -->
             <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-hourglass-end text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/emplois.php">les emploit de tepms</a> 
            </li>
            <!-- all but there is traitement inside
               supper admin + agenet scolaire =>lister par : depatrement + filers + annee + modules + matiers
               chef departement => lister par : filers + annee + modules + matiers
               chef filier => lister par : annee + modules + matiers
               prof => marker absence + lister par matiers 
            -->
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-building text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/absences.php">les absences</a> 
            </li>
            <!-- only for prof -->
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-building text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/marker.php">marker</a> 
            </li>
        </ul>
        
        <div class="w-full  text-white h-1/5 self-end">
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
