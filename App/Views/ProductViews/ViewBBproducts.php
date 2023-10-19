<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Products</title>
  </head>
  <body>
    <main class="Main_Section_Container">
      <div class="Products_Container">

        <div class="D_Back_Button_Container">
          <div class="D_UserProfile_title"> Bid </div>
          <!--<a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Product/Myproducts">Back</a>-->
        </div>

        <!--<div class="M_Purchasepage_Search_Bar_Container">
          <div class="M_Purchasepage_Search_Bar_Wrapper">
            <form action="#">
              <input class="M_Purchasepage_Search_Input" type="text" placeholder="Search by Seller Name, Order ID, Product name in all orders" name="search">
              <button class="M_Purchasepage_Search_Bar_Button noSelect"type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>-->

        <br>
        <?php Flasher::flash(); ?>
        <?php foreach($data['Get_Bid_Products_get_beat'] as $Product): ?>
          <div class="M_Purchasepage_search_result_wrapper">
            <div class="M_Purchasepage_seller_and_shipment_detail_wrapper">
              <div class="M_Purchasepage_seller_detail_wrapper">
                <span class="">Seller: <?= $Product['user_name']; ?></span>
                <span class=""><a href="<?= BASEURL; ?>/Profile/SellerProfile/<?= $Product['user_id']; ?>" class="Basic_Anchor M_Purchasepage_seller_detail_btn ">View Profile</a></span>
              </div>
              <div class="M_Purchasepage_shipment_detail_wrapper">
                <!--<span class="M_Purchasepage_shipment_description">Sender is preparing to ship your parcel</span>-->
                <span class="M_Purchasepage_shipment_status"> Pending</span>
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
                    <span class="M_Purchasepage_product_Name_Detail_Product_Name">Product Names: <?= $Product['Product_Name']; ?></span>
                    <span class="M_Purchasepage_product_Name_Detail_Product_Name">Time End:<?php
                      $timestamp = strtotime($Product['Product_Start_Session']);
                      $datetime = date("Y-m-d H:i", $timestamp);
                      echo " ".$datetime; ?></span>
                  </span>
                </div>
                <div class="M_Purchasepage_product_Price_Wrapper">
                  <span>Bid Price: <?= $Product['Product_Current_Price']; ?></span>
                </div>
              </div>
            </a>
            <div class="M_Purchasepage_total_price_and_buttons_Wrapper">
              <!--<div class="M_Purchasepage_total_price_wrapper">
                <span class="M_Purchasepage_total_span">Order Total</span><span class="M_Purchasepage_total_price">RM 95.50</span>
              </div>-->
              <div class="M_Purchasepage_rate_button">
                <?php if(empty($_SESSION["shopping_cart"])): ?>
                <form class="" action="<?= BASEURL; ?>/Payment/AddtoCart" method="post">
                  <input type="hidden" name="Product_Id" value="<?=$Product['Product_Id'];?>">
                  <input type="hidden" name="Product_Name" value="<?=$Product['Product_Name'];?>">
                  <input type="hidden" name="Product_Current_Price" value="<?=$Product['Product_Current_Price'];?>">
                  <button class="Edit_P_Buttons_100" type="submit" name="button">Add to Cart</button>
                </form>
                <?php else: ?>
                  <?php foreach($_SESSION["shopping_cart"] as $keys => $values): ?>
                  <?php if($values["Product_Id"] != $Product["Product_Id"]): ?>
                    <form class="" action="<?= BASEURL; ?>/Payment/AddtoCart" method="post">
                      <input type="hidden" name="Product_Id" value="<?=$Product['Product_Id'];?>">
                      <input type="hidden" name="Product_Name" value="<?=$Product['Product_Name'];?>">
                      <input type="hidden" name="Product_Current_Price" value="<?=$Product['Product_Current_Price'];?>">
                      <button class="Edit_P_Buttons_100" type="submit" name="button">Add to Cart </button>
                    </form>
                  <?php else: ?>
                    <form class="" action="<?= BASEURL; ?>/Payment/DeletefromCart" method="post">
                      <button class="Edit_P_Buttons_200" type="submit" name="button">Delete From Cart</button>
                      <input type="hidden" name="Product_Id" value="<?=$values['Product_Id'];?>">
                    </form>
                  <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="D_Payment_Button_Wrapper">
          <?php if(empty($_SESSION["shopping_cart"])): ?>
            <form class="" action="<?= BASEURL; ?>/Payment/PaypalPayment" method="post">
              <button class="Disable_Buttons_200 " type="submit" name="button">Pay</button>
            </form>
          <?php else: ?>
            <form class="" action="<?= BASEURL; ?>/Payment/PaypalPayment" method="post">
              <button class="Edit_P_Buttons_200" type="submit" name="button">Pay</button>
              <input type="hidden" name="Product_Id" value="<?=$values['Product_Id'];?>">
            </form>
          <?php endif; ?>
          </div>
        <?php endforeach;?>


      </div>
    </main>


  </body>
</html>
