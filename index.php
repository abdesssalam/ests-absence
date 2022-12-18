<?php include_once 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/output.css">
    
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <title>Home page</title>
    <style>
        input:focus,select:focus{
            outline:none;
        }
    </style>
</head>
<body class="bg-blue-400 ">

<div class="w-screen h-screen flex flex-col justify-center items-center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="w-1/2 md:w-1/3 bg-blue-500 py-2 px-1 rounded-lg shadow-md">
    <div class="mb-2">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
        <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="exemple@ests.edu" required>
    </div>
    <div class="mb-2">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre Mot de pass</label>
        <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
    </div>
    <button type="submit" class="text-white w-full  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">connecter a votre compte</button>
   

</form>
</div>

<?php require_once 'includes/footer.php' ?>
