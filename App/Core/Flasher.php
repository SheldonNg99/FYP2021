<?php

class Flasher{
  //Static allow us to class the method without instantiate it
  public static function setFlash($message){
    $_SESSION['flash'] = [
      'message' => $message
    ];
  }

  public static function flash(){
    if(isset($_SESSION['flash'])){
      echo '<div id="Close_Message_Error_Box" class="A_Message_Box_C">
              <div class="A_Message_Detail">
                '.$_SESSION['flash']['message'].'
              </div>
              <div class="A_Message_B_W">
                <button type="button" id="Close_Message_Error_Button" class="A_P_E_Buttons" name="button"> Ok </button>
              </div>
            </div>';
      unset($_SESSION['flash']);
    }
  }
}
