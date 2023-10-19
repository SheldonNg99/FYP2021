<?php

class Profile_Model extends Dbh{

  //Get seller details based on seller id
  public function getSellerDetails($Seller_Id){
    $sql = "SELECT *
            FROM users
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('s',$Seller_Id);
    $stmt->execute([$Seller_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Add the number of product inserted
  public function Add_Number_Of_Product(){
    $User_Id = $_SESSION['id'];
    $sql = "UPDATE users
            SET Num_of_Products = Num_of_Products + 1
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Minus the number of product inserted
  public function Minus_Number_Of_Product(){
    $User_Id = $_SESSION['id'];
    $sql = "UPDATE users
            SET Num_of_Products = Num_of_Products - 1
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Insert follower to database
  public function SetFollower($Seller_Id){
    $User_Id = $_SESSION['id'];
    $sql = "INSERT INTO user_follows(User_Id, Seller_Id)
            VALUES(?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id,$Seller_Id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Unset the follower
  public function UnsetFollower($Seller_Id){
    $User_Id = $_SESSION['id'];
    $sql = "DELETE FROM user_follows
            WHERE User_Id = ?
            AND Seller_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('ss',$User_Id,$Seller_Id);
    $stmt->execute([$User_Id, $Seller_Id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Check the follower status
  public function Check_Follower_Status($Seller_Id){
    $User_Id = $_SESSION['id'];
    $sql = "SELECT *
            FROM user_follows
            WHERE User_Id = ?
            AND Seller_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('ss',$User_Id,$Seller_Id);
    $stmt->execute([$User_Id, $Seller_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Update the following
  public function UpdateFollowing(){
    $User_Id = $_SESSION['id'];
    $sql = "UPDATE users
            SET Num_of_Following = Num_of_Following + 1
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Update the follower
  public function UpdateFollower($Seller_Id){
    $sql = "UPDATE users
            SET Num_of_Followers = Num_of_Followers + 1
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Seller_Id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Minus the number of followers
  public function MinusFollower($Seller_Id){
    $User_Id = $_SESSION['id'];
    $sql = "UPDATE users
            SET Num_of_Followers = Num_of_Followers - 1
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Seller_Id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Minus the number of following
  public function MinusFollowing(){
    $User_Id = $_SESSION['id'];
    $sql = "UPDATE users
            SET Num_of_Following = Num_of_Following - 1
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Check the user details based on the id
  public function getUserDetails(){
    //2. Check uniqueness of email
    $UserId = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('s',$UserId);
    $stmt->execute([$UserId]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Check current password
  public function CheckCurrentPassowrd($data){
    $UserId = $_SESSION['id'];
    $password = $data['C_psw'];
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('s',$UserId);
    $stmt->execute([$UserId]);

    $results = $stmt->fetchAll();

    if($results > 0){
      foreach($results as $result){
        if(password_verify($password, $result['user_password'])){
          // Return 1 when the password and is equal
          return 1;
        }
        else{
          return 0;
        }
      }
    }
    else{
      return 0;
    }
  }

  //Update the password
  public function UpdatePassword($data){
    $UserId = $_SESSION['id'];
    $NewPassword = $data['N_psw'];
    $Hash_password = password_hash($NewPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE users
            SET user_password = ?
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('ss',$Hash_password,$UserId);
    $stmt->execute([$Hash_password,$UserId]);

    $results = $stmt->rowCount();
    return $results;
  }

  //Update Profile image
  public function UpdateImage($filename){
    $UserId = $_SESSION['id'];
    $Filepath = $filename;
    $sql = "UPDATE users
            SET Profile_picture = ?
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('ss',$Filepath,$UserId);
    $stmt->execute([$Filepath,$UserId]);

    $results = $stmt->rowCount();
    return $results;
  }

  //Update username
  public function UpdateUsernameEmail($data){
    $UserId = $_SESSION['id'];
    $user_email = $data['email'];
    $user_name = $data['username'];
    $sql = "UPDATE users
            SET user_name = ?
            WHERE user_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('ss',$user_name, $UserId);
    $stmt->execute([$user_name, $UserId]);

    $results = $stmt->rowCount();
    return $results;
  }

  //Insert address to the database
  public function AddAddress($data){
    $address_street = $data['Address_street'];
    $address_city = $data['Address_City'];
    $address_state = $data['Address_state'];
    $address_zip = $data['Address_ZipCode'];
    $address_country = $data['Address_Country'];
    $address_status = "Primary";
    $UserId = $_SESSION['id'];

    $sql = "INSERT INTO user_shipment_address(address_street, address_city, address_state, address_zip, address_country, address_status, User_Id)
            VALUES(?,?,?,?,?,?,?)";

    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $address_street, PDO::PARAM_STR);
    $stmt->bindParam(2, $address_city, PDO::PARAM_STR);
    $stmt->bindParam(3, $address_state, PDO::PARAM_STR);
    $stmt->bindParam(4, $address_zip, PDO::PARAM_STR);
    $stmt->bindParam(5, $address_country, PDO::PARAM_STR);
    $stmt->bindParam(6, $address_status, PDO::PARAM_STR);
    $stmt->bindParam(7, $UserId, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->rowCount();
    return $results;
  }

  //Check the address
  public function CheckAddress(){
    $UserId = $_SESSION['id'];

    $sql = "SELECT *
            FROM user_shipment_address
            WHERE user_shipment_address.User_Id = ?";

    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('s', $UserId);
    $stmt->execute([$UserId]);

    $results = $stmt->rowCount();
    return $results;
  }

  //Retrieve the address
  public function GetCurrentUserAddress(){
    $UserId = $_SESSION['id'];

    $sql = "SELECT *
            FROM user_shipment_address
            WHERE User_Id = ?";

    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('s', $UserId);
    $stmt->execute([$UserId]);

    $results = $stmt->fetchAll();
    return $results;
  }

  //Edit the address
  public function Get_Edit_Address($Edit_Address_Id){

    $sql = "SELECT *
            FROM user_shipment_address
            WHERE user_shipment_id = ?";

    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('s', $Edit_Address_Id);
    $stmt->execute([$Edit_Address_Id]);

    $results = $stmt->fetchAll();
    return $results;
  }

  //Update the address
  public function Update_Address($data){

    $address_street = $data['Address_street'];
    $address_city = $data['Address_City'];
    $address_state = $data['Address_state'];
    $address_zip = $data['Address_ZipCode'];
    $address_country = $data['Address_Country'];
    $Edit_Address_Id = $data['Edit_Address_Id'];

    $sql = "UPDATE user_shipment_address
            SET address_street = ?,
                address_city = ?,
                address_state = ?,
                address_zip = ?,
                address_country = ?
            WHERE user_shipment_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $address_street, PDO::PARAM_STR);
    $stmt->bindParam(2, $address_city, PDO::PARAM_STR);
    $stmt->bindParam(3, $address_state, PDO::PARAM_STR);
    $stmt->bindParam(4, $address_zip, PDO::PARAM_STR);
    $stmt->bindParam(5, $address_country, PDO::PARAM_STR);
    $stmt->bindParam(6, $Edit_Address_Id, PDO::PARAM_INT);
    $stmt->execute();

    $results = $stmt->rowCount();
    return $results;
  }

}
