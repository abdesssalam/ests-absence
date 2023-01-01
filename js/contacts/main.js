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
        });
        
        function loadRoles(){
            $.get(BASE_URL+"auth.php?all",function(data,st){
                data=JSON.parse(data)
                if(data){
                 data.forEach((auth)=>{
                    var content='<tr class="bg-white border-b"> <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">';
                    content+=auth.label+'</th><td class="py-4 px-6">';
                    content+=auth.action+'</td><td class="py-4 px-6">';
                    content+=auth.table+'</td>';
                    content+='<td id="td-delete-'+auth.CodePermission+'-'+auth.NumRole+'" class="py-4 px-6"> <span  id="edit-'+auth.NumRole+'" class="cursor-pointer text-blue-600 w-full ">supprimer</span></td></tr>';
                    $("#table tbody").append(content);
                 })   
                }
            })
        }
    })
    
    
})