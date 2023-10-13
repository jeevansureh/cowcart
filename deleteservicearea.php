<?php include('connection.php'); 


if($_SERVER["REQUEST_METHOD"]=="POST")
{
    echo "inside isset";
    $id=$_POST['ids'];
    echo $id;
    $sql="DELETE FROM tbl_servicearea WHERE service_id='".$id."'";
    $result=mysqli_query($conn,$sql);
}
else{
    echo "outside isset";
}


?>