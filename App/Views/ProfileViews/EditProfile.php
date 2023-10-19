<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <main class="Main_Section_Container">

      <div class="D_Back_Button_Container">
        <a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Profile/MyProfile">Back</a>
      </div>

      <div class="D_Purchasepage_search_filter_wrapper">
        <span class="D_Purchasepage_search_filter active" id="Profile_Button">Profile</span>
        <span class="D_Purchasepage_search_filter" id="Addresses_Button">Addresses</span>
        <span class="D_Purchasepage_search_filter" id="Password_Button">Change Password</span>
        <!--<span class="D_Purchasepage_search_filter" id="Wallet_Button">Payment & Wallet</span>-->
      </div>

      <div class="" id="Profile">
        <div class="D_Edit_Wrapper">
          <div class="D_EditProfile_Ti_Wrapper">
            <div class="D_EditProfile_Image_Wrapper">
              <?php foreach($data['Get_Userprofile_Details'] as $User): ?>
                <?php if ($User['Profile_picture'] == null): ?>
                  <img class="D_EditProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
                <?php else: ?>
                  <img class="D_EditProfile_Image" src="../<?= $User['Profile_picture']; ?>">
                <?php endif; ?>
              <?php endforeach;?>
            </div>
            <div class="D_EditProfile_Title_Wrapper">
              <h2>My Profile</h2>
              <p>Manage and protect your account</p>
            </div>
          </div>
          <div class="D_EditProfile_Details_Wrapper">
            <?php foreach($data['Get_Userprofile_Details'] as $User): ?>
            <form class="" action="<?= BASEURL;  ?>/Profile/ChangeProfileDetails" method="post" enctype="multipart/form-data">
              <div class="D_EditPassword_Details_Container">
                <div class="D_EditPassword_Detail_Wrapper">
                  Email: <input class="D_EditPassword_Inputs" type="text" id="fname" name="email" value="<?= $User['user_email'];  ?>">
                </div>
                <div class="D_EditPassword_Detail_Wrapper">
                  Username: <input class="D_EditPassword_Inputs" type="text" id="fname" name="username" value="<?= $User['user_name'];  ?>">
                </div>
                <div class="D_EditPassword_Detail_Wrapper">
                  Profile Picture: <input type="file" name="file" />
                </div>
              </div>
              <br>
              <?php endforeach;?>
              <div class="D_EditPassword_Button_Wrapper">
                <button type="submit" name="button" class="Edit_S_Buttons_100">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="" id="Addresses"  style="display:none">
        <div class="D_AddAddress_Wrapper">
          <a class="Edit_P_Buttons_100 Basic_Anchor noSelect margin_right_20" href="<?= BASEURL; ?>/Profile/Address">Add</a>
        </div>
        <?php foreach ($data['GetCurrentUserAddress'] as $Address): ?>
          <div class="D_ViewAddress_Wrapper">
            <div class="D_ViewAddress_Status">
              <?= $Address['address_status']; ?>
            </div>
            <div class="D_ViewAddress_Address">
              <?= $Address['address_street']; ?>
              <?= $Address['address_city']; ?>
              <?= $Address['address_state']; ?>
              <?= $Address['address_zip']; ?>
              <?= $Address['address_country']; ?>
            </div>
            <form class="D_ViewAddress_Btn" action="<?= BASEURL; ?>/Profile/ViewEditAddress" method="post">
              <button class="Edit_P_Buttons_100 margin_right_20" type="submit" name="Edit_Address_Id" value="<?= $Address['user_shipment_id']; ?>">Edit</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="" id="Password" style="display:none">
        <div class="D_Edit_Wrapper">
          <div class="D_EditPassword_Title_Wrapper">
            <h2>Change Password</h2>
            <p>For your account's security, do not share your password with anyone else</p>
          </div>
          <form class="D_EditPassword_Detailsx_Wrapper" action="<?= BASEURL;  ?>/Profile/ChangePassword" method="POST">
            <div class="D_EditPassword_Detail_Wrapper">
              Current Password: <input class="D_EditPassword_Inputs" type="password" id="fname" name="C_psw">
            </div>
            <div class="D_EditPassword_Detail_Wrapper">
              New Password: <input class="D_EditPassword_Inputs" type="password" id="fname" name="N_psw">
            </div>
            <div class="D_EditPassword_Detail_Wrapper">
              Confirm Password: <input class="D_EditPassword_Inputs" type="password" id="fname" name="R_psw">
            </div>
            <!--  <a class="Basic_Anchor noSelect" href="#">Forget your Password</a>-->
            <br>
            <div class="D_EditPassword_Button_Wrapper">
              <button type="submit" name="button" class="Edit_S_Buttons_100">Update</button>
            </div>
          </form>
        </div>
      </div>

      <!--<div class="" id="Wallet" style="display:none">
        <div class="">
          Wallet
        </div>
      </div>-->
      <br>
      <?php Flasher::flash(); ?>

    </main>
  </body>
</html>
<script type="text/javascript">

  document.getElementById('Profile_Button').onclick = function() {
    document.getElementById('Profile').style.display='block';
    document.getElementById('Addresses').style.display='none';
    document.getElementById('Password').style.display='none';
    document.getElementById('Wallet').style.display='none';
    document.getElementById('Profile_Button').classList.add("active");
    document.getElementById('Addresses_Button').classList.remove("active");
    document.getElementById('Password_Button').classList.remove("active");
  };

  document.getElementById('Addresses_Button').onclick = function() {
    document.getElementById('Profile').style.display='none';
    document.getElementById('Addresses').style.display='block';
    document.getElementById('Password').style.display='none';
    document.getElementById('Wallet').style.display='none';
    document.getElementById('Profile_Button').classList.remove("active");
    document.getElementById('Addresses_Button').classList.add("active");
    document.getElementById('Password_Button').classList.remove("active");
  };

  document.getElementById('Password_Button').onclick = function() {
    document.getElementById('Profile').style.display='none';
    document.getElementById('Addresses').style.display='none';
    document.getElementById('Password').style.display='block';
    document.getElementById('Wallet').style.display='none';
    document.getElementById('Profile_Button').classList.remove("active");
    document.getElementById('Addresses_Button').classList.remove("active");
    document.getElementById('Password_Button').classList.add("active");
  };


</script>
