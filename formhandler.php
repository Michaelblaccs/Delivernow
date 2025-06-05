<?php 
session_start(); 
?>
<!doctype html>
<html>
<head> 
    <title>Create Account Page</title>
    <!-- css is added here-->
    <link rel="stylesheet" href="style.css">
</head>
<body> 

<!-- code to fix create the nav bar -->
<div class="Nav">
    <div class="Companyname">DeliverNow</div>
    <button class="btnicon" onclick="openPopup()">
      <svg class="menuicon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
           stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
      </svg>
    </button>
</div>

<!-- Popup -->
<div class="popup-overlay" id="popup">
  <div class="popup-box">
    <button class="pplogin" onclick="loginFunction()">Log in</button>
    <button class="ppcreateacct" onclick="createAccountFunction()">Create Account</button>
    <button class="pplist" onclick="goToHomePage()">Home page</button>
    <button class="pplist" onclick="orderNow()">Order Now</button>
    <button class="pplist">Contact Us</button>
    <div class="close-btn" onclick="closePopup()">Cancel</div>
  </div>
</div>
<div class="contents">
  <form action="includes/signup.inc.php" method="POST">
    <div class="contentsheader">Create Account</div>
    <?php
if(isset($_GET["error"])){
  if($_GET["error"] == "emptyinput"){
    echo '<p class="errormessage">Fill in all fields correctly!</p>';

  }
  else if($_GET["error"] == "invalidfirstname"){
    echo '<p class="errormessage">Invalid firstname format!</p>';
  }
  else if($_GET["error"] == "invalidlastname"){
    echo '<p class="errormessage">Invalid lastname format!</p>';
  }
  else if($_GET["error"] == "invalidpassword"){
    echo '<p class="errormessage">Invalid password format!</p>';
  }
  else if($_GET["error"] == "invalidemail"){
    echo '<p class="errormessage">Invalid email format!</p>';
  }
  else if($_GET["error"] == "emailalreadyexists"){
    echo '<p class="errormessage">You already have an account!</p>';
  }
  elseif($_GET["error"]=="stmtfailed"){
    echo '<P class= "errormessage"> something went wrong try again!</p>';
  }
  else if($_GET["error"] == "none"){
    echo '<pp class="errormessage">You are signed up!</p>';
  }
}
?>

    <label for="firstname" class="formlabels">First Name:</label><br>
    <input id="firstname" class="createinput" type="text" name="firstname" placeholder="Firstname">
    <p></p>

    <label for="lastname" class="formlabels">Last Name:</label><br>
    <input id="lastname" class="createinput" type="text" name="lastname" placeholder="Lastname">
    <p></p>

    <label for="password" class="formlabels">Password:</label><br>
    <input id="password" class="createinput" type="password" name="password" placeholder="Password">
    <p></p>

    <label for="email" class="formlabels">Email:</label><br>
    <input id="email" type="email" name="email" placeholder="Email address" class="createinput">
    <p></p>

    <label for="state" class="formlabels">State:</label><br>
    <select id="state" name="state" class="createinput">
      <option value="CA">California</option>
      <option value="PHX">Phoenix</option>
    </select>
    <p></p>

    <button type="submit" class="submitbtn" name="submit">Create Account</button>
    <p></p>

    Already got an account? <a href="Login.php" class="loginlink">Log in</a>
    <p></p>

    By creating an account you agree to our terms and conditions<br>
    Please read our privacy statements 
  </form>
</div>

<div class="footer">
  <div class="footerfiller">
    <a href="#">Jobs</a> <a href="#">Jobs</a> <a href="#">Jobs</a>
    <a href="#">Jobs</a> <a href="#">Jobs</a> <a href="#">Jobs</a>
  </div>
  <br>
  <p class="footerP">copyright 2025(c)</p>
</div>

<script src="script.js"></script>
<script src="signup.js"></script>
<script src= "cart.js"></script>
</body>
</html>

