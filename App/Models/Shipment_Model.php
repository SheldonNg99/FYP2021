<?php

class Shipment_Model extends Dbh{

  public function Set_User_Shipment_Detail(){
    $sql = "SELECT * FROM users";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;

  }
  //Select product which is paid
  public function Get_Shipment_Products(){
    $User_Id = $_SESSION['id'];
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
            AND Product_Seller_Id = ?
            AND products.products_final_status = 'Paid'
            GROUP BY products.Product_Id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Select product pending for receive
  public function Get_Receive_Products(){
    $User_Id = $_SESSION['id'];
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
            AND Top_Bidder_User_Id = ?
            AND products.products_final_status = 'Shipping'
            GROUP BY products.Product_Id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

}
