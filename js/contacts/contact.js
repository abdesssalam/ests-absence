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

    // toggle form
    let ic_toggle_form=$('#toggle-form-user');
    ic_toggle_form.click(()=>toggleForm())

    function toggleForm(){
        //hide
        if(ic_toggle_form[0].classList.contains('active')){
            $('#table').removeClass('hidden');
            // if($('#table')[0].classList.contains('hidden')){
            //     $('#table').removeClass('hidden');
            // } 
            ic_toggle_form.removeClass('active');
            $('#form-user').addClass('hidden');
            ic_toggle_form.addClass('fa-angle-down');
            ic_toggle_form.removeClass('fa-angle-up');
        }else{
            ic_toggle_form.addClass('active');
            $('#form-user').removeClass('hidden');
            ic_toggle_form.removeClass('fa-angle-down');
            ic_toggle_form.addClass('fa-angle-up');
            $('#table').addClass('hidden');
        }
        
    }

    
})

