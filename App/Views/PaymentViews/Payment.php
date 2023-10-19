<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <main class="Main_Section_Container">

    <div class="D_Back_Button_Container">
      <a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Bid/ViewBidproducts">Back</a>
    </div>
    <div class="D_payment_Container">
      <div class="D_payment_right_wrapper">
        <div class="D_payment_Image_wrapper">
          <?php foreach($data['Product_Details'] as $Image): ?>
            <?php if ($Image['products_image_path'] == NULL): ?>
              <img class="D_payment_Image" src="../../Public/img/Product_Image/Default_Image.png">
            <?php else: ?>
              <img class="D_payment_Image" src="<?= BASEURL;  ?>../<?= $Image['products_image_path']; ?>">
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <?php foreach ($data['Product_Details'] as $Product_Details): ?>
        <div class="D_payment_Product_Details_wrapper">
          <span class="D_payment_Product_Title"><?= $Product_Details['Product_Name']; ?></span>
          <span class="D_payment_Product_Price">Bid Price: RM <?= $Product_Details['Product_Current_Price']; ?></span>
          <span class="D_payment_Product_Price">Delivery Fee: RM <?= $Product_Details['product_shipment_fee']; ?></span>
          <span class="D_payment_Product_Title">Tax: 6% of SST & 10% of Platform Fee</span>
          <span class="D_payment_Product_Price">SST Tax: RM <?= $Product_Details['product_sst_tax']; ?></span>
          <span class="D_payment_Product_Price">SST Tax: RM <?= $Product_Details['product_platform_tax']; ?></span>
          <span class="D_payment_Product_Price">Total Price: RM <?= $Product_Details['product_final_price']; ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="D_payment_left_wrapper">
        <?php if (empty($data['Get_Product_Image_Based_On_Id'])): ?>
          <a class="Edit_P_Buttons_100 noSelect Basic_Anchor" href="#">Add</a>
        <?php else: ?>
          <?php foreach($data['Get_Shipment_Address_Based_On_User_Id'] as $Address): ?>
          <span class="D_Shipment_Left_Title">Shipping address</span>
          <span class="D_Paymentpage_Checkout_Address_Layer_Address">
            <p class="D_Paymentpage_Checkout_Address_Layer_Info"><?= $Address['user_name'];  ?></p>
            <p class="D_Paymentpage_Checkout_Address_Layer_Info"><?= $Address['address_street'];  ?></p>
            <p class="D_Paymentpage_Checkout_Address_Layer_Info"><?= $Address['address_city'];  ?></p>
            <p class="D_Paymentpage_Checkout_Address_Layer_Info"><?= $Address['address_state'];  ?></p>
            <p class="D_Paymentpage_Checkout_Address_Layer_Info"><?= $Address['address_zip'];  ?></p>
            <p class="D_Paymentpage_Checkout_Address_Layer_Info"><?= $Address['address_country'];  ?></p>
          </span>
          <div class="D_payment_left_edit_btn_wrapper">
            <a class="Edit_P_Buttons_100 noSelect Basic_Anchor" href="#">Edit</a>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="D_Payment_Title_Divider">
      <span>Pay With</span>
    </div>
    <div class="D_Paywith_wrapper">
      <div class="D_Paymentpage_Select_Payment_Wrapper">
        <div class="D_Paymentpage_Select_Payment_Row">
          <input class="D_Paymentpage_Select_Payment_Radio_Btn" type="radio" name="favorite_pet" value="Ripple">
          <p class="D_Paymentpage_Select_Payment_Radio_Label">  Ripple</p>
        </div>
        <div class="D_Paymentpage_Select_Payment_Row">
          <input class="D_Paymentpage_Select_Payment_Radio_Btn" type="radio" name="favorite_pet" value="Pay_Pal">
          <p class="D_Paymentpage_Select_Payment_Radio_Label">  Pay Pal</p>
        </div>
      </div>
    </div>
    <div class="D_Payment_Title_Divider">
      <span>Coupon</span>
    </div>
    <div class="D_Payment_With_Coupon_Wrapper">
      <form class="D_Coupon_Wrapper" action="#" method="post">
        <input type="text" class="A_Inputs" name="" placeholder="Coupon">
      </form>
    </div>
    <div class="D_Payment_Title_Divider">
      <span>Donation(Optional)</span>
    </div>
    <div class="D_Payment_Coupon_Wrapper">
      <select class="D_Paymentpage_Selection_Donation_Wrapper noSelect">
        <option value="0.00">None</option>
        <option value="1.00">1.00</option>
        <option value="2.00">2.00</option>
        <option value="3.00">3.00</option>
        <option value="4.00">4.00</option>
        <option value="5.00">5.00</option>
      </select>
    </div>
    <div class="D_Payment_Pay_Btn_Wrapper">
      <form class="" action="<?= BASEURL; ?>/Payment/PaypalPayment" method="post">
        <button class="Edit_P_Buttons_100" type="submit" name="button">Pay</button>
        <?php foreach($data['Product_Details'] as $Product): ?>
          <input type="hidden" name="Product_Id" value="<?= $Product['Product_Id']; ?>">
        <?php endforeach; ?>
      </form>
    </div>
  </main>
</html>
