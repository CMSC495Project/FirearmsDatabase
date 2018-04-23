<?php
  session_start();
?>
<html>
    <body>
    <?php
        require "database_connect.php";        
        if(isset($_POST['checkboxes'])) {
            foreach($_POST['checkboxes'] as $n) {
              $query = "DELETE FROM registered_firearms WHERE registered_arms_id='$n'"; 
              $mysqli->query($query);  
            }
        }
        header("location: CMSC495_MyAccount.php");
    ?>
    </body>
</html>