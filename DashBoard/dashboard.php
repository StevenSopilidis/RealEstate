<?php 
    session_start();                    
    include '../includes/autoload.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/0c735a34da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../scss/main.css">
    <link rel="stylesheet" href="dashBoard.css">
</head>
<body>

    <div id="vue-app">
        <nav>
            <div id='left'>
                <i class="fas fa-home"></i>
                <h4 @click="goToHomePage">Home</h4>
                <h4 @click="goToAbout">About</h4>
                <h4 v-on:click="gotoalllistings">Featured Listing</h4>
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
        <div id="welcomer">
            <div id="underlay">
                <h2 class="text-center">User Dashboard</h2>
                <p class="text-center">Manage Your BT Real Estae Account</p>
            </div>
        </div>
        <!--Display all the listings that the user made-->
        <div id="main-content">
            <h2>Welcome <?php echo $_SESSION['username'] ?></h2>
            <p>Here are All the Properties You have inquired for</p>
            <!-- display any message -->
            <?php 
                if(isset($_GET['inquire'])){
                    $messange = $_GET['inquire'];
                    if($messange == 'inquireMade'){
                        //notify user that his inquire was been made successfuly
                        echo '<div id="messange" class="alert alert-success">
                                <strong>Success!</strong> Inquiry Sent Successfully
                            </div>';

                        echo '<script>
                            window.setTimeout(()=>{
                                $("#messange").hide();
                            },3000)
                            </script>';
                    }elseif($messange == 'AlreadyMadeAnInquire'){
                        //notify user that he has already made that specific inquire
                        echo '<div id="messange" class="alert alert-danger">
                                <strong>You</strong> have already inquired the specific property
                            </div>';
                        //make it disapear after 3 sec
                        echo '<script>
                                window.setTimeout(()=>{
                                    $("#messange").hide();
                                },3000)
                            </script>';
                    }
                }
            
            ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Property</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    //return all the users inquires
                    $view = new Userview();
                    $username = $_SESSION['username'];
                    $allInquires = $view->usersInquires($username);
                    for ($i=0; $i < sizeof($allInquires); $i++) { 
                        $propery_id = $allInquires[$i]['property_id'];
                        $propery_address = $allInquires[$i]['property_name'];
                        //add also the locations
                        echo "<tr>
                                <td>$propery_id</td>
                                <td>$propery_address</td>
                                <td><button v-on:click='seeInqurie' class='btn btn-info'>View Listign</button></td>
                            </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="dash.js"></script>
</body>
</html>
