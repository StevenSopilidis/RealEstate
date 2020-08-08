<?php 

class User extends Dbh{
    //create user account
    protected function setUser($firstname,$lastname,$username,$password,$email,$userStatus){
        $sql = "INSERT INTO users (firstname,lastname,username,password,email,userStatus) VALUES (?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$firstname,$lastname,$username,$password,$email,$userStatus]);
    }



    protected function matchPasswords($password){
        //match the password;
        $sql = "SELECT password FROM users";
        $stmt = $this->connect()->query($sql);
        while($row = $stmt->fetch()){
            if (password_verify($password, $row['password'])) {
                return true;
                exit();
            }
        }
        return false;
    }

    //logs in the user if the details he inputed are valid
    protected function loginUser($email,$password){
        $passwordFound = $this->matchPasswords($password);
        if(!$passwordFound){
            header('Location: Login/login.php?login=InvalidPassword');
        }else{
            //if password was found check for the email
            $sql = "SELECT username FROM users WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);

            $rows = $stmt->rowCount();
            if($rows === 0){
                header('Location: Login/login.php?login=InvalidEmailAdress');
            }else{
                header("Location: Login/login.php?login=UserFound&email=$email");
            }
        }
    }

    //method that checks if username or email is already taken
    protected function takenDetails($username,$email){
        $sql = "SELECT * FROM users WHERE username=? OR email=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username,$email]);
        $result = $stmt->rowCount();
        if($result == 0){
            return false;
        }else{
            return true;
        }
    }

    //mtehod that finds the username depending on the email
    protected function findUsername($email){//use the method in the view class
        $sql = "SELECT username FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result;
    }

    //function that returns all the listed properties
    protected function getAllProperties(){
        $sql = "SELECT * FROM listings";
        $result = $this->connect()->query($sql);
        $result = $result->fetchAll();
        return $result;
    }

    //returns all details from a specific house depending on its id
    protected function getAllHouseDetails($houseId){
        $sql = "SELECT * FROM listings WHERE properties_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$houseId]);
        $result = $stmt->fetchAll();
        return $result;
    }


    //gets the three latest listings
    protected function latestListings(){
        $sql = "SELECT * FROM listings WHERE active_listing = 'published' ORDER BY id DESC LIMIT 3";//the bigger the id the latest it was listed
        $result = $this->connect()->query($sql);
        $result = $result->fetchAll();
        return $result;
    }



    //check if the user is an Admin
    protected function checkifAdmin($username,$password){
        $passwordFound = $this->matchPasswords($password);

        //check of the validity of the password
        if(!$passwordFound){
            header('Location: loginAdmin.php?login=InvalidPassword');//file included in Admin
        }else{
            //if password was found check for the email
            $sql = "SELECT userStatus FROM users WHERE username = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);
            $result = $stmt->fetch();

            $rows = $stmt->rowCount();
            //check for the validity of the username;
            if($rows === 0){
                header('Location: loginAdmin.php?login=InvalidUsername');//file included in Admin
            }else{
                //check the user status
                $status = $result['userStatus'];
                session_start();
                $_SESSION['username'] = $username;
                if($status == 'Admin'){
                    header('Location: loginAdmin.php?login=authorised');//file included in Admin
                }else{
                    header('Location: loginAdmin.php?login=NoAutorization');//file included in Admin
                }
            }
        }
    }

    //check if user exists by usename and email before make an inqure for a house
    protected function inqUserFind($username,$email){
        $sql = "SELECT username FROM users WHERE email = ? AND username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email,$username]);

        $rows = $stmt->rowCount();

        if($rows == 0){
            return false;
        }else{
            return true;
        }     
    }

    //check if user has already made an inquirment on the same house based on houseid,email and username
    protected function inqAlreadyMade($propertyId,$email,$username){
        $sql = "SELECT * FROM inquires WHERE property_id = ? AND email = ? AND users_username = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$propertyId,$email,$username]);

        //count the row to see if we have any results
        $row = $stmt->rowCount();
        
        if($row > 0){
            return true;//means house has already been inquired 
        }else{
            return false;//meanse house hasnt been inquired
        }
    }

    //method for senting the inquirement
    protected function sendInq($property_id,$username,$email,$phonenumber,$messange,$address,$realtor){
        $sql = "INSERT INTO inquires (property_id,users_username,email,messange,phonenumber,property_name,realtor) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$property_id,$username,$email,$messange,$phonenumber,$address,$realtor]);
    }


    //select all the inquires the user made
    protected function allInquired($username){
        $sql = "SELECT * FROM inquires WHERE users_username = '$username' ";
        
        $result = $this->connect()->query($sql);
        $result = $result->fetchAll();
        return $result;
    }


    //delete inquire
    protected function deleteInquire($houseId,$username){
        $sql = "DELETE FROM inquires WHERE users_username = '$username' AND property_id = '$houseId' ";
        $result = $this->connect()->query($sql);
    }

    //get all the listings the realtor made by using his name(we get the street name)
    protected function getRealtorsListings($name){
        $sql = "SELECT street FROM listings WHERE realtor = '$name'";
        $result = $this->connect()->query($sql);
        $result = $result->fetchAll();

        return $result;
    }

    //get users and display them on the admin area
    protected function displayUsers($count){
        $sql = "SELECT * FROM users WHERE userStatus = 'User' LIMIT $count";

        $result = $this->connect()->query($sql)->fetchAll();
        return $result;
    }

    //get all the realtors and display them
    protected function displayRealtors(){
        $sql = "SELECT * FROM users WHERE userStatus = 'Admin'";

        $result = $this->connect()->query($sql)->fetchAll();
        return $result;
    }

