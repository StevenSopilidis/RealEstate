<?php
session_start();

include '../includes/autoload.inc.php';

$houseId = $_SESSION['houseId'];

//get all the details of the house
$view = new Userview();
$details = $view->getHouseDetails($houseId); //get the details of the house the user selected 

$houseImage = $details[0]['first_image'];

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
    <link rel="stylesheet" href="singleHouse.css">
</head>
<body>

    <div id="vue-app">
        <nav>
            <div id='left'>
                <i class="fas fa-home"></i>
                <h4 v-on:click="goHome">Home</h4>
                <h4 @click="goToAbout">About</h4>
                <h4 v-on:click="goFeaturedListings">Featured Listing</h4>
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
                <h2 class="text-center"><?php echo $details[0]['street'] ?></h2>
                <h5 style="color: #fff" class="text-center"><?php echo $details[0]['state'] . ' ' . $details[0]['city'] ?></h5>
            </div>
        </div>
        <div id="house-details">
            <div id="house">
                <div id='house-image'>
                    <?php echo "<img src='../img/$houseImage' alt='selectedHouse'>" ?>
                    <div style="display: flex;" id="more-images">
                        <?php 
                            //get all the images about this propertie
                            $house_images = $view->get_all_propertie_images($houseId);
                            foreach ($house_images as $image){
                                echo "<img @click.prevent='seeImage' style='width:140px; height:80px; margin-left: 1rem;cursor: pointer;' src='../img/$image[image_name]' alt='house_Image'>";
                            }

                        ?>
                    </div>
                </div>
                <div id="house-chars">
                    <div id="quick-char">
                        <div id="left-column">
                            <div id="price">
                                <div>
                                    <i class="fas fa-money-bill-wave"></i>
                                    <p>Asking Price: </p>                     
                                </div>
                                <p><?php echo $details[0]['price']?>$</p>                     
                            </div>
                            <div id="bedrooms">
                                <div>
                                    <i class='fas fa-bed'></i>
                                    <p>Bedrooms: </p>
                                </div>
                                <p><?php echo $details[0]['bedrooms'] ?></p>                    
                            </div>
                            <div id="bathrooms">
                                <div>
                                    <i class='fas fa-bath'></i>
                                    <p>Bathrooms</p>
                                </div>
                                <p><?php echo $details[0]['bathroomss'] ?></p>                     
                            </div>
                            <div id="garage">
                                <div>
                                    <i class='fas fa-car'></i>
                                    <p>Garage: </p>
                                </div>
                                <p><?php echo $details[0]['garage'] ?></p>                     
                            </div>
                        </div>
                        <div id="right-column">
                        <div id="price">
                                <div>
                                    <i class='fas fa-th-large'></i>
                                    <p>Square Foot: </p>                     
                                </div>
                                <p><?php echo $details[0]['square_foot'] ?></p>                     
                            </div>
                            <div id="bedrooms">
                                <div>
                                    <i class="fas fa-square"></i>
                                    <p>Lot Size:</p>
                                </div>
                                <p><?php echo $details[0]['lot_size'] ?></p>                    
                            </div>
                            <div id="bathrooms">
                                <div>
                                <i class="far fa-calendar-alt"></i>
                                    <p>Listing Date: </p>
                                </div>
                                <p><?php echo $details[0]['listing_date'] ?></p>                     
                            </div>
                            <div id="garage">
                                <div>
                                    <i class='fas fa-user-alt'></i>
                                    <p>Realtor: </p>
                                </div>
                                <p><?php echo $details[0]['realtor'] ?></p>                     
                            </div>
                        </div>
                    </div>
                    <div id="detailed-chars">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae saepe est necessitatibus ipsam! Eius inventore nisi porro assumenda labore, dolores cum ut sapiente voluptatibus minima. Quis illum reprehenderit, iure ipsa esse atque recusandae cumque quisquam itaque, magni molestias! Eum, quo facilis labore voluptate soluta est id vitae ad dolorum dignissimos.</p>
                    </div>
                </div>
            </div>
            <div id="realtor">
                <div id="realtor-details">
                    <!--Display the realtorss details-->
                    <?php 
                        $realtorsDetails = $view->getRealtorsNameandImage($houseId);
                        
                        echo  "<img src='../img/$realtorsDetails[image]' alt='realtors image'>
                                <h5>Property Realtor</h5>
                               <h6>$realtorsDetails[name]</h6>";
                    ?>


                </div>
                <button v-on:click.prevent="makeInqurie" class="btn btn-info col-12">Inquire</button>
            </div>
            <!--Later Add a popup form to display the form for user to make an inqurie-->
        </div>
        
        <!--Overlay for when the user clicks at an image-->
        <div v-if="displayOverlay" id="image_overlay">
            <div>
                <i @click="closeWindow" class="fas fa-times"></i>
                <img id="selected_image" v-bind:src="srcOfImage">
            </div>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./seeDetails.js"></script>
</body>
</html>
