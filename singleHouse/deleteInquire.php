<?php
//let user delete inquire if wants to
session_start();
include '../includes/autoload.inc.php';

if(isset($_SESSION['houseId'])){
    $houseId = $_SESSION['houseId'];
    $username = $_SESSION['username'];
    //delete property from users inquires
    $userContr = new Usercontr();
    $userContr->deleteUsersInquire($houseId,$username);
    header("Location: ../DashBoard/dashboard.php");
}