<?php
include_once 'connection.php';
error_reporting(E_ALL);
session_start();
// define variables and set to empty values
$name = $email = $password = $confpassword = $mobile = $h_name= $street = $city = $landmark = $district = $pincode ="";
$nameErr = $emailErr = $passwordErr = $confpasswordErr = $mobileErr = $h_nameErr= $streetErr = $cityErr = $landmarkErr = $districtErr = $pincodeErr ="";
$flag=1;
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

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

	  
if (empty($_POST["ph_number"])) {
	$mobileErr = "phone number is required";
	$flag=0;
  $error="empty phno";
  } 
  else {
	$mobile = test_input($_POST["ph_number"]);
  
  
  $pattern = '/^\d{10}$/'; // Regular expression pattern for 10-digit phone number
  
  if (preg_match($pattern, $mobile)) {
    $error="mismatch phno";
	$mobile = test_input($_POST["ph_number"]);
  } else {
	  $mobileErr= "Invalid phone number";
	  $flag=0;
  }
}
if (empty($_POST["h_name"])) {
  $h_nameErr = "house name is required";
  $flag=0;
  $error="empty hname";
  } 
  if (empty($_POST["street"])) {
    $streetErr = "street is required";
    $flag=0;
    $error="empty street";
    }
    if (empty($_POST["city"])) {
      $cityErr = "city is required";
      $flag=0;
      $error="empty city";
      }
      if (empty($_POST["landmark"])) {
        $landmarkErr = "landmark is required";
        $flag=0;
        $error="empty landmark";
        }
        if (empty($_POST["district"])) {
          $districtErr = "district is required";
          $flag=0;
          $error="empty district";
          } 
             
          if (empty($_POST["pincode"])) {
            $pincodeErr = "pincode is required";
            $flag=0; $error="empty pincode";
            }
    if ($flag==1) {
            $sql = "INSERT INTO tbl_login (email,password,typeofuser) VALUES ('$email','$password','$user')";
          mysqli_query($conn, $sql);
        $sql = "INSERT INTO tbl_customer(c_name,c_email,password,mobile,h_name,street,city,landmark,district,pincode,typeofuser) VALUES ('$name','$email','$password','$mobile','$h_name','$street','$city','$landmark','$district','$pincode','$user')";
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['message2'] = "Error: " . mysqli_error($conn);
        }
    } else {
        $_SESSION["message2"] = "Passwords do not match.";
        echo $error;
        header('Location: customer_login.php');
        exit();
    }
}
if (isset($_POST["login"])) {
    $email = $_POST['username'];
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
        header('Location: login.php');
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
			<input type="text" name="name" placeholder="Name" id="name"  value="<?php echo $name;?>">
			<span class="error"> <?php if(isset($nameErr)){ echo $nameErr;}?></span>
 
			<input type="email" name="username" placeholder="Email" id="username"  value="<?php echo $email;?>">
			<span class="error">  <?php if(isset($emailErr)){ echo $emailErr;}?> </span>  
 
			<input type="password" name="password" placeholder="Password" id="password"  value="<?php echo $password;?>">
			<span class="error">  <?php echo $emailErr;?> </span>  
  
            <input type="password" name="confpassword" placeholder="confirm password"  value="<?php echo $password;?>">  
  <span class="error">  <?php echo $emailErr;?> </span>
  
            <input type="number" name="ph_number" placeholder="Ph_number" id="ph_number"  value="<?php echo $mobile;?>">  
 <span class="error">  <?php if(isset($mobileErr)){ echo $mobileErr;}?> </span>  
 
			      <input type="text" name="h_name" placeholder="H_name" id="h_name"  value="<?php echo $h_name;?>">
 <span class="error">  <?php if(isset($h_nameErr)){ echo $h_nameErr;}?> </span>  

			      <input type="text" name="street" placeholder="Street" id="street"   value="<?php echo $street;?>">
 <span class="error">  <?php if(isset($streetErr)){ echo $streetErr;}?> </span>  

			      <input type="text" name="city" placeholder="City" id="city"   value="<?php echo $city;?>">
 <span class="error">  <?php if(isset($cityErr)){ echo $cityErr;}?> </span>  

			      <input type="text" name="landmark" placeholder="Land_mark" id="landmark"  value="<?php echo $landmark;?>">
 <span class="error">  <?php if(isset($landmarkErr)){ echo $landmarkErr;}?> </span> 

			      <input type="text" name="district" placeholder="District" id="district"   value="<?php echo $district;?>">
 <span class="error">  <?php if(isset($districtErr)){ echo $districtErr;}?> </span>

			      <input type="number" name="pincode" placeholder="Pincode" id="pincode"  value="<?php echo $pincode;?>">
 <span class="error">  <?php if(isset($pincodeErr)){ echo $pincodeErr;}?> </span>  

      <button type="submit" name="signup" id = "signup">
				<form id="signup" action="" method="post">
					signup
				</form>
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