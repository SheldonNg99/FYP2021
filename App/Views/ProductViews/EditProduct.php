<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
    <main class="Main_Section_Container">

      <div class="D_Back_Button_Container">
        <a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Product/Myproducts">Back</a>
      </div>

      <div class="" id="Profile">
        <?php foreach($data['Get_Edit_Product'] as $Product): ?>
        <form class="D_AddProduct_Wrapper" action="<?= BASEURL; ?>/Product/Edit_Product" method="post" enctype="multipart/form-data">
          <div class="D_Left_AddProduct_Wrapper">
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Name : <input class="D_Left_AddProduct_Inputs" type="text" id="fname" name="product_name" value="<?= $Product['Product_Name'];?>">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Condition :
              <select class="D_Left_AddProduct_Inputs" name="product_condition">
                <?php foreach($data['Get_Product_Conditions'] as $Condition): ?>
                  <option value="<?= $Condition['Product_Condition_Id'];  ?>"
                    <?php
                    if ($Condition['Product_Condition_Id'] == $Product['Product_Condition']){
                      echo 'selected="selected"';
                    }
                    ?> >
                    <?= $Condition['Product_Condition'];  ?>
                  </option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Quantity : <input class="D_Left_AddProduct_Inputs" type="number" id="fname" name="product_quantity"  value="<?= $Product['Product_Quantity'];?>">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Category :
              <select class="D_Left_AddProduct_Inputs" name="product_category">
                <?php foreach($data['Get_Product_Category'] as $Category): ?>
                  <option value="<?= $Category['Category_Id'];  ?>"
                    <?php
                    if ($Category['Category_Id'] == $Product['Product_Category']){
                      echo 'selected="selected"';
                    }
                    ?> >
                    <?= $Category['Category'];  ?>
                  </option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Status:
              <select class="D_Left_AddProduct_Inputs" name="product_status">
                <?php foreach($data['Get_Product_Status'] as $Status): ?>
                  <option value = "<?= $Status['product_status_id']; ?>"
                    <?php
                      if ($Status['product_status_id'] == $Product['product_status']){
                        echo 'selected="selected"';
                      }
                    ?> >
                    <?= $Status['product_status']; ?>
                    </option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Material : <input class="D_Left_AddProduct_Inputs" type="text" id="fname" name="product_material" value="<?= $Product['Product_Material'];?>">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper" >
              Product Author : <input class="D_Left_AddProduct_Inputs" type="text" id="fname" name="Product_Author" value="<?= $Product['Product_Author'];?>">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Year Of Published : <input class="D_Left_AddProduct_Inputs" type="date" id="fname" name="Year_Of_Published" value="<?= $Product['Year_Of_Published'];?>">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Start Bid Session : <input class="D_Left_AddProduct_Inputs" type="datetime-local" id="fname" name="Product_Start_Session" value="<?php
              $timestamp = strtotime($Product['Product_Start_Session']);
              echo date("Y-m-d\TH:i:s", $timestamp);?>">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              End Bid Session : <input class="D_Left_AddProduct_Inputs" type="datetime-local" id="fname" name="Product_End_Session" value="<?php
              $timestamp = strtotime($Product['Product_End_Session']);
              echo date("Y-m-d\TH:i:s", $timestamp);?>">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Initial Price : <input class="D_Left_AddProduct_Inputs" type="number" id="fname" name="Initial_Price" value="<?= $Product['Product_Initial_Price'];?>">
            </div>
            <div class="D_Left_AddProduct_Button_Wrapper">
              <button type="submit" name="button" class="Edit_S_Buttons_100">Update</button>
              <input type="hidden" name="product_id" value="<?= $Product['Product_Id'];?>">
            </div>
          </div>
          <div class="D_Right_AddProduct_Wrapper">
            <div class="Edit_Image_Wrapper">
              <div class="Preview_Slider_Wrapper">
                  <?php if (empty($data['Get_Product_Image'])): ?>
                    <img id="file-ip-1-preview">
                  <?php else: ?>
                    <?php foreach($data['Get_Product_Image'] as $Image): ?>
                    <a class="Preview_Delete_Btn Basic_Anchor noSelect" href="<?= BASEURL; ?>/Product/Delete_Product_Image/<?= $Image['products_image_id']; ?>
                      " onclick="return confirm('are you sure?');">Delete</a>
                    <img class="Preview_Slides" id="file-ip-1-preview" src="../<?= $Image['products_image_path']; ?>">
                    <?php endforeach; ?>
                  <?php endif; ?>
                <div class="Preview_Slider_Dot_Wrapper">
                  <?php $i = 1; ?>
                  <?php foreach($data['Get_Product_Image'] as $Image): ?>
                    <span class="Preview_Slider_Dot Dots dot_hover_white" onclick="currentDiv(<?= $i; $i+=1; ?>)"></span>
                  <?php endforeach; ?>
                </div>
              </div>
              <label for="file-ip-1">Upload Image</label>
              <input type="file" id="file-ip-1" onchange="showPreview(event);" name="files[]" multiple>
            </div>
          </div>
        </form>
        <?php endforeach;?>
      </div>

      <br>
      <?php Flasher::flash(); ?>

    </main>
  </body>


</html>
<script rel="text/javascript" src="<?= BASEURL;  ?>/js/Preview_slider.js"></script>
<script type="text/javascript">

function showPreview(event){
if(event.target.files.length > 0){
  var src = URL.createObjectURL(event.target.files[0]);
  var preview = document.getElementById("file-ip-1-preview");
  preview.src = src;
  preview.style.display = "block";
}
}


</script>
