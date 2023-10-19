<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <main class="Main_Section_Container">
      <!--Mobile View Start-->
      <div class="M_Product_Title_Container Hide_In_Desktop">
        <div class="M_Product_Title"> My Profile </div>
      </div>

      <div class="M_UserProfile_Container Hide_In_Desktop">
        <div class="M_UserProfile_Wrapper">
          <div class="M_UserProfile_image_wrapper">
            <?php foreach($data['Get_Userprofile_Details'] as $User): ?>
              <?php if ($User['Profile_picture'] == null): ?>
                <img class="M_UserProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
              <?php else: ?>
                <img class="M_UserProfile_Image" src="../<?= $User['Profile_picture']; ?>">
              <?php endif; ?>
            <?php endforeach;?>
          </div>
          <div class="M_UserProfile_Name">
            <?php foreach($data['Get_Userprofile_Details'] as $User): ?>
              <?= $User['user_name'];  ?>
            <?php endforeach;?>
          </div>
        </div>
        <div class="M_UserProfile_Wrapper">
          <?php foreach($data['Get_Userprofile_Details'] as $User): ?>
          <i class="M_UserProfile_Details fa fa-home">&#160; Products: &#160;<p><?= $User['Num_of_Products'];  ?></p></i>
          <i class="M_UserProfile_Details fa fa-shopping-cart">&#160; Bids: &#160;<p><?= $User['Num_of_Bids'];  ?></p></i>
          <i class="M_UserProfile_Details fa fa-user">&#160; Following: &#160;<p><?= $User['Num_of_Following'];  ?></p></i>
        </div>
        <div class="M_UserProfile_Wrapper">
          <i class="M_UserProfile_Details fa fa-users">&#160; Followers: &#160;<p><?= $User['Num_of_Followers'];  ?></p></i>
          <i class="M_UserProfile_Details fa fa-star">&#160; Rating: &#160;<p><?= $User['Percentage_of_Rating'];  ?> (<?= $User['Num_of_Rates'];  ?> Rating)</p></i>
          <i class="M_UserProfile_Details fa fa-table">&#160; Joined: &#160;<p><?= $User['Date_Joined'];  ?></p></i>
        </div>
        <?php endforeach;?>
      </div>

      <div class="M_UserProfile_Button_Container Hide_In_Desktop">
        <?php if(isset($_SESSION['id'])): ?>
          <!--<a class="Basic_Anchor noSelect Edit_P_Buttons_100 margin_right_20"href="<?= BASEURL;  ?>/Bid/ViewBidproducts">Pending</a>-->
          <a class="Basic_Anchor noSelect M_Edit_P_Buttons_100 margin_right_20"href="<?= BASEURL;  ?>/Bid/ViewmyBid">Bids</a>
          <a class="Basic_Anchor noSelect M_Edit_P_Buttons_100 margin_right_20"href="<?= BASEURL;  ?>/Product/Myproducts">Products</a>
          <a class="Basic_Anchor noSelect M_Edit_P_Buttons_100" href="<?= BASEURL;  ?>/Profile/Edit">Edit</a>
        <?php else: ?>
          <?php endif;?>
      </div>

      <div class="M_Purchasepage_search_filter_wrapper Hide_In_Desktop">
        <span class="M_Purchasepage_search_filter active" id="All_Button">Products</span>
        <span class="M_Purchasepage_search_filter" id="Sold_Button">Sold</span>
        <span class="M_Purchasepage_search_filter" id="Purchase_Button">Purchased</span>
      </div>
      <!-- -->
      <div class="D_Product_Container Hide_In_Desktop" id="All">
        <?php if (empty($data['Get_Current_User_Product'])): ?>
          <div class="M_Products_Lists_Details_Wrapper">
            Current user do not have any products open to bid ~
          </div>
        <?php else: ?>
          <?php foreach($data['Get_Current_User_Product'] as $Product): ?>
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
        <?php endif; ?>
      </div>

      <div class="D_Product_Container Hide_In_Desktop" id="Sold" style="display:none">
        <?php if (empty($data['Get_Sold_Products'])): ?>
          <div class="M_Products_Lists_Details_Wrapper">
            Current user do not have any products open to bid ~
          </div>
        <?php else: ?>
          <?php foreach($data['Get_Sold_Products'] as $Product): ?>
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
        <?php endif; ?>
      </div>

      <div class="D_Product_Container Hide_In_Desktop" id="Purchase" style="display:none">
        <?php if (empty($data['Get_Bought_Products'])): ?>
          <div class="M_Products_Lists_Details_Wrapper">
            Current user do not have any products open to bid ~
          </div>
        <?php else: ?>
          <?php foreach($data['Get_Bought_Products'] as $Product): ?>
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
        <?php endif; ?>
      </div>



      <!--Mobile View End-->



      <div class="D_Back_Button_Container Hide_In_Mobile">
        <div class="D_UserProfile_title"> My Profile </div>
        <!--<a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Product/Myproducts">Back</a>-->
      </div>

      <div class="D_UserProfile_Container Hide_In_Mobile">
        <div class="D_UserProfile_Wrapper">
          <div class="D_UserProfile_image_wrapper">
            <?php foreach($data['Get_Userprofile_Details'] as $User): ?>
              <?php if ($User['Profile_picture'] == null): ?>
                <img class="D_EditProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
              <?php else: ?>
                <img class="D_EditProfile_Image" src="../<?= $User['Profile_picture']; ?>">
              <?php endif; ?>
            <?php endforeach;?>
          </div>
          <div class="D_UserProfile_Name">
            <?php foreach($data['Get_Userprofile_Details'] as $User): ?>
              <?= $User['user_name'];  ?>
            <?php endforeach;?>
          </div>
        </div>
        <div class="D_UserProfile_Wrapper">
          <?php foreach($data['Get_Userprofile_Details'] as $User): ?>
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

      <div class="D_UserProfile_Button_Container Hide_In_Mobile">
        <?php if(isset($_SESSION['id'])): ?>
          <!--<a class="Basic_Anchor noSelect Edit_P_Buttons_100 margin_right_20"href="<?= BASEURL;  ?>/Bid/ViewBidproducts">Pending</a>-->
          <a class="Basic_Anchor noSelect Edit_P_Buttons_100 margin_right_20"href="<?= BASEURL;  ?>/Bid/ViewmyBid">My Bids</a>
          <a class="Basic_Anchor noSelect Edit_P_Buttons_100 margin_right_20"href="<?= BASEURL;  ?>/Product/Myproducts">My Products</a>
          <a class="Basic_Anchor noSelect Edit_P_Buttons_100" href="<?= BASEURL;  ?>/Profile/Edit">Edit</a>
        <?php else: ?>
          <?php endif;?>
      </div>
      <!-- -->
      <div class="D_Purchasepage_search_filter_wrapper Hide_In_Mobile">
        <span class="D_Purchasepage_search_filter active" id="All_Button">Products</span>
        <span class="D_Purchasepage_search_filter" id="Sold_Button">Sold</span>
        <span class="D_Purchasepage_search_filter" id="Purchase_Button">Purchased</span>
      </div>
      <!-- -->
      <div class="D_Product_Container Hide_In_Mobile" id="All">
        <?php if (empty($data['Get_Current_User_Product'])): ?>
          <div class="D_Products_Lists_Details_Wrapper">
            Current user do not have any products open to bid ~
          </div>
        <?php else: ?>
          <?php foreach($data['Get_Current_User_Product'] as $Product): ?>
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
      <div class="D_Product_Container Hide_In_Mobile" id="Sold" style="display:none">
        <?php if (empty($data['Get_Sold_Products'])): ?>
          <div class="D_Products_Lists_Details_Wrapper">
            Current user do not sold any product ~
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
      <div class="D_Product_Container Hide_In_Mobile" id="Purchase" style="display:none">
        <?php if (empty($data['Get_Bought_Products'])): ?>
          <div class="D_Products_Lists_Details_Wrapper">
            Current user do not bought any product ~
          </div>
        <?php else: ?>
          <?php foreach($data['Get_Bought_Products'] as $Product): ?>
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
    document.getElementById('Sold').style.display='none';
    document.getElementById('Purchase').style.display='none';
    document.getElementById('All_Button').classList.add("active");
    document.getElementById('Sold_Button').classList.remove("active");
    document.getElementById('Purchase_Button').classList.remove("active");
  };

  document.getElementById('Sold_Button').onclick = function() {
    document.getElementById('Sold').style.display='block';
    document.getElementById('All').style.display='none';
    document.getElementById('Purchase').style.display='none';
    document.getElementById('Sold_Button').classList.add("active");
    document.getElementById('All_Button').classList.remove("active");
    document.getElementById('Purchase_Button').classList.remove("active");
  };

  document.getElementById('Purchase_Button').onclick = function() {
    document.getElementById('Purchase').style.display='block';
    document.getElementById('All').style.display='none';
    document.getElementById('Sold').style.display='none';
    document.getElementById('Purchase_Button').classList.add("active");
    document.getElementById('All_Button').classList.remove("active");
    document.getElementById('Sold_Button').classList.remove("active");
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
