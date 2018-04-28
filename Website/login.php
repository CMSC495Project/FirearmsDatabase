<?php
  session_start();
  header("x-content-type-options: nosniff"); // protects against MIME sniffing and XSS
  header("x-frame-options: deny"); //protects against click-jacking
?>
<html>
    <body>
    <?php
        require "database_connect.php";
        $user_email = $user_psw = $user_name = "";
        $valid_user = false;

        $user_email=$_POST['email'];

        $stmt=$mysqli->prepare("SELECT * FROM users WHERE user_email= ?");
        $stmt->bind_param('s', $user_email);
        $stmt->execute();

        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {
          $user = $stmt_result->fetch_assoc();
					$user_pass = $user["user_password"];
            if (password_verify($_POST['psw'], $user_pass)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $user_email;
                $valid_user = true;
            }
        }
	$stmt->close();
	$mysqli->close();

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
