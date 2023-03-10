<?php 
$title = 'gestion des absences';
require_once '../includes/header.php';


// case chef dep
$prof;
if(in_array(5,$_SESSION['roles'])){
    $prof = $db->getData('professeurs')->firstWhere('id',$_SESSION['ID']);
}

$modules;
$filiersALL;
$filiers;
$matiers;

//chef filier
$chefFilier;

if(isset($prof) && min($_SESSION['roles'])>=4 ){

    // prof
    $seances = $db->getData('seances')
        ->where('prof', $_SESSION['ID']);
    $dataProf = $seances->map(function ($item) {
        return [
            'filier'=>$item['filier'],
            'annee'=>$item['annee'],
            'matier'=>$item['matier'],
            'group'=>$item['groupe'] 
        ];
    })->unique();

    //get filiers and matiers
    $filiersProf = $dataProf->map(function ($item) use ($db) {
        //get initiule filier
        $dd = $db->getData('filiers')
            ->firstWhere('codeFil', $item['filier']);
        $item['intituleFil'] = $dd['intituleFil'];
        return $item;

    });
    //get matiers
    $matiersProf = $dataProf->map(function ($item) use ($db) {
        //get initiule filier
        $dd=$db->getData('matieres')
        ->where('filier', $item['filier'])
        ->where('annee', $item['annee'])
        ->firstWhere('codeMat', $item['matier']);
        $dd['group'] = $item['group'];
        return $dd;
    });
    
    //end prof

    //chef filier

    
    if (in_array(4, $_SESSION['roles'])) {
        $chefFilier = $db->getData('filiers')->where('responsable', $_SESSION['ID']);
        //append groupes
        $x=0;
        $filiers_chef;
        $chefFilier = array_values($chefFilier->toArray());
        // var_dump($chefFilier);
        if(count($chefFilier)>0){
             for ($i = 0; $i < count($chefFilier);$i++){
            $item = $chefFilier[$i];
            $groups = $db->getData('groups')
            ->where('filier',$item['codeFil'])
            ->where('annee',$item['numAnnee']);
            $groups=array_values($groups->toArray());
            for ($j = 0; $j < count($groups);$j++){
                $it = $groups[$j];
                $dd['filier'] = $item['codeFil'];
                $dd['intituleFil'] = $item['intituleFil'];
                $dd['annee'] = $item['numAnnee'];
                $dd['group'] = $it['codeGrp'];
                $filiers_chef[$x] = $dd;
                $x++;
                } 
                if(isset($filiers_chef)){
                    $matiersChef;
                $x = 0;
                for ($i = 0; $i < count($filiers_chef);$i++){
                    $item = $filiers_chef[$i];
                    $matiers = $db->getData('matieres')
                        ->where('filier', $item['filier'])
                        ->where('annee', $item['annee']);
                    $matiers = array_values($matiers->toArray());
                    for ($j = 0; $j < count($matiers);$j++){
                        $it=$matiers[$j];
                        $it['group'] = $item['group'];
                        $matiersChef[$x] = $it;
                        $x++;
                    }
                    }
                    
            //clean matiers
                    unset($matiersChef['codeMod']);
                   
                $filiersProf = array_filter($filiersProf->toArray(), function ($item) use ($filiers_chef) {
                    $fils = collect($filiers_chef)
                        ->where('filier', $item['filier'])
                        ->where('annee', $item['annee']);
                    if(count($fils)==0){
                        return $item;
                    }
                });
                $matiersProf = array_filter($matiersProf->toArray(), function ($item) use ($matiersChef) {
                    $mats = collect($matiersChef)
                        ->where('filier', $item['filier'])
                        ->where('annee', $item['annee'])
                        ->where('codeMat', $item['codeMat']);
                    if(count($mats)==0){
                        return $item;
                    }
                });
               
            } 

        }
        // var_dump($filiers_chef);
        //append matier
        

        //cleaning filiers
        
       
        //cleaning matiers
        
        }
       
    }
    if(isset($filiers_chef)){
        
       $filiersALL = array_merge($filiers_chef, $filiersProf);
        $matiersAll = array_merge($matiersProf, $matiersChef); 
        
    }else{
  
        $filiersALL = array_values($filiersProf->toArray());
        $matiersAll = array_values($matiersProf->toArray());
    }
    
    
    $filiers = collect($filiersALL)->unique(['filier']);
   
    $matiers = collect($matiersAll)->unique(['codeMat']);
 
}
?>

