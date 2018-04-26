<?php
  session_start();
header("x-content-type-options: nosniff");
header("x-frame-options: deny");
?>
<html>
    <body>
    <?php
        require "database_connect.php";    
          //Get the POST values 
$checkboxes=$_POST['checkboxes'];
/*
        if(isset($_POST['checkboxes'])) {
            foreach($_POST['checkboxes'] as $n) {
              $query = "DELETE FROM registered_firearms WHERE registered_arms_id='$n'"; 
              $mysqli->query($query);  
            }
        }
*/

 if(isset($checkboxes) {
            foreach($checkboxes as $n) {
//Prepare the sql statment
              	$stmt = mysqli->prepare("DELETE FROM registered_firearms WHERE registered_arms_id= ?"); 
             	$stmt->bind_param('s', $n);
		$stmt->execute();
//bind the result
		$stmt->bind_result($nResult);
		$stmt->fetch();


            }
        }

        header("location: CMSC495_MyAccount.php");

//close statement and connection
		$stmt->close();
		$mysqli->close();

    ?>
    </body>
</html>
