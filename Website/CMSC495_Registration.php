<?php
session_start();
header("x-content-type-options: nosniff"); // protects against MIME sniffing and XSS
header("x-frame-options: deny"); //protects against click-jacking
if(!isset($_SESSION['logged_in'])) {
  $_SESSION['logged_in'] = false;
}
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
    <a class="navbarItem" id="loginAccount" onclick="overlayOn('loginOverlay')">Login</a>
    <span class="dropdown" id="myAccount">
      <a class="navbarItem">My Account</a>
      <span class="dropdown-contents" id="myAccount-contents">
        <a href="CMSC495_MyAccount.php">My Registrations</a>
        <a href="logout.php">Logout</a>
      </span>
    </span>
  </div>

  <!======== Registration Content ======= >

	<div class="regMain">
		<div class="regContainer">
			<div class="regForm" style="grid-area: regForm">
				<form style="display: grid" id="gunregForm" action="reg_firearm.php" method="POST">
					<h1 style="font-size: 1.5em">* Required Field</h1>
					<label class="regLabels" for="fName" style="grid-area: nameLabel ">Name:</label>
					<input type="text" name="fName" id="fName" placeholder="First Name" style="grid-area: fname">
					<input type="text" name="mInitial" id="mInitial" placeholder="M.I" style="grid-area: minitial">
					<input type="text" name="lName" id="lName" placeholder="Last Name" style="grid-area: lname">
					<label class="regLabels" for="address1" style="grid-area: addressLabel">Address:</label>
					<input type="text" name="address1" id="adr1" placeholder="Address Line 1" style="grid-area: address1">
					<input type="text" name="address2" id="adr2" placeholder="Address Line 2" style="grid-area: address2">
					<input type="text" name="address3" id="adr3" placeholder="Address Line 3" style="grid-area: address3">
					<input type="text" name="city" id="city" placeholder="City" style="grid-area: city">
					<input type="text" name="state" id="state" placeholder="ST" style="grid-area: state">
					<input type="number" name="zipcode" id="zipcode" placeholder="Zipcode" style="grid-area: zipcode" min="0" required>
					<label style="grid-area: required; font-size: 20px">*</label>
					<label class="regLabels" style="grid-area: faLabel; margin-top: 25px">Firearm Information:</label>
					<div class="firearmReg" style="grid-area: fainfo">
						<div class="dropdown" style="grid-area: faType1">
              <button type="button" id="firearm1Btn" name="firearm1">Firearm Type</button>
							<div class="dropdown-contents">
								<a onclick="setFirearmType('firearm1Btn','Rifle')">Rifle</a>
								<a onclick="setFirearmType('firearm1Btn','Shotgun')">Shotgun</a>
								<a onclick="setFirearmType('firearm1Btn','Handgun')">Handgun</a>
								<a onclick="setFirearmType('firearm1Btn','Other')">Other</a>
							</div>
						</div>
						<input type="number" id="qty1" name="qty1" placeholder="Quantity" min="0" required>
						<button type="button" title="Add Another Firearm" onclick="addFirearm('firearm2')">+</button>

						<div class="dropdown firearm2" style="grid-area: faType2">
							<button type="button" id="firearm2Btn" name="firearm2">Firearm Type</button>
							<div class="dropdown-contents">
								<a onclick="setFirearmType('firearm2Btn','Rifle')">Rifle</a>
								<a onclick="setFirearmType('firearm2Btn','Shotgun')">Shotgun</a>
								<a onclick="setFirearmType('firearm2Btn','Handgun')">Handgun</a>
								<a onclick="setFirearmType('firearm2Btn','Other')">Other</a>
							</div>
						</div>
						<input class="firearm2" type="number" id="qty2" name="qty2" placeholder="Quantity" min="0">
						<button class="firearm2" type="button" title="Add Another Firearm" onclick="addFirearm('firearm3')">+
						</button>

						<div class="dropdown firearm3" style="grid-area: faType3">
							<button type="button" id="firearm3Btn" name="firearm3">Firearm Type</button>
							<div class="dropdown-contents">
								<a onclick="setFirearmType('firearm3Btn','Rifle')">Rifle</a>
								<a onclick="setFirearmType('firearm3Btn','Shotgun')">Shotgun</a>
								<a onclick="setFirearmType('firearm3Btn','Handgun')">Handgun</a>
								<a onclick="setFirearmType('firearm3Btn','Other')">Other</a>
							</div>
						</div>
						<input class="firearm3" type="number" id="qty3" name="qty3" placeholder="Quantity" min="0">
						<button class="firearm3" type="button" title="Add Another Firearm" onclick="addFirearm('firearm4')">+
						</button>

						<div class="dropdown firearm4" style="grid-area: faType4">
							<button type="button" id="firearm4Btn" name="firearm4">Firearm Type</button>
							<div class="dropdown-contents">
								<a onclick="setFirearmType('firearm4Btn','Rifle')">Rifle</a>
								<a onclick="setFirearmType('firearm4Btn','Shotgun')">Shotgun</a>
								<a onclick="setFirearmType('firearm4Btn','Handgun')">Handgun</a>
								<a onclick="setFirearmType('firearm4Btn','Other')">Other</a>
							</div>
						</div>
						<input class="firearm4" type="number" id="qty4" name="qty4" placeholder="Quantity">
					</div>
					<button type="submit" id="submit">Submit</button>
					<button onclick="removeFirearm()" type="reset" id="clearform">Clear Form</button>
					<div id="regError"></div>
					<div class="tosContainer" style="grid-area: tos">
						<div style="; height: 15%; width: 100%; background-color: #afceff"></div>
					<div style="height: 375px; width: 100%; background-color: white">
						<h1>ToS</h1>
						<h3 style="color: black; text-align: center" id="tosText">
              By using this form you agree to share your firearm registration information to all users that vist this site and understand that all information submitted, including personally identifiable information, will be archived until you request removal.</h3>
					</div>
					<div style="height: 15%; width: 100%; background-color: #afceff"></div>
					<div id="ackBox">
						<span><input type="checkbox" name="checkbox" required><label style="margin-left: 10px;">Acknowledge</label></span>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<! ======== Overlays for Login, Signup, and About ======== >

