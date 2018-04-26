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

/*     
     
	 $user_email = $mysqli->escape_string($_POST['email']);
        $query = "SELECT * FROM users WHERE user_email='$user_email'";
        $results = $mysqli->query($query); 
*/

/*  ========= Begin Edit ===============*/
//Get the POST value
	$user_email=$_POST['email'];
	
//Prepare sql statement
	$stmt=mysqli->prepare("SELECT * FROM users WHERE user_email= ?");
	$stmt->bind_param('s', $user_email);
	$stmt->execute();
//Bind the result
	$stmt->bind_result($user_emailResult);
	$stmt->fetch();
/*  ======== End edit ==================*/


        if ($results->num_rows > 0) {
          $user = $results->fetch_assoc();
					$user_pass = $user["user_password"];
            if (password_verify($_POST['psw'], $user_pass)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $user_email;
                $valid_user = true;
            }
        }

//Close statement and connection
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
