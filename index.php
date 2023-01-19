<?php include_once 'includes/session.php';
include_once 'db/config.php';
include_once 'db/Columns.php';

?>
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
$err = 0;
//  espace for testing $db functions


//end testing
if(isset($_POST['submit'])){
     $us=$db->get_users()->firstWhere('email',$_POST['email']);
     if($us){
        if(password_verify($_POST['password'],$us['password'])){
           
            $_SESSION['ID'] = $us['id'];
            $permissions = $db->get_User_Permessions($_SESSION['ID']);
                $_SESSION['permissions'] = $permissions;
                $_SESSION['roles'] = $db->get_num_roles_user($us['id']);
            if(password_verify('ESTS123',$us['password'])){
                header("Location:newpass.php");
            }else{
                
                 if(in_array(1,$_SESSION['roles'])){
                    header("Location:dashboard/contacts.php");
                 }else if(in_array(2,$_SESSION['roles'])){
                    // agent de scolarite
                    header("Location:dashboard/absences.php");
                 }else if(in_array(3,$_SESSION['roles'])){
                    // chef departement=>get dep
                    $dep = $db->getData('departements')->firstWhere('chef', $us['id']);
                    if($dep){
                        $_SESSION['dep'] = $dep['NumDept'];
                         header("Location:dashboard/absences.php");
                    }else{
                         header("Location:dashboard/marker.php");
                    }
                }else if(in_array(4,$_SESSION['roles'])){
                    // chef filier=>filier
                    $fil = $db->getData('filiers')->firstWhere('responsable', $us['id']);
                    if($fil){
                        $_SESSION['filier'] = $dep['codeFil'];
                         header("Location:dashboard/absences.php");
                    }else{
                         header("Location:dashboard/marker.php");
                    }

                }else if(in_array(5,$_SESSION['roles'])){
                        // professeur
                     header("Location:dashboard/marker.php");
                }
                 
                
            }
        }else{
            $err = 1;
        }
        }else{
            $err = 1;
        }


}
?>


<body class="bg-blue-400 ">

<div class="w-screen h-screen flex flex-col justify-center items-center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="w-1/2 md:w-1/3 bg-blue-500 py-5 px-2  rounded-lg shadow-md">
        <?php if($err==1): ?>
            <div class="p-4 mb-4 text-sm text-center text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">les informations incorrectes!</span> 
            </div>
        <?php endif; ?>
        <div class="mb-2">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
            <input type="email"  name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="exemple@ests.edu" required>
        </div>
        <div class="mb-2">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre Mot de pass</label>
            <input type="password"  name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="votre mot de pass" required>
        </div>
        <button name="submit" type="submit" class="text-white w-full  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">connecter a votre compte</button>
   

    </form>
</div>

<?php require_once 'includes/footer.php' ?>



