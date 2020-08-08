<?php
include_once '../../includes/autoload.inc.php';

//upload the new users details in the database
if(isset($_POST['updateBtn'])){
    $userId = $_GET['usersId'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $user_status = $_POST['userStatus'];

    $userView = new Usercontr();
    $userView->updateUser($userId,$firstname,$lastname,$username,$user_status);

    header('Location: AdminPanel.php');
}