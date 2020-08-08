<?php 
//unset the $_SESSION['user'];


//handle the log ins
include 'includes/autoload.inc.php';

$email = $_POST['email'];
$password = $_POST['password'];

$logInUser = new Usercontr();
$logInUser->getUser($email,$password);
