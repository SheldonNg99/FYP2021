$(document).ready(function(){

  $('#First_Pswd').keyup(function() {
    // set password variable
    var pswd = $(this).val();
    var count = 0;
    //validate the length
    if ( pswd.length > 8 ) {
      $('#Pswd_length').removeClass('invalid').addClass('valid');
      count++;
    } else {
      $('#Pswd_length').removeClass('valid').addClass('invalid');
    }
    //validate letter
    if ( pswd.match(/[a-z]/) ) {
      $('#Pswd_letter').removeClass('invalid').addClass('valid');
      count++;
    } else {
      $('#Pswd_letter').removeClass('valid').addClass('invalid');
    }

    //validate capital letter
    if ( pswd.match(/[A-Z]/) ) {
      $('#Pswd_capital').removeClass('invalid').addClass('valid');
      count++;
    } else {
      $('#Pswd_capital').removeClass('valid').addClass('invalid');
    }

    //validate number
    if ( pswd.match(/\d/) ) {
      $('#Pswd_number').removeClass('invalid').addClass('valid');
      count++;
    } else {
      $('#Pswd_number').removeClass('valid').addClass('invalid');
    }

    // Close if once fullfill every requirement
    if (count == 4){
      $("#pswd_info").delay(1000).fadeOut(400);
      //$('#pswd_info').hide();
    }
    else{
      $('#pswd_info').show();
    }

  }).focus(function() {
      $('#pswd_info').show();
  }).blur(function() {
      $('#pswd_info').delay(1000).fadeOut(400);
  });

  $('#Second_Pswd').blur(function() {
    var pass = $('#First_Pswd').val();
    var repass = $('#Second_Pswd').val();

    if (pass != repass) {
      $('#Second_Pswd').addClass('has-error');
      $('#Close_Message_Error_Box').fadeIn(200);
    }
    else{
      $('#Second_Pswd').removeClass('has-error');
    }

  });





});
