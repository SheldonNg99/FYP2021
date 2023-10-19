<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Comment</title>
  </head>
  <body>
    <main class="Main_Section_Container">

      <div class="D_Back_Button_Container">
        <div class="D_UserProfile_title"> Edit Comment </div>
        <!--<a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Product/Myproducts">Back</a>-->
      </div>

      <!--<div class="D_Back_Button_Container">
        <a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Product/Myproducts">Back</a>
      </div>-->

      <div class="D_Review_Container">
        <form class="D_Review_Form_Wrapper" action="<?= BASEURL;  ?>/Comment/EditComment" method="post">
          <?php foreach ($data['Get_Comment_Based_On_Comment_Id'] as $Comment): ?>
          <div class="D_Review_UserProfile_Image_Wrapper">
            <?php if ($Comment['Profile_picture'] == null): ?>
              <img class="D_Review_UserProfile_Image" src="<?= BASEURL;  ?>/img/Userprofile/default.png">
            <?php else: ?>
              <img class="D_Review_UserProfile_Image " src="<?= BASEURL;  ?>../<?= $Comment['Profile_picture']; ?>">
            <?php endif; ?>
          </div>
          <?php endforeach;?>
          <div class="D_Review_Input_Wrapper">
            <input type="text" class="D_Review_Input" name="Comment" placeholder="Write your comment here" value="<?= $Comment['User_Comment']; ?>">
            <button class="D_Review_Button" type="submit" name="button"><i class="fa fa-comment"></i></button>
            <input type="hidden" name="User_Comment_Id" value="<?= $Comment['User_Comment_Id'];  ?>">
            <input type="hidden" name="Product_Id" value="<?= $Comment['Product_Id'];  ?>">
          </div>
        </form>
      </div>



      <br>
      <?php Flasher::flash(); ?>

    </main>
  </body>


</html>
