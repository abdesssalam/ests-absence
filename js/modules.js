$(document).ready(function(){
    // toggle content
    let menu_module=$('#module-module');
    let menu_matiers=$('#module-matier');
    let content=$('#content');
    //proprities
    let dept=$('#departement');
    let filier=$('#filier');
    let numAnnee=$('#numAnnee');
    
    //work on departement
    $.get(BASE_URL+'modules.php?departement&all',function(deps){
        deps=JSON.parse(deps);
        filier.empty();
        deps.forEach((dep,i)=>{
            // var s=i==0 ? 'selected' : '';
            dept.append(`<option  value="${dep.NumDept}">${dep.intituleDep}</option>`);
        })
    })
    //fill filiers
    dept.change(function(){
        filier.empty();
        $.get(BASE_URL+'modules.php?filiers='+dept.val(),function(fils){
           
            fils=JSON.parse(fils);
            fils.forEach((fil)=>{
                filier.append(`<option value="${fil.codeFil}">${fil.intituleFil}</option>`);
            })
            
        })
        
       
    })

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
            let data={'nomModule':nomModule.val(),'filier':filier.val(),'numAnnee':numAnnee.val(),'coordonnateur':coordonnateur.val(),'add':'add'};
            
             $.post(BASE_URL+'modules.php',data,function(res){
                res=JSON.parse(res)
                $('#alertS').removeClass('hidden');
                $('#msg').text(res.message);
                setTimeout(()=>{$('#alertS').addClass('hidden')},1500)
             })
            }
            
        })
        
        numAnnee.change(()=>{
                
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
            console.log(fl)
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
        
    }

    //code de la page matier
    
})