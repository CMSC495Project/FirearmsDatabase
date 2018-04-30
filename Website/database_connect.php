<html>
    <body>
    <?php

        $host = "guntracker.coowhgohnbdb.us-west-2.rds.amazonaws.com";
        $user = "root";
        $db_pass = "password12";
        $db = "guntracker";
        $mysqli = new mysqli($host,$user,$db_pass,$db);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
    ?>
    
    </body>
</html>
