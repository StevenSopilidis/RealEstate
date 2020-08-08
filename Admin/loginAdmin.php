<!--Page where realto will be able to log in-->
<?php 
    session_start();
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
    <link rel="stylesheet" href="loginPage.css">
</head>
<body>
    
    <div id='vue-login-app'>
        <div id="login-container">
            <div id="header">
                <i class="fas fa-home"></i>
                <h3>Admin Area</h3>
            </div>
            <div id="message">
                <?php 
                    //warn use that we isnt authorised
                    
                    if(isset($_GET['login'])){
                        $messange = $_GET['login'];
                        //error handle and display the correct input
                        
                        if($messange == 'InvalidPassword' || $messange == 'InvalidUsername'){
                            echo '<invalidInput></invalidInput>';
                        }elseif($messange == 'NoAutorization'){
                            echo "<p class='text-danger'>As $_SESSION[username] you are not authorised to access, Switch to another account if you have the authorization</p>";
                        }else{
                            //set a session so we know if an admin has loged in or not
                            $_SESSION['adminLoged'] = $_SESSION['username'];
                            header('Location: ../adminMain/adminPanel.php');
                        };
                    }
                ?>
            </div> 

            <form action="loginAdmin.act.php" method="post">
                <div class='form-group'>
                    <label for="uname">Username: </label>
                    <input type="text" class="form-control" name="username" placeholder="Username...">
                </div>
                <div class='form-group'>
                    <label for="uname">Password: </label>
                    <input type="password" class="form-control" name="password" placeholder="Username...">
                </div>
                <button name="submitBtn" type="submit">Log In</button>
            </form>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="logAdmin.js"></script>
</body>
</html>