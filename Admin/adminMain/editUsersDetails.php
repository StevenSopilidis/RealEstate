<?php
    //if user hasnt loged in as admin navigate him to the Mainpage
    if(!isset($_SESSION['adminLoged'])){
        header("Location: ../../Main/main.php");
    }

    if(isset($_GET['id'])){
        //get the users id
        $usersId  = $_GET['id'];
    }
    session_start();
    $realtor = $_SESSION['adminLoged'];//realtors name
    include_once '../../includes/autoload.inc.php';

    //get all the users details
    $userView = new Userview();
    $details = $userView->editUsersDetails($usersId);
    $firstname = $details['firstname'];
    $lastname = $details['lastname'];
    $username = $details['username'];
    $email = $details['email'];
    $User  = $details['userStatus'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script><link rel="stylesheet" href="../../scss/main.css">
    <script src="https://kit.fontawesome.com/0c735a34da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/adminMain.css">
</head>
<body>
    
    <div id="vue-app">
        <nav id="navbar">
            <div id="controlls">
                <div>
                    <i id="logo" class="fas fa-home"></i>
                    <h4>Admin Area</h4>
                </div>
                <div>
                    <a href="realtorsProfile.php">Welcome <?php echo $realtor ?>/</a>
                    <a href="../../Main/main.php">View Site/</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </nav>
        
        <form style="width: 70%; margin: 0 auto; margin-top: 40px;" action="editUser.act.php?usersId=<?php echo $usersId?>" method="post" id="registerForm">
                <div class="form-group col-12">
                    <label for="firnm">First Name:</label>
                    <input value="<?php echo $firstname ?>" type="text" class="form-control" name="firstname">
                </div>
                <div class="form-group col-12">
                    <label for="lastnm">Last Name:</label>
                    <input value="<?php echo $lastname ?>" type="text" class="form-control" name="lastname">
                </div>
                <div class="form-group col-12">
                    <label for="usnm">Username:</label>
                    <input value="<?php echo $username ?>" type="text" class="form-control" name="username">
                </div>
                <div class="form-group col-12">
                    <label for="userStatus">Status: </label>
                    <select name="userStatus">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <button name="updateBtn" style="margin-left: 30%; margin-top: 40px" class="btn btn-success col-4">Edit User</button>
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="editUser.js"></script>
</body>
</html>