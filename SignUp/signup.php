<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
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
                <h4 v-on:click="gotoallistings">Featured Listing</h4>
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

        <div style="height: 80vh" id="form-field">
            <div id="welocome_tag">
                <i class="fas fa-user-plus"></i>
                <h5>Register</h5>
            </div>
            <?php 
                //display message if username or email already taken
                
                if(isset($_GET['signUp'])){
                    $message = $_GET['signUp'];
                    if($message == 'UsernameOrEmailAlreadyTaken'){
                        echo '<div id=message class="alert alert-danger">
                                <strong>Username Or Email</strong> Already taken
                            </div>';
                        
                            echo "<script>
                                window.setTimeout(() => {
                                    $(message).hide()
                                },3000)
                            </script>";
                    }      
                }
            ?>

            <form style="margin-top: 10px" v-bind:class="validate" method="post" action="../signup.act.php" id="registerForm">
                <div class="form-group col-12">
                    <label for="firnm">First Name:</label>
                    <input v-on:keyup="validateFirstName" type="text" class="form-control" v-model="firstName" name="firstname">
                    <p v-bind:class="firstname_class">{{firstname_message}}</p>
                </div>
                <div class="form-group col-12">
                    <label for="lastnm">Last Name:</label>
                    <input v-on:keyup="validateLastname" type="text" class="form-control" v-model="lastName" name="lastname">
                    <p v-bind:class="lastname_class">{{lastname_message}}</p>
                </div>
                <div class="form-group col-12">
                    <label for="usnm">Username:</label>
                    <input v-on:keyup='validateUserName' type="text" class="form-control" v-model="username" name="username">
                    <p v-bind:class="username_class">{{username_message}}</p>
                </div>
                <div class="form-group col-12">
                    <label for="eml">Email:</label>
                    <input v-on:keyup="validateEmail" type="text" class="form-control" v-model="email" name="email">
                    <p v-bind:class="email_class">{{email_message}}</p>
                </div>
                <div class="form-group col-12">
                    <label for="firnm">Password:</label>
                    <input v-on:keyup='validatePassword' type="password" class="form-control" v-model="password" name="password">
                    <p v-bind:class="password_class">{{password_message}}</p>
                </div>
                <button v-on:click.prevent="registerUser" style="margin-left: 20px; margin-top: 10px" class="btn btn-success col-11">Register</button>
            </form>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='register.js'></script>
</body>
</html>