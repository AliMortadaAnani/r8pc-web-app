
<?php
include "../ConnectDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($dbc, $_POST['username']);
    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $password = mysqli_real_escape_string($dbc, $_POST['password']);
    $passwordRepeat = mysqli_real_escape_string($dbc, $_POST['password-repeat']);

    
    if ($password !== $passwordRepeat) {
       
        $errorMessage2 = "Passwords do not match.";
        header("Location: signup.php?error=password_mismatch&message=" . urlencode($errorMessage2));
        exit();
    }

    $checkEmailQuery = "SELECT * FROM users WHERE email=?";
    $checkEmailStmt = mysqli_prepare($dbc, $checkEmailQuery);
    
    mysqli_stmt_bind_param($checkEmailStmt, "s", $email);
    mysqli_stmt_execute($checkEmailStmt);
    $emailResult = mysqli_stmt_get_result($checkEmailStmt);

    if (mysqli_num_rows($emailResult) > 0) {
      
        $errorMessage = "Email is already registered.";
        header("Location: signup.php?error=email_exists&message=" . urlencode($errorMessage));
        exit();
    }

    
    $insertQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $insertStmt = mysqli_prepare($dbc, $insertQuery);
    
 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($insertStmt, "sss", $username, $email, $hashedPassword);
    
    if (mysqli_stmt_execute($insertStmt)) {
       
        header("Location: login.php?registration=success");
    } else {
        
        header("Location: signup.php?error=registration_failed");
    }

 
    mysqli_stmt_close($checkEmailStmt);
    mysqli_stmt_close($insertStmt);
}

mysqli_close($dbc);
?>
