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

    // toggle form user on icon click
    let icon_arrow=$('#toggle-form-user');
    icon_arrow.click(()=>toggleForm());

    //toggle form on click in modifier
    $('.btn_edit').click(()=>toggleForm());

    // btn_edit
    function toggleForm(){
       console.log("clicl")
        if(icon_arrow[0].classList.contains('active')){
           icon_arrow.removeClass('active');
           icon_arrow.removeClass('fa-angle-down');
           icon_arrow.addClass('fa-angle-up');
            $('#form-user').removeClass('hidden');
        }else{
           icon_arrow.addClass('active');
           icon_arrow.addClass('fa-angle-down');
           icon_arrow.removeClass('fa-angle-up');
            $('#form-user').addClass('hidden');
        }
    }
})

