<?php

include_once '../../includes/autoload.inc.php';
$userContr = new Usercontr();

if(isset($_POST['houseId']) && isset($_POST['active'])){
    $houseId = $_POST['houseId'];
    $active = $_POST['active'];//if the house is published or not before the user checked the box

    if($active == 'published'){
        $active = 'draft';
    }else{
        $active = 'published';
    }

    echo $active;

    $userContr->changeHousePublishStatus($active,$houseId);
}

if(isset($_POST['deletehouseId'])){
    //delete propertie the user has selected
    $houseId = $_POST['deletehouseId'];
    $userContr->deletePropertie($houseId);
}