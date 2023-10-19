<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <main class="Main_Section_Container">
      <div class="D_Back_Button_Container">
        <a class="Basic_Anchor noSelect Edit_P_Buttons_100"href="<?= BASEURL;  ?>/Profile/Edit">Back</a>
      </div>

      <div class="Address_Container">
        <form class="Address_Wrapper" action="<?= BASEURL;  ?>/Profile/AddAddress" method="POST">
          <div class="Address_Input_Wrapper">
            <span class="Address_label">Street Name: </span><input class="D_Address_Inputs" type="text" name="Address_street" value="">
          </div>
          <div class="Address_Input_Wrapper">
            <span class="Address_label">City: </span><input class="D_Address_Inputs"  type="text" name="Address_City" value="">
          </div>
          <div class="Address_Input_Wrapper">
            <span class="Address_label">State: </span><input class="D_Address_Inputs"  type="text" name="Address_state" value="">
          </div>
          <div class="Address_Input_Wrapper">
            <span class="Address_label">Zip Code: </span><input class="D_Address_Inputs"  type="text" name="Address_ZipCode" value="">
          </div>
          <div class="Address_Input_Wrapper">
            <span class="Address_label">Country: </span><input class="D_Address_Inputs"  type="text" name="Address_Country" value="">
          </div>
          <div class="Address_Buttons_Wrapper">
            <button class="Edit_P_Buttons_100" type="submit" name="button">Submit</button>
          </div>
        </form>
      </div>

      <br>
      <?php Flasher::flash(); ?>

    </main>
  </body>
</html>
