<?php
include '../../includes/autoload.inc.php';
//check if the user has admin status

$username = $_POST['username'];
$password = $_POST['password'];

$checkAccount = new Usercontr();
$checkAccount->checkAdmin($username,$password);

