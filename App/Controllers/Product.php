<?php

class Product extends Controller{

  //Redirect to View product page
  public function index(){
    //Send the data from the url
    $data['title'] = 'Product';
    //Send the data by using model
    $this->view('Templates/Header',$data);
    $this->view('ProductViews/Product',$data);
    $this->view('Templates/Footer');
  }

  //Redirect to View current user product page
  public function Myproducts(){
    //Send the data from the url
    $data['title'] = 'My Products';
    //Send the data by using model
    $data['Get_Current_User_Product'] = $this->model('Product_Model')->Get_Current_User_Product();
    $this->view('Templates/Header',$data);
    $this->view('ProductViews/MyProducts',$data);
    $this->view('Templates/Footer');
  }

  //Redirect to View product page based on certain product id
  public function Viewproduct($Product_Id){
    //Send the data from the url
    $data['title'] = 'My Products';
    //Send the data by using model
    $data['Get_Product_Based_On_Id'] = $this->model('Product_Model')->Get_Product_Based_On_Id($Product_Id);
    $data['Get_Product_Image_Based_On_Id'] = $this->model('Product_Model')->Get_Product_Image_Based_On_Id($Product_Id);
    $data['Get_Userprofile_Based_On_Id'] = $this->model('Product_Model')->Get_Userprofile_Based_On_Id($Product_Id);
    $data['Get_Bid_Name_Based_On_Id'] = $this->model('Product_Model')->Get_Bid_Name_Based_On_Id($Product_Id);
    $data['Get_Bids_Based_On_Id'] = $this->model('Bid_Model')->Get_Bids_Based_On_Id($Product_Id);
    $data['Get_More_Products'] = $this->model('Product_Model')->Get_More_Products();
    $data['Get_Comments_Based_On_Id'] = $this->model('Comment_Model')->Get_Comments_Based_On_Id($Product_Id);
    $data['Get_Comments_Based_On_User_Id'] = $this->model('Comment_Model')->Get_Comments_Based_On_User_Id($Product_Id);
    //$data['Get_Current_User_Product'] = $this->model('Product_Model')->Get_Current_User_Product();
    $this->view('Templates/Header',$data);
    $this->view('ProductViews/ViewProduct',$data);
    $this->view('Templates/Footer');
  }

  //Redirect to Add product page
  public function Add(){
    //Send the data from the url
    $data['title'] = 'Add';
    //Send the data by using model
    //$data['Get_Userprofile_Details'] = $this->model('Profile_Model')->getUserDetails();
    //Get Condition and category
    $data['Get_Product_Conditions'] = $this->model('Product_Model')->Get_Product_Condition();
    $data['Get_Product_Category'] = $this->model('Product_Model')->Get_Product_Category();
    $data['Get_Product_Status'] = $this->model('Product_Model')->Get_Product_Status();
    $this->view('Templates/Header',$data);
    $this->view('ProductViews/AddProduct',$data);
    $this->view('Templates/Footer');
  }

