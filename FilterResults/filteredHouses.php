<?php
include_once "../includes/autoload.inc.php";

//display any results from the filtered houses (the results will be displayed in the Main/main.php; 
if(isset($_POST['propertie_price'])){
    //get the paramaeters of the user and search if any propertie meets those parameters
    $bathrooms = $_POST['bathrooms'];
    $bedrooms = $_POST['bedrooms']; 
    $state = $_POST['state'];
    $city = $_POST['city'];
    $propertie_price = $_POST['propertie_price'];


    $user_view = new Userview();
    $properties = $user_view->display_filtered_properties($bathrooms,$bedrooms,$state,$city,$propertie_price); //the properties that we got 


    //if the size of the array (of the filted house === 0 )
    if(sizeof($properties)  == 0){
        echo '<h5 class="text-danger">No Properties Match those Criteria</h5>';
    }else{
        for ($i=0; $i < sizeof($properties); $i++) { 
            //get all the information we need for the featured listings section
            $price = $properties[$i]['price'];
            $street = $properties[$i]['street'];
            $state_city = $properties[$i]['state'] . ' ' . $properties[$i]['city'];
            $sqrft = $properties[$i]['square_foot'];
            $garage = $properties[$i]['garage'];
            $bedrooms = $properties[$i]['bedrooms'];
            $bathrooms = $properties[$i]['bathroomss'];
            $realtor = $properties[$i]['realtor'];
            $listingdate = $properties[$i]['listing_date'];
            $house_id = $properties[$i]['properties_id'];//unique id of each listing
            $image = $properties[$i]['first_image'];


            echo "<div id='house'>
                    <div style = 'background-image : url(../img/$image);' id='upper'>
                        <div id='price'>
                            <h5>$price$</h5>
                        </div>
                    </div>
                    <div id='lower'>
                        <div id='location'>
                            <h5>$street</h5>
                            <div>
                                <i class='fas fa-map-marker'></i>
                                <p>$state_city</p>
                            </div>
                        </div>
                        <div id='small-details'>
                            <div id='sqrft-garage'>
                                <div id='squarefeet'>
                                    <i class='fas fa-th-large'></i>
                                    <p>$sqrft</p>
                                </div>
                                <div id='garage'>
                                    <i class='fas fa-car'></i>
                                    <p>Garage: $garage</p>
                                </div>
                            </div>
                            <div id='bedr-bath'>
                                <div id='bedroom'>
                                    <i class='fas fa-bed'></i>
                                    <p>Bedrooms: $bedrooms</p>
                                </div>
                                <div id='bathroom'>
                                    <i class='fas fa-bath'></i>
                                    <p>Bathrooms: $bathrooms</p>
                                </div>
                            </div>
                        </div>
                        <div id='realtor'>
                            <div id='realtor-name'>
                                <i class='fas fa-user-alt'></i>
                                <p>$realtor</p>
                            </div>
                            <div id='listing-date'>
                                <i class='far fa-clock'></i>
                                <p>$listingdate</p>
                            </div>
                        </div>
                        <button id='seeDetailsBtn' data-id=$house_id class='btn btn-info col-10' ref='houseid'>Details</button>
                    </div>
                </div>";
        }
    }

}else{//if not dont allow the user to access this page and navigate him back to the mainpage
    header("Location: ../Main/main.php");
}