<?php
session_start();

//display the users username when he is loged in
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    
    echo $username;
}