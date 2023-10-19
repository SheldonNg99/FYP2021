<?php

class Comment extends Controller{

  //Redirect to View Edit Comment page
  public function Edit(){
    $data['title'] = 'Product';

    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Edit_Comment_Id = $_POST['Edit_Comment_Id'];
      $data['Get_Comment_Based_On_Comment_Id'] = $this->model('Comment_Model')->Get_Comment_Based_On_Comment_Id($Edit_Comment_Id);
      $this->view('Templates/Header',$data);
      $this->view('CommentViews/EditComment',$data);
      $this->view('Templates/Footer');
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Product/Myproducts');
    }
  }

  //Edit Comment
  public function EditComment(){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Product_Id = $_POST['Product_Id'];
      if($this->model('Comment_Model')->Update_Comment($_POST) > 0){
        $result = "Update Comment Successfully";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
      }
      else{
        $result = "Failed to Update Comment";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Product/Myproducts');
    }
  }

  //Add Comment
  public function AddComment(){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Product_Id = $_POST['Product_Id'];
      if(!empty($_POST['Comment'])) {
        if($this->model('Comment_Model')->Set_New_Comment($_POST) > 0){
          header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
        }
        else{
          $result = "Failed to comment";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
        }
      }
      else{
        $result = "Failed to comment";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Product/Myproducts');
    }
  }

  //Delete Comment
  public function DeleteComment(){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Product_Id = $_POST['Product_Id'];
      $Delete_Comment_Id = $_POST['Delete_Comment_Id'];
      if($this->model('Comment_Model')->Delete_Comment_Based_On_Comment_Id($Delete_Comment_Id) > 0){
        $result = "Comment Deleted";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
      }
      else{
        $result = "Failed to Delete comment";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Product/Viewproduct/'.$Product_Id);
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Product/Myproducts');
    }
  }

  //Comment Pagination
  /*public function Commentpagination(){
    $record_per_page = 5;
    $page = '';
    $output = '';
    if(isset($_POST["page"])){
      $page = $_POST["page"];
    }
    else{
      $page = 1;
    }
    $start_from = ($page - 1)*$record_per_page;
    foreach($data['Get_Comments_Based_On_Id'] as $Comment){
      $output .= '
      <div class="D_View_Review_Wrapper">
          <div class="D_Review_Datetime_Detail_Wrapper">
            <div class="D_Review_Datetime_Wrapper">
              <span><?= $Comment["user_name"];  ?></span> Comment on <?= $Comment['Comment_DateTime']; ?>
            </div>
            <div class="D_Review_Btns_Wrapper">
              <form class="" action="<?= BASEURL; ?>/Comment/Edit" method="post">
                  <button class="Review_Buttons_100" type="submit" name="Edit_Comment_Id" value="<?= $Comment['User_Comment_Id']; ?>"><i class="fa fa-edit"></i></button>
              </form>
              <form class="" action="<?= BASEURL; ?>/Comment/DeleteComment" method="post">
                <button class="Review_Buttons_100" type="submit" name="Delete_Comment_Id" value="<?= $Comment['User_Comment_Id']; ?>"><i class="fa fa-trash"></i></button>
                <input type="hidden" name="Product_Id" value="<?= $Product['Product_Id'];  ?>">
              </form>
            </div>
          </div>
          <div class="D_Review_Image_Detail_Wrapper">
            <?php foreach($data["Get_Userprofile_Based_On_Id"] as $User): ?>
              <div class="D_Review_UserProfile_Image_Wrapper">
                <?php if ($User["Profile_picture"] == null): ?>
                  <img class="D_Review_UserProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
                <?php else: ?>
                  <img class="D_Review_UserProfile_Image " src="<?= BASEURL;  ?>../<?= $User['Profile_picture']; ?>">
                <?php endif; ?>
              </div>
            <?php endforeach;?>
            <div class="D_Review_Details__Wrapper" >
              <?= $Comment["User_Comment"];  ?>
            </div>
          </div>
        </div>';
    }

    $output .= '</table><br /><div align="center">';
    $page_query = "SELECT * FROM tbl_student ORDER BY student_id DESC";
    $page_result = mysqli_query($connect, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$record_per_page);
    for($i=1; $i<=$total_pages; $i++)
    {
      $output .= "<span class='D_Pagination_Wrapper' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";
    }
    $output .= '</div><br /><br />';

    echo $output;
  }*/
}
