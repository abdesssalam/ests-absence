$(document).ready(function(){
    // toggle content
    let ic_toggle_form_f=$('#toggle-form');



ic_toggle_form_f.click(()=>toggleForm())


function showForm(){
    ic_toggle_form_f.addClass('active');
    $('#form').removeClass('hidden');
    ic_toggle_form_f.removeClass('fa-angle-down');
    ic_toggle_form_f.addClass('fa-angle-up');
    $('table').addClass('hidden');
}

function toggleForm(){
    //hide
    if(ic_toggle_form_f[0].classList.contains('active')){
        $('table').removeClass('hidden');
       
        ic_toggle_form_f.removeClass('active');
        $('#form').addClass('hidden');
        ic_toggle_form_f.addClass('fa-angle-down');
        ic_toggle_form_f.removeClass('fa-angle-up');
    }else{
       showForm();
    }
    
}
    
    
})