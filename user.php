<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
include 'includes/db_connect.php'; // Database connection

// Assuming user information is stored in session
$userID = $_SESSION['user_id'] ?? 'Guest';  // Use user_id as the unique identifier
$userEmail = $_SESSION['email'] ?? 'guest@example.com';  // Use email directly

// Accessing full name directly when needed
$userFullname = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];  // Concatenate directly

// If state is needed, you can access it directly as well
$userState = $_SESSION['state'] ?? '';  // Use state if necessary

// You can now use $userID, $userFullname, $userEmail, and $userState in your code
?>
