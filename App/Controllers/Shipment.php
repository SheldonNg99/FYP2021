<?php

class Shipment extends Controller{

  //View shipment page
  public function index(){
    //Send the data from the url
    $data['title'] = 'Shipment';
    //Send the data by using model
    $data['Get_Shipment_Products'] = $this->model('Shipment_Model')->Get_Shipment_Products();
    $data['Get_Receive_Products'] = $this->model('Shipment_Model')->Get_Receive_Products();
    $data['Get_Shipment_User'] = $this->model('Shipment_Model')->Set_User_Shipment_Detail();
    $this->view('Templates/Header',$data);
    $this->view('ShipmentViews/ViewShipment',$data);
    $this->view('Templates/Footer');
  }

  //Update product status to shipping
  public function UpdateProductShipmentStatus(){
    $data['title'] = 'Ship';
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      if($this->model('Product_Model')->UpdateProductShipmentStatus($_POST) > 0){
        header('Location: '. BASEURL.'/Shipment/Shipment');
      }
      else{
        $result = "Unable to update shipment status in database";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Shipment/Shipment');
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Shipment/Shipment');
    }
  }

  //Update product status to delivered
  public function UpdateProductShipmentDeliveredStatus(){
    $data['title'] = 'Ship';
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      if($this->model('Product_Model')->UpdateProductShipmentDeliveredStatus($_POST) > 0){
        header('Location: '. BASEURL.'/Shipment/Shipment');
      }
      else{
        $result = "Unable to update shipment status in database";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Shipment/Shipment');
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Shipment/Shipment');
    }
  }
}
