$(document).ready(function(){

    //define elements
    let nom=$('#user_nom');
    let prenom=$('#user_prenom');
    let email=$('#user_email');
    let id=$('#user_id');
    let role=$('input[name="roles"]');
   
    // console.log(role.val())
    // let role=$('#user_role');

    //load users
    loadUsers()
    //add  new user
    $('#btn_action_user').click(function(e){
        e.preventDefault();
        let roles= [];
        role.each(function(){
            if($(this).is(":checked")){
                roles.push($(this).val());
            }
           
        });
       
        let data={'id':id.val(),'nom':nom.val(),'prenom':prenom.val(),'email':email.val(),'roles':roles,'submit':$(this).attr('name')};
        
        $.post(BASE_URL+'users.php',data,function(data,st){
            console.log("sttt"+st);
            console.log(data);
        })
    })

    // toggle form
    let ic_toggle_form=$('#toggle-form');
    ic_toggle_form.click(()=>toggleForm())
    
    //define all functions
    function showForm(){
        ic_toggle_form.addClass('active');
        $('#form').removeClass('hidden');
        ic_toggle_form.removeClass('fa-angle-down');
        ic_toggle_form.addClass('fa-angle-up');
        // $('#table').addClass('hidden');
    }

    function toggleForm(){
        //hide
        if(ic_toggle_form[0].classList.contains('active')){
            $('#table').removeClass('hidden');
           
            ic_toggle_form.removeClass('active');
            $('#form').addClass('hidden');
            ic_toggle_form.addClass('fa-angle-down');
            ic_toggle_form.removeClass('fa-angle-up');
        }else{
           showForm();
        }
        
    }

    function loadUsers(){
        $.get(BASE_URL+"users.php?all",function(data,st){
            data=JSON.parse(data)
            if(data){
                data.forEach(function(user){
                    var roles="";
                    user.roles.forEach((r)=>{
                        roles+= `<li class="my-1 md:my-0">${r.label}</li>`;       
                    });
                    roles+="";

                    var content='<tr class="bg-white border-b"> <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">';
                     content+=user.nom+' '+user.prenom+'</th><td class="py-4 px-6">';
                     content+=user.email+'</td><td class="py-4 px-6">';
                     content+=roles+'</td>';
                      content+='<td id="td-edit-'+user.id+'" class="py-4 px-6"> <span  id="edit-'+user.id+'" class="cursor-pointer text-blue-600 w-full btn_edit" href="?edit='+user.id+'">modfier</span></td></tr>';
                     $("#table tbody").append(content)

                    content=$.parseHTML(content);
                     $('#content #table tbody').find(`#edit-${user.id}`).click(function(){
                        $('#btn_action_user').attr('name','edit');
                        $('#btn_action_user').val('modifier');
                        nom.val(user.nom);
                        prenom.val(user.prenom);
                        email.val(user.email);
                        id.val(user.id);
                        user.roles.forEach((r)=>{
                            $(`input[name="roles"][value="${r.NumRole}"]`).prop('checked',true);
                        })
                        
                        showForm();
                     })
                    //console.log($('#content #table tbody').find(`#edit-${user.id}`))

                     
                })
                
            }
           
        })
    }

    

    
})

