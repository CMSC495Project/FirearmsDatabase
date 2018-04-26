<?php
session_start();
if(!isset($_SESSION['logged_in'])) {
  $_SESSION['logged_in'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CMSC495_Layout.css">
    <script src="CMSC495_JavaScript.js"></script>
    <title>Firearm Registry</title>
</head>
<body>
    <div class="w3-display-container" style="overflow: hidden">
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
    <a class="navbarItem" id="loginAccount" onclick="overlayOn('loginOverlay')">Login</a>
    <span class="dropdown" id="myAccount">
      <a class="navbarItem">My Account</a>
      <span class="dropdown-contents" id="myAccount-contents">
        <a href="CMSC495_MyAccount.php">My Registrations</a>
        <a href="logout.php">Logout</a>
      </span>
    </span>
  </div>

    <div class="main" id="main" style="height: 90em">
        <div class="mainContainer">          
          <h3>Search Registered Firearms in Your Area</h3>
          <div class="searchContainer">
              <div class="searchBar">
                <form id="searchForm" action="firearm_map.php" method="POST">
                  <input id="searchZip" name="searchZip" type="textbox" placeholder="Search in Zipcode ...">
                  <button id="search" type="submit">Search</button>
                </form>
              </div>
          </div>
          <div class="mapContainer">
            <div class="modal" id="searchModal">
              <div class="searchResults animate" id="searchResults"></div>
            </div>
              <div id="map"> </div>
              <script onload="initMap()"></script>
              <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6CkAuPApPgoSSMDaRrTELah_4Bcv05hI&callback=initMap"></script>   
          </div>
        </div>
      
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

<! ======== Login Overlay ======= >
<div class="modal" id="loginOverlay">
  <form class="modal-content animate" id="loginForm" action="login.php" method="POST" autocomplete="off">
    <div class="imgcontainer" style="width:40%; height: 200px; margin: auto">
      <img src="placeholderRound.png" alt="Avatar" class="avatar" style="width: 100%; padding: 20px;">
    </div>
    <div class="loginContainer">
      <label class="loginLabel"><b>Username</b></label>
      <input class="loginInput" type="email" name="email" id="email" placeholder="Enter Email Address" required>
      <label class="loginLabel"><b>Password</b></label>
      <input class="loginInput" type="password" name="psw" id="psw" placeholder="Enter Password" required>
      <button type="submit" id="login">Login</button>
    </div>
    <p id="loginError"> </p>
    <div class="bottomButtonsContainer">
      <span><a onclick="overlayOff('loginOverlay'); overlayOn('signupOverlay')">Need an Account?</a></span>
      <span><a href="#">Forgot password?</a></span>
    </div>
  </form>
</div>

<! ======== Signup Overlay ======== >
<div class="modal" id="signupOverlay">
  <form class="modal-content" id="signupForm" action="register.php" method="POST" autocomplete="off">
    <div class="signupContainer">
      <p><b>Complete the form below<br> to request an account</b></p>
      <label class="signupLabels"><b>Email</b></label>
      <input class="signupInput" type="email" name="reg_email" id="reg_email" placeholder="Enter Email"  required>
      <label class="signupLabels" for="psw"><b>Password</b></label>
      <input class="signupInput" type="password" name="reg_psw" id="reg_psw" placeholder="Enter Password" required>
      <label class="signupLabels" for="psw-repeat"><b>Repeat Password</b></label>
      <input class="signupInput" type="password" name="reg_psw_repeat" id="reg_psw_repeat" placeholder="Repeat Password"  required>
      <p id="signupError"> </p>
      <p>By creating an account you agree to our <br><a href="#" style="color:dodgerblue">Terms of Service</a>.</p>
    </div>
    <div class="bottomButtonsContainer">
      <button type="button" onclick="overlayOff('signupOverlay')">Cancel</button>
      <button type="submit" id="register">Submit</button>
    </div>
  </form>
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
  <script>    
  $(document).ready(function() { 
    var loggedIn = "<?php echo $_SESSION['logged_in']; ?>";
    if(loggedIn) {
      $("#loginAccount").css("display", "none");
      $("#myAccount").css("display", "block")
    }
    $("#loginForm, #signupForm, #searchForm").submit(function(event) {
      var element = $(this).attr("id");
      if (element == "loginForm") {
          event.preventDefault();
          var email = $("#email").val();
          var psw = $("#psw").val();
          $("#loginError").load("login.php", {
              email: email,
              psw: psw
          });
      $("#loginForm input").css("border-color", "#f0f3f6");
      }
      if (element == "signupForm") {
          event.preventDefault();
          var email = $("#reg_email").val();
          var psw = $("#reg_psw").val();
          var pswRepeat = $("#reg_psw_repeat").val();
          $("#signupError").load("register.php", {
              reg_email: email,
              reg_psw: psw,
              reg_psw_repeat: pswRepeat
          });
      $("#signupForm input").css("border-color", "#f0f3f6");
      }
      if (element == "searchForm") {
          event.preventDefault();
          var zip = $("#searchZip").val();
          $("#searchResults").load("firearm_map.php", {
              searchZip: zip
          });
      }
    });
  });
  </script>
</footer>
</html>
