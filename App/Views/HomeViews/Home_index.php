<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <main class="Main_Section_Container">

    <div class="M_Product_Title_Container Hide_In_Desktop">
      <div class="M_Product_Title"> Most Popular Bid </div>
    </div>
    <div class="M_Products_Container noSelect Hide_In_Desktop">
      <?php foreach($data['Get_More_Products'] as $Product): ?>
      <a class="Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Product/Viewproduct/<?= $Product['Product_Id'];  ?>">
        <div class="M_Product_Wrapper">
          <div class="M_Product_Image_Wrapper">
            <?php if ($Product['products_image_path'] == null): ?>
              <img class="M_Product_Image" src="<?= BASEURL;  ?>/img/Product_Image/Default_Image.png">
            <?php else: ?>
              <img class="M_Product_Image" src="<?= BASEURL;  ?>../<?= $Product['products_image_path']; ?>">
            <?php endif; ?>
          </div>
          <div class="M_Product_Details">
            <div class="M_Product_Detail_Title">
              <?= $Product['Product_Name']; ?>
            </div>
            <div class="M_Product_Detail_Price">
              <i class="fa fa-dollar"></i> RM <?= $Product['Product_Current_Price']; ?>
            </div>
            <div class="M_Product_Detail_Bid_Number">
              <i class="fa fa-eye"></i> <?= $Product['Num_Of_Bids']; ?>
            </div>
          </div>
        </div>
      </a>
      <?php endforeach;?>
    </div>

    <div class="M_Product_Title_Container Hide_In_Desktop">
      <div class="M_Product_Title"> Top Seller </div>
    </div>

    <div class="M_Products_Table_Container noSelect  Hide_In_Desktop">
      <div class="M_Product_Table_Header">
        <div class="M_Product_Table_Header_Name">
          NAME
        </div>
        <div class="M_Product_Table_Header_Price">
          PRICE
        </div>
      </div>

      <a class="Basic_Anchor" href="#">
        <div class="M_Product_Table_Row">
          <div class="M_Product_Table_Row_Name_Wrapper">
            <span class="M_Product_Table_Row_Picture_Icon_Wrapper">
              <img class="M_Product_Table_Row_Picture_Icon" src="<?= BASEURL;  ?>/img/download1.jpg">
            </span>
            <span class="M_Product_Table_Row_Name_Detail_Wrapper">
              <span class="M_Product_Table_Row_Name_Detail_Wrapper_Product_Name">Product Names Alfreds Futterkiste</span>
              <span class="M_Product_Table_Row_Name_Detail_Wrapper_Seller_Name">Seller: Maria Anders</span>
            </span>
          </div>
          <div class="M_Product_Table_Row_Price_Wrapper">
            <span>RM 67,920.00 </span>
          </div>
        </div>
      </a>
    </div>

    <div class="M_Product_Title_Container Hide_In_Mobile">
      <div class="M_Product_Title"> Most Popular Bid </div>
    </div>

    <div class="D_Products_Table_Container noSelect Hide_In_Mobile">
      <?php foreach($data['Get_More_Products'] as $Product): ?>
      <a class="Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Product/Viewproduct/<?= $Product['Product_Id'];  ?>">
        <div class="D_Product_Wrapper">
          <div class="D_Product_Image_Wrapper">
            <?php if ($Product['products_image_path'] == null): ?>
              <img class="D_Product_Image" src="<?= BASEURL;  ?>/img/Product_Image/Default_Image.png">
            <?php else: ?>
              <img class="D_Product_Image" src="<?= BASEURL;  ?>../<?= $Product['products_image_path']; ?>">
            <?php endif; ?>
          </div>
          <div class="D_Product_Details">
            <div class="D_Product_Detail_Title">
              <?= $Product['Product_Name']; ?>
            </div>
            <div class="D_Product_Detail_Price">
              <i class="fa fa-dollar"></i> RM <?= $Product['Product_Current_Price']; ?>
            </div>
            <div class="D_Product_Detail_Bid_Number">
              <i class="fa fa-eye"></i> <?= $Product['Num_Of_Bids']; ?>
            </div>
          </div>
        </div>
      </a>
      <?php endforeach;?>
    </div>

    <div class="M_Product_Title_Container Hide_In_Mobile">
      <div class="M_Product_Title"> Top Seller </div>
    </div>

    <div class="M_Product_Table_Header">
      <div class="M_Product_Table_Header_Name">
        NAME
      </div>
      <div class="M_Product_Table_Header_Price">
        PRICE
      </div>
    </div>

    <a class="Basic_Anchor" href="#">
      <div class="M_Product_Table_Row">
        <div class="M_Product_Table_Row_Name_Wrapper">
          <span class="M_Product_Table_Row_Picture_Icon_Wrapper">
            <img class="M_Product_Table_Row_Picture_Icon" src="<?= BASEURL;  ?>/img/download1.jpg">
          </span>
          <span class="M_Product_Table_Row_Name_Detail_Wrapper">
            <span class="M_Product_Table_Row_Name_Detail_Wrapper_Seller_Name">Seller: Maria Anders</span>
          </span>
        </div>
        <div class="M_Product_Table_Row_Price_Wrapper">
          <span>RM 67,920.00 </span>
        </div>
      </div>
    </a>

  </main>

</html>
