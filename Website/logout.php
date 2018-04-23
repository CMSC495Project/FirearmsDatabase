<?php
  session_start();
?>
<html>
    <body>
        <?php
            session_destroy();
            header("location: CMSC495_Home.php");
        ?>
    </body>
</html>