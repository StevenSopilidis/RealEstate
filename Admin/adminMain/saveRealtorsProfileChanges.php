<?php 
session_start();
$username = $_SESSION['adminLoged'];
include_once '../../includes/autoload.inc.php';

//if user hasnt loged in as admin navigate him to the Mainpage
if(!isset($_SESSION['adminLoged'])){
    header("Location: ../../Main/main.php");
}

if(isset($_POST['saveBtn'])){
    //get the details of the user he wants to change
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $image_name = $_FILES['imageProfile']['name'];
    $image_temp = $_FILES['imageProfile']['tmp_name'];   

    //save image 
    move_uploaded_file($image_temp, "../../img/$image_name");


    $userContr = new Usercontr();
    $userContr->change_realtor_profile($firstname,$lastname, $image_name, $username, $email);

}