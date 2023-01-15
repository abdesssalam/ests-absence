<?php 
$title = 'gestion des professeurs';
if(!isset($_GET['dep'])){
     
    header('Location:index.php');
}
require_once '../includes/header.php';


$data = $db->getData('professeurs')->where('departement', 0);
$data2 = $db->getData('professeurs')->where('departement', $_GET['dep']);

$data = $data->where('etat', 1);
$data = $data->merge($data2);
$users = $db->getData('users');
$data = $data->map(function ($prof) use ($users) {
    $user = $users->firstWhere('id', $prof['id']);
    $prof = $user->merge($prof);
    return $prof;
});


?>



<!-- list des professeur -->


<div class="overflow-x-auto relative mt-5">
    <table id="table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    <span id="label-id"></span>
                </th>
                <th scope="col" class="py-3 px-6">
                    <span id="label-lastName"></span>
                </th>
                <th scope="col" class="py-3 px-6">
                    <span id="label-firstName"></span>
                </th>
                <th scope="col" class="py-3 px-6">

                </th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $prof): ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   <?php echo $prof['id'] ?>
                </th>
                <td class="py-4 px-6">
                <?php echo $prof['nom'] ?>
                </td>
                <td class="py-4 px-6">
                <?php echo $prof['prenom'] ?>
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center">
                        <input id="<?php echo $prof['id'] ?>" <?php echo $prof['departement']==$_GET['dep'] ? 'checked disabled' : '' ?> type="checkbox" class="checkbox-prof w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-3"  class="sr-only">checkbox</label>
                    </div>
                </td>

            </tr>
            <?php endforeach; ?>
           
           
        </tbody>
    </table>
    <input id="btn_save" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="sauvgarder">
</div>
<script>
    $(document).ready(function(){
       
        let checkbox_profs=$('input[type="checkbox"]');
        let btn_save=$('#btn_save');
        let dp='<?php echo $_GET['dep'] ?>'
        btn_save.click(function(){
           let profs = getChecked();
            let data={'submit':'link_prof_dep','departement' : dp,'profs':profs};
            $.post(BASE_URL+'users.php',data,function(res){
                console.log(res);
            })
            
        })
       
        function getChecked(){
            let IDS=[];
            checkbox_profs.each(function(){
                if($(this).is(':checked') && !$(this).is(':disabled')){
                    IDS.push($(this).attr('id'))
                    
                }
              
            }) 
            return IDS;
        }
        
    })


</script>