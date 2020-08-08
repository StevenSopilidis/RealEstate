<?php
//set a realtor as mvp in displayAllRealtors.php
include_once '../../includes/autoload.inc.php';

if(isset($_POST['mvp'])){//set the user provided as mvp
    $mvp = $_POST['mvp'];//username of the realtors we want to set as mvp;
    $view = new Usercontr();
    $view->set_new_mvp($mvp); 



}