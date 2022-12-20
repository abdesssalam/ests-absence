$(document).ready(function(){

    //add  new user
    $('#btn_add_user').click(function(){
       console.log("hello")
        let nom=$('#user_nom').val();
        let prenom=$('#user_prenom').val();
        let email=$('#user_email').val();
       
        let role=$('#user_role').val();
        let data={'nom':nom,'prenom':prenom,'email':email,'role':role,'type':'ajax'};
        
        $.post('../ajax/add_user.php',data,function(data,st){
            console.log("sttt"+st);
            console.log(data);
        })
    })

    

    
})