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

    <!-- Injected header content inside nav bar -->
    <div class="nav-user-info">
        <!-- Display the welcome message with the user's first and last name -->
        <p class='user-name'>Welcome, <?php echo ucfirst(strtolower($_SESSION["firstname"])) . " " . ucfirst(strtolower($_SESSION["lastname"])); ?></p>
    </div>

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
        <button class="pplist" onclick="window.location.href='profile.php'">
            <svg class= "menuicons" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <?php echo ucfirst(strtolower($_SESSION["firstname"])) . ' ' . ucfirst(strtolower($_SESSION["lastname"])); ?>
        </button>
        <button class="pplist" onclick="window.location.href='includes/logout.inc.php'">
            <svg class="menuicons" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
            </svg>
            Log Out
        </button>

        <button class="pplist" onclick="goToHomePage()">
            <svg class= "menuicons" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Home page
        </button>

        <button class="pplist" onclick="orderNow()">
            <svg class = "menuicons" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
            Order Now
        </button>

        <button class="pplist">
            <svg class= "menuicons" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
            </svg>
            Contact Us
        </button>

        <div class="close-btn" onclick="closePopup()">
            <svg class="menuiconsclose" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>
    </div>
</div>

<div class="contents">
<form action="includes/edit.inc.php" method="POST">
    <div class="contentsheader">Edit Profile</div>
    
    <?php
    if (isset($_SESSION["error"])) {
        echo '<p class="error-message">' . $_SESSION["error"] . '</p>';
        unset($_SESSION["error"]);
    }

    if (isset($_SESSION["success"])) {
        echo '<p class="success-message">' . $_SESSION["success"] . '</p>';
        unset($_SESSION["success"]);
    }

    if (isset($_SESSION["noChanges"])) {
        echo '<p class="info-message">No changes were made.</p>';
        unset($_SESSION["noChanges"]);
    }
    ?>
    
    <label class="formlabels">First Name:</label>
    <input type="text" name="firstname" class="createinput" value="<?php echo htmlspecialchars($_SESSION['firstname']); ?>" required><br><br>

    <label class="formlabels">Last Name:</label>
    <input type="text" class="createinput" name="lastname" value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>" required><br><br>

    <label class="formlabels">State:</label>
    <input type="text" class="createinput" name="state" value="<?php echo htmlspecialchars($_SESSION['state']); ?>" required><br><br>

    <label class="formlabels">Email:</label>
    <input type="email" class="createinput" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required><br><br>

    <!-- New fields -->
    <label class="formlabels">Phone Number:</label>
    <input type="text" class="createinput" placeholder="(optional)"name="phone_number" maxlength="15" value="<?php echo isset($_SESSION['phone_number']) ? htmlspecialchars($_SESSION['phone_number']) : ''; ?>"><br><br>

    <label class="formlabels">Delivery Address:</label>
    <textarea class="createinput" placeholder="(optional)" name="delivery_address" rows="3"><?php echo isset($_SESSION['delivery_address']) ? htmlspecialchars($_SESSION['delivery_address']) : ''; ?></textarea><br><br>

    <button type="submit" name="submit" class="submitbtn">Update Profile</button>
</form>

<!-- Separate form for Delete Account to avoid accidental deletion -->
<form action="includes/delete_account.inc.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
    <button type="submit" name="delete_account" class="deletebtn">Delete Account</button>
</form>
</div>

<script src="script.js"></script>
<script src="signup.js"></script>
</body>
</html>
