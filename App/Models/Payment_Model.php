<?php

class Payment_Model extends Dbh{

  //Retrieve prduct details basded on the id
  Public function Get_Product_Based_On_Id($Product_Id){
    $sql = "SELECT *
            FROM products
            INNER JOIN users
            ON users.user_id = products.Product_Seller_Id
            LEFT JOIN products_image
            ON products_image.product_id = products.Product_Id
            WHERE NOW() > Product_End_Session
            AND products.Product_Id in
            (
              select max(products.Product_Id) from products
              group by products.Product_Id
            )
            AND products.product_id = ?
            GROUP BY products.Product_Id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get shipment address based on the user id
  public function Get_Shipment_Address_Based_On_User_Id(){
    $User_Id = $_SESSION['id'];
    $sql = "SELECT *
            FROM user_shipment_address
            INNER JOIN users
            ON users.user_id = user_shipment_address.User_Id
            WHERE user_shipment_address.User_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    $result = $stmt->fetchAll();
    return $result;
  }

  //Check the product before finalization
  public function Check_Product_Final($Product_Id){
    $sql = "SELECT *
            FROM products
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    $result = $stmt->fetchAll();
    return $result;
  }

  //Update the price before payment
  public function Update_Product_Price($Product_sst_tax, $Platfom_fee, $Final_price, $Product_Id){
    $sql = "UPDATE products
            SET product_sst_tax = ?,
                product_platform_tax = ?,
                product_final_price = ?
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);

    $stmt->bindParam(1, $Product_sst_tax, PDO::PARAM_STR);
    $stmt->bindParam(2, $Platfom_fee, PDO::PARAM_STR);
    $stmt->bindParam(3, $Final_price, PDO::PARAM_STR);
    $stmt->bindParam(4, $Product_Id, PDO::PARAM_STR);

    $stmt->execute();

    $results = $stmt->rowCount();
    return $results;
  }

  //Insert new transaction
  public function Set_transaction($Transaction_status){
    $User_Id = $_SESSION['id'];
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
      $ProductId = $values['Product_Id'];
      $sql = "INSERT INTO user_transaction(Product_Id,User_Id,transaction_status)
              VALUES(?,?,?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$ProductId,$User_Id,$Transaction_status]);
      $results = $stmt->rowCount();
      return $results;
    }
  }


}
