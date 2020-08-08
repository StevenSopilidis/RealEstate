<?php 
session_start();
include '../../includes/autoload.inc.php';
//if user hasnt loged in as admin navigate him to the Mainpage
if(!isset($_SESSION['adminLoged'])){
    header("Location: ../../Main/main.php");
}

 
//upload the house details only
//the image will be uploaded on another page

if(isset($_POST['price'])){
    //get the details
    
    //the prop id will be a 10 digit random number 
    //the images of the propertie will be uploaded in another page

    $realtor = $_SESSION['adminLoged'];
    $price = $_POST['price']; 
    $bedrooms = $_POST['bedrooms']; 
    $bathrooms = $_POST['bathrooms']; 
    $garages = $_POST['garages']; 
    $square_foot = $_POST['square_foot']; 
    $lot_size = $_POST['lot_size']; 
    $date = $_POST['date']; 
    $state = $_POST['state']; 
    $city = strtolower($_POST['city']); 
    $details = $_POST['details']; 
    $street = $_POST['street']; 
    $prop_id = rand(9000000000,10000000000);

    //add session so we can save the props id so we can add Image
    $_SESSION['prop_id'] = $prop_id;
            
    $userControl = new Usercontr();
    //upload the details exept the image to the db
    $userControl->uploadDetails($realtor,$price,$bedrooms,$bathrooms,$garages,$square_foot,$lot_size,$date,$state,$city,$details,$street,$prop_id);

}