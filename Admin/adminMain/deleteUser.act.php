<?php 
//delete the user depending on its id
//its will also be user for deleting an realtor
include_once '../../includes/autoload.inc.php';

if(isset($_POST['userId'])){
    $usersId = $_POST['userId'];
    $userContr = new Usercontr();

    $userContr->deleteUserByAdmin($usersId);
}