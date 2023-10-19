<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Product</title>
    <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <main class="Main_Section_Container">

      <!--Mobile view start-->
      <div class="M_ViewProduct_Slider_Wrapper Hide_In_Tablet Hide_In_Desktop">
        <?php if (empty($data['Get_Product_Image_Based_On_Id'])): ?>
          <img class="M_Product_Slides" src="<?= BASEURL;  ?>/img/Product_Image/Default_Image.png">
        <?php else: ?>
          <?php foreach($data['Get_Product_Image_Based_On_Id'] as $Image): ?>
            <img class="M_Product_Slides" src="<?= BASEURL;  ?>../<?= $Image['products_image_path']; ?>">
          <?php endforeach; ?>
        <?php endif; ?>
        <div class="M_ViewProduct_Slider_Dot_Wrapper">
          <?php $i = 1; ?>
          <?php foreach($data['Get_Product_Image_Based_On_Id'] as $Image): ?>
            <span class="M_ViewProduct_Slider_Dot M_Dots dot_hover_white" onclick="currentDiv(<?= $i; $i+=1; ?>)"></span>
          <?php endforeach; ?>
        </div>
      </div>
      <div class=" Hide_In_Desktop">
        <?php foreach($data['Get_Product_Based_On_Id'] as $Product): ?>
        <div class="M_ViewProduct_Product_Info_Wrapper">
          <span class="M_Products_Product_Title"><?= $Product['Product_Name'];  ?></span>
          <span class="M_Products_Product_Current_Price">Current Price: RM <?= $Product['Product_Current_Price'];  ?></span>
          <span class="M_ViewProduct_Info">Higest Bid User Name:
            <?php if ($Product['Top_Bidder_User_Id'] != NULL ): ?>
              <?php foreach ($data['Get_Bid_Name_Based_On_Id'] as $Bid_Name): ?>
                <?= $Bid_Name['user_name'];  ?>
              <?php endforeach; ?>
            <?php else: ?>
              <?= "No Users Bid yet"  ?>
            <?php endif; ?>
          </span>
          <span class="M_ViewProduct_Info">Time Left: <span id="M_demo"></span></span>
          <span class="M_ViewProduct_Info">Number Of Bids: <?= $Product['Num_Of_Bids'];  ?></span>
          <span class="M_ViewProduct_Info">Number Of Bidder: <?= $Product['Num_Of_Bidder'];  ?></span>
          <form class="M_ViewProduct_Buttons_Wrapper" action="<?= BASEURL; ?>/Bid/Create_New_Bid" method="post">
            <input id="Bid_Price" class="M_ViewProduct_Bid_Input" type="number" name="Bid_Price" placeholder="Price" value="<?= $Product['Product_Current_Price']+5;  ?>">
            <button id="Bid_Price_Btn" class="M_Edit_P_Buttons_100" type="submit" name="button">Bid</button>
            <input type="hidden" name="Product_Id" value="<?= $Product['Product_Id'];  ?>">
          </form>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="M_Product_Title Hide_In_Tablet Hide_In_Desktop">
        <span class="M_P_Title_Name">Listing</span>
      </div>
      <div class="M_Products_Lists_Wrapper Hide_In_Tablet Hide_In_Desktop">
        <?php if ($Product['Top_Bidder_User_Id'] != NULL ): ?>
          <?php foreach($data['Get_Bids_Based_On_Id'] as $Bid): ?>
            <div class="M_Products_Lists_Details_Wrapper">
              <span class="M_Product_Lists_Details_User_Picture_Icon_Wrapper">
                <?php if ($Bid['Profile_picture'] == null): ?>
                  <img class="M_Product_Lists_Details_User_Picture_Icon" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
                <?php else: ?>
                  <img class="M_Product_Lists_Details_User_Picture_Icon" src="<?= BASEURL;  ?>../<?= $Bid['Profile_picture']; ?>">
                <?php endif; ?>
              </span>
              <span class="M_Product_Lists_Details_Wrapper">
                <span class="M_Product_Lists_Price_Raised"><?= $Bid['user_name']; ?> raised price to RM <?= $Bid['Bid_Price']; ?></span>
                <span class="M_Product_Lists_Date_Raised"><?= $Bid['Bid_Time']; ?></span>
              </span>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="M_Product_Lists_Details_Wrapper">
            No User Bid this Product Yet ~
          </div>
        <?php endif; ?>
      </div>

      <div class="M_Product_Title Hide_In_Tablet Hide_In_Desktop">
        <span class="M_P_Title_Name">Seller Details</span>
      </div>

      <div class="M_Product_Seller_Page Hide_In_Desktop">
        <?php foreach($data['Get_Userprofile_Based_On_Id'] as $User): ?>
        <div class="M_Product_Seller_Profile_Image_Wrapper">
          <div class="M_SellerProfile_Image_Wrapper">
              <?php if ($User['Profile_picture'] == null): ?>
                <img class="M_SellerProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
              <?php else: ?>
                <img class="M_SellerProfile_Image" src="<?= BASEURL;  ?>../<?= $User['Profile_picture']; ?>">
              <?php endif; ?>
          </div>
        </div>
        <div class="M_Seller_Profile_Details_Wrapper">
          <span class="M_Seller_Profile_Details">Name: <a class="Basic_Anchor noSelect" href="<?= BASEURL; ?>/Profile/SellerProfile/<?= $User['user_id']; ?>"><?= $User['user_name'];  ?></a></span>
          <span class="M_Seller_Profile_Details">Following: <?= $User['Num_of_Following'];  ?></span>
          <span class="M_Seller_Profile_Details">Followers: <?= $User['Num_of_Followers'];  ?></span>
          <span class="M_Seller_Profile_Details">Date Joined: <?= $User['Date_Joined'];  ?></span>
          <span class="M_Seller_Profile_Details">Rating: <?= $User['Percentage_of_Rating'];  ?> (<?= $User['Num_of_Rates'];  ?>)</span>
        </div>
        <?php endforeach;?>
      </div>

      <div class="M_Product_Title Hide_In_Tablet Hide_In_Desktop">
        <span class="M_P_Title_Name">Comments</span>
      </div>

      <div class="M_Review_Container Hide_In_Desktop">
        <form class="M_Review_Form_Wrapper" action="<?= BASEURL;  ?>/Comment/AddComment" method="post">
          <?php foreach($data['Get_Userprofile_Based_On_Id'] as $User): ?>
          <div class="M_Review_UserProfile_Image_Wrapper">
            <?php if ($User['Profile_picture'] == null): ?>
              <img class="M_Review_UserProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
            <?php else: ?>
              <img class="M_Review_UserProfile_Image " src="<?= BASEURL;  ?>../<?= $User['Profile_picture']; ?>">
            <?php endif; ?>
          </div>
          <?php endforeach;?>
          <div class="M_Review_Input_Wrapper">
            <input type="text" class="M_Review_Input" name="Comment" placeholder="Write your comment here">
            <button class="M_Review_Button" type="submit" name="button"><i class="fa fa-comment"></i></button>
            <input type="hidden" name="Product_Id" value="<?= $Product['Product_Id'];  ?>">
          </div>
        </form>
      </div>
      <br>
      <div class="M_View_Review_Container Hide_In_Desktop">
        <?php if ($data['Get_Comments_Based_On_Id'] != NULL): ?>
          <?php foreach ($data['Get_Comments_Based_On_Id'] as $Comment): ?>
          <div class="M_View_Review_Wrapper">
            <div class="M_Review_Datetime_Detail_Wrapper">
              <div class="M_Review_Datetime_Wrapper">
                <span><?= $Comment['user_name'];  ?></span>: <?= $Comment['Comment_DateTime']; ?>
              </div>
              <div class="M_Review_Btns_Wrapper">
                <?php if ($_SESSION['id'] == $Comment['User_Id']): ?>
                  <form class="" action="<?= BASEURL; ?>/Comment/Edit" method="post">
                      <button class="M_Review_Buttons_100" type="submit" name="Edit_Comment_Id" value="<?= $Comment['User_Comment_Id']; ?>"><i class="fa fa-edit"></i></button>
                  </form>
                  <form class="" action="<?= BASEURL; ?>/Comment/DeleteComment" method="post">
                    <button class="M_Review_Buttons_100" type="submit" name="Delete_Comment_Id" value="<?= $Comment['User_Comment_Id']; ?>"><i class="fa fa-trash"></i></button>
                    <input type="hidden" name="Product_Id" value="<?= $Product['Product_Id'];  ?>">
                  </form>
                <?php else: ?>
                <?php endif; ?>
              </div>
            </div>
            <div class="M_Review_Image_Detail_Wrapper">
                <div class="M_Review_UserProfile_Image_Wrapper">
                  <?php if ($Comment['Profile_picture'] == null): ?>
                    <img class="M_Review_UserProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
                  <?php else: ?>
                    <img class="M_Review_UserProfile_Image " src="<?= BASEURL;  ?>../<?= $Comment['Profile_picture']; ?>">
                  <?php endif; ?>
                </div>
              <div class="M_Review_Details__Wrapper" >
                <?= $Comment['User_Comment'];  ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="M_Products_Lists_Details_Wrapper">
            No User Comment in this Bid Session Yet ~
          </div>
        <?php endif; ?>
      </div>


      <div class="M_Product_Title Hide_In_Tablet Hide_In_Desktop">
        <span class="M_P_Title_Name">More Products</span>
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




      <!--Mobile view end-->

      <div class="D_Back_Button_Container Hide_In_Mobile">
        <div class="D_UserProfile_title"> Product </div>
        <!--<a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Product/Myproducts">Back</a>-->
      </div>
      <?php foreach($data['Get_Product_Based_On_Id'] as $Product): ?>
      <div class="D_ViewProduct_Wrapper Hide_In_Mobile">
        <div class="D_ViewProduct_Details_Wrapper Hide_In_Mobile">
          <div class="D_ViewProduct_Right_Wrapper">
            <div class="D_ViewProduct_Slider_Wrapper">
              <?php if (empty($data['Get_Product_Image_Based_On_Id'])): ?>
                <img class="Product_Slides" src="<?= BASEURL;  ?>/img/Product_Image/Default_Image.png">
              <?php else: ?>
                <?php foreach($data['Get_Product_Image_Based_On_Id'] as $Image): ?>
                  <img class="Product_Slides" src="<?= BASEURL;  ?>../<?= $Image['products_image_path']; ?>">
                <?php endforeach; ?>
              <?php endif; ?>
              <div class="D_ViewProduct_Slider_Dot_Wrapper">
                <?php $i = 1; ?>
                <?php foreach($data['Get_Product_Image_Based_On_Id'] as $Image): ?>
                  <span class="D_ViewProduct_Slider_Dot Dots dot_hover_white" onclick="currentDiv(<?= $i; $i+=1; ?>)"></span>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="D_ViewProduct_Left_Wrapper">
            <div class="D_ViewProduct_Product_Info_Wrapper">
              <span class="D_Products_Product_Title"><?= $Product['Product_Name'];  ?></span>
              <span class="D_Products_Product_Current_Price">Current Price: RM <?= $Product['Product_Current_Price'];  ?></span>
              <span class="D_ViewProduct_Info">Higest Bid User Name:
                <?php if ($Product['Top_Bidder_User_Id'] != NULL ): ?>
                  <?php foreach ($data['Get_Bid_Name_Based_On_Id'] as $Bid_Name): ?>
                    <?= $Bid_Name['user_name'];  ?>
                  <?php endforeach; ?>
                <?php else: ?>
                  <?= "No Users Bid yet"  ?>
                <?php endif; ?>
              </span>
              <span class="D_ViewProduct_Info">Time Left: <span id="demo"></span></span>
              <span class="D_ViewProduct_Info">Number Of Bids: <?= $Product['Num_Of_Bids'];  ?></span>
              <span class="D_ViewProduct_Info">Number Of Bidder: <?= $Product['Num_Of_Bidder'];  ?></span>
              <form class="D_ViewProduct_Buttons_Wrapper" action="<?= BASEURL; ?>/Bid/Create_New_Bid" method="post">
                <input id="Bid_Price" class="D_ViewProduct_Bid_Input" type="number" name="Bid_Price" placeholder="Price" value="<?= $Product['Product_Current_Price']+5;  ?>">
                <button id="Bid_Price_Btn" class="Edit_P_Buttons_100" type="submit" name="button">Bid</button>
                <input type="hidden" name="Product_Id" value="<?= $Product['Product_Id'];  ?>">
              </form>
            </div>
          </div>
        </div>
      </div>
      <br>
      <?php Flasher::flash(); ?>
      <div class="D_Space_Divider Hide_In_Mobile">
        <span class="D_Space_Divider_Title">Recent Activity</span>
        <span class="D_Space_Divider_Title">More Information</span>
      </div>

      <div class="D_RecentActivity_Wrapper Hide_In_Mobile">
        <div class="D_RecentActivity_Right_Wrapper">
          <?php if ($Product['Top_Bidder_User_Id'] != NULL ): ?>
            <?php foreach($data['Get_Bids_Based_On_Id'] as $Bid): ?>
              <div class="D_Products_Lists_Details_Wrapper">
                <span class="D_Product_Lists_Details_User_Picture_Icon_Wrapper">
                  <?php if ($Bid['Profile_picture'] == null): ?>
                    <img class="D_Product_Lists_Details_User_Picture_Icon" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
                  <?php else: ?>
                    <img class="D_Product_Lists_Details_User_Picture_Icon" src="<?= BASEURL;  ?>../<?= $Bid['Profile_picture']; ?>">
                  <?php endif; ?>
                </span>
                <span class="D_Product_Lists_Details_Wrapper">
                  <span class="D_Product_Lists_Price_Raised"><?= $Bid['user_name']; ?> raised price to RM <?= $Bid['Bid_Price']; ?></span>
                  <span class="D_Product_Lists_Date_Raised"><?= $Bid['Bid_Time']; ?></span>
                </span>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="D_Products_Lists_Details_Wrapper">
              No User Bid this Product Yet ~
            </div>
          <?php endif; ?>
        </div>

        <div class="D_RecentActivity_Left_Wrapper">
          <div class="D_RecentActivity_Left_Buttons_Wrapper">
            <span class="D_RecentActivity_Left_Buttons" id="Seller_Button">About This Seller</span>
          </div>

          <div class="D_RecentActivity_Left_Seller_Page" id="Seller_Page">
            <?php foreach($data['Get_Userprofile_Based_On_Id'] as $User): ?>
            <div class="D_Seller_Profile_Image_Wrapper">
              <div class="D_SellerProfile_Image_Wrapper">
                  <?php if ($User['Profile_picture'] == null): ?>
                    <img class="D_SellerProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
                  <?php else: ?>
                    <img class="D_SellerProfile_Image" src="<?= BASEURL;  ?>../<?= $User['Profile_picture']; ?>">
                  <?php endif; ?>
              </div>
            </div>
            <div class="D_Seller_Profile_Details_Wrapper">
              <span class="D_Seller_Profile_Details">Name: <a class="Basic_Anchor noSelect" href="<?= BASEURL; ?>/Profile/SellerProfile/<?= $User['user_id']; ?>"><?= $User['user_name'];  ?></a></span>
              <span class="D_Seller_Profile_Details">Following: <?= $User['Num_of_Following'];  ?></span>
              <span class="D_Seller_Profile_Details">Followers: <?= $User['Num_of_Followers'];  ?></span>
              <span class="D_Seller_Profile_Details">Date Joined: <?= $User['Date_Joined'];  ?></span>
              <span class="D_Seller_Profile_Details">Rating: <?= $User['Percentage_of_Rating'];  ?> (<?= $User['Num_of_Rates'];  ?>)</span>
            </div>
            <?php endforeach;?>
          </div>

        </div>
      </div>
      <br>
      <div class="D_Space_Divider Hide_In_Mobile">
        <span class="D_Space_Divider_Title">Review</span>
      </div>
      <br>

      <div class="D_Review_Container Hide_In_Mobile">
        <form class="D_Review_Form_Wrapper" action="<?= BASEURL;  ?>/Comment/AddComment" method="post">
          <?php foreach($data['Get_Userprofile_Based_On_Id'] as $User): ?>
          <div class="D_Review_UserProfile_Image_Wrapper">
            <?php if ($User['Profile_picture'] == null): ?>
              <img class="D_Review_UserProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
            <?php else: ?>
              <img class="D_Review_UserProfile_Image " src="<?= BASEURL;  ?>../<?= $User['Profile_picture']; ?>">
            <?php endif; ?>
          </div>
          <?php endforeach;?>
          <div class="D_Review_Input_Wrapper">
            <input type="text" class="D_Review_Input" name="Comment" placeholder="Write your comment here">
            <button class="D_Review_Button" type="submit" name="button"><i class="fa fa-comment"></i></button>
            <input type="hidden" name="Product_Id" value="<?= $Product['Product_Id'];  ?>">
          </div>
        </form>
      </div>
      <br>
      <div class="D_View_Review_Container Hide_In_Mobile">
        <?php if ($data['Get_Comments_Based_On_Id'] != NULL): ?>
          <?php foreach ($data['Get_Comments_Based_On_Id'] as $Comment): ?>
          <div class="D_View_Review_Wrapper">
            <div class="D_Review_Datetime_Detail_Wrapper">
              <div class="D_Review_Datetime_Wrapper">
                <span><?= $Comment['user_name'];  ?></span> Comment on <?= $Comment['Comment_DateTime']; ?>
              </div>
              <div class="D_Review_Btns_Wrapper">
                <?php if ($_SESSION['id'] == $Comment['User_Id']): ?>
                  <form class="" action="<?= BASEURL; ?>/Comment/Edit" method="post">
                      <button class="Review_Buttons_100" type="submit" name="Edit_Comment_Id" value="<?= $Comment['User_Comment_Id']; ?>"><i class="fa fa-edit"></i></button>
                  </form>
                  <form class="" action="<?= BASEURL; ?>/Comment/DeleteComment" method="post">
                    <button class="Review_Buttons_100" type="submit" name="Delete_Comment_Id" value="<?= $Comment['User_Comment_Id']; ?>"><i class="fa fa-trash"></i></button>
                    <input type="hidden" name="Product_Id" value="<?= $Product['Product_Id'];  ?>">
                  </form>
                <?php else: ?>
                <?php endif; ?>
              </div>
            </div>
            <div class="D_Review_Image_Detail_Wrapper">
                <div class="D_Review_UserProfile_Image_Wrapper">
                  <?php if ($Comment['Profile_picture'] == null): ?>
                    <img class="D_Review_UserProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
                  <?php else: ?>
                    <img class="D_Review_UserProfile_Image " src="<?= BASEURL;  ?>../<?= $Comment['Profile_picture']; ?>">
                  <?php endif; ?>
                </div>
              <div class="D_Review_Details__Wrapper" >
                <?= $Comment['User_Comment'];  ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="D_Products_Lists_Details_Wrapper">
            No User Comment in this Bid Session Yet ~
          </div>
        <?php endif; ?>
      </div>
      <!--<div class="D_Pagination_Wrapper">
        <div class="pagination">
          <a href="#">&laquo;</a>
          <a href="#">1</a>
          <a href="#">2</a>
          <a href="#">3</a>
          <a href="#">4</a>
          <a href="#">5</a>
          <a href="#">6</a>
          <a href="#">&raquo;</a>
        </div>
      </div>-->
      <?php endforeach;?>
      <br>
      <div class="D_Space_Divider Hide_In_Mobile">
        <span class="D_Space_Divider_Title">More Products</span>
      </div>
      <div class="D_More_Products_Wrapper Hide_In_Mobile">
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
    </main>
  </body>
