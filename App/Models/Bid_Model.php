<?php

class Bid_Model extends Dbh{

  //Insert data for new bid
  public function Set_New_Bid($data){
    $Bid_Price = $data['Bid_Price'];
    $Product_Id = $data['Product_Id'];
    $User_Id = $_SESSION['id'];
    $sql = "INSERT INTO user_bid(Bid_Price,Product_Id,User_Id)
            VALUES (?,?,?)";
    $stmt = $this->connect()->prepare($sql);

    $stmt->bindParam(1, $Bid_Price, PDO::PARAM_STR);
    $stmt->bindParam(2, $Product_Id, PDO::PARAM_INT);
    $stmt->bindParam(3, $User_Id, PDO::PARAM_INT);

    $stmt->execute();

    $results = $stmt->rowCount();
    return $results;
  }

  //Get the user bid id
  public function GetUserBidId(){
    $sql = "SELECT * FROM user_bid ORDER BY User_Bid_Id DESC LIMIT 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
  }

  //Get the highest bid
  public function Get_Highest_Bid($Product_Id){
    $sql = "SELECT Product_Current_Price
            FROM products
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the bid details based on the product id
  public function Get_Bids_Based_On_Id($Product_Id){
    $sql = "SELECT *
            FROM user_bid
            INNER JOIN users
            ON users.user_id = user_bid.User_Id
            WHERE Product_Id = ?
            ORDER BY Bid_Time DESC
            LIMIT 10";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the bid product based on user id
  public function Get_Bid_Products_Based_On_User_Id(){
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
            AND products.products_final_status IS NULL
            GROUP BY products.Product_Id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the bid product based on user id
  public function Get_Bid_Products_get_beat(){
    $User_Id = $_SESSION['id'];
    $sql = "SELECT *
            FROM products
            INNER JOIN users
            ON users.user_id = products.Product_Seller_Id
            INNER JOIN user_bid
            ON user_bid.User_Id = users.user_id
            LEFT JOIN products_image
            ON products_image.product_id = products.Product_Id
            WHERE NOW() > Product_End_Session
            AND products.Product_Id in
            (
              select max(products.Product_Id) from products
              group by products.Product_Id
            )
            AND user_bid.User_Id = ?
            AND products.products_final_status IS NULL
            GROUP BY products.Product_Id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  /*public function Update_Post_Bid_Product_Status(){
    $User_Id = $_SESSION['id'];
    $sql = "UPDATE products
            SET Product_Name = ?
            WHERE NOW() > Product_End_Session
            AND Top_Bidder_User_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->rowCount();
    return $result;
  }*/

}
