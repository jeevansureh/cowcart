
CODE FOR VALIDATION /REGISTRATION/UPLOAD IMAGE TO FOLDER
--------------------------------------------------------
<?php
include_once 'connection.php';
// define variables and set to empty values
$fname = $lname=$email = $gender = $painterphoto = $phone = $dob="";
$fnameErr=$emailErr=$dateErr=$imageErr=$poneErr=$lnameErr=$generErr="";
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
 { 
    $fname = test_input($_POST["fname"]);    
    $email = test_input($_POST["email"]);
    $lname= test_input($_POST["lname"]);
    $gender = test_input($_POST["gender"]);
    $phone = test_input($_POST["phone"]);
    $dob = test_input($_POST["dob"]);
    $password=test_input($_POST["password"]);
    $user="user";
    $cat=test_input($_POST["category"]); 
    $image=$_FILES['image']['name'];
    $flag=1;    

  //Upload to folder
  $allow = array("jpg", "jpeg", "gif", "png");
  $todir = 'image/';      
  if ( !!$_FILES['image']['tmp_name'] ) // is the file uploaded yet?
  {
    $info = explode('.', strtolower( $_FILES['image']['name']) ); // whats the extension of the file

    if ( in_array( end($info), $allow) ) // is this file allowed
    {
        if ( move_uploaded_file( $_FILES['image']['tmp_name'], $todir . basename($_FILES['image']['name'] ) ) )
        {
            echo " the file has been moved correctly";
            $dst_db="image/".$painterphoto;
        }
    }
    else
    {
        $imageErr= " error this file ext is not allowed";
        $flag=0;
    }
  }

//End upload
//validation code
if (empty($_POST["fname"])) {
  $fnameErr = "Name is required";
  $flag=0;
} else {
  $fname = test_input($_POST["fname"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
    $fnameErr = "Only letters and white space allowed";
    $flag=0;
  }
}
if (empty($_POST["lname"])) {
  $lnameErr = "Name is required";
  $flag=0;
} else {
  $fname = test_input($_POST["lname"]);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
    $lnameErr = "Only letters and white space allowed";
    $flag=0;
  }
}

if (empty($_POST["email"])) {
  $emailErr = "Email is required";
  $flag=0;
} else {
  echo "inside emailvalidation";
  $email = test_input($_POST["email"]);
  // check if e-mail address is well-formed
  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    
    $emailErr = "Invalid email format";
    $flag=0;
  }
}
if (empty($_POST["gender"])) {
  $genderErr = "gender is required";
  $flag=0;
} 
else {
  $gender = test_input($_POST["gender"]);
}


if (empty($_FILES['image']['name'])) {
  $imageErr = "Upload your photo";
  $flag=0;
} 
else {
  $image=$_FILES['image']['name'];
}

if (empty($_POST["dob"])) {
  $dobErr = "dob is required";
  $flag=0;
} 
else {
  $dob = test_input($_POST["dob"]);
  $inputDate = new DateTime($dob);
$today = new DateTime();

if ($inputDate > $today) {
    $dateErr= "date error is greater than today's date.";
    $flag=0;
} else {
  $dob = test_input($_POST["dob"]);
}
}

if (empty($_POST["phone"])) {
  $phoneErr = "phone number is required";
  $flag=0;
} 
else {
  $phone = test_input($_POST["phone"]);


$pattern = '/^\d{10}$/'; // Regular expression pattern for 10-digit phone number

if (preg_match($pattern, $phone)) {
  $phone = test_input($_POST["phone"]);
} else {
    $phoneErr= "Invalid phone number";
    $flag=0;
}
}  
   
  if($flag==1){
    $sql="insert into painter_personalinfo (fname,lname,dob,email,phone,gender,image,category) 
    values('$fname','$lname','$dob','$email','$phone','$gender','$image','$cat')";
    $result=mysqli_query($conn,$sql);
    $sql="insert into login (uname,password,keyuser) values('$email','$password','$user')";
    $result=mysqli_query($conn,$sql);
  }    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


 
    <h1> PHP Registration Form Example </h1>  
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <b> Enter First Name: </b> <input type="text" name="fname" value="<?php echo $fname;?>">
  <span class="error">* <?php if(isset($fnameErr)){ echo $fnameErr;}?></span>
  <br> <br> 
  <b> Enter Last Name: </b> <input type="text" name="lname" value="<?php echo $lname;?>">  
  <span class="error"> *  <?php if(isset($lnameErr)){ echo $fnameErr;}?></span>
  <br> <br>  
 <b> Enter E-mail: </b> <input type="text" name="email" value="<?php echo $email;?>">  
  <span class="error"> * <?php if(isset($emailErr)){ echo $emailErr;}?> </span>  
  <br> <br> 

  <b> Enter Category: </b><?php
  $sql = "SELECT * FROM category";
$result = mysqli_query($conn,$sql);
echo "<select name='category'>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
}
echo "</select>";
?>
  


  <b> Enter Passord: </b> <input type="text" name="password" value="<?php echo $password;?>">  
  <span class="error"> * <?php echo $emailerr;?> </span>  
  <br> <br> 
  <b> Enter onfirm password: </b> <input type="text" name="cpassword" value="<?php echo $password;?>">  
  <span class="error"> * <?php echo $emailerr;?> </span>  
  <br> <br>  
 <b> Enter PhoneNumber: </b> <input type="text" name="phone" value="<?php echo $phone;?>">  
 <span class="error"> * <?php if(isset($phoneErr)){ echo $phoneErr;}?> </span>  
  <br> <br>  
  <b> Dob: </b> <input type="date" name="dob" value="<?php echo $dob;?>"> 
  <span class="error"> * <?php if(isset($dateErr)){ echo $dateErr;}?> </span>  
  <br> <br>  
  <label class="radio-inline">
    <input type="radio" name="gender" value="Male" <?php if ($gender != "Female") echo "checked"; ?> />Male
  </label>
  <label class="radio-inline">
    <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?> />Female
  </label>
  <b> Upload Photo: </b> <input type="file" name="image" class="input_text" > 
  <span class="error">* <?php if(isset($imageErr)){ echo $imageErr;}?></span>
  
  <br> <br>  
    
  <input type="submit" name="submit" value="Register ">    
</form>
</body>
</html>