<div class="w-full mt-5">
    <div class="w-11/12 mx-auto  bg-green-300 py-3 px-2 rounded shadow flex flex-wrap justify-start items-center">
        <div class="w-full md:w-2/6  my-2  flex justify-between items-center" >
            <label  class="block w-1/3 text-sm font-medium text-gray-900 dark:text-white">departement</label>
            <select <?php echo  min($_SESSION['roles'])>2 ? 'disabled' : '';?> id="departement" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser departement</option>
                <?php foreach ($db->getData('departements') as $dep):
                    if (isset($prof)):?>
                         <option <?php echo $prof['etat']==1 &&  $prof['departement']==$dep['NumDept'] ? 'selected':'' ?> value="<?php echo $dep['NumDept']?>"><?php echo $dep['intituleDep']?></option>
                   <?php else:?>
                    <option value="<?php echo $dep['NumDept']?>"><?php echo $dep['intituleDep']?></option>';
                <?php endif; endforeach; ?>     
            </select>
        </div>
        
        <div class="w-full md:w-2/6 px-2 my-2   flex justify-between items-center" >
            <label  class="block  w-1/5 text-sm font-medium text-gray-900 dark:text-white">filier</label>
            <select <?php echo   max($_SESSION['roles'])<5 ? 'disabled' : '';?>  id="filiers" class="w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser filier</option>
                <?php if(isset($filiers)){
                    // if(min($_SESSION['roles']==3)){

                    // }
                    foreach($filiers as $fil){
                        echo '<option value="'.$fil['filier'].'">'.$fil['intituleFil'].'</option>';
                    }
                } 
                 ?>
            </select>
        </div>
        <div class="w-full md:w-2/6 px-2 my-2   flex justify-between items-center" >
            <label  class="block w-1/5 text-sm font-medium text-gray-900 dark:text-white">Ann??e</label>
            <select <?php echo   max($_SESSION['roles'])<5 ? 'disabled' : '';?> id="annee" class="w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser l'ann??e</option>
                <option value="1">1er</option>
                <option value="2">2eme</option>
               
            </select>
        </div>
        
        <div class="w-full md:w-2/6 px-2 my-2   flex justify-between items-center" >
            <label  class="block w-1/5 text-sm font-medium text-gray-900 dark:text-white">groupes :</label>
            <select <?php echo  max($_SESSION['roles'])<5 ? 'disabled' : '';?> id="groupes" class=" w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
            <option selected>choiser le groupe</option>
            </select>
        </div>
        
        <div class="w-full md:w-2/6 px-2 my-2   flex justify-between items-center" >
            <label  class="block w-1/5 text-sm font-medium text-gray-900 dark:text-white">Matier :</label>
            <select  <?php echo  max($_SESSION['roles'])<5 ? 'disabled' : '';?> id="matiers" class=" w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
            <option selected>choiser la matier</option>
            </select>
        </div>
    </div>
    <button id="btn_afficher" type="button" class="block w-1/4 mx-auto my-3 focus:outline-none text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg uppercase px-5 py-2.5  dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">afficher</button>

