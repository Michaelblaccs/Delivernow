<?php

function emptyInputSignup($firstname, $lastname, $password, $email, $state) {
    return empty($firstname) || empty($lastname) || empty($state) || empty($email) || empty($password);
}

function invalidFirstName($firstname) {
    return !preg_match("/^[a-zA-Z]*$/", $firstname);
}

function invalidLastName($lastname) {
    return !preg_match("/^[a-zA-Z]*$/", $lastname);
}

function invalidState($state) {
    return !preg_match("/^[a-zA-Z\s]*$/", $state);
}

function invalidPassword($password) {
    return !preg_match("/^[a-zA-Z0-9]*$/", $password);
}

function invalidEmail($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function emailExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../createaccount.php?error=emailalreadyexists");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return false;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $firstname, $lastname, $state, $email, $password) {
    $sql = "INSERT INTO users (firstname, lastname, state, email, password) VALUES(?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../createaccount.php?error=stmtfailed");
        exit();
    }

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $state, $email, $hashedpassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $user = emailExists($conn, $email); // fetch the newly created user
    
    $_SESSION["user_id"] = $user["user_id"];
    $_SESSION["email"] = $user["email"];
    $_SESSION["firstname"] = $user["firstname"];
    $_SESSION["lastname"] = $user["lastname"];     
    $_SESSION["state"] = $user["state"];       
    $_SESSION["phone_number"] = $user["phone_number"] ?? '';
    $_SESSION["delivery_address"] = $user["delivery_address"] ?? '';

    header("location: ../home.php?signup=success");
    exit();
}

function emptyInputLogin($email, $password) {
    return empty($email) || empty($password);
}

function loginUser($conn, $email, $password) {
    $emailExists = emailExists($conn, $email);
    
    if ($emailExists === false) {
        header("location: ../login.php?error=wronglogindetails");
        exit();
    }

    $passwordhashed = $emailExists["password"];
    $checkpassword = password_verify($password, $passwordhashed);
    
    if ($checkpassword === false) {
        header("location: ../login.php?error=wrongpassword");
        exit();
    } else {
        $_SESSION["user_id"] = $emailExists["user_id"];
        $_SESSION["email"] = $emailExists["email"];
        $_SESSION["firstname"] = $emailExists["firstname"];
        $_SESSION["lastname"] = $emailExists["lastname"];   
        $_SESSION["state"] = $emailExists["state"];         
        $_SESSION["phone_number"] = $emailExists["phone_number"] ?? '';
        $_SESSION["delivery_address"] = $emailExists["delivery_address"] ?? '';

        header("location: ../home.php");
        exit();
    }
}

// Validation for updating profile
function emptyInputEdit($firstname, $lastname, $state, $email, $phone, $address) {
    return empty($firstname) || empty($lastname) || empty($state) || empty($email) || empty($phone) || empty($address);
}

function invalidPhone($phone) {
    return !preg_match("/^[0-9]{7,15}$/", $phone);
}

function invalidAddress($address) {
    return !preg_match("/^[a-zA-Z0-9\s,.\#-]+$/", $address);
}

function updateUser($conn, $firstname, $lastname, $state, $email, $phone, $address, $user_id) {
    $sql = "UPDATE users SET firstname=?, lastname=?, state=?, email=?, phone_number=?, delivery_address=? WHERE user_id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "ssssssi", $firstname, $lastname, $state, $email, $phone, $address, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}
?>
