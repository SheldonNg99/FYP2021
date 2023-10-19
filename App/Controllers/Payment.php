<?php

class Payment extends Controller{

  //Calculate the price of the product before payment
  public function PrePayment(){
    //Send the data from the url
    $data['title'] = 'Product';
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Product_Id = $_POST['Product_Id'];
      //Send the data by using model
      $data['Check_Product_Final'] = $this->model('Payment_Model')->Check_Product_Final($Product_Id);
      if ($data['Check_Product_Final'] > 0) {
        foreach ($data['Check_Product_Final'] as $Product_final) {
          if ($Product_final['product_final_price'] == NULL) {
            // Product sst tax is 6% : Product Price X 6%
            $Product_sst_tax = $Product_final['Product_Current_Price'] * 0.06;
            // Platform fee is 10%: Product Price X 10%
            $Platfom_fee = $Product_final['Product_Current_Price'] * 0.10;
            // Final Price = Product Current Price + Product sst tax + Platform fee + Shipment Fee
            $Final_price = $Product_final['Product_Current_Price'] + $Product_sst_tax + $Platfom_fee + $Product_final['product_shipment_fee'];
            if ($this->model('Payment_Model')->Update_Product_Price($Product_sst_tax, $Platfom_fee, $Final_price, $Product_Id) > 0) {
              $data['Product_Details'] = $this->model('Payment_Model')->Get_Product_Based_On_Id($Product_Id);
              $data['Get_Shipment_Address_Based_On_User_Id'] = $this->model('Payment_Model')->Get_Shipment_Address_Based_On_User_Id();
              $this->view('Templates/Header',$data);
              $this->view('PaymentViews/Payment',$data);
              $this->view('Templates/Footer');
            }
            else{
              $result = "Unable to update final price 1";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Bid/ViewBidproducts');
            }
          }
          else{
            $data['Product_Details'] = $this->model('Payment_Model')->Get_Product_Based_On_Id($Product_Id);
            $data['Get_Shipment_Address_Based_On_User_Id'] = $this->model('Payment_Model')->Get_Shipment_Address_Based_On_User_Id();
            $this->view('Templates/Header',$data);
            $this->view('PaymentViews/Payment',$data);
            $this->view('Templates/Footer');
          }
        }
      }
      else{
        $result = "Invalid Product";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Bid/ViewBidproducts');
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Bid/ViewBidproducts');
    }
  }

  //Make payment with paypal
  public function PaypalPayment(){
    $data['title'] = 'Product';
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $data['title'] = 'Product';
      $Product_Id = $_POST['Product_Id'];
      //Send the data by using model
      $data['Check_Product_Final'] = $this->model('Payment_Model')->Check_Product_Final($Product_Id);
      if ($data['Check_Product_Final'] > 0) {
        foreach ($data['Check_Product_Final'] as $Product_final) {
          if ($Product_final['product_final_price'] == NULL) {
            // Product sst tax is 6% : Product Price X 6%
            $Product_sst_tax = $Product_final['Product_Current_Price'] * 0.06;
            // Platform fee is 10%: Product Price X 10%
            $Platfom_fee = $Product_final['Product_Current_Price'] * 0.10;
            // Final Price = Product Current Price + Product sst tax + Platform fee + Shipment Fee
            $Final_price = $Product_final['Product_Current_Price'] + $Product_sst_tax + $Platfom_fee + $Product_final['product_shipment_fee'];
            if ($this->model('Payment_Model')->Update_Product_Price($Product_sst_tax, $Platfom_fee, $Final_price, $Product_Id) > 0) {
              $this->model('Payment_Model')->Get_Product_Based_On_Id($Product_Id);
              $this->model('Payment_Model')->Get_Shipment_Address_Based_On_User_Id();
              $this->view('Templates/Header');
              $this->view('PaymentViews/PaypalPayment');
              $this->view('Templates/Footer');
            }
            else{
              header('Location: '. BASEURL.'/Bid/ViewBidproducts');
            }
          }
          else{
            $data['Product_Details'] = $this->model('Payment_Model')->Get_Product_Based_On_Id($Product_Id);
            $data['Get_Shipment_Address_Based_On_User_Id'] = $this->model('Payment_Model')->Get_Shipment_Address_Based_On_User_Id();
            $this->view('Templates/Header');
            $this->view('PaymentViews/PaypalPayment');
            $this->view('Templates/Footer');
          }
        }
      }
      else{
        $result = "Invalid Product";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Bid/ViewBidproducts');
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Bid/ViewBidproducts');
    }
  }

