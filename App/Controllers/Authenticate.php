<?php

class Authenticate extends Controller{

  //Redirect to Login page
  public function Login(){
    //Send the data from the url
    $data['title'] = 'Dash';
    //Send the data by using model
    $this->view('Templates/AuthenticateHeader',$data);
    $this->view('AuthenticateViews/Login',$data);
  }

  // User Login action
  public function UserLogin(){
    //Check whether it is post or not
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      //Check user have insert all data or not
      if(!empty($_POST['username']) && !empty($_POST['psw'])){
        // Proceed to login process
        if($this->model('Authenticate_Model')->userlogin($_POST) > 0){
          //$result = "Login Successfully";
          //Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Profile/MyProfile');
          exit;
        }
        else{
          $result = "Invalid Username or Password";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Authenticate/Login');
          exit;
        }
      }
      else{
        $result = "Please do not leave the input empty";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Authenticate/Login');
        exit;
      }
    }
    else{
      $result = "POST ERROR";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Authenticate/Login');
      exit;
    }
  }

  //Redirect to register page
  public function Register(){
    //Send the data from the url
    $data['title'] = 'Dash';
    //Send the data by using model
    $this->view('Templates/AuthenticateHeader',$data);
    $this->view('AuthenticateViews/Register',$data);
  }

  //User register action
  public function UserRegister(){
    //Check whether it is post or not
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      //Check user have insert all or not
      if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['psw']) && !empty($_POST['psw-repeat'])){
        // Check valid email or not
        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
          // Check uniqueness of email
          if($this->model('Authenticate_Model')->validateemail($_POST) == 0){
            // Check uniquess of username
            if($this->model('Authenticate_Model')->validateusername($_POST) == 0){
              // Register the user
              if($this->model('Authenticate_Model')->userregister($_POST) > 0){
                // Register successfully
                $result = "Register Successfully";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Authenticate/Register');
                exit;
              }
              else{
                $result = "Register Fail";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Authenticate/Register');
                exit;
              }
            }
            else{
              $result = "This username has been taken";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Authenticate/Register');
              exit;
            }
          }
          else{
            $result = "This email has been register";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Authenticate/Register');
            exit;
          }
        }
        else{
          $result = "Invalid Email";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Authenticate/Register');
          exit;
        }
      }
      else{
        $result = "Please do not leave the input empty";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Authenticate/Register');
        exit;
      }
    }
    else{
      $result = "POST ERROR";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Authenticate/Register');
      exit;
    }
  }

  //User Logout action
  public function UserLogout(){
    session_start();
    session_destroy();
    // Redirect to the Home page:
    header('Location: '. BASEURL.'/Authenticate/Login');
  }

}
