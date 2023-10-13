<?php
include_once 'connection.php';
error_reporting(E_ALL);
session_start();
function test_input($data)
{
    $data=trim($data);
    $data=stripslashes($data);
    htmlspecialchars($data);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['username'];
    $password = $_POST['password'];
    $confpassword = $_POST['confpassword'];
    $mobile = $_POST['phnumber'];          
echo "Password: " . $password;
echo "Confirm Password: " . $confpassword;
$user="staff";
    if ($password == $confpassword) {
        $sql = "INSERT INTO tbl_staff(s_name,s_email,password,s_mobile,typeofuser) VALUES ('$name', '$email', '$password','$mobile','$user')";
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['message2'] = "Error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION["message2"] = "Passwords do not match.";
        header('Location: staff_login.php');
        exit();
    }
}
else{
    
}

if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM tbl_staff WHERE s_email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // User exists, perform further actions
        // For example, set session variables or redirect to a logged-in page
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];

        if ($row['name'] == "Admin") {
            header("Location: index.php");
        } else {
            header('Location: index.php');
            exit();
        }
    } else {
        $_SESSION["message1"] = "Invalid email or password";
        header('Location: signup.php');
        exit();
    }
}
?>
