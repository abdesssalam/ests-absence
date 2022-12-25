<?php 
$title = 'gestion des modules et filier';
require_once '../includes/header.php'

// role : chef filier

?>
<div class="w-full  py-1 px-2">
    <ul class="list-none flex flex-col md:flex-row w-full justify-between bg-green-400 ">
        <li id="module-module" class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white w-full  md:w-1/2 text-center">les modules</li>
        <li id="module-matier" class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white  w-full md:w-1/2 text-center">les matiers</li>
       
    </ul>
   <div id="content">
   
   </div>
</div>

<script>
    $(document).ready(function(){
    // toggle content
    let menu_module=$('#module-module');
    let menu_matiers=$('#module-matier');
    let content=$('#content');
   
    content.load('../content/modules/module.php');
    menu_module.click(function(){
        
        content.load('../content/modules/module.php');
       
    })
    menu_matiers.click(function(){
        content.load('../content/modules/matiers.php');
        
    })
    
    
})
</script>