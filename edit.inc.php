<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $state = trim($_POST["state"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone_number"]);  // consistent key
    $address = trim($_POST["delivery_address"]);
    $user_id = $_SESSION["user_id"];

    // Required fields validation (phone and address optional)
    if (empty($firstname) || empty($lastname) || empty($state) || empty($email)) {
        $_SESSION["error"] = "Please fill in all required fields.";
        header("location: ../profile.php");
        exit();
    }

    if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
        $_SESSION["error"] = "First name can only contain letters.";
        header("location: ../profile.php");
        exit();
    }

    if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
        $_SESSION["error"] = "Last name can only contain letters.";
        header("location: ../profile.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Invalid email address.";
        header("location: ../profile.php");
        exit();
    }

    if (!preg_match("/^[a-zA-Z\s]*$/", $state)) {
        $_SESSION["error"] = "State can only contain letters and spaces.";
        header("location: ../profile.php");
        exit();
    }

    if ($phone !== "" && invalidPhone($phone)) {
        $_SESSION["error"] = "Invalid phone number format.";
        header("location: ../profile.php");
        exit();
    }

    if ($address !== "" && invalidAddress($address)) {
        $_SESSION["error"] = "Invalid delivery address.";
        header("location: ../profile.php");
        exit();
    }

    // Check if no changes were made
    if (
        $firstname === $_SESSION["firstname"] &&
        $lastname === $_SESSION["lastname"] &&
        $state === $_SESSION["state"] &&
        $email === $_SESSION["email"] &&
        $phone === (isset($_SESSION["phone_number"]) ? $_SESSION["phone_number"] : '') &&
        $address === (isset($_SESSION["delivery_address"]) ? $_SESSION["delivery_address"] : '')
    ) {
        $_SESSION["noChanges"] = "No changes were made.";
        header("location: ../profile.php");
        exit();
    }

    // Update user in the database
    $updateSuccess = updateUser($conn, $firstname, $lastname, $state, $email, $phone, $address, $user_id);

    if ($updateSuccess) {
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["state"] = $state;
        $_SESSION["email"] = $email;
        $_SESSION["phone_number"] = $phone;
        $_SESSION["delivery_address"] = $address;

        $_SESSION["success"] = "Profile updated successfully!";
        header("location: ../profile.php");
        exit();
    } else {
        $_SESSION["error"] = "Something went wrong. Please try again.";
        header("location: ../profile.php");
        exit();
    }
} else {
    header("location: ../profile.php");
    exit();
}
?>
