<?php 

$title = 'gestion des absences';
require_once '../includes/header.php';



// $date = '2023-01-03';
$time = date("h:i");
$num_seance;

if($time>=date('h:i',strtotime('08:30am'))){
    if($time>=date('h:i',strtotime('10:30pm'))){
        $num_seance=2;
    }else{
        $num_seance=1;
    }
}

if($time>=date('h:i',strtotime('02:30pm'))){
    if($time>=date('h:i',strtotime('04:30pm'))){
        $num_seance=4;
    }else{
        $num_seance=3;
    }
}
if(isset($_SESSION['ID'])){
    $prof = $_SESSION['ID'];
    $seance = $db->get_seance($prof, $num_seance);
    $etudiants;
    $professeur;
    $filier;
    $matier;
}
 

if(isset($seance)){
    $etudiants = $db->getData('etudiants')
                ->where('filier', $seance['filier'])
                ->where('annee', $seance['annee'])
                ->where('group', $seance['groupe']);
    $professeur = $db->getData('users')->firstWhere('id', $seance['prof']);
    $professeur = collect($professeur)->forget('password');
    $filier = $db->getData('filiers')->firstWhere('codeFil',$seance['filier']);
    $matier = $db->getData('matieres')
        ->where('filier', $seance['filier'])
        ->where('annee', $seance['annee'])
        ->firstWhere('codeMat', $seance['matier']);
        
}
?>

<?php if(isset($seance)): ?>
<div class="w-11/12 mx-auto bg-blue-500 flex flex-wrap justify-start rounded-md shadow-md cursor-pointer " >
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-full md:w-1/2 "><span id="label-professeur"></span><span class="text-gray-100"><?php echo isset($seance) ? $professeur['nom'].' '.$professeur['prenom'] : '' ?></span>  </h3>
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-full md:w-1/2 "><span id="label-filier"></span><span class="text-gray-100"><?php echo isset($seance) ? $filier['intituleFil'] : '' ?></span>  </h3>
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-full md:w-1/4 "><span id="label-annee"></span><span class="text-gray-100"><?php echo isset($seance) ? $seance['annee'] : '' ?></span>  </h3>
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-full md:w-1/4 "><span id="label-groupe"></span><span class="text-gray-100"><?php echo isset($seance) ? $seance['groupe'] : '' ?></span>  </h3>
    <h3 class="text-xl font-semibold uppercase px-2 text-gray-800 w-full md:w-2/4 "><span id="label-matiere"></span><span class="text-gray-100"> <?php echo isset($seance) ? $matier['nomMatier'] : '' ?> </span>  </h3>
</div>

<!-- list des etudiants -->
<div id="alertS" class="hidden p-4 w-1/2 mx-auto text-center my-5 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
  <span class="font-medium"><span id="msg-absenceAdded"></span></span> 
</div>

<div class="overflow-x-auto relative mt-5">
    <table id="table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    <span id="label-numero"></span>
                </th>
                <th scope="col" class="py-3 px-6">
                     <span id="label-lastName"></span>
                </th>
                <th scope="col" class="py-3 px-6">
                     <span id="label-firstName"></span>
                </th>
                <th scope="col" class="py-3 px-6">
                    <span id="label-absences"></span>
                </th>
                
            </tr>
        </thead>
        <tbody>

            <?php
            if(isset($seance)):
             foreach($etudiants as $etd): ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <?php echo $etd['numEtd'] ?>
                </th>
                <td class="py-4 px-6">
                <?php echo $etd['nom'] ?>
                </td>
                <td class="py-4 px-6">
                <?php echo $etd['prenom'] ?>
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center">
                        <input id="<?php echo $etd['numEtd'] ?>" type="checkbox" class="checkbox-abs w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-3" class="sr-only">checkbox</label>
                    </div>
                </td>

            </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
    <input id="btn_add_abs" class="block text-white w-1/4 mx-auto bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="sauvgarder">
</div>
<script>
    $(document).ready(function(){
        let checkbox_abs=$('.checkbox-abs');
        let btn_add_abs=$('#btn_add_abs');
        
        btn_add_abs.click(()=>{
            let NUMBERS=getCheckedAbsence();
            let seance =<?php echo json_encode($seance) ?>;
            // ss=JSON.parse(ss);
            // console.log(seance);
          
            let data={
                'NumSeance':seance.numSeance,
                'jour':seance.jour,
                'semaine':seance.semaine,
                'semester':seance.semester,
                'NumsEtds':NUMBERS,
                'NumFilier':seance.filier,
                'NumAnnee':seance.annee,
                'NumGroupe':seance.groupe,
                'DateAbsence':seance.dateSeance,
                'prof':seance.prof,
                'matier':seance.matier,
                'departement':<?php echo $filier['codeDep']?>,
                'module':<?php echo $matier['codeMod']?>,
                'add_abs':'submit'
            }
          
           $.ajax({
            url:`${BASE_URL}absence.php`,
            type:'post',
            data:data,
            success:function(res){
                res=JSON.parse(res);
                if(res.message=='ok'){
                    let alert=$('#alertS');
                    alert.removeClass('hidden')
                    setTimeout(()=>{
                        alert.addClass('hidden')
                    },2500)
                } 
            }
           })

            
        })

        function getCheckedAbsence(){
            let NUMBERS=[];
            checkbox_abs.each(function(){
                if($(this).is(':checked')){
                    NUMBERS.push($(this).attr('id'))
                }
               
            })
            return NUMBERS;
        }
    })
</script>
<?php else:
    echo '<div class="w-1/2 cursor-pointer text-center mx-auto p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
<span class="font-medium">pas de seance maintenant!! Merci :)</span> 
</div>';

endif; ?>