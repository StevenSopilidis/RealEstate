<?php 

//just save the houseId and the properties adress which was provided by the featuredList.js
session_start();

    $_SESSION['houseId'] = $_POST['houseId'];
    if(isset($_POST['address'])){
        $_SESSION['address'] = $_POST['address'];
    }
