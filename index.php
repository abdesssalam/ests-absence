<?php include_once 'includes/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/output.css">
    

    <!-- find a way to use tailwind instead -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   



    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <title>Home page</title>
    <style>
        input:focus,select:focus{
            outline:none;
        }
    </style>
</head>

<?php
if(isset($_POST['submit'])){
    
     $login = $_POST['email'];
     $password = $_POST['password'];

    $existanceOfUser = false;
    $root = simplexml_load_file('db/absence.xml');
    
    
    foreach($root->users->user as $user) { 
       if($login ==  $user->email && $password ==  $user->password ){
            //ran 3arfo bli utlisateur kayn ray b9a n3rfo role dyalo bax 3la hsab xno ran ntal3o lih
            session_start();

            $_SESSION['identifiant'] = $_POST['email'];
            $_SESSION['role'] = "$user->role";

            header('Location:dashboard/index.php');
            $existanceOfUser = true;

            break;
        }
    }

    //ila l code wsall lhan ran 3arfo khona makynx f lbase.

    echo "<h1>ndiroha f popup : user doesn't exist</h1>";


}
$noSuchUserPopup = false ;


?>


<body class="bg-blue-400 ">

<div class="w-screen h-screen flex flex-col justify-center items-center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="w-1/2 md:w-1/3 bg-blue-500 py-2 px-1 rounded-lg shadow-md">
    <div class="mb-2">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
        <input type="email" value="test@gmail.com" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="exemple@ests.edu" required>
    </div>
    <div class="mb-2">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre Mot de pass</label>
        <input type="password" value="12345" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
    </div>
    <button name="submit" type="submit" class="text-white w-full  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">connecter a votre compte</button>
   

</form>
</div>

<?php require_once 'includes/footer.php' ?>



