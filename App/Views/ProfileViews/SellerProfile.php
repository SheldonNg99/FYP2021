<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <main class="Main_Section_Container">

      <div class="D_Back_Button_Container">
        <div class="D_UserProfile_title"> Seller </div>
        <!--<a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Bid/ViewBidproducts">Back</a>-->
      </div>
      <div class="D_UserProfile_Container">
        <div class="D_UserProfile_Wrapper">
          <div class="D_UserProfile_image_wrapper">
            <?php foreach($data['Get_SellerProfile_Details'] as $User): ?>
              <?php if ($User['Profile_picture'] == null): ?>
                <img class="D_EditProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
              <?php else: ?>
                <img class="D_EditProfile_Image" src="<?= BASEURL;  ?>/<?= $User['Profile_picture']; ?>">
              <?php endif; ?>
            <?php endforeach;?>
          </div>
          <div class="D_UserProfile_Name">
            <?php foreach($data['Get_SellerProfile_Details'] as $User): ?>
              <?= $User['user_name'];  ?>
            <?php endforeach;?>
          </div>
        </div>
        <div class="D_UserProfile_Wrapper">
          <?php foreach($data['Get_SellerProfile_Details'] as $User): ?>
          <i class="D_UserProfile_Details fa fa-home">&#160; Products: &#160;<p><?= $User['Num_of_Products'];  ?></p></i>
          <i class="D_UserProfile_Details fa fa-shopping-cart">&#160; Bids: &#160;<p><?= $User['Num_of_Bids'];  ?></p></i>
          <i class="D_UserProfile_Details fa fa-user">&#160; Following: &#160;<p><?= $User['Num_of_Following'];  ?></p></i>
        </div>
        <div class="D_UserProfile_Wrapper">
          <i class="D_UserProfile_Details fa fa-users">&#160; Followers: &#160;<p><?= $User['Num_of_Followers'];  ?></p></i>
          <i class="D_UserProfile_Details fa fa-star">&#160; Rating: &#160;<p><?= $User['Percentage_of_Rating'];  ?> (<?= $User['Num_of_Rates'];  ?> Rating)</p></i>
          <i class="D_UserProfile_Details fa fa-table">&#160; Joined: &#160;<p><?= $User['Date_Joined'];  ?></p></i>
        </div>
        <?php endforeach;?>
      </div>

      <div class="D_UserProfile_Button_Container">
        <?php foreach($data['Get_SellerProfile_Details'] as $User): ?>
        <?php if ($_SESSION['id'] == $User['user_id']): ?>

        <?php else: ?>
          <!--<form action="index.html" method="post">
            <button class="Edit_P_Buttons_100 margin_right_20" type="submit" name="button">Review</button>
          </form>-->
          <?php if ($data['Check_Follow_Status'] != NULL): ?>
            <form action="<?= BASEURL; ?>/Profile/UnfollowSeller/<?= $User['user_id'];?>" method="post">
              <button class="Edit_P_Buttons_100" type="submit" name="button">Following</button>
            </form>
          <?php else: ?>
            <form action="<?= BASEURL; ?>/Profile/FollowSeller/<?= $User['user_id'];?>" method="post">
              <button class="Edit_P_Buttons_100" type="submit" name="button">Follow</button>
            </form>
          <?php endif; ?>
        <?php endif; ?>
        <?php endforeach;?>
      </div>
      <!-- -->
      <div class="D_Purchasepage_search_filter_wrapper">
        <span class="D_Purchasepage_search_filter active" id="All_Button">Products</span>
        <span class="D_Purchasepage_search_filter" id="Bids_Button">Completed Bid Session</span>
      </div>
      <!-- -->
      <div class="D_Product_Container" id="All">
        <?php if (empty($data['Get_Current_Seller_Products'])): ?>
          <div class="D_Products_Lists_Details_Wrapper">
            Current user do not have any products open to bid ~
          </div>
        <?php else: ?>
        <?php foreach($data['Get_Current_Seller_Products'] as $Product): ?>
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
        <?php endif; ?>
      </div>
      <div class="" id="Bids" style="display:none">
        <?php if (empty($data['Get_Sold_Products'])): ?>
          <div class="D_Products_Lists_Details_Wrapper">
            Current user do not have any products sold ~
          </div>
        <?php else: ?>
        <?php foreach($data['Get_Sold_Products'] as $Product): ?>
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
        <?php endif; ?>
      </div>
    </main>
  </body>
</html>
<script type="text/javascript">

  document.getElementById('All_Button').onclick = function() {
    document.getElementById('All').style.display='block';
    document.getElementById('Bids').style.display='none';
    document.getElementById('All_Button').classList.add("active");
    document.getElementById('Bids_Button').classList.remove("active");
  };

  document.getElementById('Bids_Button').onclick = function() {
    document.getElementById('Bids').style.display='block';
    document.getElementById('All').style.display='none';
    document.getElementById('Bids_Button').classList.add("active");
    document.getElementById('All_Button').classList.remove("active");
  };

  var dropdown = document.getElementsByClassName("D_Searchpage_search_result_filter_dropdown_btn");
  var i;

  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "none") {
          dropdownContent.style.display = "block";
        } else {
          dropdownContent.style.display = "none";
        }
      });
    }

</script>
