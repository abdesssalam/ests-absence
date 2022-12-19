<?php include_once 'session.php';

$title = 'gestion des absences';
$full_name = 'abdessalam ait omar';
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
</head>
<body class="md:flex ">

    <div class="md:hidden bg-blue-500 text-center text-3xl  w-full">
    
        <i id="menu" class="fas fa-bars cursor-pointer "></i>
    </div>
    
    <nav class="bg-blue-500 py-2  flex flex-col items-center cursor-pointer w-screen   md:w-3/12 md:h-screen">
        <div class="bg-blue-900 w-11/12 rounded-md  my-2 text-center text-white uppercase py-2 md:block sm:flex-none h-1/4 ">
            <h3 class="text-lg font-semibold ">EST SAFI</h3>
            <h1 class="text-lg font-semibold my-1"> les absences</h1>
            <div class="flex items-center mx-auto text-center justify-center w-10/12 border border-gray-100 py-1 rounded-md hover:text-gray-400 ">
                <i class="fas fa-user text-3xl mx-2"></i>
                <span><?php echo $full_name; ?> </span>
            </div>
            
        </div>
        <ul class="w-11/12 h-3/4 text-white font-bold text-lg uppercase ">
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fas fa-user text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/contacts.php">les comptes et les roles</a>
            </li>
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-table-list text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/departements.php">les départements</a>
            </li>
           <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-graduation-cap text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/filiers.php">les  filiers</a> 
            </li>
           
            

             <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-hourglass-end text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/emplois.php">les emploit de tepms</a> 
            </li>
            <li class="flex w-11/12 bg-green-500 py-2 my-1 items-center hover:bg-green-700">
                <i class="fa-solid fa-building text-3xl mx-3"></i>
                <a class="w-full" href="../dashboard/absences.php">les absences</a> 
            </li>
        </ul>
        
        <div class="w-full  text-white h-1/5 self-end">
            <div class="flex items-center bg-red-500 w-11/12 mx-auto py-2 uppercase">
                <i class="fa-solid fa-right-to-bracket text-3xl mx-3"></i>
                <a class="w-full"  href="#">déconnection</a> 
            </div>
        
        </div>
       
    </nav>
    <div class="content bg-gray-100 md:w-9/12 md:mb-5 ">
      <div class="w-9/12 text-center cursor-pointer bg-green-500 mx-auto my-2 py-4 rounded-md shadow-md hover:bg-green-700">
        <h3 class="text-lg uppercase font-semibold text-white"><?php echo $title ?></h3>
      </div>
<!--    
    <div class="content bg-gray-100 md:w-9/12 md:mb-5 ">
      <div class="w-full text-center cursor-pointer mx-auto my-2 py-24 rounded-md shadow-md"> -->

      <!--  <h3 class="text-lg uppercase font-semibold text-white">-----home in php----------</h3>
-->
        <!-- <div class="header" style="width:100%;border:2px solid black; ">
            <a href="./index.php" class="logo test">- Ecole Supérieure de Technologie -</a>
            <div class="header-right">
            <a class="active" href="./index.php">Home</a>
            <a href="mailto:contact.ests@uca.ma">contact Us</a>
            <a href="../controllers/logout.php">logout <i class="icon fa fa-sign-out fa-fw " title="Déconnexion" aria-label="Déconnexion"></i></a>
            </div>
        </div>

    </div>   -->