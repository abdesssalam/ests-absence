<?php
$title = 'gestion des comptes et permessions';
require_once '../includes/header.php' ?>

<div class="w-full  py-1 px-2">
    <ul class="list-none flex flex-col md:flex-row w-full justify-between bg-green-400 ">
        <li id="contact-contact" class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white w-full  md:w-1/2 text-center"><span id="label-accouts"></span></li>
        <li id="contact-role" class="cursor-pointer text-lg text-gray-700 font-semibold py-1 hover:bg-blue-400 hover:text-white border-r border-r-white  w-full md:w-1/2 text-center"><span id="label-rolesANDpermissions"></span></li>

    </ul>
    <span id="welcome">e</span>
    <div id="content">

    </div>
</div>


<!-- <script src="../js/jquery-3.6.0.min.js"></script> -->

<script src="../js/contacts/main.js"></script>

<?php require_once '../includes/footer.php' ?> 