<?php 
include_once 'headerloginpage.php';
?>

<div class="contents">
  <form action="includes/reset-request.inc.php" method="POST">
    <div class="contentsheader2">Reset Your Password</div>
    <p>An email will be sent to you with instructions on what to </p>
    

    <input id="email" class="loginput" type="email" name="email" placeholder="Enter E-mail Address..." required /><br /><br />

    <button type="submit" class="ResetPassword" name="reset-request-submit">Send Email</button><br /><br />
    

  </form>
</div>

<script src="script.js"></script>
<script src="signup.js"></script>
</body>
</html>
