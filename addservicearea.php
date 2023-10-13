<?php
include_once'connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    echo "inside POST";
    $pincode=$_POST['pincode'];
    $location=$_POST['location'];
    echo $pincode;
    echo $location;
    $sql = "insert into tbl_servicearea(pincode,location) values('$pincode','$location')";
    $result=mysqli_query($conn,$sql);
}
else{
    echo "post failed";
}
?>

<?php include_once('connection.php');?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Glassmorphism login Form Tutorial in html css</title>
  


  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css”>

    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    
  background-image: url('img/milk1.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;

}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
form{
    height: 520px;
    width: 400px;
    background: transparent;
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #130202;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #110101;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff60;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}


    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    
    <form method="POST" action="addservicearea.php">
        <h3>Add Service Area</h3>

        <label for="pincode">Pincode</label>
        <input type="text" placeholder="pincode" name="pincode" id="pincode">
        
        <label for="location">Location</label>
        <input type="text" placeholder="location" name="location" id="locaton">

       
        <input type="submit" name="Add" id = "Add" value="Add">
       
    </form></div></div></div>
</body>
</html>
