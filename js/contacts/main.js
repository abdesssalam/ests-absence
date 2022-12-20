$(document).ready(function(){
    // toggle content
    let menu_contact=$('#contact-contact');
    let menu_roles=$('#contact-role');
    let content=$('#content');
   
    content.load('../content/contacts/contact.php');
    menu_contact.click(function(){
        
        content.load('../content/contacts/contact.php');
       
    })
    menu_roles.click(function(){
        content.load('../content/contacts/role.php');
        
    })
    
    
})