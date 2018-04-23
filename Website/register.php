<?php
  session_start();
?>
<html>
<body>

  <?php
  require "database_connect.php";

  $user_email = $mysqli->escape_string($_POST['reg_email']);
  $psw = $mysqli->escape_string($_POST['reg_psw']);
  $psw_repeat = $mysqli->escape_string($_POST['reg_psw_repeat']);
  $valid_entry = true;
  $query = "SELECT * FROM users WHERE user_email='$user_email'";
  $results = $mysqli->query($query);
  $error_message = 0;
  

  
  if ($psw != $psw_repeat) {
    $valid_entry = false;
    $error_message = 1;
  }

  if (strlen($psw) < 8) {
    $valid_entry = false;
    $error_message = 2;
  }

  if($results->num_rows > 0) {
    $valid_entry = false;
    $error_message = 3;
    
  if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
		$valid_entry = false;
		$error_message = 4;
	}
    
  } else if ($valid_entry && ($results->num_rows == 0)) {
    $hash = $mysqli->escape_string(password_hash($_POST['reg_psw'], PASSWORD_DEFAULT));
    $sql = "INSERT INTO users (user_email, user_password)
    VALUES ('$user_email', '$hash')";
    $mysqli->query($sql);
  }
  
  ?>
<script>
  var valid_entry = "<?php echo $valid_entry; ?>";
  var error_message = "<?php echo $error_message; ?>";
  if (!valid_entry) {
    switch(error_message) {
      case '1':
        error_message = "Passwords do not match";
        $("#reg_psw_repeat,#reg_psw").css("border-style", "solid");
        $("#reg_psw_repeat,#reg_psw").css("border-color", "tomato");
        break;
      case '2':
        error_message = "Password must contain at least 8 characters";
        $("#reg_psw_repeat,#reg_psw").css("border-style", "solid");
        $("#reg_psw_repeat,#reg_psw").css("border-color", "tomato");
        break;
      case '3':
        error_message = "That E-mail Address already exists.";
        $("#reg_email").css("border-style", "solid");
        $("#reg_email").css("border-color", "tomato");
        break;
      case '4':
        error_message = "Invalid email, please check format";
        $("#reg_email").css("border-style", "solid");
        $("#reg_email").css("border-color", "tomato");
        break;
    }
    $("#signupError").text(error_message);
  } else {
    window.location.href = "CMSC495_Home.php";
  }
</script>

</body>
</html>
