$(document).ready(function(){
    //difine proprties
    let filier=$('#filier');
    let annee=$('#annee');
    let semester=$('#semester');
    let matier=$('#matier');
    let group=$('#group');
    let professeur=$('#professeur');
    let debut=$('#debut');
    let fin=$('#fin');
    let jour=$('#jour');
    let seance=$('#seance');
    let departments=$('.dep');
    
    let filiersData=[];
    let groupsData=[];
    //load filiers et groups
    departments.each(function(){
        $(this).click(function(){
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
            professeur.empty();
            $.get(BASE_URL+'emploi.php?profs='+$(this).attr('id'),function(profs){
                profs=JSON.parse(profs);
                profs.forEach((prof)=>{
                    professeur.append(`<option value="${prof.id}">${prof.nom} ${prof.prenom}</option>`)
                })
                
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
        $.get(BASE_URL+'emploi.php?groups='+filier.val(),function(grs){
            grs=JSON.parse(grs);
            groupsData=grs;
        })
    })
    annee.click(function(){
        let grps=groupsData.filter((it)=>it.annee==annee.val())
        if(grps.length>0){
            group.attr('disabled',false); 
          
            matier.attr('disabled',false);
        }else{
            group.attr('disabled',true); 
           
            matier.attr('disabled',true);
        }
        group.empty();
        for(i=1;i<=grps.length;i++){
            group.append(`<option value="${i}">${i}</option>`)
        }
        console.log(annee.val())
        //load matiers
        $.get(`${BASE_URL}modules.php?matiers&filier=${filier.val()}&annee=${annee.val()}`,function(mats){
            mats=JSON.parse(mats);
            matier.empty();
            mats.forEach((mat)=>{
                matier.append(`<option value="${mat.codeMat}">${mat.nomMatier}</option>`)
            })
        })
    });

    
    //add
    $('#add_seance').click(function(){
       
        let data={
            'add':'submit',
            'numSeance':seance.val(),
            'jour':jour.val(),
            'debut':debut.val(),
            'fin':fin.val(),
            'semester':semester.val(),
            'filier':filier.val(),
            'annee':annee.val(),
            'groupe':group.val(),
            'prof':professeur.val()
        }
        $.post(BASE_URL+'emploi.php',data,function(res){
            res=JSON.parse(res);
            console.log(res);
        })
        console.log(data);
    })
})