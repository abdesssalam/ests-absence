<?php 
$title = 'gestion des absences';
require_once '../includes/header.php' ?>

<div class="w-full mt-5">
    <div class="w-11/12 mx-auto  bg-green-300 py-3 px-2 rounded shadow flex flex-wrap justify-start items-center">
        <div class="w-full md:w-2/6  my-2  flex justify-between items-center" >
            <label  class="block w-1/3 text-sm font-medium text-gray-900 dark:text-white">departement</label>
            <select id="departement" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser departement</option>
                <?php foreach($db->getData('departements') as $dep){
                    echo '<option value="'.$dep['NumDept'].'">'.$dep['intituleDep'].'</option>';
                } ?>     
            </select>
        </div>
        
        <div class="w-full md:w-2/6 px-2 my-2   flex justify-between items-center" >
            <label  class="block  w-1/5 text-sm font-medium text-gray-900 dark:text-white">filier</label>
            <select disabled  id="filiers" class="w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser filier</option>
                <option value="GI">GI</option>
                <option value="GIM">GIM</option>
                <option value="TM">TM</option>
                <option value="TIMQ">TIMQ</option>
            </select>
        </div>
        <div class="w-full md:w-2/6 px-2 my-2   flex justify-between items-center" >
            <label  class="block w-1/5 text-sm font-medium text-gray-900 dark:text-white">Année</label>
            <select disabled id="annee" class="w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>choiser l'année</option>
                <option value="1">1er</option>
                <option value="2">2eme</option>
               
            </select>
        </div>
        
        <div class="w-full md:w-2/6 px-2 my-2   flex justify-between items-center" >
            <label  class="block w-1/5 text-sm font-medium text-gray-900 dark:text-white">Matier :</label>
            <select disabled id="modules" class=" w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
            <option selected>choiser la matier</option>
            </select>
        </div>
        
        <div class="w-full md:w-2/6 px-2 my-2   flex justify-between items-center" >
            <label  class="block w-1/5 text-sm font-medium text-gray-900 dark:text-white">Matier :</label>
            <select disabled id="matiers" class=" w-4/5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
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


<!-- 
http://localhost/ests-absence/api/home.php?filiers=1
http://localhost/ests-absence/api/home.php?modules&filier=3&annee=1
http://localhost/ests-absence/api/home.php?matiers&filier=3&annee=1
 -->
<script>
    $(document).ready(function(){
        const departement=$('#departement');
        const filier=$('#filiers');
        const annee=$('#annee');
        const modules=$('#modules');
        const matier=$('#matiers');
       
        const table=$('#table tbody');
        const btn_afficher=$('#btn_afficher');

        let absencesData=[];
        let filiersData=[];
        let matiersData=[];
        let clicked='';
        departement.click(function(){
            if(!isNaN(departement.val())){
                clicked='departement';
                $.get(
                    BASE_URL+'home.php?filiers='+departement.val(),
                    function(res){
                        res=JSON.parse(res);
                        if(res.length>0){
                            filier.attr('disabled',false);
                           
                            filier.empty();
                            filiersData=res;
                            const key='codeFil';
                            const unique=[...new Map(res.map(it=>[it[key],it])).values()]
                            console.log(unique);
                            unique.forEach((fil)=>{
                                filier.append(`<option value="${fil.codeFil}">${fil.intituleFil}</option>`);
                            })
                        }
                       
                    }
                );
                $.get(
                    BASE_URL+'absence.php?departement='+departement.val(),
                    function(res){
                        res=JSON.parse(res);
                        absencesData=res;
                    }
                )
            }
           
        })

        filier.click(function(){
            clicked='filier';
            const t=filiersData.filter((it)=>it.codeFil==filier.val());
            annee.empty();
            annee.attr('disabled',false);
            for(i=1;i<=t.length;i++){
                annee.append(`<option value="${i}">${i}</option>`)
            }
            
        })

        annee.click(function(){
            $.get(
                `${BASE_URL}home.php?modules&filier=${filier.val()}&annee=${annee.val()}`,
                function(mods){
                    mods=JSON.parse(mods);
                    if(mods.length>0){
                       modules.empty();
                       modules.attr('disabled',false);
                        mods.forEach((mod)=>{
                            modules.append(`<option value="${mod.codeMod}">${mod.nomModule}</option>`)
                        }) 
                    }
                    
            })
            $.get(
                `${BASE_URL}home.php?matiers&filier=${filier.val()}&annee=${annee.val()}`,
                function(res){
                    res=JSON.parse(res);
                    matiersData=res;
                }
            )
            clicked='annee'
        })

        modules.click(function(){
            matier.empty();
            matier.attr('disabled',false);
            let mod_matiers=matiersData.filter((it)=>it.codeMod==modules.val());
            mod_matiers.forEach((mat)=>{
                matier.append(`<option value="${mat.codeMat}">${mat.nomMatier}</option>`)
            })
            clicked='modules'
        })

        matier.click(function(){
            clicked='matier';
        })

        btn_afficher.click(function(){
            table.empty();
            let data=[];
            switch(clicked){
                case 'departement':
                    data=absencesData
                    break;
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
                case 'modules':
                    data=absencesData.filter(
                        it=>
                            it.NumFilier==filier.val() && 
                            it.NumAnnee==annee.val() &&
                            it.module==modules.val() 
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
                
            }
        })
        
        
    })
</script>