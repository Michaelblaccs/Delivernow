<?php
session_start();
if (isset($_POST["submit"])) {
    //assign variables to the information from signup form 
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $state = $_POST["state"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Check for empty input
    if (emptyInputSignup($firstname, $lastname, $password, $email, $state) !== false) {
        header("location: ../createaccount.php?error=emptyinput");
        exit();
    }

    // Check if first name is invalid
    if (invalidFirstName($firstname) !== false) {
        header("location: ../createaccount.php?error=invalidfirstname");
        exit();
    }

    // Check if last name is invalid
    if (invalidLastName($lastname) !== false) {
        header("location: ../createaccount.php?error=invalidlastname");
        exit();
    }

    // Check if password is invalid
    if (invalidPassword($password) !== false) {
        header("location: ../createaccount.php?error=invalidpassword");
        exit();
    }

    // Check if email is invalid
    if (invalidEmail($email) !== false) {
        header("location: ../createaccount.php?error=invalidemail");
        exit();
    }

    // Check if email already exists
    if (emailExists($conn, $email) !== false) {
        header("location: ../createaccount.php?error=emailalreadyexists");
        exit();
    }

    // Create user in the database
    createUser($conn, $firstname, $lastname, $state, $email, $password);
} else {
    header("location:../ordernow.php");
    exit();
}
?>
