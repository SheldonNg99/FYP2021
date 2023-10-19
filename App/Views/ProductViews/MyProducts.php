<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Products</title>
  </head>
  <body>
    <main class="Main_Section_Container">
      <div class="M_Products_Container Hide_In_Desktop">

        <div class="D_myproduct_Button_Container">
          <div class="D_UserProfile_title">
            My products
          </div>
          <?php if(isset($_SESSION['id'])): ?>
            <a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Product/Add">Add</a>
          <?php else: ?>
          <?php endif;?>
        </div>

        <?php foreach($data['Get_Current_User_Product'] as $Product): ?>
        <div class="M_Purchasepage_search_result_wrapper">
          <div class="M_Purchasepage_seller_and_shipment_detail_wrapper">
            <div class="M_Purchasepage_seller_detail_wrapper">
              <!--<span class="">marvel.mobileshop</span>
              <span class=""><a href="#" class="Basic_Anchor M_Purchasepage_seller_detail_btn ">View Shop</a></span>-->
            </div>
            <div class="M_Purchasepage_shipment_detail_wrapper">
              <!--<span class="M_Purchasepage_shipment_description">Sender is preparing to ship your parcel</span>-->
              <span class="M_Purchasepage_shipment_status">
                <?php if ($Product['products_final_status'] == null): ?>
                <?= $Product['product_status'];  ?>
                <?php else: ?>
                <?= $Product['products_final_status'];  ?>
                <?php endif; ?>
              </span>
            </div>
          </div>
          <a class="Basic_Anchor" href="<?= BASEURL; ?>/Product/Viewproduct/<?= $Product['Product_Id']; ?>">
            <div class="M_Purchasepage_product_and_price_detail_wrapper">
              <div class="M_Purchasepage_product_Name_Wrapper">
                <span class="M_Purchasepage_product_Picture_Icon_Wrapper">
                  <?php if (empty($Product['products_image_path'])): ?>
                    <img class="M_Purchasepage_product_Picture_Icon" src="../../Public/img/Product_Image/Default_Image.png">
                  <?php else: ?>
                    <img class="M_Purchasepage_product_Picture_Icon" src="../<?= $Product['products_image_path'];  ?>">
                  <?php endif; ?>
                </span>
                <span class="M_Purchasepage_product_Name_Detail_Wrapper">
                  <span class="M_Purchasepage_product_Name_Detail_Product_Name">Name:<?= $Product['Product_Name']; ?></span>
                  <span class="M_Purchasepage_product_Name_Detail_Product_Name">Time End:<?php
                    $timestamp = strtotime($Product['Product_Start_Session']);
                    $datetime = date("Y-m-d H:i", $timestamp);
                    echo " ".$datetime; ?></span>
                  <!--<span class="M_Purchasepage_product_Name_Detail_Product_Name">Number of Bidder: <?= $Product['Num_Of_Bidder']; ?></span>
                  <span class="M_Purchasepage_product_Name_Detail_Product_Name">Number of Bids: <?= $Product['Num_Of_Bids']; ?></span>
                  <span class="M_Purchasepage_product_Name_Detail_Product_Name">Initial Price: <?= $Product['Product_Initial_Price']; ?></span>-->
                </span>
              </div>
              <div class="M_Purchasepage_product_Price_Wrapper">
                <span>C Price: <?= $Product['Product_Current_Price']; ?></span>
              </div>
            </div>
          </a>
          <div class="M_Purchasepage_total_price_and_buttons_Wrapper">
            <!--<div class="M_Purchasepage_total_price_wrapper">
              <span class="M_Purchasepage_total_span">Order Total</span><span class="M_Purchasepage_total_price">RM 95.50</span>
            </div>-->
            <div class="M_Purchasepage_rate_button">
              <?php if ($Product['products_final_status'] == null): ?>
                <form class="" action="<?= BASEURL; ?>/Product/Edit" method="post">
                    <button class="Edit_S_Buttons_100 margin_right_20" type="submit" name="Edit_Product_Id" value="<?= $Product['Product_Id']; ?>">Edit</button>
                </form>
                <form class="" action="<?= BASEURL; ?>/Product/Delete_Product" method="post">
                  <button class="Edit_S_Buttons_100" type="submit" name="Delete_Product_Id" value="<?= $Product['Product_Id']; ?>">Delete</button>
                </form>
              <?php else: ?>
                <form class="" action="<?= BASEURL; ?>/Product/Edit" method="post">
                    <button class="Disable_Buttons_100 margin_right_20" type="submit" name="Edit_Product_Id" value="<?= $Product['Product_Id']; ?>">Edit</button>
                </form>
                <form class="" action="<?= BASEURL; ?>/Product/Delete_Product" method="post">
                  <button class="Disable_Buttons_100" type="submit" name="Delete_Product_Id" value="<?= $Product['Product_Id']; ?>">Delete</button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach;?>

      </div>
      <div class="Products_Container Hide_In_Mobile">
        <div class="D_myproduct_Button_Container">
          <div class="D_UserProfile_title">
            My products
          </div>
          <?php if(isset($_SESSION['id'])): ?>
            <a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Product/Add">Add</a>
          <?php else: ?>
          <?php endif;?>
        </div>

      <!--<div class="M_Purchasepage_Search_Bar_Container">
          <div class="M_Purchasepage_Search_Bar_Wrapper">
            <form action="#">
              <input class="M_Purchasepage_Search_Input" type="text" placeholder="Search by Seller Name, Order ID, Product name in all orders" name="search">
              <button class="M_Purchasepage_Search_Bar_Button noSelect"type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>-->

        <?php Flasher::flash(); ?>
        <br>
        <?php foreach($data['Get_Current_User_Product'] as $Product): ?>
        <div class="M_Purchasepage_search_result_wrapper Hide_In_Mobile">
          <div class="M_Purchasepage_seller_and_shipment_detail_wrapper">
            <div class="M_Purchasepage_seller_detail_wrapper">
              <!--<span class="">marvel.mobileshop</span>
              <span class=""><a href="#" class="Basic_Anchor M_Purchasepage_seller_detail_btn ">View Shop</a></span>-->
            </div>
            <div class="M_Purchasepage_shipment_detail_wrapper">
              <!--<span class="M_Purchasepage_shipment_description">Sender is preparing to ship your parcel</span>-->
              <span class="M_Purchasepage_shipment_status">
                <?php if ($Product['products_final_status'] == null): ?>
                <?= $Product['product_status'];  ?>
                <?php else: ?>
                <?= $Product['products_final_status'];  ?>
                <?php endif; ?>
              </span>
            </div>
          </div>
          <a class="Basic_Anchor" href="<?= BASEURL; ?>/Product/Viewproduct/<?= $Product['Product_Id']; ?>">
            <div class="M_Purchasepage_product_and_price_detail_wrapper">
              <div class="M_Purchasepage_product_Name_Wrapper">
                <span class="M_Purchasepage_product_Picture_Icon_Wrapper">
                  <?php if (empty($Product['products_image_path'])): ?>
                    <img class="M_Purchasepage_product_Picture_Icon" src="../../Public/img/Product_Image/Default_Image.png">
                  <?php else: ?>
                    <img class="M_Purchasepage_product_Picture_Icon" src="../<?= $Product['products_image_path'];  ?>">
                  <?php endif; ?>
                </span>
                <span class="M_Purchasepage_product_Name_Detail_Wrapper">
                  <span class="M_Purchasepage_product_Name_Detail_Product_Name">Product Names:<?= $Product['Product_Name']; ?></span>
                  <span class="M_Purchasepage_product_Name_Detail_Product_Name">Time End:<?php
                    $timestamp = strtotime($Product['Product_Start_Session']);
                    $datetime = date("Y-m-d H:i", $timestamp);
                    echo " ".$datetime; ?></span>
                  <span class="M_Purchasepage_product_Name_Detail_Product_Name">Number of Bidder: <?= $Product['Num_Of_Bidder']; ?></span>
                  <span class="M_Purchasepage_product_Name_Detail_Product_Name">Number of Bids: <?= $Product['Num_Of_Bids']; ?></span>
                  <span class="M_Purchasepage_product_Name_Detail_Product_Name">Initial Price: <?= $Product['Product_Initial_Price']; ?></span>
                </span>
              </div>
              <div class="M_Purchasepage_product_Price_Wrapper">
                <span>Current Price: <?= $Product['Product_Current_Price']; ?></span>
              </div>
            </div>
          </a>
          <div class="M_Purchasepage_total_price_and_buttons_Wrapper">
            <!--<div class="M_Purchasepage_total_price_wrapper">
              <span class="M_Purchasepage_total_span">Order Total</span><span class="M_Purchasepage_total_price">RM 95.50</span>
            </div>-->
            <div class="M_Purchasepage_rate_button">
              <?php if ($Product['products_final_status'] == null): ?>
                <form class="" action="<?= BASEURL; ?>/Product/Edit" method="post">
                    <button class="Edit_S_Buttons_100 margin_right_20" type="submit" name="Edit_Product_Id" value="<?= $Product['Product_Id']; ?>">Edit</button>
                </form>
                <form class="" action="<?= BASEURL; ?>/Product/Delete_Product" method="post">
                  <button class="Edit_S_Buttons_100" type="submit" name="Delete_Product_Id" value="<?= $Product['Product_Id']; ?>">Delete</button>
                </form>
              <?php else: ?>
                <form class="" action="<?= BASEURL; ?>/Product/Edit" method="post">
                    <button class="Disable_Buttons_100 margin_right_20" type="submit" name="Edit_Product_Id" value="<?= $Product['Product_Id']; ?>">Edit</button>
                </form>
                <form class="" action="<?= BASEURL; ?>/Product/Delete_Product" method="post">
                  <button class="Disable_Buttons_100" type="submit" name="Delete_Product_Id" value="<?= $Product['Product_Id']; ?>">Delete</button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </main>


  </body>
</html>
