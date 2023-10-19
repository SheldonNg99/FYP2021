<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <main class="Main_Section_Container">

      <div class="D_Back_Button_Container">
        <div class="D_UserProfile_title"> Shipment </div>
        <!--<a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Product/Myproducts">Back</a>-->
      </div>

      <br>
      <?php Flasher::flash(); ?>
      <div class="D_Purchasepage_search_filter_wrapper">
        <span class="D_Purchasepage_search_filter active" id="Ship_Button">Ship</span>
        <span class="D_Purchasepage_search_filter" id="Receive_Button">Receive</span>
      </div>


      <div class="" id="Ship_page">
        <?php if (empty($data['Get_Shipment_Products'])): ?>
          <div class="D_Products_Lists_Details_Wrapper">
            Do not have any products to ship ~
          </div>
        <?php else: ?>
          <?php foreach ($data['Get_Shipment_Products'] as $Shipment): ?>
            <div class="M_Purchasepage_search_result_wrapper">
              <div class="M_Purchasepage_seller_and_shipment_detail_wrapper">
                <div class="M_Purchasepage_seller_detail_wrapper">
                </div>
                <div class="M_Purchasepage_shipment_detail_wrapper">
                  <!--<span class="M_Purchasepage_shipment_description">Sender is preparing to ship your parcel</span>-->
                  <span class="M_Purchasepage_shipment_status"> <?= $Shipment['products_final_status']; ?></span>
                </div>
              </div>
              <div class="M_Purchasepage_product_and_price_detail_wrapper">
                <div class="M_Purchasepage_product_Name_Wrapper">
                  <span class="M_Purchasepage_product_Picture_Icon_Wrapper">
                    <?php if (empty($Shipment['products_image_path'])): ?>
                      <img class="M_Purchasepage_product_Picture_Icon" src="../../Public/img/Product_Image/Default_Image.png">
                    <?php else: ?>
                      <img class="M_Purchasepage_product_Picture_Icon" src="../<?= $Shipment['products_image_path'];  ?>">
                    <?php endif; ?>
                  </span>
                  <span class="M_Purchasepage_product_Name_Detail_Wrapper">
                    <span class="M_Purchasepage_product_Name_Detail_Product_Name">Product Names: <?= $Shipment['Product_Name']; ?></span>
                    <span class="M_Purchasepage_product_Name_Detail_Product_Name">Buyer Name:
                      <?php foreach ($data['Get_Shipment_User'] as $ShipmentUser):?>
                        <?php if ($ShipmentUser['user_id'] == $Shipment['Top_Bidder_User_Id']): ?>
                          <?= $ShipmentUser['user_name']; ?>
                        <?php else: ?>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </span>
                  </span>
                </div>
                <div class="M_Purchasepage_product_Price_Wrapper">
                  <span>Paid Price: RM <?= $Shipment['product_final_price']; ?></span>
                </div>
              </div>
              <div class="M_Purchasepage_rate_button">
                <!--<form class="" action="index.html" method="post">
                  <button class="Edit_P_Buttons_100 margin_right_20" type="submit" name="button">Print</button>
                </form>-->
                <form class="" action="<?= BASEURL; ?>\Shipment\UpdateProductShipmentStatus" method="post">
                  <button class="Edit_P_Buttons_100 margin_right_20" type="submit" name="button">Ship</button>
                  <input type="hidden" name="Product_id" value="<?= $Shipment['Product_Id']; ?>">
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <div class="" id="Receive_page" style="display:none">
        <?php if (empty($data['Get_Receive_Products'])): ?>
          <div class="D_Products_Lists_Details_Wrapper">
            Do not have any products to receive ~
          </div>
        <?php else: ?>
          <?php foreach ($data['Get_Receive_Products'] as $Shipment): ?>
            <div class="M_Purchasepage_search_result_wrapper">
              <div class="M_Purchasepage_seller_and_shipment_detail_wrapper">
                <div class="M_Purchasepage_seller_detail_wrapper">
                </div>
                <div class="M_Purchasepage_shipment_detail_wrapper">
                  <!--<span class="M_Purchasepage_shipment_description">Sender is preparing to ship your parcel</span>-->
                  <span class="M_Purchasepage_shipment_status"> <?= $Shipment['products_final_status']; ?></span>
                </div>
              </div>
              <div class="M_Purchasepage_product_and_price_detail_wrapper">
                <div class="M_Purchasepage_product_Name_Wrapper">
                  <span class="M_Purchasepage_product_Picture_Icon_Wrapper">
                    <?php if (empty($Shipment['products_image_path'])): ?>
                      <img class="M_Purchasepage_product_Picture_Icon" src="../../Public/img/Product_Image/Default_Image.png">
                    <?php else: ?>
                      <img class="M_Purchasepage_product_Picture_Icon" src="../<?= $Shipment['products_image_path'];  ?>">
                    <?php endif; ?>
                  </span>
                  <span class="M_Purchasepage_product_Name_Detail_Wrapper">
                    <span class="M_Purchasepage_product_Name_Detail_Product_Name">Product Names: <?= $Shipment['Product_Name']; ?></span>
                    <span class="M_Purchasepage_product_Name_Detail_Product_Name">Seller Name: <?= $Shipment['user_name']; ?></span>
                  </span>
                </div>
                <div class="M_Purchasepage_product_Price_Wrapper">
                  <span>Paid : RM <?= $Shipment['product_final_price']; ?></span>
                </div>
              </div>
              <div class="M_Purchasepage_rate_button">
                <!--<form class="" action="index.html" method="post">
                  <button class="Edit_P_Buttons_100 margin_right_20" type="submit" name="button">Print</button>
                </form>-->
                <form class="" action="<?= BASEURL; ?>\Shipment\UpdateProductShipmentDeliveredStatus" method="post">
                  <button class="Edit_P_Buttons_100 margin_right_20" type="submit" name="button">Receive</button>
                  <input type="hidden" name="Product_id" value="<?= $Shipment['Product_Id']; ?>">
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>




    </main>

  </body>
</html>
<script type="text/javascript">
  document.getElementById('Ship_Button').onclick = function() {
    document.getElementById('Ship_page').style.display='block';
    document.getElementById('Receive_page').style.display='none';
    document.getElementById('Ship_Button').classList.add("active");
    document.getElementById('Receive_Button').classList.remove("active");
  };

  document.getElementById('Receive_Button').onclick = function() {
    document.getElementById('Receive_page').style.display='block';
    document.getElementById('Ship_page').style.display='none';
    document.getElementById('Receive_Button').classList.add("active");
    document.getElementById('Ship_Button').classList.remove("active");
  };
</script>
