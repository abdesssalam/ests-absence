<?php 
$title = 'gestion des etudiants';
require_once '../includes/header.php';

if(isset($_POST['submit'])){
    if (isset($_FILES['etudiants']) && is_uploaded_file($_FILES['etudiants']['tmp_name'])) {
    // Open the file
    $file = fopen($_FILES['etudiants']['tmp_name'], 'r');
    
    // Loop through each line of the file
        $i = 0;
        $kys = [];
        $sucss = true;
        while (($line = fgetcsv($file)) !== FALSE) {
            if($i>0){
                $data = [];
                for ($x = 0; $x < count($line);$x++){
                    $data[$kys[$x]] = $line[$x];
                    
                }
                $data = array_merge($data, $_POST);
                $sucss = $db->add_etudiant($data);
                var_dump($sucss);
            }else{
                $kys = $line;
                
            } 
            $i++;
        }
        
    
    // Close the file
    fclose($file);

}
} 

?>

<!-- TODO: dynamic departements and filiers for menu -->
<div class="w-full  py-1 px-2">
    <ul id="department" class="list-none flex flex-col md:flex-row w-full justify-between  ">    
       <?php foreach($db->getData('departements') as $dep): ?>
        <li id="<?php echo $dep['NumDept']?>"  class="dep bg-green-400  cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white w-full md:mx-1 md:my-0 my-1  md:w-1/2 text-center" "><?php echo $dep['intituleDep']?> </li>
        <?php endforeach;?>
    </ul>
    <!-- display after GET Method -->
   <form  action="" method="post" enctype="multipart/form-data">
    <div id="box" class="hidden w-full mt-5 mx-auto  bg-green-300 py-3 px-2 rounded shadow   flex-wrap justify-between items-center">
        <div class="md:w-1/2 w-full px-1 my-1 flex justify-between items-center " >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 dark:text-white">filiers</label>
            <select disabled name="filier" id="filier"  class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </select>
        </div>
        <div class="md:w-1/2 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block md:w-1/3 w-full text-sm font-medium text-gray-900 dark:text-white">Année</label>
            <select disabled  name="annee" id="annee" class="md:w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                
               
            </select>
        </div>
        <div class="md:w-1/2 w-full px-1 my-1  flex justify-between items-center" >
            <label  class="block  md:w-1/3 w-full  text-sm font-medium text-gray-900 ">la list des etudiants </label>
            <input id="etudiants" name="etudiants" accept=".csv" class=" p-2.5 md:p-2 rounded-md md:w-2/3 w-full " type="file" >
        </div>

        <div class="md:w-1/3 w-full px-1 my-1  flex justify-end items-center" >
            
            <input name="submit" class="cursor-pointer text-white font-semibold   rounded-md justify-self-end  md:w-2/3 w-full p-2.5 bg-green-600 hover:bg-green-500 hover:text-gray-50" type="submit" value="ajouter" >
        </div>
        
    </div>
    </form>
    <!-- table -->
    
</div>

<script src="../js/etudiants.js"></script>