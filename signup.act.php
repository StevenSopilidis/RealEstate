<?php
include 'includes/autoload.inc.php';


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$userStatus = "User";//whether the user is admin or not

//first check if username or password is already taken
$taken = new Userview();
$taken = $taken->getDublicates($username,$email);

if($taken == true){
    header("Location: SignUp/signup.php?signUp=UsernameOrEmailAlreadyTaken");
}else{
    $createUser = new Usercontr();
    $createUser->createUser($firstname,$lastname,$username,$password,$email,$userStatus);
    //start a session to save the username
    session_start();
    $_SESSION['user'] = $username;
    header("Location: Login/login.php");
}
