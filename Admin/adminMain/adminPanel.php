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
        <div  id="options">
            <div id="controls">
                <div id="auth">
                    <div id="header">
                        <p>Authentication and Authorization</p>
                    </div>
                    <div id="body">
                        <div  id="users">
                            <div id="left">
                                <p v-on:click="seeAllUsers">Users</p>
                            </div>
                            <div id="right">
                                <div v-on:click="addUser" style="cursor: pointer;" id="add">
                                    <i id="add-contr" class="fas fa-plus"></i>Add
                                </div>
                                <div v-on:click="editUser" style="cursor: pointer;" id="edit">
                                    <i id="change-contr" class="fas fa-pencil-alt"></i>Change
                                </div>
                            </div>
                        </div>
                        <div  id="realtors">
                            <div id="left">
                                    <p v-on:click="seeRealtors">Realtors</p>
                                </div>
                                <div id="right">
                                    <div v-on:click="addRealtor" style="cursor: pointer;" id="add">
                                        <i id="add-contr" class="fas fa-plus"></i>Add
                                    </div>
                                    <div v-on:click="editRealtor" style="cursor: pointer;" id="edit">
                                        <i id="change-contr" class="fas fa-pencil-alt"></i>Change
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <div id="contact">
                    <div id="header">
                        <p>Contacts</p>
                    </div>
                    <div id="body">
                        <div  id="users">
                            <div id="left">
                                <p v-on:click="seeInquires">Contacts</p>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div id="Listings">
                    <div id="header">
                        <p>Listings</p>
                    </div>
                    <div id="body">
                        <div  id="users">
                            <div id="left">
                                <p v-on:click="goToListings">Listings</p>
                            </div>
                            <div id="right">
                                <div v-on:click="addProperty" style="cursor: pointer;" id="add">
                                    <i id="add-contr" class="fas fa-plus"></i>Add
                                </div>
                                <div v-on:click="editListings" style="cursor: pointer;" id="edit">
                                    <i id="change-contr" class="fas fa-pencil-alt"></i>Change
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- all of realtors actions -->
            <div id="realtors-actions">
                <div id="header">
                    <h5>Renent Actions</h5>
                    <hr>
                </div>

                <!--Display the listings of the realtor-->
                <?php 
                    $userView = new Userview();
                    
                    $listings = $userView->realtorsProperties($realtor);
                    for ($i=0; $i < sizeof($listings); $i++) {
                        $street = $listings[$i]['street'];
                        echo "
                        <div id='property'>
                            <div>
                                <i id='change-contr' class='fas fa-pencil-alt'></i>
                                <h6>$street</h6>
                            </div>
                            <p>Listed</p>
                        </div>";
                    }
                ?>

                <div id="addproperty">
                    <div style="cursor: pointer" v-on:click="addProperty">
                        <!-- let addmin add property -->
                        <i id="add-contr" class="fas fa-plus"></i>
                        <h6>Add Property</h6>
                    </div>
                </div>
            </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="adminsPanel.js"></script>
</body>
</html>