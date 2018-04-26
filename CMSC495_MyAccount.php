<?php
session_start();
 header("x-content-type-options: nosniff"); // protects against MIME sniffing and XSS
 header("x-frame-options: deny"); //protects against click-jacking
require "database_connect.php";


/*
$user_email = $_SESSION['email'];
$query = "SELECT * FROM registered_firearms WHERE registrant_email='$user_email'";
$results = $mysqli->query($query);
*/

/* ========== Begin edit ========*/
//Get SESSION variable
	$user_email = $_SESSION['email'];
//Prepare statement
	$stmt=mysqli->prepare("SELECT * FROM registered_firearms WHERE registrant_email= ?");
	$stmt->bind_param('s', $user_email);
	$stmt->execute();
//Bind the result
	$stmt->bind_result($user_emailResult);
	$stmt->fetch();
/* ========== End edit ========*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" type="text/css" href="CMSC495_Layout.css">
  <script src="CMSC495_JavaScript.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>Firearm Registry</title>


</head>
<body>
  <div class="w3-display-container">
    <img src="banner-flag-us.png" class="w3-image" style="width: 100%">
    <div class="w3-display-middle" style="width: 100%; text-align: center">
      <h1 style="font-size: 3em">Voluntary Firearm Registration</h1>
      <h2 style="font-size: 2em">Providing a visualization of voluntarily registered firearms in your area.</h2>
    </div>
  </div>

  <! ======== Nav Bar ======== >

  <div class="navbar" id="navBar">
    <a class="navbarItem" href="CMSC495_Home.php">Home</a>
    <a class="navbarItem" href="CMSC495_Registration.php">Registration</a>
    <a class="navbarItem" onclick="overlayOn('aboutOverlay')">About</a>
    <span class="dropdown" id="myAccount" style="display: block">
      <a class="navbarItem">My Account</a>
      <span class="dropdown-contents" id="myAccount-contents">
        <a>My Registrations</a>
        <a href="logout.php">Logout</a>
      </span>
    </span>
  </div>
  
  <div class="accountMain">
    <form id="accountForm" action="remove_entries.php" method="POST">
      <div class="accountContainer">
        <table id="accountTable">
          <tr>
            <th>Registration ID</th>
            <th>Registration Zip</th>
            <th>Firearm Type</th>
            <th>Firearm Quantity</th>
            <th>Remove Entry</th>
          <?php
            $entry_num = 0;
            while($row = $results->fetch_assoc()){
              $entry_num = "\"" . $row['registered_arms_id'] . "\"";
              echo "<tr>";
              echo "<td>" . $row['registered_arms_id'] . "</td>";
              echo "<td>" . $row['register_zip'] . "</td>";
              echo "<td>" . $row['firearm_category'] . "</td>";
              echo "<td>" . $row['quantity'] . "</td>";
              echo "<td><input type='checkbox' class='rem_entries' name='checkboxes[]' value=$entry_num></td>";
            }

//Close statement and connection
	$stmt->close();
	$mysqli->close();


          ?>
        </table>
      </div>
      <div class="btnContainer">
        <div id="checkAndSubmit">
        <button type="button" onclick="checkAll(this)">Check All</button>
        <button type="submit" id="removeEntries" style="float:right">Remove Checked Entries</button>
        </div>
      </div>
    </form>
  </div>
  
<! ======== Overlays for Login, Signup, and About ======== >

<! ======== About Overlay ======== >
<div class="modal" id="aboutOverlay" onclick="overlayOff('aboutOverlay')">
  <div class="animate" id="about">
    <div class="aboutBox">
      <p>Some Stuff About Us</p>
    </div>
  </div>
</div>
</body>

<footer>
  <div class="footer" style="text-align: center">
    <h1 style="grid-column: 1/6; padding: 1%"> Project Contributors</h1>
    <h2>Michael Manteuffel</h2>
    <p>Project Manager</p>
    <h2>Erik Faulk</h2>
    <p>Web Developer</p>
    <h2>Moses Daniels</h2>
    <p>Database Developer</p>
    <h2>Aaron Turner</h2>
    <p>Security Analyst</p>
    <h2>Rachel Flores</h2>
    <p>AWS Developer</p>
  </div>
</footer>
</html>
























