  //Add the product from cart
  public function AddtoCart(){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $Product_Id = $_POST['Product_Id'];
      $Product_Name = $_POST['Product_Name'];
      $Product_Current_Price = $_POST['Product_Current_Price'];

      $data['Check_Product_Final'] = $this->model('Payment_Model')->Check_Product_Final($Product_Id);
      if ($data['Check_Product_Final'] > 0) {
        foreach ($data['Check_Product_Final'] as $Product_final) {
          if ($Product_final['product_final_price'] == NULL) {
            // Product sst tax is 6% : Product Price X 6%
            $Product_sst_tax = $Product_final['Product_Current_Price'] * 0.06;
            // Platform fee is 10%: Product Price X 10%
            $Platfom_fee = $Product_final['Product_Current_Price'] * 0.03;
            // Final Price = Product Current Price + Product sst tax + Platform fee + Shipment Fee
            $Final_price = $Product_final['Product_Current_Price'] + $Product_sst_tax + $Platfom_fee + $Product_final['product_shipment_fee'];
            if ($this->model('Payment_Model')->Update_Product_Price($Product_sst_tax, $Platfom_fee, $Final_price, $Product_Id) > 0) {
              $data['Product_Details'] = $this->model('Payment_Model')->Get_Product_Based_On_Id($Product_Id);
              foreach ($data['Product_Details'] as $Products) {
                if(isset($_SESSION["shopping_cart"])){
                  $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                  if(!in_array($Product_Id, $item_array_id)){
                    $count = count($_SESSION["shopping_cart"]);
                    $item_array = array(
                      'Product_Id'	 =>	$Product_Id,
                      'Product_Name' => $Product_Name,
                      'Product_Current_Price' => $Product_Current_Price,
                      'product_shipment_fee' => $Products['product_shipment_fee'],
                      'product_sst_tax' => $Products['product_sst_tax'],
                      'product_platform_tax' => $Products['product_platform_tax'],
                      'product_final_price' => $Products['product_final_price'],
                      'product_image_path' => $Products['products_image_path']
                    );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                    header('Location: '. BASEURL.'/Bid/ViewBidproducts');
                  }
                  else{
                    $result = "Item Already Added";
                    Flasher::setFlash($result, 'Failed', 'danger');
                    header('Location: '. BASEURL.'/Bid/ViewBidproducts');
                  }
                }
                else{
                  $item_array = array(
                    'Product_Id'	 =>	$Product_Id,
                    'Product_Name' => $Product_Name,
                    'Product_Current_Price' => $Product_Current_Price,
                    'product_shipment_fee' => $Products['product_shipment_fee'],
                    'product_sst_tax' => $Products['product_sst_tax'],
                    'product_platform_tax' => $Products['product_platform_tax'],
                    'product_final_price' => $Products['product_final_price'],
                    'product_image_path' => $Products['products_image_path']
                  );
                  $_SESSION["shopping_cart"][$count] = $item_array;
                  header('Location: '. BASEURL.'/Bid/ViewBidproducts');
                }
              }
            }
            else{
              $result = "Unable to update final price 1 2";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Bid/ViewBidproducts');
            }
          }
          else{
            // Product sst tax is 6% : Product Price X 6%
            $Product_sst_tax = $Product_final['Product_Current_Price'] * 0.06;
            // Platform fee is 10%: Product Price X 10%
            $Platfom_fee = $Product_final['Product_Current_Price'] * 0.03;
            // Final Price = Product Current Price + Product sst tax + Platform fee + Shipment Fee
            $Final_price = $Product_final['Product_Current_Price'] + $Product_sst_tax + $Platfom_fee + $Product_final['product_shipment_fee'];
            if ($this->model('Payment_Model')->Update_Product_Price($Product_sst_tax, $Platfom_fee, $Final_price, $Product_Id) > 0) {
              $data['Product_Details'] = $this->model('Payment_Model')->Get_Product_Based_On_Id($Product_Id);
              foreach ($data['Product_Details'] as $Products) {
                if(isset($_SESSION["shopping_cart"])){
                  $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                  if(!in_array($Product_Id, $item_array_id)){
                    $count = count($_SESSION["shopping_cart"]);
                    $item_array = array(
                      'Product_Id'	 =>	$Product_Id,
                      'Product_Name' => $Product_Name,
                      'Product_Current_Price' => $Product_Current_Price,
                      'product_shipment_fee' => $Products['product_shipment_fee'],
                      'product_sst_tax' => $Products['product_sst_tax'],
                      'product_platform_tax' => $Products['product_platform_tax'],
                      'product_final_price' => $Products['product_final_price'],
                      'product_image_path' => $Products['products_image_path']
                    );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                    header('Location: '. BASEURL.'/Bid/ViewBidproducts');
                  }
                  else{
                    $result = "Item Already Added";
                    Flasher::setFlash($result, 'Failed', 'danger');
                    header('Location: '. BASEURL.'/Bid/ViewBidproducts');
                  }
                }
                else{
                  $item_array = array(
                    'Product_Id'	 =>	$Product_Id,
                    'Product_Name' => $Product_Name,
                    'Product_Current_Price' => $Product_Current_Price,
                    'product_shipment_fee' => $Products['product_shipment_fee'],
                    'product_sst_tax' => $Products['product_sst_tax'],
                    'product_platform_tax' => $Products['product_platform_tax'],
                    'product_final_price' => $Products['product_final_price'],
                    'product_image_path' => $Products['products_image_path']
                  );
                  $_SESSION["shopping_cart"][$count] = $item_array;
                  header('Location: '. BASEURL.'/Bid/ViewBidproducts');
                }
              }
            }
            else{
              $data['Product_Details'] = $this->model('Payment_Model')->Get_Product_Based_On_Id($Product_Id);
              foreach ($data['Product_Details'] as $Products) {
                if(isset($_SESSION["shopping_cart"])){
                  $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                  if(!in_array($Product_Id, $item_array_id)){
                    $count = count($_SESSION["shopping_cart"]);
                    $item_array = array(
                      'Product_Id'	 =>	$Product_Id,
                      'Product_Name' => $Product_Name,
                      'Product_Current_Price' => $Product_Current_Price,
                      'product_shipment_fee' => $Products['product_shipment_fee'],
                      'product_sst_tax' => $Products['product_sst_tax'],
                      'product_platform_tax' => $Products['product_platform_tax'],
                      'product_final_price' => $Products['product_final_price'],
                      'product_image_path' => $Products['products_image_path']
                    );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                    header('Location: '. BASEURL.'/Bid/ViewBidproducts');
                  }
                  else{
                    $result = "Item Already Added";
                    Flasher::setFlash($result, 'Failed', 'danger');
                    header('Location: '. BASEURL.'/Bid/ViewBidproducts');
                  }
                }
                else{
                  $item_array = array(
                    'Product_Id'	 =>	$Product_Id,
                    'Product_Name' => $Product_Name,
                    'Product_Current_Price' => $Product_Current_Price,
                    'product_shipment_fee' => $Products['product_shipment_fee'],
                    'product_sst_tax' => $Products['product_sst_tax'],
                    'product_platform_tax' => $Products['product_platform_tax'],
                    'product_final_price' => $Products['product_final_price'],
                    'product_image_path' => $Products['products_image_path']
                  );
                  $_SESSION["shopping_cart"][$count] = $item_array;
                  header('Location: '. BASEURL.'/Bid/ViewBidproducts');
                }
              }
            }
          }
        }
      }
      else{
        $result = "Invalid Product";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Bid/ViewBidproducts');
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Bid/ViewBidproducts');
    }
  }

