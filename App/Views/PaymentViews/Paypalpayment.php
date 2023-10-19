<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
    <main class="Main_Section_Container">

      <?php Flasher::flash(); ?>

      <div class="D_Back_Button_Container">
        <a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Bid/ViewBidproducts">Back</a>
      </div>
      <div class="D_paypalpayment_Container">
        <?php foreach($_SESSION["shopping_cart"] as $keys => $values): ?>
        <div class="D_paypalpayment_right_wrapper">
          <div class="D_paypalpayment_Image_wrapper">
            <?php if ($values['product_image_path'] == NULL): ?>
              <img class="D_paypalpayment_Image" src="../../Public/img/Product_Image/Default_Image.png">
            <?php else: ?>
              <img class="D_paypalpayment_Image" src="<?= BASEURL;  ?>../<?= $values['product_image_path']; ?>">
            <?php endif; ?>
          </div>
          <div class="D_Paypalpayment_Product_Details_wrapper">
            <span class="D_Paypalpayment_Product_Title"><?= $values['Product_Name']; ?></span>
            <span class="D_Paypalpayment_Product_Price">Bid Price: RM <?= $values['Product_Current_Price']; ?></span>
            <span class="D_Paypalpayment_Product_Price">Delivery Fee: RM <?= $values['product_shipment_fee']; ?></span>
            <span class="D_Paypalpayment_Product_Price">SST Tax(6%): RM <?= $values['product_sst_tax']; ?></span>
            <span class="D_Paypalpayment_Product_Price">Platform Tax(10%): RM <?= $values['product_platform_tax']; ?></span>
            <span class="D_Paypalpayment_Product_Price">Total Price: RM <?= $values['product_final_price']; ?></span>
          </div>
        </div>
        <?php endforeach; ?>
        <?php $total_amount = 0; ?>
        <div class="D_paypalpayment_left_wrapper">
          <?php $Product_Index = count($_SESSION["shopping_cart"]);  ?>
          <?php foreach($_SESSION["shopping_cart"] as $keys => $values): ?>
          <div class="D_paypalpayment_title">
            Product (<?= $Product_Index; ?>)
          </div>
          <div class="D_paypalpayment_products_wrapper">
            <label for="">Product <?= $Product_Index; ?></label>
            <span> <?= $values['product_final_price']; ?></span>
          </div>
          <div class="D_paypalpayment_total_amount_wrapper">
            <label for="">Total Amount</label>
            <span id="total_amount"> <?= $_SESSION['Total_amount'] = $values['product_final_price'];?></span>
          </div>

          <?php endforeach; ?>
          <div id="paypal-payment-button">
          </div>
        </div>
      </div>
    </main>
    <script src="https://www.paypal.com/sdk/js?client-id=ARNXeVz05ztiaT1vquLdKHWlMfLmdDnenTpv9fFPTAZBvX5EBzMBf2u9qnQaIrK3s271I_01qGsrXTKA&currency=MYR&disable-funding=credit,card"></script>
    <script type="text/javascript">
      paypal.Buttons({
        style:{
          color: 'blue',
          shape: 'pill'
        },
        createOrder:function(data, actions){
          return actions.order.create({
            purchase_units:[{
              amount:{
                value: '<?= $_SESSION['Total_amount']; ?>'
              }
            }]
          });
        },
        onApprove:function(data, actions){
          return actions.order.capture().then(function(details){
            actions.redirect('<?= BASEURL;  ?>/Payment/SeccessPayment');
          })
        },
        onCancel:function(data, actions){
            actions.redirect('<?= BASEURL;  ?>/Payment/CancelPayment');
        }
      }).render('#paypal-payment-button');
    </script>
  </body>
</html>
