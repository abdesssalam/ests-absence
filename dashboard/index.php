<?php require_once '../includes/header.php' ?>
dashboard
<?php
if(isset($_SESSION)){
   echo $role = $_SESSION['role'];
}
?>
<?php require_once '../includes/footer.php' ?>