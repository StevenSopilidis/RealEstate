<?php

class Userview extends User
{

    //check for duplicates
    public function getDublicates($username, $password)
    {
        $found = $this->takenDetails($username, $password);
        return $found;
    }

    //get the usersName
    public function getUsername($email)
    {
        $username = $this->findUsername($email);
        return $username;
    }

    //displays the listed properties
    public function viewProperties()
    {
        $dbResults = $this->getAllProperties();
        for ($i = 0; $i < sizeof($dbResults); $i++) {
            //get all the information we need for the featured listings section
            $price = $dbResults[$i]['price'];
            $street = $dbResults[$i]['street'];
            $state_city = $dbResults[$i]['state'] . ' ' . $dbResults[$i]['city'];
            $sqrft = $dbResults[$i]['square_foot'];
            $garage = $dbResults[$i]['garage'];
            $bedrooms = $dbResults[$i]['bedrooms'];
            $bathrooms = $dbResults[$i]['bathroomss'];
            $realtor = $dbResults[$i]['realtor'];
            $listingdate = $dbResults[$i]['listing_date'];
            $house_id = $dbResults[$i]['properties_id']; //unique id of each listing
            $image = $dbResults[$i]['first_image'];
            $house_status = $dbResults[$i]['active_listing']; //whether its published or not

            //display the house if only the house_status is set ass published

            if ($house_status === 'published') {
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
    }

    //get the details of the house the user selected
    public function getHouseDetails($houseid)
    {
        $data = $this->getAllHouseDetails($houseid);
        return $data;
    }



    //return the latest 3 listings
    public function latestThree()
    {
        $dbResults = $this->latestListings();
        for ($i = 0; $i < sizeof($dbResults); $i++) {
            //get all the information we need for the featured listings section
            $price = $dbResults[$i]['price'];
            $street = $dbResults[$i]['street'];
            $state_city = $dbResults[$i]['state'] . ' ' . $dbResults[$i]['city'];
            $sqrft = $dbResults[$i]['square_foot'];
            $garage = $dbResults[$i]['garage'];
            $bedrooms = $dbResults[$i]['bedrooms'];
            $bathrooms = $dbResults[$i]['bathroomss'];
            $realtor = $dbResults[$i]['realtor'];
            $listingdate = $dbResults[$i]['listing_date'];
            $house_id = $dbResults[$i]['properties_id']; //unique id of each listing
            $image = $dbResults[$i]['first_image'];


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

    //return users latest inquires
    public function usersInquires($username)
    {
        $result = $this->allInquired($username);

        return $result;
    }

    //get all realtors listed properties
    public function realtorsProperties($name)
    {
        $result = $this->getRealtorsListings($name);

        return $result;
    }

    //display some users on the admin
    public function getUsers($count)
    {
        $result = $this->displayUsers($count);
        return $result;
    }

    //display all realtors
    public function getRealtors()
    {
        $realtors = $this->displayRealtors();

        return $realtors;
    }

    //display realtors inquries
    public function displayRealtorsInquires($realtorName)
    {
        $inquires = $this->getRealtorsInquires($realtorName);

        return $inquires;
    }

    //display all the info assocciated with realtors listings
    public function realtorsListingsDetails($realtorsName)
    {
        $listings = $this->getRealtorsHouseListings($realtorsName);
        return $listings;
    }

    public function editUsersDetails($id)
    {
        $usersDetails = $this->editUser($id);
        return $usersDetails;
    }


    //display all details about the loged in realtor
    public function getRealtorsDetails($realtorsName)
    {
        $data = $this->get_RealtorsDetails($realtorsName);
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $username = $data['username'];
        $image = $data['image_profile'];

        echo "<form action='saveRealtorsProfileChanges.php' method='post' enctype='multipart/form-data'>
                <img id='realtors_profileImage' src='../../img/$image' alt='realtors_image'>
                <input type='file' name='imageProfile' id='file' class='inputfile' />
                <label for='file'>Choose a file</label>
                <div class='form-group'>
                    <label for='firstname'>Firstname:</label>
                    <input type='text' id='firstname' name='firstname' value=$firstname class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='firstname'>Lastname:</label>
                    <input type='text' id='lastname' name='lastname' value=$lastname class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='firstname'>Email:</label>
                    <input type= 'text' id='email' name='email' value=$email class='form-control'>
                </div>
                <div class='col text-center'>
                    <button name='saveBtn' class='btn btn-info col-7'>Save</button>
                </div>
            </form>";
    }

    //return all the images of the propertie the user is reviewing
    public function get_all_propertie_images(int $houseId)
    {
        return $this->get_images($houseId);
    }


    public function getRealtorsNameandImage(int $houseId)
    {

        return $this->realtorsImage($houseId);
    }

    //display the mvp on the about section
    public function get_mvp_realtor()
    {
        $data = $this->get_mvp();
        $img = $data['image_profile'];
        $username = $data['username'];

        echo "<img src='../img/$img' alt='saler of the month'>
        <div>
            <h5>Seller Of The Month</h5>
            <h6 class='text-success'>$username</h6>
            <p id='mvp_text'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta eaque quod reiciendis nihil animi dolore, eius placeat, quisquam aperiam quasi harum, maxime itaque? Accusantium ex quasi asperiores accusamus fugiat, sed assumenda vitae earum doloribus odit iste, dolores consequuntur, dolore similique?</p>
        </div>";
    }


    //display the filted properties
    public function display_filtered_properties($bathrooms, $bedrooms, $state, $city, $propertie_price)
    {
        return $this->filter_properties($bathrooms, $bedrooms, $state, $city, $propertie_price);
    }
}
