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
        <form class="D_AddProduct_Wrapper" action="<?= BASEURL; ?>/Product/Add_Product" method="post" enctype="multipart/form-data">
          <div class="D_Left_AddProduct_Wrapper">
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Name : <input class="D_Left_AddProduct_Inputs" type="text" id="fname" name="product_name">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Condition :
              <select class="D_Left_AddProduct_Inputs" name="product_condition">
                <?php foreach($data['Get_Product_Conditions'] as $Codition): ?>
                  <option value="<?= $Codition['Product_Condition_Id'];  ?>"><?= $Codition['Product_Condition'];  ?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Quantity : <input class="D_Left_AddProduct_Inputs" type="number" id="fname" name="product_quantity">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Category :
              <select class="D_Left_AddProduct_Inputs" name="product_category">
                <?php foreach($data['Get_Product_Category'] as $Category): ?>
                  <option value="<?= $Category['Category_Id'];  ?>"><?= $Category['Category'];  ?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Status:
              <select class="D_Left_AddProduct_Inputs" name="product_status">
                <?php foreach($data['Get_Product_Status'] as $Status): ?>
                  <option value="<?= $Status['product_status_id'];  ?>"><?= $Status['product_status'];  ?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Product Material : <input class="D_Left_AddProduct_Inputs" type="text" id="fname" name="product_material">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper" >
              Product Author : <input class="D_Left_AddProduct_Inputs" type="text" id="fname" name="Product_Author">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Year Of Published : <input class="D_Left_AddProduct_Inputs" type="date" id="fname" name="Year_Of_Published">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Start Bid Session : <input class="D_Left_AddProduct_Inputs" type="datetime-local" id="fname" name="Product_Start_Session">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              End Bid Session : <input class="D_Left_AddProduct_Inputs" type="datetime-local" id="fname" name="Product_End_Session">
            </div>
            <div class="D_Left_AddProduct_Detail_Wrapper">
              Initial Price : <input class="D_Left_AddProduct_Inputs" type="number" id="fname" name="Initial_Price">
            </div>
            <div class="D_Left_AddProduct_Button_Wrapper">
              <button type="submit" name="button" class="Edit_S_Buttons_100">Submit</button>
            </div>
          </div>
          <div class="D_Right_AddProduct_Wrapper">
            <div class="D_Right_UploadImage_Wrapper">
              <div class="preview">
                <img id="file-ip-1-preview">
              </div>
              <label for="file-ip-1">Upload Image</label>
              <input type="file" id="file-ip-1" onchange="showPreview(event);" name="files[]" multiple>
            </div>
          </div>
        </form>

      </div>

      <br>
      <?php Flasher::flash(); ?>

    </main>
  </body>


</html>
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
