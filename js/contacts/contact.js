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

    // toggle form user
    $('#toggle-form-user').click(function(){
        $(this).toggleClass('active');
        
        if($(this)[0].classList.contains('active')){
            $(this).removeClass('fa-angle-down');
            $(this).addClass('fa-angle-up');
            $('#form-user').removeClass('hidden');
        }else{
            $(this).addClass('fa-angle-down');
            $(this).removeClass('fa-angle-up');
            $('#form-user').addClass('hidden');
        }
    })

    
})