    //get the realtor of the house based on the id of the house
    protected function getRealtor($houseId){
        $sql = "SELECT realtor FROM listings WHERE properties_id = '$houseId'";
        $result = $this->connect()->query($sql)->fetch();

        return $result;
    }
    //get all the inquiries that have been made to the admin
    protected function getRealtorsInquires($realtorName){
        $sql = "SELECT * FROM inquires WHERE realtor = '$realtorName' LIMIT 5";
        $result = $this->connect()->query($sql)->fetchAll();

        return $result;
    }

    //get all the values that are assocciated with the realtors listings
    protected function getRealtorsHouseListings($realtorsName){
        $sql = "SELECT * FROM listings WHERE realtor = '$realtorsName'";
        $result = $this->connect()->query($sql);
        $result = $result->fetchAll();

        return $result;
    }


    
    //upload propertiesDetails(not image)
    //details will be ann array
    protected function uploadHouseDetails($realtor,$price,$bedrooms,$bathrooms,$garages,$square_foot,$lot_size,$date,$state,$city,$details,$street,$prop_id){
        $firstImage = 'no Image';
        echo $date;
        $sql = "INSERT into listings (properties_id, price,bedrooms,bathroomss,garage,square_foot,lot_size,listing_date,realtor,state,city,details,first_image,street)
        VALUES ('$prop_id','$price','$bedrooms','$bathrooms','$garages','$square_foot','$lot_size','$date','$realtor','$state','$city','$details','noImage.jpg','$street');";        
        $result = $this->connect()->query($sql);
    } 

    //get all the users details based on his id so we can edit him
    protected function editUser($userId){
        $sql = "SELECT * FROM users WHERE id = '$userId'";
        $result = $this->connect()->query($sql)->fetch();

        return $result;
    }

    //function that updates users details by the admin 
    protected function updateUsersDetails($userId,$firstname,$lastname,$username,$user_status){
        $sql = "UPDATE users set firstname = '$firstname', lastname = '$lastname', username = '$username', userStatus = '$user_status'  WHERE id = '$userId'";
        $result = $this->connect()->query($sql);
    }

    //delete User by admin
    protected function deleteUser($userId){
        $sql = "DELETE FROM users WHERE id = '$userId'";
        
        $result = $this->connect()->query($sql);
    }

    //methods that changes the house in published or draft
    protected function publishedOrNotProp($active,$property_id){
        $sql = "UPDATE listings set active_listing = '$active' WHERE properties_id = '$property_id'";
        $result = $this->connect()->query($sql);
    }

    //let admin the propertie he has selected
    protected function deletePropertieByAdmin($houseId){
        $sql = "DELETE from listings WHERE 	properties_id = '$houseId' ";
        $result = $this->connect()->query($sql); 
    }

    //get all realtors details and display them so he can choose to change them
    protected function get_RealtorsDetails($realtors_name){
        $sql = "SELECT * FROM users WHERE username = '$realtors_name' ";
        $result = $this->connect()->query($sql);
        $result = $result->fetch();

        return $result;
    }

    //change realtors profile details (firstname,lastname,email,image)
    protected function set_realtors_details($firstname,$lastname,$image,$username, $email){
        $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', image_profile = '$image', email = '$email' WHERE username = '$username' ";
        $result = $this->connect()->query($sql);
    }

    //upload the images to the db
    protected function upload_image(string $image,int $propId){
        $sql = "INSERT INTO images (image_name,properties_id) VALUE('$image','$propId')";
        $result = $this->connect()->query($sql);
    }

    //get all the images of the propertie the user selected
    protected function get_images(int $houseId){
        $sql = "SELECT * FROM images WHERE properties_id = '$houseId'";
        $result = $this->connect()->query($sql)->fetchAll();
        return $result;
    }

    //get realtors name by the propertie_id
    protected function getRealtorsNameById(int $houseId){
        $sql = "SELECT realtor FROM listings WHERE properties_id = '$houseId'";
        $result = $this->connect()->query($sql)->fetch();
        return $result;
    }

    //get realtors image and name
    protected function realtorsImage(int $houseId){
        $name = $this->getRealtorsNameById($houseId);
        $name = $name['realtor'];

        $get_image_sql = "SELECT image_profile FROM users WHERE username = '$name'";
        $image = $this->connect()->query($get_image_sql)->fetch();
        $image = $image['image_profile'];

        return ['image' => $image, 'name' => $name];
    }

    //set User as mvp
    protected function set_mvp($username){
        //first remove the mvp status from previous realtor
        $sql = "UPDATE users SET MVP = 'No' WHERE MVP = 'Yes' ";
        $this->connect()->query($sql);
        //set the new MVP
        $sql = "UPDATE users SET MVP = 'Yes' WHERE username = '$username' ";
        $result = $this->connect()->query($sql);
    }

    //select the mvp from db
    protected function get_mvp(){
        $sql = "SELECT image_profile,username FROM users WHERE MVP = 'Yes'";
        $result = $this->connect()->query($sql)->fetch();
        return $result;
    }

    //method for filtering properties
    protected function filter_properties($bathrooms,$bedrooms,$state,$city,$propertie_price){
        // $sql = "SELECT * FROM listings WHERE price <= $propertie_price AND bedrooms <= '$bathrooms' AND bathroomss <= $bedrooms AND state = '$state' AND city = '$city'";
        
        // $result = $this->connect()->query($sql)->fetchAll();
        // return $result;
        $sql = "SELECT * FROM listings WHERE price <= $propertie_price AND bathroomss <= $bathrooms AND bedrooms <= $bedrooms AND state = '$state' AND city = '$city'";
        $result = $this->connect()->query($sql)->fetchAll();

        return $result;
    }
}