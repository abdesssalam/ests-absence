$(document).ready(function(){
    // toggle content
    let menu_module=$('#module-module');
    let menu_matiers=$('#module-matier');
    let content=$('#content');
   

    content.load('../content/modules/module.php',()=>{
        modules()
    
    });
    menu_module.click(function(){
        
        content.load('../content/modules/module.php',()=>{
            modules()
            // showTableMatiers(1,1);
        });
       
    })
    menu_matiers.click(function(){
        content.load('../content/modules/matiers.php',()=>{matiers()});
        
    })
    
    // code de la page module
    function modules(){
         //proprities
    let dept=$('#departement');
    let filier=$('#filier');
    let numAnnee=$('#numAnnee');
    
    //work on departement
    $.get(BASE_URL+'modules.php?departement&all',function(deps){
        deps=JSON.parse(deps);
        filier.empty();
        deps.forEach((dep)=>{

            dept.append(`<option  value="${dep.NumDept}">${dep.intituleDep}</option>`);
        })
        
        
    })
    //fill filiers
    let filiersData=[];
    dept.change(function(){
        filier.empty();
        $.get(BASE_URL+'modules.php?filiers='+dept.val(),function(fils){
           
            fils=JSON.parse(fils);
            filiersData=fils;
            const key='codeFil';
            const unique=[...new Map(fils.map(it=>[it[key],it])).values()]
            unique.forEach((fil)=>{
                filier.append(`<option value="${fil.codeFil}">${fil.intituleFil}</option>`);
            })
            if(fils.length>0){
                filier.attr('disabled',false);
                numAnnee.attr('disabled',false);
                
            }
            
        })
    })
    

        let table=$('#content #table tbody')
        
        // showTableMatiers(1,1,table);
        let btn_add=$('#btn_add_module');
        let nomModule=$('#nomModule');
        let coordonnateur=$('#coordonnateur');
        btn_add.click(function(){
            //validation
            if(dept.val()=='' || nomModule.val()=='' ||filier.val()=='' ||numAnnee.val()==''){
                $('#alertD').removeClass('hidden');
               
                setTimeout(()=>{$('#alertD').addClass('hidden')},2000)
            }else{
            let data={'nomModule':nomModule.val(),'filier':filier.val(),'numAnnee':numAnnee.val(),'coordonnateur':coordonnateur.val(),'add_mod':'add'};
           
             $.post(BASE_URL+'modules.php',data,function(res){
                res=JSON.parse(res)
                $('#alertS').removeClass('hidden');
                $('#msg').text(res.message);
                setTimeout(()=>{$('#alertS').addClass('hidden')},1500)
             })
            }
            
        })
       
        filier.click(function(){
            const t=filiersData.filter((it)=>it.codeFil==filier.val());
            numAnnee.empty();
            for(i=1;i<=t.length;i++){
                numAnnee.append(`<option value="${i}">${i}</option>`)
            }
            
        })
        
        numAnnee.click(()=>{
               
                let yr=numAnnee.val() && !isNaN(numAnnee.val()) ? numAnnee.val() : 1;
                if(filier.val()!==''){
                    showTableMatiers(filier.val(), yr)
                }
                
            })

        //load table
        function showTableMatiers(f,y){
       
        table.empty();
        let url=`${BASE_URL}modules.php?by&filier=${f}&annee=${y}`;
        $.get(url,function(fl){
            fl=JSON.parse(fl);
            if(typeof fl.message==='undefined'){
            fl.forEach((fil)=>{
              var content=`
                <tr class="bg-white border-b ">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                        ${fil.nomModule}
                    </th>
                    <td class="py-4 px-6">
                        ${fil.prenom} ${fil.nom}
                    </td>
                    <td class="py-4 px-6">
                        ${fil.intituleFil}
                    </td>
                    <td class="py-4 px-6">
                        ${fil.numAnnee}
                    </td>
                </tr>
            `; 
            
            table.append(content); 
            })
            }
            
            
            
        })
    }
   
    }
    
    function matiers(){
         //proprities
        let dept=$('#departement');
        let filier=$('#filier');
        let numAnnee=$('#numAnnee');
        let table=$('#content #table tbody');
        let drp_module=$('#module'); 
        let btn_add_matier=$('#btn_add_matier');
        let NomMatier=$('#NomMatier');
        //events
        //work on departement
        $.get(BASE_URL+'modules.php?departement&all',function(deps){
            deps=JSON.parse(deps);
            filier.empty();
            deps.forEach((dep)=>{

                dept.append(`<option  value="${dep.NumDept}">${dep.intituleDep}</option>`);
            })
        })
       //fill filiers
        let filiersData=[];
        dept.change(function(){
            filier.empty();
            $.get(BASE_URL+'modules.php?filiers='+dept.val(),function(fils){
            
                fils=JSON.parse(fils);
                filiersData=fils;
                const key='codeFil';
                const unique=[...new Map(fils.map(it=>[it[key],it])).values()]
                unique.forEach((fil)=>{
                    filier.append(`<option value="${fil.codeFil}">${fil.intituleFil}</option>`);
                })
                if(fils.length>0){
                    filier.attr('disabled',false);
                    numAnnee.attr('disabled',false);   
                } })})
          //fill annee
          filier.click(function(){
            const t=filiersData.filter((it)=>it.codeFil==filier.val());
            numAnnee.empty();
            for(i=1;i<=t.length;i++){
                numAnnee.append(`<option value="${i}">${i}</option>`)
            }
            
        })      
         
            //load modules on dropdown
            numAnnee.click(()=>{
                
                drp_module.empty();
                if(isNaN(numAnnee.val())){
                    return
                }
                //load modules in dropdown
                let url=`${BASE_URL}modules.php?by&filier=${filier.val()}&annee=${numAnnee.val()}`;
                $.get(url,function(md){
                    md=JSON.parse(md);
                    if(typeof md.message==='undefined'){
                        md.forEach((mod)=>{
                            drp_module.append(`<option  value="${mod.codeMod}">${mod.nomModule}</option>`);
                        })}else{
                            console.log('pop up no module');
                        }
                            
                })})
            //add new matier
                btn_add_matier.click(function(){
                    if(NomMatier.val()==''){
                        NomMatier.addClass('border-2 border-red-500');
                        return;
                    }
                    
                    if(drp_module.find('option').length==0){
                        drp_module.addClass('border-2 border-red-500');
                        return;
                    }

                    let data={
                        'codeMod':drp_module.val(),
                        'filier':filier.val(),
                        'annee':numAnnee.val(),
                        'nomMatier':NomMatier.val(),
                        'add_mat':'submit'
                    }
                    $.post(BASE_URL+'modules.php',data,function(res){
                        res=JSON.parse(res)
                        
                        $('#alertS').removeClass('hidden');
                        $('#msg').text(res.message);
                        setTimeout(()=>{$('#alertS').addClass('hidden')},1500)
                     })
                })
    }

    //code de la page matier
    
})