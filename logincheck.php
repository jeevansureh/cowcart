<?php
include_once 'connection.php';
error_reporting(E_ALL);
if($_SERVER["REQUEST_METHOD"]=='POST')
{
    echo "inside post";
    $email=$_POST['username']; // Change 'username' to 'email'
    $password=$_POST['password'];
    $typeofuser=$_POST['typeofuser'];
    echo $email; // Change 'name' to 'email'
    echo $password;
    echo $typeofuser; 
    $sql="select * from tbl_login where email='".$email."' and password='".$password."'";
    $result=mysqli_query($conn,$sql);
    //echo $result;
    $row=mysqli_fetch_array($result);
    echo $row;session_start();
    if($row["typeofuser"]=="customer")
    {
        $sql="select * from tbl_customer where c_email='".$email."' ";
        $result=mysqli_query($conn,$sql);
        //echo $result;
        $row=mysqli_fetch_array($result);
        $_SESSION['customerid']=$row['c_id'];
        $_SESSION['customername']=$row['c_name'];
        header("location:customer.php");
    }
    elseif($row["typeofuser"]=="admin")
    {
        echo "hai";
        $_SESSION['email']=$email;
        header("location:admindash.php");
    }
    elseif($row["typeofuser"]=="staff")
    {
        $_SESSION['email']=$email;
        header("location:index.html");
    }
    else
    {
        session_start();
        //echo "invalid username or password";
        $message="Invalid username or password";
        $_SESSION['loginMessage']=$message;
        header("location:login.php");
    }
}
else{
    echo " outside post";
}
?>
