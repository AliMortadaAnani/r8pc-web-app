
<?php

include "../ConnectDB.php";


$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];


$hashedPassword = password_hash($password, PASSWORD_BCRYPT);


$query = "SELECT username, password FROM users WHERE email=?";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
  
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['username'] = $row['username'];
        header("Location: ../2.php");
        exit(); 
    } else {
       
        mysqli_stmt_close($stmt); 
        mysqli_close($dbc); 
        header("Location: login.php?error=1");
        exit();
    }
} else {

    mysqli_stmt_close($stmt); 
    mysqli_close($dbc); 
    header("Location: login.php?error=1");
    exit();
}
?>
