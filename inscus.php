<?php
include_once 'connection.php';
error_reporting(E_ALL);
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['username'];
    $password = $_POST['password'];
    $confpassword = $_POST['confpassword'];
    $mobile = $_POST['ph_number'];           
    $h_name = $_POST['h_name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $landmark = $_POST['landmark'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $user="customer";
  
   
    if ($password == $confpassword) {
            $sql = "INSERT INTO tbl_login (email,password,typeofuser) VALUES ('$email','$password','$user')";
          mysqli_query($conn, $sql);
        $sql = "INSERT INTO tbl_customer(c_name,c_email,password,mobile,h_name,street,city,landmark,district,pincode,typeofuser) VALUES ('$name','$email','$password','$mobile','$h_name','$street','$city','$landmark','$district','$pincode','$user')";
        
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
        header('Location: customer.php');
        exit();
    }
}
if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM tbl_customer WHERE c_email = '$email' AND password = '$password'";
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
