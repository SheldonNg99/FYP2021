<?php

class Product_Model extends Dbh{

  //Get more product on the below
  public function Get_More_Products(){
    $sql = "SELECT *
            FROM products
            INNER JOIN products_status
            ON products_status.product_status_id = products.product_status
            LEFT JOIN products_image
            ON products_image.product_id = products.Product_Id
            WHERE products.Product_Id in
            (
              select max(products.Product_Id) from products
              group by products.Product_Id
            )
            GROUP BY products.Product_Id
            LIMIT 20";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the current user product
  public function Get_Current_User_Product(){
    $User_Id = $_SESSION['id'];
    $sql = "SELECT *
            FROM products
            INNER JOIN products_status
            ON products_status.product_status_id = products.product_status
            LEFT JOIN products_image
            ON products_image.product_id = products.Product_Id
            WHERE products.Product_Id in
            (
              select max(products.Product_Id) from products
              group by products.Product_Id
            )
            AND Product_Seller_Id = ?
            GROUP BY products.Product_Id DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the current seller product
  public function Get_Current_Seller_Products($Seller_Id){
    $sql = "SELECT *
            FROM products
            INNER JOIN products_status
            ON products_status.product_status_id = products.product_status
            LEFT JOIN products_image
            ON products_image.product_id = products.Product_Id
            WHERE products.Product_Id in
            (
              select max(products.Product_Id) from products
              group by products.Product_Id
            )
            AND Product_Seller_Id = ?
            GROUP BY products.Product_Id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Seller_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get product details based on user id
  Public function Get_Product_Based_On_User_Id($User_Id){
    $sql = "SELECT *
            FROM products
            WHERE Product_Seller_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get product based on product id
  Public function Get_Product_Based_On_Id($Product_Id){
    $sql = "SELECT *
            FROM products
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the username of bidder based on the product id
  public function Get_Bid_Name_Based_On_Id($Product_Id){
    $sql = "SELECT *
            FROM products
            INNER JOIN users
            ON users.user_id = products.Top_Bidder_User_Id
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the product image based on product id
  public function Get_Product_Image_Based_On_Id($Product_Id){
    $sql = "SELECT *
            FROM products_image
            WHERE product_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the userprofile based on product id
  public function Get_Userprofile_Based_On_Id($Product_Id){
    $sql = "SELECT *
            FROM products
            INNER JOIN users
            ON users.user_id = products.Product_Seller_Id
            WHERE product_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the status of the product
  public function Get_Product_Status(){
    $sql = "SELECT * FROM products_status";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the condition of the product
  public function Get_Product_Condition(){
    $sql = "SELECT * FROM products_condition";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get the category of the product
  public function Get_Product_Category(){
    $sql = "SELECT * FROM category";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Insert the new product to database
  public function Add_Product($data){
    $product_name = $data['product_name'];
    $product_condition = $data['product_condition'];
    $product_quantity = $data['product_quantity'];
    $product_category = $data['product_category'];
    $product_status = $data['product_status'];
    $product_material = $data['product_material'];
    $Product_Author = $data['Product_Author'];
    $Year_Of_Published = $data['Year_Of_Published'];
    $Product_Start_Session = $data['Product_Start_Session'];
    $Product_End_Session = $data['Product_End_Session'];
    $Num_Of_Bidder = 0;
    $Num_Of_Bids = 0;
    $Product_Current_Price = $data['Initial_Price'];

    $Initial_Price = $data['Initial_Price'];
    $Product_Authenticity = "Haven't Verify";

    $Product_Seller_Id = $_SESSION['id'];

    $sql = "INSERT INTO products(
            Product_Name,Product_Condition,Product_Quantity,Product_Material,Product_Author,
            Year_Of_Published,Product_Authenticity,Product_Category,Product_Start_Session,
            Product_End_Session,Num_Of_Bidder,Num_Of_Bids,Product_Current_Price,Product_Initial_Price,
            Product_Seller_Id,product_status)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$product_name,$product_condition,$product_quantity,$product_material,$Product_Author,
                    $Year_Of_Published,$Product_Authenticity,$product_category,$Product_Start_Session,
                    $Product_End_Session,$Num_Of_Bidder,$Num_Of_Bids,$Product_Current_Price,$Initial_Price,
                    $Product_Seller_Id,$product_status]);
    //Row count to count the row
    $results = $stmt->rowCount();
    return $results;
  }

  //Get the lastes id of product
  public function GetProductId(){
    $sql = "SELECT Product_Id FROM products ORDER BY Product_Id DESC LIMIT 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    if($results > 0){
      foreach($results as $result){
        $results = $result['Product_Id'];
      }
    }
    else{
      $results = 0;
    }
    return $results;
  }

  //Add picture to database
  public function Add_Picture($Image_Path, $Product_Id){
    $sql = "INSERT INTO products_image(products_image_path,product_id) VALUES (?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Image_Path,$Product_Id]);
    //Row count to count the row
    $results = $stmt->rowCount();
    return $results;

  }

  //Get the picture from database
  public function Get_Image_Path_Based_On_Id($id){
    $sql = "SELECT *
            FROM products_image
            WHERE products_image_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    //$stmt->fetchColumn();
    $results = $stmt->fetchAll();
    if($results > 0){
      foreach($results as $result){
        return $result['products_image_path'];
      }
    }
    else{
      return 0;
    }
  }

  //Get muliple image from database based on product id
  public function Get_Multiple_Images_Path_Based_On_Product_Id($id){
    $sql = "SELECT *
            FROM products_image
            WHERE product_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    //$stmt->fetchColumn();
    $results = $stmt->fetchAll();
    return $results;
  }

  //Delete images based on product id
  public function Delete_Images_Based_On_Product_Id($id){
    $sql = "DELETE
            FROM products_image
            WHERE product_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    //$stmt->fetchColumn();
    $results = $stmt->rowCount();
    return $results;
  }

  //Delete product image form database based on image id
  public function Delete_Product_Image($id){
    $sql = "DELETE
            FROM products_image
            WHERE products_image_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    //$stmt->fetchColumn();
    $results = $stmt->rowCount();
    return $results;
  }

  //Delete product
  public function Delete_Product($id){
    $sql = "DELETE
            FROM products
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);

    $results = $stmt->rowCount();
    return $results;
  }

  //Check user bid before delete
  public function Check_Bid_Delete($id){
    $sql = "SELECT *
            FROM user_bid
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    //$stmt->fetchColumn();
    $results = $stmt->rowCount();
    return $results;
  }

  //Delete user bid
  public function Delete_User_Bid_Product($id){
    $sql = "DELETE
            FROM user_bid
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    //$stmt->fetchColumn();
    $results = $stmt->rowCount();
    return $results;
  }

  //Check user comment before delete
  public function Check_Comment_Delete($id){
    $sql = "SELECT *
            FROM user_comments
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    //$stmt->fetchColumn();
    $results = $stmt->rowCount();
    return $results;
  }

  //Delete user commment
  public function Delete_User_comment_Product($id){
    $sql = "DELETE
            FROM user_comments
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    //$stmt->fetchColumn();
    $results = $stmt->rowCount();
    return $results;
  }

  //Update the product details
  public function Update_Product_Details($data){
    $product_id = $data['product_id'];
    $product_name = $data['product_name'];
    $product_condition = $data['product_condition'];
    $product_quantity = $data['product_quantity'];
    $product_category = $data['product_category'];
    $product_status = $data['product_status'];
    $product_material = $data['product_material'];
    $Product_Author = $data['Product_Author'];
    $Year_Of_Published = $data['Year_Of_Published'];
    $Product_Start_Session = $data['Product_Start_Session'];
    $Product_End_Session = $data['Product_End_Session'];
    $Initial_Price = $data['Initial_Price'];

    $sql = "UPDATE products
            SET Product_Name = ?,
                Product_Condition = ?,
                Product_Quantity = ?,
                Product_Category = ?,
                product_status = ?,
                Product_Material = ?,
                Product_Author = ?,
                Year_Of_Published = ?,
                Product_Start_Session = ?,
                Product_End_Session = ?,
                Product_Initial_Price = ?
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);

    $stmt->bindParam(1, $product_name, PDO::PARAM_STR);
    $stmt->bindParam(2, $product_condition, PDO::PARAM_STR);
    $stmt->bindParam(3, $product_quantity, PDO::PARAM_STR);
    $stmt->bindParam(4, $product_category, PDO::PARAM_STR);
    $stmt->bindParam(5, $product_status, PDO::PARAM_STR);
    $stmt->bindParam(6, $product_material, PDO::PARAM_STR);
    $stmt->bindParam(7, $Product_Author, PDO::PARAM_STR);
    $stmt->bindParam(8, $Year_Of_Published, PDO::PARAM_STR);
    $stmt->bindParam(9, $Product_Start_Session, PDO::PARAM_STR);
    $stmt->bindParam(10, $Product_End_Session, PDO::PARAM_STR);
    $stmt->bindParam(11, $Initial_Price, PDO::PARAM_STR);
    $stmt->bindParam(12, $product_id, PDO::PARAM_STR);

    $stmt->execute();

    $results = $stmt->rowCount();
    return $results;

  }

  //Update picture
  public function Update_Picture($Image_Path, $data){
    $product_id = $data['product_id'];
    $sql = "INSERT INTO products_image(products_image_path,product_id) VALUES (?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Image_Path,$product_id]);
    //Row count to count the row
    $results = $stmt->rowCount();
    return $results;
  }

  //Update bid user
  public function Update_Bid_User_Product($data, $Num_Of_Bid, $Num_Of_Bidder){
    $Bid_Price = $data['Bid_Price'];
    $Product_Id = $data['Product_Id'];
    $User_Id = $_SESSION['id'];

    $sql = "UPDATE products
            SET Product_Current_Price = ?,
                Top_Bidder_User_Id = ?,
                Num_Of_Bids = ?,
                Num_Of_Bidder = ?
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);

    $stmt->bindParam(1, $Bid_Price, PDO::PARAM_STR);
    $stmt->bindParam(2, $User_Id, PDO::PARAM_INT);
    $stmt->bindParam(3, $Num_Of_Bid, PDO::PARAM_INT);
    $stmt->bindParam(4, $Num_Of_Bidder, PDO::PARAM_INT);
    $stmt->bindParam(5, $Product_Id, PDO::PARAM_INT);

    $stmt->execute();

    $results = $stmt->rowCount();
    return $results;
  }

  //Count the number of bid based on the product id
  public function Count_Num_Of_Bid($data){
    $Product_Id = $data['Product_Id'];

    $sql = "SELECT COUNT(User_Bid_Id) AS Num_Of_Bid
            FROM user_bid
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);

    $stmt->bindParam(1, $Product_Id, PDO::PARAM_INT);

    $stmt->execute();

    $results = $stmt->fetchAll();

    if($results > 0){
      foreach($results as $result){
        $results = $result['Num_Of_Bid'];
      }
    }
    else{
      $results = 0;
    }
    return $results;
  }

  //Count the number of the bidder based on the product id
  public function Count_Num_Of_Bidder($data){
    $Product_Id = $data['Product_Id'];

    $sql = "SELECT COUNT(DISTINCT User_Id) AS Num_Of_Bidder
            FROM user_bid
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);

    $stmt->bindParam(1, $Product_Id, PDO::PARAM_INT);

    $stmt->execute();

    $results = $stmt->fetchAll();

    if($results > 0){
      foreach($results as $result){
        $results = $result['Num_Of_Bidder'];
      }
    }
    else{
      $results = 0;
    }
    return $results;
  }

  //Update the product status to paid
  public function UpdateProductStatus(){
    $Product_Status = "Paid";
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
      $ProductId = $values['Product_Id'];

      $sql = "UPDATE products
              SET products_final_status = ?
              WHERE Product_Id = ?";

      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(1, $Product_Status, PDO::PARAM_STR);
      $stmt->bindParam(2, $ProductId, PDO::PARAM_INT);
      $stmt->execute();

      $results = $stmt->rowCount();
      return $results;
    }
  }

  //Update the product status to shipping
  public function UpdateProductShipmentStatus($data){
    $products_final_status = "Shipping";
    $Product_id = $data['Product_id'];
    $sql = "UPDATE products
            SET products_final_status = ?
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$products_final_status,$Product_id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Update the product status to delivered
  public function UpdateProductShipmentDeliveredStatus($data){
    $products_final_status = "Delivered";
    $Product_id = $data['Product_id'];
    $sql = "UPDATE products
            SET products_final_status = ?
            WHERE Product_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$products_final_status,$Product_id]);
    $results = $stmt->rowCount();
    return $results;
  }

  //Get user bought products
  public function Get_Bought_Product(){
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
            AND (products.products_final_status = 'Delivered'
            OR products.products_final_status = 'Paid'
            OR products.products_final_status = 'Shipping')
            GROUP BY products.Product_Id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Get user sold products
  public function Get_Sold_Products(){
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
            AND (products.products_final_status = 'Delivered'
            OR products.products_final_status = 'Paid'
            OR products.products_final_status = 'Shipping')
            GROUP BY products.Product_Id";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }


}
