<?php 
//display all listed properties 

include '../includes/autoload.inc.php';
$getAllHouses = new Userview();
$getAllHouses->viewProperties();


//when user clicks the btn get the unique id of each listing and with that display all the items details