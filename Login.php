<?php  
include_once 'headerloginpage.php';
?>




  <form action="includes/login.inc.php" method="POST">
    <div class="contentsheader">Log in</div>
    <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo '<p class="errormessage">Fill in all fields correctly!</p>';
      } else if ($_GET["error"] == "invalidemail") {
        echo '<p class="errormessage">Invalid email format!</p>';
      } else if ($_GET["error"] == "wronglogindetails") {
        echo '<p class="errormessage">Email not found!</p>';
      } else if ($_GET["error"] == "wrongpassword") {
        echo '<p class="errormessage">Incorrect password!</p>';
      }
    }
    ?>
    <label for="email" class="formlabels">Email:</label><br />
    <input id="email" class="loginput" type="email" name="email" placeholder="Email address" required /><br /><br />

    <label for="password" class="formlabels">Password:</label><br />
    <input id="password" class="loginput" type="password" name="password" placeholder="Password" required /><br /><br />

    <button type="submit" class="submitbtn" name="submit">Log In</button><br /><br />

    Don't have an account?
    <a href="createaccount.php" class="loginlink">Create account</a>
    <a href="forgotpassword.php" class="loginlink">Forgot your Password</a><br /><br />
    By creating an account you agree to our terms and conditions.<br />
    Please read <a href="privacycenter.html">our statements</a>.
  </form>
</div>

<script src="script.js"></script>
<script src="signup.js"></script>
</body>
</html>
