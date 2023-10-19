<?php

class Comment_Model extends Dbh{

  //This is for the edit comment purpose
  public function Get_Comment_Based_On_Comment_Id($Comment_Id){
    $sql = "SELECT *
            FROM user_comments
            INNER JOIN users
            ON users.user_id = user_comments.User_Id
            WHERE User_Comment_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Comment_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Update the comment based on the updated comment
  public function Update_Comment($data){
    $User_Comment_Id = $data['User_Comment_Id'];
    $Comment = $data['Comment'];
    $sql = "UPDATE user_comments
            SET User_Comment = ?
            WHERE User_Comment_Id = ?";
    $stmt = $this->connect()->prepare($sql);

    $stmt->execute([$Comment, $User_Comment_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->rowCount();
    return $result;
  }

  //Insert the new comment to database
  public function Set_New_Comment($data){
    $User_Comment = $data['Comment'];
    $User_Id = $_SESSION['id'];
    $Product_Id = $data['Product_Id'];
    $sql = "INSERT INTO user_comments(User_Comment,User_Id,Product_Id)
            VALUES (?,?,?)";
    $stmt = $this->connect()->prepare($sql);

    $stmt->bindParam(1, $User_Comment, PDO::PARAM_STR);
    $stmt->bindParam(2, $User_Id, PDO::PARAM_INT);
    $stmt->bindParam(3, $Product_Id, PDO::PARAM_INT);

    $stmt->execute();

    $results = $stmt->rowCount();
    return $results;
  }

  //Get Comment page()
  /*public function Get_Page($Product_Id){
    $sql = "SELECT *
            FROM user_comments
            WHERE Product_Id = ?
            ORDER BY User_Comment_Id DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->rowCount();
    return $result;
  }*/

  //Retrieve comment based on the product id
  public function Get_Comments_Based_On_Id($Product_Id){
    $sql = "SELECT *
            FROM user_comments
            INNER JOIN users
            ON users.user_id = user_comments.User_Id
            WHERE Product_Id = ?
            ORDER BY Comment_DateTime DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  public function Get_Comments_Based_On_User_Id($Product_Id){
    $User_Id = $_SESSION['id'];
    $sql = "SELECT *
            FROM user_comments
            INNER JOIN users
            ON users.user_id = user_comments.User_Id
            WHERE Product_Id = ?
            AND users.user_id = ?
            ORDER BY Comment_DateTime DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Product_Id,$User_Id]);
    //$stmt->fetchColumn();
    $result = $stmt->fetchAll();
    return $result;
  }

  //Delete the comment based on the comment id
  public function Delete_Comment_Based_On_Comment_Id($Delete_Comment_Id){
    $sql = "DELETE
            FROM user_comments
            WHERE User_Comment_Id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$Delete_Comment_Id]);
    //$stmt->fetchColumn();
    $results = $stmt->rowCount();
    return $results;
  }

}
