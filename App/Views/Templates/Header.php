<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL;  ?>/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title><?= $data['title']; ?></title>
    <script rel="text/javascript" src="<?= BASEURL;  ?>/js/script.js"></script>
    <?php

    if (empty($_SESSION['id'])) {
      //
      header('Location: '. BASEURL.'/Authenticate/Login');
    }
    else{

    }

     ?>
  </head>


  <!--Mobile -->
  <div class="Top_navigation Hide_In_Desktop">
    <a class="Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Home/"><div class="top_nav_logo_container"><img class="top_nav_logo" src="<?= BASEURL;  ?>/img/logo.jpg"></div></a>
    <div id="Open_dropdown_menu_btn" class="top_dropdown_menu"><i class="fa fa-bars"></i>
    </div>
  </div>

  <div id="dropdown_container" class="top_dropdown_container">
    <a class="top_nav_link Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Bid/ViewBidproducts">
      <i class="top_nav_icon fa fa-book fa-fw"></i>
      <span class="top_nav">Product</span>
    </a>
    <a class="top_nav_link Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Bid/ViewBidproducts">
      <i class="top_nav_icon fa fa-bookmark fa-fw"></i>
      <span class="top_nav">Bid</span>
    </a>
    <a class="top_nav_link Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Shipment/Shipment">
      <i class="top_nav_icon fa fa-cart-plus fa-fw"></i>
      <span class="top_nav">Shipment</span>
    </a>
    <a class="top_nav_link Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Profile/MyProfile">
      <i class="top_nav_icon fa fa-user fa-fw"></i>
      <span class="top_nav">Profile</span>
    </a>
    <a class="top_nav_link Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Authenticate/UserLogout">
      <i class="top_nav_icon fa fa-sign-out fa-fw"></i>
      <span class="top_nav">Logout</span>
    </a>
  </div>

  <div class="D_Top_Nav Hide_In_Mobile Hide_In_Tablet">
    <div class="D_Top_Nav_Wrapper">
      <div class="D_Top_Nav_Icon_wrapper">
        <a class="Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Home/"><img class="D_Top_Nav_Picture" src="<?= BASEURL;  ?>/img/logo.jpg"></a>
      </div>
      <div class="D_Top_Nav_Functions_Icon_wrapper">
        <?php if(!isset($_SESSION['id'])): ?>

        <?php else: ?>
          <a class="Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Profile/MyProfile"><img class="D_Top_Nav_Profile_Picture" src="<?= BASEURL;  ?>/img/logo.jpg"></a>
        <?php endif;?>
        <a class="Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Bid/ViewBidproducts"><i class="fa fa-cart-plus"></i></a>
        <a class="Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Shipment/Shipment"><i class="fa fa-truck"></i></a>
        <a class="Basic_Anchor noSelect" href="<?= BASEURL;  ?>/Authenticate/UserLogout"><i class="fa fa-sign-out"></i></a>
      </div>
    </div>
  </div>


</html>


<script type="text/javascript">

  document.getElementById('Open_dropdown_menu_btn').onclick = function() {
    document.getElementById("dropdown_container").classList.add("show");
  };

  window.onclick = function(event) {
    if (!event.target.matches('.top_dropdown_menu') && !event.target.matches('.top_nav_link')) {
        var sharedowns = document.getElementsByClassName("top_dropdown_container");
        var i;
        for (i = 0; i < sharedowns.length; i++) {
            var openSharedown = sharedowns[i];
            if (openSharedown.classList.contains('show')) {
                openSharedown.classList.remove('show');
            }
          }
        }
      }

  document.getElementById("Open_dropdown_menu_btn").addEventListener('click',function(event){
    event.stopPropagation();
  });

</script>
