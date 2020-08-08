<?php 


class Usercontr extends User{

    public function createUser($firstname,$lastname,$username,$password,$email,$userStatus){
        $password = password_hash($password,PASSWORD_ARGON2ID);
        $this->setUser($firstname,$lastname,$username,$password,$email,$userStatus);
    }

    //logInUser
    public function getUser($email,$password){
        $this->loginUser($email,$password);
    }

    //check if the user is admin or not
    public function checkAdmin($username,$password){
        $this->checkifAdmin($username,$password);
    }


    ///check if inquire was already made by the user
    public function inquireAlreadyMadeByUser($houseId,$email,$username){
        $result = $this->inqAlreadyMade($houseId,$email,$username);
        return $result;
    }
    //check if user exists by usename and email before make an inqure for a house
    public function userExists($username,$email){
        $result = $this->inqUserFind($username,$email);
        
        return $result;
    }

    //send the iqnuire for a certain house
    public function sendInquirment($property_id,$username,$email,$phonenumber,$message,$address,$realtor){
        $this->sendInq($property_id,$username,$email,$phonenumber,$message,$address,$realtor);
    }
    
    //get a houses address depending on its id 
    public function getAddress($houseId){
        $result = $this->get_address($houseId);
        return $result;
    }

    //delete a inquire that the user made
    public function deleteUsersInquire($houseId,$username){
        $this->deleteInquire($houseId,$username);
    }

    //get the realtor of the house based on the id of the house
    public function getRealtorsName($houseId){
        $realtor = $this->getRealtor($houseId);
        return $realtor;
    }

    ////upload propertiesDetails(not image)
    //details will be ann array
    public function uploadDetails($realtor,$price,$bedrooms,$bathrooms,$garages,$square_foot,$lot_size,$date,$state,$city,$details,$street,$prop_id){
        $this->uploadHouseDetails($realtor,$price,$bedrooms,$bathrooms,$garages,$square_foot,$lot_size,$date,$state,$city,$details,$street,$prop_id);
    }

    //update users details by admin
    public function updateUser($userId,$firstname,$lastname,$username,$user_status){
        $this->updateUsersDetails($userId,$firstname,$lastname,$username,$user_status);
    }

    //delete users details by admin
    public function deleteUserByAdmin($userId){
        $this->deleteUser($userId);
    } 

    //methods that changes the house in published or draft
    public function changeHousePublishStatus($active,$property_id){
        $this->publishedOrNotProp($active,$property_id);    
    } 

    //delete listing by admin
    public function deletePropertie($houseId){
        $this->deletePropertieByAdmin($houseId);
    }

    //save change that the realtor made to his profile
    public function change_realtor_profile($firstname,$lastname,$image,$username, $email){
        $this->set_realtors_details($firstname,$lastname,$image,$username, $email);
    }

    public function uploadImagesToDb(string $images,int $propId){
        return $this->upload_image($images,$propId);
    }

    //set new mvp
    public function set_new_mvp($username){
        $this->set_mvp($username);
    }
}
