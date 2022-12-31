<?php 
$title = 'profile';
require_once '../includes/header.php';
require_once '../db/config.php';


if(isset($_SESSION['identifiant'])){
    $active = $db->getLoggedUser($_SESSION['identifiant']);
}
    if(isset($_POST['update'])){


        $data = [
            "nom"=> (isset($_POST['nom']) ? $_POST['nom'] : $active['nom']),
            "prenom" => (isset($_POST['prenom']) ? $_POST['prenom'] : $active['prenom']),
            "email" => (isset($_POST['email']) ? $_POST['email'] : $active['email']),
            "pass" => (isset($_POST['password']) ? $_POST['password'] : $active['password'])
        ];


           /* if ( isset($_POST['pass_old'])){ 
                if(password_verify($_POST['pass_old'],$active['password'])){
                if($_POST['pass_nv_conf'] == $_POST['pass_nv']){
                        $db->updateUserInfo($active['id'],$data);
                    }
                }
            }$*/
//            $db->updateUserInfo($active['id'],$data);
  
foreach($data as $a){
    echo $a."<br>";
}


}
 
?>

<div class="w-full ">
    <h1 class="text-center text-2xl font-semibold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl mt-3 mb-8">les information personnel</h1>
    
    <div class="w-full md:w-2/3 mx-auto mt-5 bg-slate-100">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="w-1/2 mx-auto flex md:flex-row flex-col justify-between items-center mb-2">
                <div class="w-full md:w-1/2 mr-1">
                    <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 ">Nom :</label>
                    <input name="nom" value ="<?php echo  isset($active) ? $active['nom'] : '' ?>"  type="text" id="nom" class="bg-gray-50 border border-black text-gray-900 text-sm rounded-lg  block w-full p-2.5 " placeholder="nom" >
                </div>
                <div class="w-full md:w-1/2">
                    <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 ">Prenom :</label>
                    <input name="prenom"  value ="<?php echo  isset($active) ? $active['prenom'] : ''?>" type="text" id="prenom" class="bg-gray-50 border border-black text-gray-900 text-sm rounded-lg  block w-full p-2.5 " placeholder="Prenom" >
                </div> 
            </div>
            <div class="w-1/2 mx-auto mb-2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email address</label>
                <input name="email" value ="<?php echo  isset($active) ?  $active['email'] : '' ?>" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 " placeholder="john.doe@company.com">
            </div>
            <div class="w-1/2 mx-auto mb-2">
                <label for="pass_old" class="block  mb-2 text-sm font-medium text-gray-900 ">Mot de pass actuel</label>
                <input name="pass_old"  type="password" id="pass_old" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
            </div>
            <div class="w-1/2 mx-auto mb-2">
                <label for="pass_nv" class="block mb-2 text-sm font-medium text-gray-900 ">Nouveau mot de pass</label>
                <input name="pass_nv" type="password" id="pass_nv" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
            </div>
            <div class="w-1/2 mx-auto mb-2">
                <label for="pass_nv_conf" class="block mb-2 text-sm font-medium text-gray-900 ">comfermez Nouveau mot de pass</label>
                <input name="pass_nv_conf" type="password" id="pass_nv_conf" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
            </div>
            <button name="update" type="submit" class="block mt-6 text-white w-1/4 mx-auto   bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">sauvgarder</button>
        </form>
    </div>
</div>

    
<?php require_once '../includes/footer.php' ?>
