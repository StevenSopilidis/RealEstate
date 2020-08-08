<?php 

session_start();
include_once '../includes/autoload.inc.php';


//check if email and full name much the user who inquired\
if(isset($_POST['username']) &&  isset($_POST['email']) && isset($_POST['phonenumber']) && isset($_POST['messange']) && isset($_SESSION['houseId'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $messange = $_POST['messange'];
    $propertyId = $_SESSION['houseId'];//the id of the property the user selected
    $address = $_SESSION['address'];

    //get the address of the house
    
    //firsts if user existss
    $userContr = new Usercontr();
    $userFound = $userContr->userExists($username,$email);

    //if user wasnt found
    if(!$userFound){
        header("Location: inquire.php?inquire=userNotFound");
        exit();
    }else{
        
        //check if user has already made an inquire for the same house
        $inqAlreadyMade = $userContr->inquireAlreadyMadeByUser($propertyId,$email,$username);
        
        if($inqAlreadyMade){//if its true the user already has made an inquire for the house
            header("Location: ../DashBoard/dashboard.php?inquire=AlreadyMadeAnInquire");//it has already been sent
            exit();
        }else{
            //get the realtor of the house based on the id of the house
            $realtor = $userContr->getRealtorsName($propertyId);
            $realtor = $realtor['realtor'];

            //sent the inquirement
            $userContr->sendInquirment($propertyId,$username,$email,$phonenumber,$messange,$address,$realtor);//save inquirment to the database so we can dispaly it in the realtor
            header("Location: ../DashBoard/dashboard.php?inquire=inquireMade");
           
        }
    }
}  
