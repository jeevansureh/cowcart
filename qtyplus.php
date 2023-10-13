<?php
  include_once('connection.php');
  echo "cartoutside";
  echo $_GET['id'];
if(isset($_GET['id']))
{
  echo"cart inside";
    echo $_GET['id'];
  
    error_reporting(E_ALL);
    $cartid=$_GET['id'];
    $sql = "UPDATE tbl_cart SET quantity = quantity + 1 WHERE cart_id='".$cartid."'";
    $result=mysqli_query($conn,$sql);
    header("Location: cart.php");
     $conn->error;
}
else{
echo "outside post";
}
?>
