<?php
  session_start();
?>
<html>
	<body>
		<?php 
			require "database_connect.php";
			$search_zip = $mysqli->escape_string($_POST['searchZip']);
      $handgun_total = $rifle_total = $shotgun_total = $other_total = 0;
			$query = "SELECT *  FROM registered_firearms WHERE register_zip='$search_zip'";
			
			$results = $mysqli->query($query);
      
			if ($results->num_rows > 0) {
				
				while($row = $results->fetch_assoc()) {
					if ($row["firearm_category"] == "Shotgun") {
						$shotgun_total = $shotgun_total + $row["quantity"];
					}
					if ($row["firearm_category"] == "Handgun") {
						$handgun_total = $handgun_total + $row["quantity"];
					}
					if ($row["firearm_category"] == "Rifle") {
						$rifle_total = $rifle_total + $row["quantity"];
					}
					if ($row["firearm_category"] == "Other") {
						$other_total = $other_total + $row["quantity"];
					}
				}
			}
      echo "<h>Registered Firearms in:</h> <h2>$search_zip</h2>";
			echo "<span><p2>Handguns:&nbsp;</p2><p3>$handgun_total</p3></span>
			<span><p2>Shotguns:&nbsp;&nbsp;</p2><p3>$shotgun_total</p3></span> 
			<span><p2>Rifles:&emsp;&emsp;&nbsp;&thinsp;&thinsp;&hairsp;</p2><p3>$rifle_total</p3></span> 
			<span><p2>Other:&emsp;&emsp;&ensp;&thinsp;&hairsp;</p2><p3>$other_total</p3></span>";
		?>
	</body>
</html>