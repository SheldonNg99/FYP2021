<?php

class Authenticate_Model extends Dbh{

  //Validate email
  public function validateemail($data){
    //2. Check uniqueness of email
    $sql = "SELECT * FROM users WHERE user_email = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('s',$data['email']);
    $stmt->execute([$data['email']]);
    //$stmt->fetchColumn();
    $result = $stmt->rowCount();
    return $result;
  }

  //Validate username
  public function validateusername($data){
    $sql = "SELECT * FROM users WHERE user_name = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('s',$data['username']);
    $stmt->execute([$data['username']]);
    //$stmt->fetchAll();
    $result = $stmt->rowCount();
    return $result;
  }

  //Insert user details to user database
  public function userregister($data){
    $user_name = $data['username'];
    $user_email = $data['email'];
    $user_password = $data['psw'];
    //Default auth level will be normal
    $user_auth_level = "normal";
    //Default status will be active
    $user_status = "active";
    $Num_Of_Products = 0;
    $Num_Of_Bids = 0;
    $Num_Of_Followers = 0;
    $Num_of_Following = 0;
    $Percentage_of_Rating = 0;
    $Num_of_Rates = 0;

    $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // and any other characters
    shuffle($seed); // probably optional since array_is randomized; this may be redundant
    $Validate_Code = '';
    foreach (array_rand($seed, 5) as $k) $Validate_Code .= $seed[$k];

    $Hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(
            user_name,user_email,user_password,user_status,user_auth_level,
            Num_of_Products,Num_of_Bids,Num_of_Following,Num_of_Followers,
            Percentage_of_Rating,Num_of_Rates,Validate_Code)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_name,$user_email,$Hash_password,$user_status,$user_auth_level,
                    $Num_Of_Products,$Num_Of_Bids,$Num_of_Following,$Num_Of_Followers,
                    $Percentage_of_Rating,$Num_of_Rates,$Validate_Code]);
    //Row count to count the row
    $results = $stmt->rowCount();
    return $results;
  }

  //Retrieve data from database to validate the user login
  public function userlogin($data){
    $username = $data['username'];
    $password = $data['psw'];

    $sql = "SELECT * FROM users WHERE user_name = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam('s',$username);
    $stmt->execute([$username]);

    // Store the result so we can check if the account exists in the database
    $results = $stmt->fetchAll();
    //return $results;
    if($results > 0){
      foreach($results as $result){
        if(password_verify($password, $result['user_password'])){
          // Verification success! User has loggedin!
          // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
          //session_regenerate_id();
          $_SESSION['name'] = $username;
          $_SESSION['id'] = $result['user_id'];

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

}
