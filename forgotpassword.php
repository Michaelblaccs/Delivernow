<?php 
include_once 'headerloginpage.php';
?>

<div class="contents">
  <form action="includes/reset-request.inc.php" method="POST">
    <div class="contentsheader2">Reset Password</div>
    <input id="newpassword" class="loginput" type="password" name="newpassword" placeholder="Enter new Password" required /><br /><br />

    <input id="newpassword" class="loginput" type="password" name="newpassword" placeholder="Confirm new Password" required /><br /><br />

    <button type="submit" class="ResetPassword" name="submit">RESET PASSWORD</button><br /><br />
    

  </form>
</div>

<script src="script.js"></script>
<script src="signup.js"></script>
</body>
</html>
