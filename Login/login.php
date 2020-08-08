<?php include_once '../includes/autoload.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script><link rel="stylesheet" href="../scss/main.css">
    <script src="https://kit.fontawesome.com/0c735a34da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../scss/main.css">
</head>
<body>

    <div id="vue-app">
        <nav>
            <div id='left'>
                <i class="fas fa-home"></i>
                <h4 v-on:click="goHome">Home</h4>
                <h4>About</h4>
                <h4 v-on:click="goToListings">Featured Listing</h4>
            </div>

            <div id="right">
                <?php 
                    if(isset($_SESSION['username'])){
                        echo '<useregistered></useregistered>';
                        echo '<logout></logout>';
                    }else{
                        echo '<register></register>';
                        echo '<login></login>';
                    }
                ?>
            </div>
        </nav>

        <div style="height: 450px; margin-top: 70px" id="form-field">
            <div id="welocome_tag">
                <i class="fas fa-user-plus"></i>
                <h5>Register</h5>
            </div>




            <!--if isset($_SESSION[user]) display the message and make it disapear after two seconds-->

            <?php 
            
                session_start();

                if(isset($_SESSION['user'])){
                    //usnset the $_SESSION['user'] which comes from signingUp
                    unset($_SESSION['user']);
                    
                    echo '<signedup></signedup>';
                }
                
                
                //uss the $_GET[login] to determine whether the user loged in or not successfully
                if(isset($_GET['login'])){
                    //handle the log in form and display the correct messsage depending on the $_GET['login'];
                    $message = $_GET['login'];
                    if($message == 'InvalidPassword'){
                        echo '<invalidpassword></invalidpassword>';
                
                    }elseif($message == 'InvalidEmailAdress'){
                        echo '<invalidemail></invalidemail>';
                
                    }else{
                        //if user was found use email to find the username         
                        $email = $_GET['email'];//users email
                        $userView = new Userview();

                        //get the username with the email
                        $username = $userView->getUsername($email);                                                
                        $username = $username['username'];

                        //start session to save username
                        session_start();
                        $_SESSION['username'] = $username;
                        header("Location: ../Main/main.php");
                    }
                }
            ?>



            <form method="post" action="../login.act.php" id="loginForm">
                <div style="margin-top: 1rem" class="form-group col-12">
                    <label for="eml">Email:</label>
                    <input type="text" class="form-control" v-model="email" name="email">
                    <p class="text-danger" v-if="invalid_email">{{email_message}}</p>
                </div>
                <div style="margin-top: 1rem" class="form-group col-12">
                    <label for="firnm">Password:</label>
                    <input type="password" class="form-control" v-model="password" name="password">
                    <p class="text-danger" v-if="invalid_password">{{password_message}}</p>
                </div>
                <button  v-on:click.prevent="loginUser" style="margin-left: 20px; margin-top: 10px" class="btn btn-success col-11">Register</button>
            </form>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='loginPage.js'></script>
</body>
</html>`