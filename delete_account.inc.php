<?php
session_start();
require_once 'dbh.inc.php'; 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['delete_account'])) {
    $userId = $_SESSION['user_id'];

    // Delete user by user_id
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $_SESSION['error'] = "Database error. Please try again.";
        header("Location: ../profile.php");
        exit();
    }

    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        // Account deleted successfully - destroy session and redirect
        session_unset();
        session_destroy();
        header("Location: ../home.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to delete account. Please try again.";
        header("Location: ../profile.php");
        exit();
    }
} else {
    header("Location: ../profile.php");
    exit();
}
?>