</html>
<script rel="text/javascript" src="<?= BASEURL;  ?>/js/Product_Slider.js"></script>

<script type="text/javascript">

  function open_make_offer_container() {
    document.getElementById("id01").style.width = "375px";
  }

  function close_make_offer_container() {
    document.getElementById("id01").style.width = "0";
    document.body.style.backgroundColor = "rgba(255,255,255,1)";
  }


  <?php foreach($data['Get_Product_Based_On_Id'] as $Product): ?>
  var countDownDate = "<?= $Product['Product_End_Session'];?>";
  <?php endforeach;?>
  var countDownDateTime = new Date(countDownDate).getTime();
  // Update the count down every 1 second
  var x = setInterval(function() {

      // Get todays date and time
      // 1. JavaScript
      // var now = new Date().getTime();
      // 2. PHP
      var now = new Date().getTime();
      /*now = now + 1000;*/

      // Find the distance between now an the count down date
      var distance = countDownDateTime - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
          minutes + "m " + seconds + "s ";

      document.getElementById("M_demo").innerHTML = days + "d " + hours + "h " +
          minutes + "m " + seconds + "s ";

      // If the count down is over, write some text
      if (distance < 0) {
          clearInterval(x);
          document.getElementById("demo").innerHTML = "EXPIRED";
          document.getElementById("M_demo").innerHTML = "EXPIRED";
          document.getElementById("Bid_Price_Btn").disabled = true;
          document.getElementById("Bid_Price_Btn").classList.remove("Edit_P_Buttons_100");
          document.getElementById("Bid_Price_Btn").classList.add("Disable_Buttons_100");
          document.getElementById("Bid_Price").disabled = true;
      }
  }, 1000);

</script>
