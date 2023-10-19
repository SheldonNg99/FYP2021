<?php

class Profile extends Controller{

  //View address page
  public function Address(){
    $data['title'] = 'Add Address';
    $this->view('Templates/Header',$data);
    $this->view('ProfileViews/AddAddress',$data);
    $this->view('Templates/Footer');
  }

  //Action of add address
  public function AddAddress(){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      if ($this->model('Profile_Model')->CheckAddress() > 0){
        $result = "You already inserted an address";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Profile/Address');
      }
      else{
        if ($this->model('Profile_Model')->AddAddress($_POST) > 0) {
          $result = "Success";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Profile/Edit');
        }
        else{
          $result = "Unable to insert address in database";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Profile/Address');
        }
      }
    }
    else{
      $result = "POST ERROR";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Profile/Edit');
    }
  }

  //Action of edit address
  public function EditAddress(){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Edit_Address_Id = $_POST['Edit_Address_Id'];
      if($this->model('Profile_Model')->Update_Address($_POST) > 0){
        $result = "Update the address successfully";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Profile/Edit');
      }
      else{
        $result = "Unable to update the address";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Profile/Edit');
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Profile/Edit');
    }
  }

  //View the edit address page
  public function ViewEditAddress(){
    //Send the data from the url
    $data['title'] = 'Edit';
    //Send the data by using model
    //$data['Get_Userprofile_Details'] = $this->model('Profile_Model')->getUserDetails();
    //Get Condition and category
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Edit_Address_Id = $_POST['Edit_Address_Id'];
      $data['Get_Edit_Address'] = $this->model('Profile_Model')->Get_Edit_Address($Edit_Address_Id);
      $this->view('Templates/Header',$data);
      $this->view('ProfileViews/EditAddress',$data);
      $this->view('Templates/Footer');
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Profile/Edit');
    }
  }

  //View seller profile
  public function SellerProfile($Seller_Id){
    $data['title'] = 'Profile';
    $data['Get_Current_Seller_Products'] = $this->model('Product_Model')->Get_Current_Seller_Products($Seller_Id);
    $data['Get_SellerProfile_Details'] = $this->model('Profile_Model')->getSellerDetails($Seller_Id);
    $data['Check_Follow_Status'] = $this->model('Profile_Model')->Check_Follower_Status($Seller_Id);
    $data['Get_Sold_Products'] = $this->model('Product_Model')->Get_Sold_Products();
    $this->view('Templates/Header',$data);
    $this->view('ProfileViews/SellerProfile',$data);
    $this->view('Templates/Footer');
  }

  //Follow the seller
  public function FollowSeller($Seller_Id){
    //Check whether it is post or not
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      if($this->model('Profile_Model')->SetFollower($Seller_Id) > 0){
        if($this->model('Profile_Model')->UpdateFollower($Seller_Id) > 0){
          if($this->model('Profile_Model')->UpdateFollowing() > 0){
            header('Location: '. BASEURL.'/Profile/SellerProfile/'.$Seller_Id);
          }
          else{
            $result = "Unable to update in database";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Profile/SellerProfile/'.$Seller_Id);
          }
        }
        else{
          $result = "Unable to update in database";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Profile/SellerProfile/'.$Seller_Id);
        }
      }
      else{
        $result = "Unable to follow this seller";
        Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Profile/SellerProfile/'.$Seller_Id);
      }
    }
    else{
      $result = "POST ERROR";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Bid/ViewBidproducts');
    }
  }

  //Unfollow a seller
  public function UnfollowSeller($Seller_Id){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      if($this->model('Profile_Model')->UnsetFollower($Seller_Id) > 0){
        if($this->model('Profile_Model')->MinusFollower($Seller_Id) > 0){
          if($this->model('Profile_Model')->MinusFollowing() > 0){
            header('Location: '. BASEURL.'/Profile/SellerProfile/'.$Seller_Id);
          }
          else{
            $result = "Unable to update in database";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Profile/SellerProfile/'.$Seller_Id);
          }
        }
        else{
          $result = "Unable to update in database";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Profile/SellerProfile/'.$Seller_Id);
        }
      }
      else{
        $result = "Unable to follow this seller";
        Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Profile/SellerProfile/'.$Seller_Id);
      }
    }
    else{
      $result = "POST ERROR";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Bid/ViewBidproducts');
    }
  }

  //View Current user profile
  public function MyProfile(){
    //Send the data from the url
    $data['title'] = 'Profile';
    //Send the data by using model
    $data['Get_Current_User_Product'] = $this->model('Product_Model')->Get_Current_User_Product();
    $data['Get_Userprofile_Details'] = $this->model('Profile_Model')->getUserDetails();
    $data['Get_Bought_Products'] = $this->model('Product_Model')->Get_Bought_Product();
    $data['Get_Sold_Products'] = $this->model('Product_Model')->Get_Sold_Products();
    $this->view('Templates/Header',$data);
    $this->view('ProfileViews/Profile',$data);
    $this->view('Templates/Footer');
  }

  //View edit page of profile
  public function Edit(){
    //Send the data from the url
    $data['title'] = 'Edit';
    //Send the data by using model
    $data['Get_Userprofile_Details'] = $this->model('Profile_Model')->getUserDetails();
    $data['GetCurrentUserAddress'] = $this->model('Profile_Model')->GetCurrentUserAddress();
    $this->view('Templates/Header',$data);
    $this->view('ProfileViews/EditProfile',$data);
    $this->view('Templates/Footer');
  }

  //Change the password
  public function ChangePassword(){
    //Check whether it is post or not
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      //Check user have insert all data or not
      if(!empty($_POST['C_psw']) && !empty($_POST['N_psw']) && !empty($_POST['R_psw'])){
        //Check strlen > 8
        if(strlen($_POST['N_psw']) >= 8 && strlen($_POST['N_psw']) <= 16 ){
          //Check got character or not
          if (preg_match('/[A-Za-z].*[A-Za-z].*[0-9]|[0-9]/', $_POST['N_psw'])){
            //Check N psw and R psw equal or not
            if ($_POST['N_psw'] == $_POST['R_psw']){
              // Check the current password is correct or not
              if($this->model('Profile_Model')->CheckCurrentPassowrd($_POST) > 0){
                //Update password
                if($this->model('Profile_Model')->UpdatePassword($_POST) > 0){
                  $result = "Update Successfully";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Profile/Edit');
                  exit;
                }
                else{
                  $result = "Update Fail";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Profile/Edit');
                  exit;
                }
              }
              else{
                $result = "Invalid Current Password";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Profile/Edit');
                exit;
              }
            }
            else{
              $result = "New Password not same with Repeat Password";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Profile/Edit');
              exit;
            }
          }
          else{
            $result = "Please make sure Capital Letters and number inside password";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Profile/Edit');
            exit;

          }
        }
        else{
          $result = "Please password more than 8 and less than 16 characters";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Profile/Edit');
          exit;
        }

      }
      else{
        $result = "Please do not leave the input empty";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Profile/Edit');
        exit;
      }
    }
    else{
      $result = "POST ERROR";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Profile/Edit');
      exit;
    }
  }

  //Change profile details
  public function ChangeProfileDetails(){
    //Check whether it is post or not
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      if(!empty($_POST['email']) && !empty($_POST['username'])){
        // This is for user who upload picture
        if(!empty($_FILES['file']['name'])) {

          // Configure upload directory and allowed file types
          $target_dir = "../Public/img/Userprofile/";
          $allowed_types = array('jpg', 'png', 'jpeg', 'gif');

          // Define maxsize for files i.e 2MB
          $maxsize = 2 * 1024 * 1024;

          $file_tmpname = $_FILES['file']['tmp_name'];
          $file_name = $_FILES['file']['name'];
          $file_size = $_FILES['file']['size'];
          $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

          // Set upload file path
          $filepath = $target_dir.$file_name;

          // Verify file size - 2MB max
          if ($file_size > $maxsize)
            echo "Error: File size is larger than the allowed limit.";

          // Check file type is allowed or not
          if(in_array(strtolower($file_ext), $allowed_types)) {
          // If file with name already exist then append time in
          // front of name of the file to avoid overwriting of file
          if(file_exists($filepath)) {

            $filepath = $target_dir.time().$file_name;

            if(move_uploaded_file($file_tmpname, $filepath)) {
              //Update Image
              if ($this->model('Profile_Model')->UpdateImage($filepath) > 0) {

                //Update
                if($this->model('Profile_Model')->UpdateUsernameEmail($_POST) > 0){
                  $result = "Update Successfully";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Profile/Edit');
                  exit;
                }
                else{
                  $result = "Failed to update detail to database";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Profile/Edit');
                  exit;
                }
              }
              else{
                $result = "Failed to upload file to database";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Profile/Edit');
                exit;
              }
            }
            else {
              $result = "Fail to upload file to root folder";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Profile/Edit');
              exit;
            }
          }
          else{
            if( move_uploaded_file($file_tmpname, $filepath)) {

              $filepath = $filepath;

              if ($this->model('Profile_Model')->UpdateImage($filepath) > 0) {
                $result = "Upload Successfully";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Profile/Edit');
              }
              else{
                $result = "Failed to upload file to database";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Profile/Edit');
              }

            }
            else {
              $result = "Fail to upload file to root folder";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Profile/Edit');
            }
          }
          }
          else{
            $result = "Invalid Image file";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Profile/Edit');
          }
        }
        else{
          //This is for user who did not upload any picture
          if($this->model('Profile_Model')->UpdateUsernameEmail($_POST) > 0){
            $result = "Update Successfully";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Profile/Edit');
            exit;
          }
          else{
            $result = "Failed to update detail to database";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Profile/Edit');
            exit;
          }
        }

      }
      else{
        $result = "Please do not leave the input empty";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Profile/Edit');
        exit;
      }
    }
    else{
      $result = "POST ERROR";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Profile/Edit');
      exit;

    }
  }

}