  //Redirect to Edit product page
  public function Edit(){
    //Send the data from the url
    $data['title'] = 'Edit';
    //Send the data by using model
    //$data['Get_Userprofile_Details'] = $this->model('Profile_Model')->getUserDetails();
    //Get Condition and category
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Product_Id = $_POST['Edit_Product_Id'];
      $data['Get_Edit_Product'] = $this->model('Product_Model')->Get_Product_Based_On_Id($Product_Id);
      $data['Get_Product_Conditions'] = $this->model('Product_Model')->Get_Product_Condition();
      $data['Get_Product_Category'] = $this->model('Product_Model')->Get_Product_Category();
      $data['Get_Product_Status'] = $this->model('Product_Model')->Get_Product_Status();
      $data['Get_Product_Image'] = $this->model('Product_Model')->Get_Product_Image_Based_On_Id($Product_Id);
      $this->view('Templates/Header',$data);
      $this->view('ProductViews/EditProduct',$data);
      $this->view('Templates/Footer');
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Product/Myproducts');
    }
  }

  //Action of edit a product
  public function Edit_Product(){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      // This is for user who upload picture
      if(!empty(array_filter($_FILES['files']['name']))) {
        if ($_POST['Product_Start_Session'] < $_POST['Product_End_Session']) {
          //Check whether there is change or not
          if($this->model('Product_Model')->Update_Product_Details($_POST) > 0){
            // 2. Insert Image to the database
            // Configure upload directory and allowed file types
            $upload_dir = '../Public/img/Product_Image/';
            $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
            // Define maxsize for files i.e 2MB
            $maxsize = 2 * 1024 * 1024;

            $Product_Id = $this->model('Product_Model')->GetProductId();

            foreach ($_FILES['files']['tmp_name'] as $key => $value) {
              $file_tmpname = $_FILES['files']['tmp_name'][$key];
              $file_name = $_FILES['files']['name'][$key];
              $file_size = $_FILES['files']['size'][$key];
              $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

              // Set upload file path
              $filepath = $upload_dir.$file_name;

              // Check file type is allowed or not
              if(in_array(strtolower($file_ext), $allowed_types)) {
                if ($file_size < $maxsize){
                  if(file_exists($filepath)) {
                    $filepath = $upload_dir.time().$file_name;
                    if(move_uploaded_file($file_tmpname, $filepath)) {
                      $Image_Path = $filepath;
                      if($this->model('Product_Model')->Update_Picture($Image_Path, $_POST) > 0){
                        $result = "Upload Successfully";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Myproducts');
                      }
                      else{
                        $result = "Fail to upload image to database";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Myproducts');
                      }

                    }
                    else{
                      $result = "Error uploading {$file_name}";
                      Flasher::setFlash($result, 'Failed', 'danger');
                      header('Location: '. BASEURL.'/Product/Myproducts');
                    }

                  }
                  else{
                    if(move_uploaded_file($file_tmpname, $filepath)) {
                      $Image_Path = $filepath;
                      if($this->model('Product_Model')->Update_Picture($Image_Path, $_POST) > 0){
                        $result = "Upload Successfully";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Myproducts');
                      }
                      else{
                        $result = "Fail to upload image to database";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Myproducts');
                      }
                    }
                    else{
                      $result = "Error uploading {$file_name}";
                      Flasher::setFlash($result, 'Failed', 'danger');
                      header('Location: '. BASEURL.'/Product/Myproducts');
                    }
                  }
                }
                else{
                  $result = "The size must smaller than 2mb";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
              }
              else{
                $result = "Invalid File Type";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
          }
          else{
            // 2. Insert Image to the database
            // Configure upload directory and allowed file types
            $upload_dir = '../Public/img/Product_Image/';
            $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
            // Define maxsize for files i.e 2MB
            $maxsize = 2 * 1024 * 1024;

            $Product_Id = $this->model('Product_Model')->GetProductId();

            foreach ($_FILES['files']['tmp_name'] as $key => $value) {
              $file_tmpname = $_FILES['files']['tmp_name'][$key];
              $file_name = $_FILES['files']['name'][$key];
              $file_size = $_FILES['files']['size'][$key];
              $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

              // Set upload file path
              $filepath = $upload_dir.$file_name;

              // Check file type is allowed or not
              if(in_array(strtolower($file_ext), $allowed_types)) {
                if ($file_size < $maxsize){
                  if(file_exists($filepath)) {
                    $filepath = $upload_dir.time().$file_name;
                    if(move_uploaded_file($file_tmpname, $filepath)) {
                      $Image_Path = $filepath;
                      if($this->model('Product_Model')->Update_Picture($Image_Path, $_POST) > 0){
                        $result = "Upload Successfully";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Myproducts');
                      }
                      else{
                        $result = "Fail to upload image to database";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Myproducts');
                      }

                    }
                    else{
                      $result = "Error uploading {$file_name}";
                      Flasher::setFlash($result, 'Failed', 'danger');
                      header('Location: '. BASEURL.'/Product/Myproducts');
                    }

                  }
                  else{
                    if(move_uploaded_file($file_tmpname, $filepath)) {
                      $Image_Path = $filepath;
                      if($this->model('Product_Model')->Update_Picture($Image_Path, $_POST) > 0){
                        $result = "Upload Successfully";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Myproducts');
                      }
                      else{
                        $result = "Fail to upload image to database";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Myproducts');
                      }
                    }
                    else{
                      $result = "Error uploading {$file_name}";
                      Flasher::setFlash($result, 'Failed', 'danger');
                      header('Location: '. BASEURL.'/Product/Myproducts');
                    }
                  }
                }
                else{
                  $result = "The size must smaller than 2mb";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
              }
              else{
                $result = "Invalid File Type";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
          }
        }
        else{
          $result = "End Session must more than start session";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Product/Myproducts');
        }
      }
      else{
        if ($_POST['Product_Start_Session'] < $_POST['Product_End_Session']) {
          if($this->model('Product_Model')->Update_Product_Details($_POST) > 0){
            $result = "Update Successfully";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Product/Myproducts');
          }
          else{
            $result = "Update Successfully";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Product/Myproducts');
          }
        }
        else{
          $result = "End Session must more than start session";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Product/Myproducts');
        }
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Product/Myproducts');
      exit();
    }
  }

  //Action of add a product
  public function Add_Product(){

    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      // This is for user who upload picture
      if(!empty(array_filter($_FILES['files']['name']))) {
        //Check If any input is empty
        if(!empty($_POST['product_name']) && !empty($_POST['product_quantity']) && !empty($_POST['product_material']) && !empty($_POST['Product_Author']) && !empty($_POST['Year_Of_Published'])
          && !empty($_POST['Product_Start_Session']) && !empty($_POST['Product_End_Session']) && !empty($_POST['Initial_Price'])){
          if ($_POST['Product_Start_Session'] < $_POST['Product_End_Session']) {
            //1. Insert product to the database
            if($this->model('Product_Model')->Add_Product($_POST) > 0){
              // 2. Insert Image to the database
              // Configure upload directory and allowed file types
              $upload_dir = '../Public/img/Product_Image/';
              $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
              // Define maxsize for files i.e 2MB
              $maxsize = 2 * 1024 * 1024;

              $Product_Id = $this->model('Product_Model')->GetProductId();

              foreach ($_FILES['files']['tmp_name'] as $key => $value) {
                $file_tmpname = $_FILES['files']['tmp_name'][$key];
                $file_name = $_FILES['files']['name'][$key];
                $file_size = $_FILES['files']['size'][$key];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

                // Set upload file path
                $filepath = $upload_dir.$file_name;

                // Check file type is allowed or not
                if(in_array(strtolower($file_ext), $allowed_types)) {
                  if ($file_size < $maxsize){
                    if(file_exists($filepath)) {
                      $filepath = $upload_dir.time().$file_name;
                      if(move_uploaded_file($file_tmpname, $filepath)) {
                        $Image_Path = $filepath;
                        if($this->model('Product_Model')->Add_Picture($Image_Path, $Product_Id) > 0){
                          if($this->model('Profile_Model')->Add_Number_Of_Product() > 0){
                            $result = "Upload Successfully";
                            Flasher::setFlash($result, 'Failed', 'danger');
                            header('Location: '. BASEURL.'/Product/Myproducts');
                          }
                          else{
                            $result = "Unable to Update Number of product";
                            Flasher::setFlash($result, 'Failed', 'danger');
                            header('Location: '. BASEURL.'/Product/Add');
                          }
                        }
                        else{
                          $result = "Fail to upload image to database";
                          Flasher::setFlash($result, 'Failed', 'danger');
                          header('Location: '. BASEURL.'/Product/Add');
                        }

                      }
                      else{
                        $result = "Error uploading {$file_name}";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Add');
                      }

                    }
                    else{
                      if(move_uploaded_file($file_tmpname, $filepath)) {
                        $Image_Path = $filepath;
                        if($this->model('Product_Model')->Add_Picture($Image_Path, $Product_Id) > 0){
                          if($this->model('Profile_Model')->Add_Number_Of_Product() > 0){
                            $result = "Upload Successfully";
                            Flasher::setFlash($result, 'Failed', 'danger');
                            header('Location: '. BASEURL.'/Product/Myproducts');
                          }
                          else{
                            $result = "Unable to Update Number of product";
                            Flasher::setFlash($result, 'Failed', 'danger');
                            header('Location: '. BASEURL.'/Product/Add');
                          }
                        }
                        else{
                          $result = "Fail to upload image to database";
                          Flasher::setFlash($result, 'Failed', 'danger');
                          header('Location: '. BASEURL.'/Product/Add');
                        }
                      }
                      else{
                        $result = "Error uploading {$file_name}";
                        Flasher::setFlash($result, 'Failed', 'danger');
                        header('Location: '. BASEURL.'/Product/Add');
                      }
                    }
                  }
                  else{
                    $result = "The size must smaller than 2mb";
                    Flasher::setFlash($result, 'Failed', 'danger');
                    header('Location: '. BASEURL.'/Product/Add');
                  }
                }
                else{
                  $result = "Invalid File Type";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Add');
                }
              }
            }
            else{
              $result = "Failed to Upload Product";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Product/Add');
            }
          }
          else{
            $result = "End Session must more than start session";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Product/Add');
          }
        }
        else{
          $result = "Do not leave the input empty";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Product/Add');
        }
      }
      else{
        if(!empty($_POST['product_name']) && !empty($_POST['product_quantity']) && !empty($_POST['product_material']) && !empty($_POST['Product_Author']) && !empty($_POST['Year_Of_Published'])
          && !empty($_POST['Product_Start_Session']) && !empty($_POST['Product_End_Session']) && !empty($_POST['Initial_Price'])){
          if ($_POST['Product_Start_Session'] < $_POST['Product_End_Session']) {
            //This is for user who did not upload any picture
            if($this->model('Product_Model')->Add_Product($_POST) > 0){
              if($this->model('Profile_Model')->Add_Number_Of_Product() > 0){
                $result = "Upload Successfully";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
              else{
                $result = "Unable to Update Number of product";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Add');
              }
            }
            else{
              $result = "Failed to Upload Product";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Product/Add');
            }
          }
          else{
            $result = "End Session must more than start session";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Product/Add');
          }
        }
        else{
          $result = "Do not leave the input empty";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Product/Add');
        }
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Authenticate/Login');
    }
  }

  //Delete Product image during edit the on certain product id
  public function Delete_Product_Image($id){

    $result = $this->model('Product_Model')->Get_Image_Path_Based_On_Id($id);
    if($result != 0){
      if(unlink($result)){
        if($this->model('Product_Model')->Delete_Product_Image($id) > 0){
          $result = "Delete Image Successfully";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Product/Myproducts');
        }
        else{
          $result = "Failed to Delete Image";
          Flasher::setFlash($result, 'Failed', 'danger');
          header('Location: '. BASEURL.'/Product/Myproducts');
        }
      }
      else{
        $result = "Unable to Delete Image In Root Folder";
        Flasher::setFlash($result, 'Failed', 'danger');
        header('Location: '. BASEURL.'/Product/Myproducts');
      }
    }
    else{
      $result = "Invalid Picture";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Product/Myproducts');
    }
  }

  //Delete the product
  public function Delete_Product(){
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
      $Product_Id = $_POST['Delete_Product_Id'];
      $results = $this->model('Product_Model')->Get_Multiple_Images_Path_Based_On_Product_Id($Product_Id);
      if ($results > 0) {
        foreach ($results as $result) {
          if(unlink($result['products_image_path'])){
            if($this->model('Product_Model')->Delete_Images_Based_On_Product_Id($Product_Id) > 0){

            }
            else{
              $result = "Failed to Delete Image";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Product/Myproducts');
            }
          }
          else{
            $result = "Invalid File Path";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Product/Myproducts');
          }
        }
        // Check Bid before delete
        if($this->model('Product_Model')->Check_Bid_Delete($Product_Id) > 0){
          // If More than 0, then delete Bid
          if($this->model('Product_Model')->Delete_User_Bid_Product($Product_Id) > 0){
            // Check Comment before delete
            if($this->model('Product_Model')->Check_Comment_Delete($Product_Id) > 0){
              // If More than 0, then user commnet
              if($this->model('Product_Model')->Delete_User_comment_Product($Product_Id) > 0){
                //Last delete product
                if ($this->model('Product_Model')->Delete_Product($Product_Id) > 0) {
                  //Update number of product of user insert
                  if($this->model('Profile_Model')->Minus_Number_Of_Product() > 0){
                    $result = "Delete Successfully";
                    Flasher::setFlash($result, 'Failed', 'danger');
                    header('Location: '. BASEURL.'/Product/Myproducts');
                  }
                  else{
                    $result = "Unable to update minus number of product";
                    Flasher::setFlash($result, 'Failed', 'danger');
                    header('Location: '. BASEURL.'/Product/Myproducts');
                  }
                }
                else{
                  $result = "Failed to Delete Image";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
              }
              else{
                // Failed to delete user comment
                $result = "Failed to User Comment";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
            else{
              // No comment then delete product only
              if ($this->model('Product_Model')->Delete_Product($Product_Id) > 0) {
                //Update number of product of user insert
                if($this->model('Profile_Model')->Minus_Number_Of_Product() > 0){
                  $result = "Delete Successfully";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
                else{
                  $result = "Unable to update minus number of product";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
              }
              else{
                $result = "Failed to Delete Image";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
          }
          else{
            // Failed to delete user bid
            $result = "Failed to User Bid";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Product/Myproducts');
          }
        }
        else{
          if($this->model('Product_Model')->Check_Comment_Delete($Product_Id) > 0){
            // If More than 0, then user commnet
            if($this->model('Product_Model')->Delete_User_comment_Product($Product_Id) > 0){
              //Last delete product
              if ($this->model('Product_Model')->Delete_Product($Product_Id) > 0) {
                //Update number of product of user insert
                if($this->model('Profile_Model')->Minus_Number_Of_Product() > 0){
                  $result = "Delete Successfully";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
                else{
                  $result = "Unable to update minus number of product";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
              }
              else{
                $result = "Failed to Delete Image";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
            else{
              // Failed to delete user comment
              $result = "Failed to User Comment";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Product/Myproducts');
            }
          }
          else{
            // No comment then delete product only
            if ($this->model('Product_Model')->Delete_Product($Product_Id) > 0) {
              //Update number of product of user insert
              if($this->model('Profile_Model')->Minus_Number_Of_Product() > 0){
                $result = "Delete Successfully";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
              else{
                $result = "Unable to update minus number of product";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
            else{
              $result = "Failed to Delete Image";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Product/Myproducts');
            }
          }
        }
      }
      else{
        // When there is no image
        // Check Bid before delete
        if($this->model('Product_Model')->Check_Bid_Delete($Product_Id) > 0){
          // If More than 0, then delete Bid
          if($this->model('Product_Model')->Delete_User_Bid_Product($Product_Id) > 0){
            // Check Comment before delete
            if($this->model('Product_Model')->Check_Comment_Delete($Product_Id) > 0){
              // If More than 0, then user commnet
              if($this->model('Product_Model')->Delete_User_comment_Product($Product_Id) > 0){
                //Last delete product
                if ($this->model('Product_Model')->Delete_Product($Product_Id) > 0) {
                  //Update number of product of user insert
                  if($this->model('Profile_Model')->Minus_Number_Of_Product() > 0){
                    $result = "Delete Successfully";
                    Flasher::setFlash($result, 'Failed', 'danger');
                    header('Location: '. BASEURL.'/Product/Myproducts');
                  }
                  else{
                    $result = "Unable to update minus number of product";
                    Flasher::setFlash($result, 'Failed', 'danger');
                    header('Location: '. BASEURL.'/Product/Myproducts');
                  }
                }
                else{
                  $result = "Failed to Delete Image";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
              }
              else{
                // Failed to delete user comment
                $result = "Failed to User Comment";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
            else{
              // No comment then delete product only
              if ($this->model('Product_Model')->Delete_Product($Product_Id) > 0) {
                //Update number of product of user insert
                if($this->model('Profile_Model')->Minus_Number_Of_Product() > 0){
                  $result = "Delete Successfully";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
                else{
                  $result = "Unable to update minus number of product";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
              }
              else{
                $result = "Failed to Delete Image";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
          }
          else{
            // Failed to delete user bid
            $result = "Failed to User Bid";
            Flasher::setFlash($result, 'Failed', 'danger');
            header('Location: '. BASEURL.'/Product/Myproducts');
          }
        }
        else{
          if($this->model('Product_Model')->Check_Comment_Delete($Product_Id) > 0){
            // If More than 0, then user commnet
            if($this->model('Product_Model')->Delete_User_comment_Product($Product_Id) > 0){
              //Last delete product
              if ($this->model('Product_Model')->Delete_Product($Product_Id) > 0) {
                //Update number of product of user insert
                if($this->model('Profile_Model')->Minus_Number_Of_Product() > 0){
                  $result = "Delete Successfully";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
                else{
                  $result = "Unable to update minus number of product";
                  Flasher::setFlash($result, 'Failed', 'danger');
                  header('Location: '. BASEURL.'/Product/Myproducts');
                }
              }
              else{
                $result = "Failed to Delete Image";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
            else{
              // Failed to delete user comment
              $result = "Failed to User Comment";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Product/Myproducts');
            }
          }
          else{
            // No comment then delete product only
            if ($this->model('Product_Model')->Delete_Product($Product_Id) > 0) {
              //Update number of product of user insert
              if($this->model('Profile_Model')->Minus_Number_Of_Product() > 0){
                $result = "Delete Successfully";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
              else{
                $result = "Unable to update minus number of product";
                Flasher::setFlash($result, 'Failed', 'danger');
                header('Location: '. BASEURL.'/Product/Myproducts');
              }
            }
            else{
              $result = "Failed to Delete Image";
              Flasher::setFlash($result, 'Failed', 'danger');
              header('Location: '. BASEURL.'/Product/Myproducts');
            }
          }
        }
      }
    }
    else{
      $result = "Invalid Post";
      Flasher::setFlash($result, 'Failed', 'danger');
      header('Location: '. BASEURL.'/Product/Myproducts');
      exit();
    }
  }

}
