<!DOCTYPE html>
<html lang="en" dir="ltr">
  <br>
  <script rel="text/javascript" src="<?= BASEURL;  ?>/js/script.js"></script>
  <br>
  <body>
    <div id="A_M_C">
      <div id="A_M_W">
        <div id="A_L_I_W">
          <img src="<?= BASEURL;?>/img/logo.jpg">
        </div>
        <div id="A_M_L_W">
          <form id="A_L_F_W" action="<?= BASEURL;  ?>/Authenticate/UserLogin" method="post">
            <input type="text" class="A_Inputs" placeholder="Username" name="username">
            <br>
            <br>
            <input type="password" class="A_Inputs" placeholder="Password" name="psw">
            <div class="Forget_Password_Link_Wrapper">
              <a href="#" id="Forget_Password_Link">Forget Password?</a>
            </div>
            <br>
            <button type="submit" class="A_P_Buttons">Login</button>
          </form>
          <div class="A_R_W">
            <a href="<?= BASEURL;  ?>/Authenticate/Register">
              <button type="button" class="A_S_Buttons">Register</button>
            </a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <?php Flasher::flash(); ?>
  </body>
</html>
