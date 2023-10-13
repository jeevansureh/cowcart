<?php
$host="localhost";
$user="root";
$password="";
$db="cowcart";
echo "full";
$conn = mysqli_connect($host,$user,$password,$db);
if(!$conn){
    echo"error connecting to database: ";
}

echo "succes";

?>