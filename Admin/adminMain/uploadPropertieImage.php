<?php
include_once '../../includes/autoload.inc.php';

//if user hasnt loged in as admin navigate him to the Mainpage
if(!isset($_SESSION['adminLoged'])){
    header("Location: ../../Main/main.php");
}

//uploading mutliple file
if(isset($_POST['uploadImage'])){
    $userContr = new Usercontr();
    $prop_id = $_GET['propId'];
    // Count total files
    $countfiles = count($_FILES['file']['name']);
   

    // Looping all files
    for($i=0;$i<$countfiles;$i++){
        $filename = $_FILES['file']['name'][$i];
        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'][$i],"../../img/$filename");
        $userContr->uploadImagesToDb($filename,$prop_id);
    }
    //unset the session
    $_SESSION['prop_id'] = null;//it hold the id of the house we are adding an image to
    header("Location: adminPanel.php");
} 