<! ======== About Overlay ======== >
<div class="modal" id="aboutOverlay" onclick="overlayOff('aboutOverlay')">
  <div class="animate" id="about">
    <div class="aboutBox">
      <div class="bigborder"></div>
      <div id="aboutText">
        <h style="font-size: 35px;color:white">About this Project</h><br><br>
        <p>There exists a gap in the marketplace for a centralized database tool that allows for tracking owners of firearms and especially for collecting and maintaining geographical data for those owners. There are a range of customers who could benefit from such a tool, from government agencies concerned about public safety to firearms manufacturers who want more sophisticated information about their customers.
        </p>

        <p>This project will develop a flexible, scalable database tool to provide for sophisticated firearm owner tracking. The database will be hosted on an instance of Amazon S3 and will have a website that will show graphically where owners are located geographically according to their registration.
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
    $("#loginForm, #signupForm, #gunregForm").submit(function(event) {
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
        if (element == "gunregForm" && !loggedIn) {
            event.preventDefault();
            $("#regError").text("You must be logged in to register a firearm.");
          
        } else {
            event.preventDefault();
            var fname = $("#fName").val();
            var lname = $("#lName").val();
            var mi = $("#mInitial").val();
            var adr1 = $("#adr1").val();
            var adr2 = $("#adr2").val();
            var adr3 = $("#adr3").val();
            var city = $("#city").val();
            var state = $("#state").val();
            var zip = $("#zipcode").val();
            var fa1 = $("#firearm1Btn").text();
            var qty1 = $("#qty1").val();
            var fa2 = $("#firearm2Btn").text();
            var qty2 = $("#qty2").val();
            var fa3 = $("#firearm3Btn").text();
            var qty3 = $("#qty3").val();
            var fa4 = $("#firearm4Btn").text();
            var qty4 = $("#qty4").val();
            $("#regError").load("reg_firearm.php", {
              fName: fname,
              lName: lname,
              mInitial: mi,
              address1: adr1,
              address2: adr2,
              address3: adr3,
              city: city,
              state: state,
              zipcode: zip, 
              firearm1: fa1,
              qty1: qty1,
              firearm2: fa2,
              qty2: qty2,
              firearm3: fa3,
              qty3: qty3,
              firearm4: fa4,
              qty4: qty4
            });
          $("#gunregForm input").css("border-style", "none");
          $("#gunregForm a").css("border-style", "none");
        }
    });
  });
  </script>
</footer>
</html>