  //Delete product from the cart
  public function DeletefromCart(){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Product_Id = $_POST['Product_Id'];
      foreach($_SESSION["shopping_cart"] as $keys => $values)
      {
        if($values["Product_Id"] == $Product_Id)
        {
          unset($_SESSION["shopping_cart"][$keys]);
          header('Location: '. BASEURL.'/Bid/ViewBidproducts');
        }
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Bid/ViewBidproducts');
    }
  }

  //Redirect to Success page when the payment is done successfully
  public function SeccessPayment(){
    $Transaction_status = "Success";
    if ($this->model('Payment_Model')->Set_transaction($Transaction_status) > 0) {
      if ($this->model('Product_Model')->UpdateProductStatus() > 0) {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
          unset($_SESSION["shopping_cart"][$keys]);
          $result = "Success";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Shipment/Shipment');
        }
      }
      else{
        $result = "Failed to upload success status product in database";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Bid/ViewBidproducts');
      }
    }
    else{
      $result = "Failed to upload success payment in database";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Bid/ViewBidproducts');
    }
  }

  //Redirect to Failed page when the payment is fail
  public function CancelPayment(){
    $result = "Transaction Failed";
    Flasher::setFlash($result, 'Failed', 'danger');
    header('Location: '. BASEURL.'/Bid/ViewBidproducts');
  }
}
