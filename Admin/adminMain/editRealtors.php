<?php
    session_start();
    include '../../includes/autoload.inc.php';
    $realtor = $_SESSION['adminLoged'];//realtors name

    //if user hasnt loged in as admin navigate him to the Mainpage
    if(!isset($_SESSION['adminLoged'])){
        header("Location: ../../Main/main.php");
    }
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
    <link rel="stylesheet" href="css/displayAllUsers.css">
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

        <h5 id="main_heading">Site Administrator</h5>
        <h6>Inspect Realtors</h6>
        
        <div id="users">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">FirstName</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Email</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody id="tablebody">
                    <tr>
                        <?php
                            //display 15 all the users to the table and if realtor wants to display more
                            $usersDisplayed = 4;
                            $userview = new Userview();
                            $result = $userview->getRealtors();
                            for ($i=0; $i < sizeof($result); $i++) { 
                                $id = $result[$i]['id'];
                                $fisrtname = $result[$i]['firstname'];
                                $lastname = $result[$i]['lastname'];
                                $email = $result[$i]['email'];
                                echo "
                                    <tr>
                                        <td>$id</td>
                                        <td>$fisrtname</td>
                                        <td>$lastname</td>
                                        <td>$email</td>
                                        <td><button data-realtorsid='$id' v-on:click='deleteRealtor' class='btn btn-danger'>Delete</button></td>
                                    </tr>
                                ";
                            }
                        ?>
                    </tr>
                    
                </tbody>
            </table>

        </div>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="editRealtors.js"></script>
</body>
</html>