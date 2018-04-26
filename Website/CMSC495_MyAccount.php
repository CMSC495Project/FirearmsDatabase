<?php
session_start();
require "database_connect.php";

$user_email = $_SESSION['email'];
$query = "SELECT * FROM registered_firearms WHERE registrant_email='$user_email'";
$results = $mysqli->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Prevent clickjacking -->
  <meta http-equiv="X-Frame-Options" content="deny"> 
    <!-- Anti-MIME sniffing -->
  <meta http-equiv="x-content-type-options" content="nosniff">
    <!-- Prevent cross-site scripting --> 
  <meta http-equiv="X-XSS-Protection: 1; mode=block"> 
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
      <div class="bigborder"></div>
      <div id="aboutText">
        <h style="font-size: 35px;color:white">About this Project</h><br><br>
        <p>There exists a gap in the marketplace for a centralized database tool
          that allows for tracking owners of firearms and especially for collecting
          and maintaining geographical data for those owners. There are a range of
          customers who could benefit from such a tool, from government agencies 
          concerned about public safety to firearms manufacturers who want more 
          sophisticated information about their customers.
        </p>

        <p>This project will develop a flexible, scalable database tool to provide for
          sophisticated firearm owner tracking. The database will be hosted on an instance
          of Amazon S3 and will have a website that will show graphically where owners are
          located geographically according to their registration.
        </p>
        
        </div>
      <div class="bigborder">
        <br>
        <h style="font-size: 27px; margin-top: 30px; color:white">This project was created for educational purposes only
        </h>
      </div>
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