</div>
<div class="w-10/12 mx-auto my-5">
<table id="table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                 <th  scope="col" class="px-6 py-3">
                        Nom et prenom
            	</th>
		        <th  scope="col" class="px-6 py-3">
                        Matier
            	</th>
		        <th  scope="col" class="px-6 py-3">
                        Date
            	</th>
            </tr>
            
        </thead>
        <tbody>
                  
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        console.log('rea')
        const departement=$('#departement');
        const filier=$('#filiers');
        const annee=$('#annee');
        const groupes=$('#groupes');
        const matier=$('#matiers');
       
        const table=$('#table tbody');
        const btn_afficher=$('#btn_afficher');

        let absencesData=[];
       
        let filierServer= '';
        <?php if(isset($filiersALL)): ?>
          filierServer= <?php echo  collect($filiersALL)->toJson()  ?>;
         
        <?php endif;?>
      
        let filiersData=filierServer!='' ? Object.values(filierServer):[];
       
        <?php if( isset($matiers)): ?>
            let matierServer='';
            matierServer=<?php echo  json_encode($matiersAll) ?>;
            
        let yy='';
        yy= <?php echo json_encode($matiers); ?>;
        let MatiersSrvFiltred=Object.values(yy);
          let matiersData=matierServer!='' ? Object.values(matierServer):[];
        <?php endif;?>
      
        let clicked='';

        function loadFiliers(){
            $.get(
                    BASE_URL+'home.php?filiers='+departement.val(),
                    function(res){
                        res=JSON.parse(res);
                        if(res.length>0){
                            filier.attr('disabled',false);
                           
                            filier.empty();
                            filiersData=res;
                            const key='filier';
                            const unique=[...new Map(res.map(it=>[it[key],it])).values()]
                            unique.forEach((fil)=>{
                                filier.append(`<option value="${fil.filier}">${fil.intituleFil}</option>`);
                            })
                        }
                       
                    }
                );
               
        }

       

        
        departement.click(function(){
            if(!isNaN(departement.val())){
                clicked='departement';
                loadFiliers()
            }
           
        })
       
        if(departement.attr('disabled')){
         
            <?php if(min($_SESSION['roles'])<5):?>
               loadFiliers();
            <?php endif;?>
            
        }

        filier.click(function(){
            clicked='filier';
            
            const filiersAnnee=filiersData.filter((it)=>it.filier==filier.val());
           
            const key='annee';
            const unique=[...new Map(filiersAnnee.map(it=>[it[key],it])).values()]
          
            annee.empty();
            annee.attr('disabled',false);
            unique.forEach((fa)=>{
                annee.append(`<option value="${fa.annee}">${fa.annee}</option>`)
            })
           
            
        })

        annee.click(function(){
            groupes.empty();
            groupes.attr('disabled',false);
            let groupesData=filiersData.filter((it)=>{
                if(it.filier==filier.val()&&it.annee==annee.val()){
                    return it;
                }
            })
           
            const key='group';
            const grps=[...new Map(groupesData.map(it=>[it[key],it])).values()]
            
            grps.forEach((grp)=>{
                groupes.append(`<option value="${grp.group}">${grp.group}</option>`)
            })
            matier.empty();
            matier.attr('disabled',false);
            /**
             * matiers depend on who is concted
             * if not prof we have to load it from API
             * if prof it's loaded here
             */
            
            <?php if( min($_SESSION['roles'])<4): ?>
                $.get(
                    `${BASE_URL}home.php?matiers&filier=${filier.val()}&annee=${annee.val()}`,
                    function(res){
                        res=JSON.parse(res);
                        res.forEach((mat)=>{
                            matier.append(`<option value="${mat.codeMat}">${mat.nomMatier}</option>`)
                        })
                    }
                  
                    ) 
           
            <?php  else: ?>
               
                // console.log(xx);
                let mtt=MatiersSrvFiltred.filter(it=>it.filier==filier.val() && annee.val() );
                // const key2='group';
                // const mty=[...new Map(mtt.map(it=>[it[key2],it])).values()]
                // console.log(mty);
                // let mttt=matiersData.filter((it)=>it.filier==filier.val() && it.annee==annee.val())
                mtt.forEach((mat)=>{
                         matier.append(`<option value="${mat.codeMat}">${mat.nomMatier}</option>`)
                })
            <?php endif; ?>
            
           
            clicked='annee'
        })

        groupes.click(function(){
            <?php if( min($_SESSION['roles'])>=4): ?>
                matier.empty()
            const matierFiltred=matiersData.filter((it)=>{
                if(
                    it.filier==filier.val() &&
                    it.annee==annee.val() &&
                    it.group==groupes.val() 
                    
                    ){
                        return it;
                    }
            })
            matierFiltred.forEach((mat)=>{
                         matier.append(`<option value="${mat.codeMat}">${mat.nomMatier}</option>`)
                })
            <?php endif; ?>    
            clicked='groupes'
        })

        matier.click(function(){
            clicked='matier';
        })

        btn_afficher.click(function(){
            table.empty();
            let data=[];
            let url;
            <?php  if( min($_SESSION['roles'])>=4): ?>
                let x='';
                x=<?php echo $_SESSION['ID'] ?>;
                url='absence.php?prof='+x;

            <?php else: ?>
                url='absence.php?departement='+departement.val();
            <?php endif; ?>
            $.get(BASE_URL+url,function(dt){
                absencesData=JSON.parse(dt);
                switch(clicked){
               
               case 'filier':
                   data=absencesData.filter(it=>it.NumFilier==filier.val())
                   break;
               case 'annee':
                   data=absencesData.filter(
                       it=>
                           it.NumFilier==filier.val() && 
                           it.NumAnnee==annee.val()
                       )
                   break;
               case 'groupes':
                   data=absencesData.filter(
                       it=>
                           it.NumFilier==filier.val() && 
                           it.NumAnnee==annee.val() &&
                           it.NumGroupe==groupes.val() 
                       )
                   break;
               case 'matier':
                   data=absencesData.filter(
                       it=>
                           it.NumFilier==filier.val() && 
                           it.NumAnnee==annee.val() &&
                           it.matier==matier.val() 
                       )
                   break;
               default:
                   data=absencesData
                   break;   
           }
          
           if(data.length>0){
           
              data.forEach(abs=>{
               let content=`
               <tr class="border-b  odd:bg-white even:bg-gray-200 ">
                   <td class="px-6 py-4">${abs.nomEtd} ${abs.prenomEtd} </td>
                   <td class="px-6 py-4">${abs.nomMatier} </td>
                   <td class="px-6 py-4">${abs.DateAbsence}  </td>
               `;
               table.append(content);
               
              })
               
           }else{
              
               let content=` <tr class="border-b  odd:bg-white even:bg-gray-200">
                   <td class="text-center text-lg py-4 font-bold" colspan="3"> no absence </td>
               </tr> 
               `
               table.append(content);
           }
            })
           
        })
        
        
    })


 
</script>