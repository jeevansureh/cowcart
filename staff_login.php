<?php
include_once 'connection.php';
error_reporting(E_ALL);
session_start();
// define variables and set to empty values
$name = $email = $password = $confpassword = $mobile ="";
$nameErr = $emailErr = $passwordErr = $confpasswordErr = $mobileErr ="";
$flag=1;
function test_input($data) 
{
    $data=trim($data);
    $data=stripslashes($data);
    htmlspecialchars($data);
    return $data;
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

if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $flag=0;
  } else {
  echo "inside name validation";
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $flag=0;
    }
  }
  if (empty($_POST["username"])) {
    $emailErr = "Email is required";
    $flag=0;
  } else {
    echo "inside emailvalidation";
    $email = test_input($_POST["username"]);
    // check if e-mail address is well-formed
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
      $emailErr = "Invalid email format";
      $flag=0;
    }
  }
  if (empty($_POST["phnumber"])) {
	$mobileErr = "phone number is required";
	$flag=0;
  $error="empty phno";
  } 
  else {
	$mobile = test_input($_POST["phnumber"]);
  
  
  $pattern = '/^\d{10}$/'; // Regular expression pattern for 10-digit phone number
  
  if (preg_match($pattern, $mobile)) {
    $error="mismatch phno";
	$mobile = test_input($_POST["phnumber"]);
  } else {
	  $mobileErr= "Invalid phone number";
	  $flag=0;
  }
}
    if ($flag==1) {
		$sql = "INSERT INTO tbl_login (email,password,typeofuser) VALUES ('$email','$password','$user')";
		mysqli_query($conn, $sql);
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
        echo $error;
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COWCART login</title>
    <link rel="stylesheet" href="css/login.css">
    <img src="" alt="">
</head>
<body>
    <style>
        body{
            background-image: url("img/milk4.jpg");
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: fixed;
        }
    </style>
    <h2></h2>
<div class="container" id="container">
	<div class="form-container sign-up-container">
	<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
			<h1>Create Account</h1>
			<span>Enter here</span>
			<input type="text" name="name" placeholder="Name" id="name" value="<?php echo $name;?>">
            <span class="error"> <?php if(isset($nameErr)){ echo $nameErr;}?></span> 

			<input type="email" name="username" placeholder="Email" id="username"  value="<?php echo $email;?>">
            <span class="error"> <?php if(isset($emailErr)){ echo $emailErr;}?></span>

			<input type="password" name="password" placeholder="Password" id="paasword" value="<?php echo $password;?>">
            <span class="error"> <?php echo $emailErr;?></span>

            <input type="password" name="confpassword" placeholder="confirm password" value="<?php echo $password;?>">
            <span class="error"> <?php echo $emailErr;?></span>

            <input type="number" name="phnumber" placeholder="ph_number" id="phnumber" value="<?php echo $mobile;?>">
            <span class="error"> <?php if(isset($mobileErr)){ echo $mobileErr;}?></span>
			<button type="submit" name="signup" id = "signup">
				signup
			</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="#">
			<h1>Sign in</h1>
			<span>Enter here</span>
			<input type="email" placeholder="Email" />
			<input type="password" placeholder="Password" />
			<a href="#">Forgot your password?</a>
			<button>Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>

<footer>
</footer>
<script src="javascript/login.js"></script>
</body>
</html>