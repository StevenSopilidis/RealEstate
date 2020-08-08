<?php 

include '../../includes/autoload.inc.php';


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$userStatus = "Admin";//whether the user is admin or not


$taken = new Userview();
$taken = $taken->getDublicates($username,$email);

if($taken == true){
    header("Location: createdAdmin.php?signUp=UsernameOrEmailAlreadyTaken");
}else{
    $createUser = new Usercontr();
    $createUser->createUser($firstname,$lastname,$username,$password,$email,$userStatus);
    //start a session to save the username
    header("Location: adminPanel.php");
}
