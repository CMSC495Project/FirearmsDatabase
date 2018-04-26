<?php
  session_start();
?>
<html>
	<body>
		<?php
		require "database_connect.php";
		$user_fname = $user_mi = $user_lname = $user_address1 = $user_address2 = "";
		$user_address3 = $user_city = $user_state = $user_zipcode = $user_firearm1 = "";
		$user_firearm2 = $user_firearm3 = $user_firearm4 = $user_quantity1 = "";
		$user_quantity2 = $user_quantity3 = $user_quantity4 = $user_email = "";
		$user_fname = $mysqli->escape_string($_POST['fName']);
		$user_mi = $mysqli->escape_string($_POST['mInitial']);
		$user_lname = $mysqli->escape_string($_POST['lName']);
		$user_address1 = $mysqli->escape_string($_POST['address1']);
		$user_address2 = $mysqli->escape_string($_POST['address2']);
		$user_address3 = $mysqli->escape_string($_POST['address3']);
		$user_city = $mysqli->escape_string($_POST['city']);
		$user_state = $mysqli->escape_string($_POST['state']);
		$user_zipcode = $mysqli->escape_string($_POST['zipcode']);
		$fa1 = $mysqli->escape_string($_POST['firearm1']);
		$fa2 = $mysqli->escape_string($_POST['firearm2']);
		$fa3 = $mysqli->escape_string($_POST['firearm3']);
		$fa4 = $mysqli->escape_string($_POST['firearm4']);
		$qty1 = $mysqli->escape_string($_POST['qty1']);
		$qty2 = $mysqli->escape_string($_POST['qty2']);
		$qty3 = $mysqli->escape_string($_POST['qty3']);
		$qty4 = $mysqli->escape_string($_POST['qty4']);
		$logged_in = $_SESSION['logged_in'];
		$query_zip = "SELECT * FROM state_zip WHERE zip='$user_zipcode'";
		$valid_entry = true;
		$error_message = "";
		$firearm_array = array("$fa1"=>"$qty1","$fa2"=>"$qty2","$fa3"=>"$qty3","$fa4"=>"$qty4");
		$reg_array = array("$fa1","$qty1","$fa2","$qty2","$fa3","$qty3","$fa4","$qty4");
		
		if($logged_in == true) {
			$user_email = $_SESSION['email'];
		}
		
		for($i = 0; $i < count($reg_array) - 1; ++$i) {
			if($reg_array[$i] == "Firearm Type" && $reg_array[$i+1] > 0) {
				$valid_entry = false;
				$error_message = 1;
			}
			$i++;
		}

		if ($fa1 == 'Firearm Type') {
			$valid_entry = false;
			$error_message = 2;
		}


		$results = $mysqli->query($query_zip);
		if($results->num_rows == 0) {
			$error_message = 3;
			$valid_entry = false;
		} else {
				while($row = $results->fetch_assoc()) {
					if($user_state != $row['state']) {
					$valid_entry = false;
					$error_message = 4;
					break;
				}
			}
		}
 
		
		if ($valid_entry == true) {
			echo "Registration Submitted";
			$query = "INSERT INTO registrants (
				first_name, 
				middle_initial, 
				last_name,  
				address_line1, 
				address_line2, 
				address_line3, 
				city, 
				state, 
				zipcode,
				registrant_email) 
				VALUES('$user_fname', '$user_mi', '$user_lname', '$user_address1', '$user_address2',
				'$user_address3', '$user_city', '$user_state', '$user_zipcode', '$user_email')";
			
			$mysqli->query($query);
			for($i = 0; $i < count($reg_array) - 1; ++$i) {
						if($reg_array[$i] != "Firearm Type" && $reg_array[$i+1] > 0) {
							$fa = $reg_array[$i];
							$fa_qty = $reg_array[$i+1];
							$query = "INSERT INTO registered_firearms (
							register_zip,
							firearm_category,
							quantity,
							registrant_email
							)
							VALUES('$user_zipcode','$fa','$fa_qty','$user_email')";
							$mysqli->query($query);
						}
						$i++;
					}
			}
			
			
		
		?>
		
		<script>
			var valid_entry = "<?php echo $valid_entry; ?>";
			var error_message = "<?php echo $error_message; ?>";
			
			if (valid_entry == false) {
				switch(error_message) {
					case '1':
						error_message = "Registered firearms must have a type.";
						break;
					case '2':
						error_message = "You must register at least one firearm.";
						$("#firearm1Btn").css("border-style", "solid");
						$("#firearm1Btn").css("border-color", "tomato");
						break;
					case '3':
						error_message = "Unkown Zipcode";
						$("#zipcode").css("border-style", "solid");
						$("#zipcode").css("border-color", "tomato");
						break;
					case '4':
						error_message = "Zipcode and State do not match.";
						$("#zipcode, #state").css("border-style", "solid");
						$("#zipcode, #state").css("border-color", "tomato");
						break;
				}
        $("#regError").text(error_message);
			} 
			
		</script>
	</body>
</html>
