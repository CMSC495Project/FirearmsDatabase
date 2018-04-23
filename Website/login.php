<?php
  session_start();
?>
<html>
    <body>
    <?php
        require "database_connect.php";
        $user_email = $user_psw = $user_name = "";
        $valid_user = false;
        $user_email = $mysqli->escape_string($_POST['email']);
        $query = "SELECT * FROM users WHERE user_email='$user_email'";
        $results = $mysqli->query($query); 

        if ($results->num_rows > 0) {
          $user = $results->fetch_assoc();
					$user_pass = $user["user_password"];
            if (password_verify($_POST['psw'], $user_pass)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $user_email;
                $valid_user = true;
            }
        }
    ?>
    <script>
        var validUser = "<?php echo $valid_user; ?>";
        var userName = "<?php echo $user_email; ?>";

        if (validUser == false) {
            $(".loginInput").css("border-color", "tomato");
            $("#loginError").text("Incorrect Username or Password");
        } else {
            window.location.href = "CMSC495_Registration.php";
        }
    </script>
    </body>
</html>
