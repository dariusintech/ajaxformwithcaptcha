<?php

  // Form Validation

  if (isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $errorName = false;
    $errorEmail = false;
    $errorMessage = false;
    $errorEmailFormat = false;
    $recaptcha = false;
    
    // Captcha Verify

    $captcha=$_POST['gcaptcha'];

    $secretKey = "SECRET_KEY_HERE";

    $ip = $_SERVER['REMOTE_ADDR'];
  
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);

    $response = file_get_contents($url);

    $responseKeys = json_decode($response,true);

    if($responseKeys["success"]) {
      $recaptcha = true;
    }

    // Form Verify

    if(empty($name)) {

      echo "<span class='form-error'>Please fill the Name field!</span>";
      $errorName = true;

    }elseif(empty($email)){

      $errorEmail = true;
      echo "<span class='form-error'>Please fill the Email field!</span>";

    }elseif(empty($message)){

      echo "<span class='form-error'>Please fill the Message field!</span>";
      $errorMessage = true;

    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

      echo "<span class='form-error'>Email is not valid</span>";
      $errorEmailFormat = true;

    }elseif($recaptcha === false){
      echo "<span class='form-error'>Please check the the captcha form.</h2>";
    }else{

      echo "<span class='form-success'>The form was sent successfully!</span>";

    }

  }else{
    echo "There was an error!";
  }

?>

<script>

  // Javascript for classes color

  $("#name, #email, #message").removeClass("input-error");

  var errorName = "<?php echo $errorName; ?>";
  var errorEmail = "<?php echo $errorEmail; ?>";
  var errorMessage = "<?php echo $errorMessage; ?>";
  var errorEmailFormat = "<?php echo $errorEmailFormat; ?>";
  var recaptcha = "<?php echo $recaptcha; ?>";

  if(errorName == true){
    $("#name").addClass("input-error");
  }

  if(errorEmail == true){
    $("#email").addClass("input-error");
  }

  if(errorMessage == true){
    $("#message").addClass("input-error");
  }

  if(errorEmail == true){
    $("#email").addClass("input-error");
  }

  if(errorEmailFormat == true){
    $("#email").addClass("input-error");
  }

  if(errorName == false && errorEmail == false && errorMessage == false && errorEmailFormat == false && recaptcha == true){
    $("#name, #email, #message").val("");
    grecaptcha.reset();
  }

</script>


<?php 


  function sendmail($to, $subject, $message, $from) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= 'From: Northstar Mortgage Corp -- website form <no-reply@northstarmortgage.com>'. "\r\n";
    $headers .= 'Bcc: backupleads.insegment@gmail.com' ."\r\n";
    $headers .= 'Reply-to: ' . $from . "\r\n";
    $result = mail($to,$subject,$message,$headers);

    if ($result) return 1;
    else return 0;
  }

  if($errorName == false && $errorEmail == false && $errorMessage == false && $errorEmailFormat == false && $recaptcha == true){
  
    $to = 'NorthStar Mortgage <opropro@gmail.com>';

    $from = $name . ' <' . $email . '>';

    $subject = 'Email from ' . $name;
    $message = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head></head>
    <body>
    <table>
      <tr><td>Name: </td><td>' . $name . '</td></tr>
      <tr><td>Email: </td><td>' . $email . '</td></tr>
      <tr><td>Message: </td><td>' . nl2br($message) . '</td></tr>
    </table>
    </body>
    </html>';

    //send the mail
    sendmail($to, $subject, $message, $from);

  }


?>