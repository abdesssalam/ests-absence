<?php require_once '../includes/header.php' ?>
dashboard
<?php


if(!isset($_SESSION)) 
{ 
	session_start(); 
	 echo  $_SESSION['role'];


} else{
	echo "wwwwwhaa";
}


?>
<?php require_once '../includes/footer.php' ?>