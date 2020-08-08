<?php 
//logout the user by endind the session username

session_start();
unset($_SESSION['username']);

