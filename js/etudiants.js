$(document).ready(function(){
    //difine proprties
    let filier=$('#filier');
    let annee=$('#annee');
    let semester=$('#semester');
    let module=$('#module');
    let matier=$('#matier');
    let group=$('#group');
    let professeur=$('#professeur');
    let debut=$('#debut');
    let fin=$('#fin');
    let jour=$('#jour');
    let seance=$('#seance');
    let departments=$('.dep');
    
    let box=document.querySelector('#box');

    let filiersData=[];
    //load filiers
    departments.each(function(){
        $(this).click(function(){
            if(box.classList.contains('hidden')){
                box.classList.remove('hidden');
                box.classList.add('flex');
           }
            departments.removeClass('bg-blue-400');
            departments.addClass('bg-green-400');
            $(this).removeClass('bg-green-400');
            $(this).addClass('bg-blue-400');
            filier.empty();
            $.get(BASE_URL+'modules.php?filiers='+$(this).attr('id'),function(fils){
                fils=JSON.parse(fils);
                filiersData=fils;
                const key='codeFil';
                const unique=[...new Map(fils.map(it=>[it[key],it])).values()]
                unique.forEach((fil)=>{
                    filier.append(`<option value="${fil.codeFil}">${fil.intituleFil}</option>`);
                })
                if(fils.length>0){
                    filier.attr('disabled',false);
                    annee.attr('disabled',false);
                    
                }
                
            })
        })
    })
    //events
    filier.click(function(){
        const t=filiersData.filter((it)=>it.codeFil==filier.val());
        annee.empty();
        for(i=1;i<=t.length;i++){
            annee.append(`<option value="${i}">${i}</option>`)
        }
        
    })
    //add

})