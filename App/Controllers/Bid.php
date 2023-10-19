<?php

class Bid extends Controller{

  /*Create new Bid*/
  public function Create_New_Bid(){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Product_Id = $_POST['Product_Id'];
      $Current_Price = $_POST['Bid_Price'];
      //Check Whether current Price is higher that current price in database
      if(empty($_SESSION['id'])){
        $result = "Please login to place a bid";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Authenticate/Login');
      }
      else{
        //Check Product Status
        $results = $this->model('Product_Model')->Get_Product_Based_On_Id($Product_Id);
        if($results > 0){
          foreach ($results as $Product) {
            if($Product['product_status'] == 2){
              $result = "Current Product is unable to bid";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
            }
            else{
              $results = $this->model('Bid_Model')->Get_Highest_Bid($Product_Id);
              if($results > 0){
                foreach ($results as $result) {
                  if ($Current_Price > $result['Product_Current_Price']) {
                    // Create new Bid
                    if($this->model('Bid_Model')->Set_New_Bid($_POST) > 0){
                      // Update Bid into Product table
                      $Num_Of_Bid = $this->model('Product_Model')->Count_Num_Of_Bid($_POST);
                      $Num_Of_Bidder = $this->model('Product_Model')->Count_Num_Of_Bidder($_POST);
                      if($this->model('Product_Model')->Update_Bid_User_Product($_POST, $Num_Of_Bid, $Num_Of_Bidder) > 0){
                        $result = "Place Bid Successfully";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
                      }
                      else{
                        $result = "Unable to update Bid into Product table";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
                      }
                    }
                    else{
                      $result = "Unable to Insert Bid into Database";
                      Flasher::setFlash($result, 'Failed', 'danger');
                      header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
                    }
                  }
                  else{
                    $result = "Price Must More Than RM".$result['Product_Current_Price'];
                    Flasher::setFlash($result, 'Failed', 'danger');
                    header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
                  }
                }
              }
              else{
                $result = "Invalid Current Price";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
          }
        }
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Product/Myproducts');
    }
  }

  //Redirect to View Bidded product page
  public function ViewBidproducts(){
    //Send the data from the url
    $data['title'] = 'Bid Product';
    //Update the status of the Bid product
    /*$this->model('Bid_Moddel')->Update_Post_Status_Products();*/
    //Send the data by using model
    $data['Get_Bid_Products_Based_On_User_Id'] = $this->model('Bid_Model')->Get_Bid_Products_Based_On_User_Id();
    $this->view('Templates/Header',$data);
    $this->view('ProductViews/ViewBproducts',$data);
    $this->view('Templates/Footer');
  }

  public function ViewmyBid(){
    //Send the data from the url
    $data['title'] = 'Bid Product';
    //Update the status of the Bid product
    /*$this->model('Bid_Moddel')->Update_Post_Status_Products();*/
    //Send the data by using model
    $data['Get_Bid_Products_get_beat'] = $this->model('Bid_Model')->Get_Bid_Products_get_beat();
    $this->view('Templates/Header',$data);
    $this->view('ProductViews/ViewBBproducts',$data);
    $this->view('Templates/Footer');
  }
}
