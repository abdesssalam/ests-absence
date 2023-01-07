$(document).ready(function(){
    // toggle content
    let menu_contact=$('#contact-contact');
    let menu_roles=$('#contact-role');
    let content=$('#content');
   
    content.load('../content/contacts/contact.php',function(){
        console.log("hello")
    });
    menu_contact.click(function(){
        
        content.load('../content/contacts/contact.php');
       
    })
    menu_roles.click(function(){
        content.load('../content/contacts/role.php',function(){
            loadRoles();
            //add new auth
            let tables=$('.tables');
            $('#btn_add_auth').click(function(){
                let role=$('#role').val();
                let table=$('#table').val();
                let action=$('#action').val();
                let tbls=get_checked_tables()
                let data={'role':role,'tables':tbls,'action':action,'add':'submit'};
                $.post(BASE_URL+'auth.php',data,function(data,st){
                    console.log(st);
                    
                    data=JSON.parse(data);
                    console.log(data);

                    if(data.message=='ok'){
                        $('#alertS').removeClass('hidden');
                            setTimeout(()=>{
                                $('alertS').addClass('hidden');
                                 $('#model').removeClass('flex');
                            $('#model').addClass('hidden');
                            },3000)
                           
                    }
                })

            })
            function get_checked_tables(){
                let tables_names=[];
                tables.each(function(){
                   
                    if($(this).is(':checked')){
                        tables_names.push($(this).val())
                    }
                })
                return tables_names;
            }

        });
        
        function loadRoles(){
            $.get(BASE_URL+"auth.php?all",function(data,st){
                
                data=JSON.parse(data)
                console.log(data);
                data.forEach((auth)=>showAuth(auth))
                
            })
        }
        
        //function to fil table
        const showAuth =(auth)=>{
           
            // auth=auth[0];
           // console.log(auth);
            var content='<tr class="bg-white border-b"> <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">';
            content+=auth.label+'</th><td class="py-4 px-6">';
            content+=auth.action+'</td><td class="py-4 px-6">';
            content+=auth.table+'</td>';
            content+='<td id="td-delete-'+auth.CodePermission+'-'+auth.NumRole+'" class="py-4 px-6"> <span  id="delete-'+auth.CodePermission+'-'+auth.NumRole+'" class="cursor-pointer text-blue-600 w-full ">supprimer</span></td></tr>';
            $("#table tbody").append(content);
            content=$.parseHTML(content);
            //delete-'+auth.NumRole+'-'+auth.NumRole
             $('#content #table tbody').find(`#delete-${auth.CodePermission}-${auth.NumRole}`).click(function(){
                $.get(`${BASE_URL}auth.php?delete&CodePermission=${auth.CodePermission}&NumRole=${auth.NumRole}`,function(d){
                    d=JSON.parse(d)
                    if(d.message=='ok'){
                        loadRoles();
                    }
                })
             })
         }
    })
    
    
})