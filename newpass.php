<?php
include_once 'includes/session.php';
include_once 'db/config.php';

$err = [];
if(isset($_POST['submit'])){
    //validation
    if($_POST['password']!=$_POST['password_conf']){
        $err['pass']='not match';
    }

    //else method to edit password
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/output.css">
    <title>Nouveau mot de pass</title>
</head>
<body class="bg-blue-400 ">
    <div class="w-screen h-screen flex flex-col justify-center items-center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="w-1/2 md:w-1/3 bg-blue-500 py-2 px-1 rounded-lg shadow-md">
            <div class="mb-2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Nouveau mot de pass </label>
                <input type="password"  name="password" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="nouveau mot de pass" required>
            </div>
            <div class="mb-2">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">confirmez votre Mot de pass</label>
                <input type="password"  name="password_conf" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="confirmez mot de pass" required>
                <?php echo isset($err['pass']) ? '<span class="text-red-600 font-semibold text-center py-2 w-full text-lg ">'.$err['pass']. '</span>' : '' ?> 
            </div>
            <button name="submit" type="submit" class="text-white w-full  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">enregestrer</button>
        </form>
    </div>
</body>
</html>
