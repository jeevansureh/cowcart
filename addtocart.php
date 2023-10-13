<?php
include('connection.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $productId = $_POST['pro_id'];
    echo $productId;
    $c_id = $_SESSION['customerid'];
    $sql = "INSERT INTO tbl_cart (pro_id, c_id) VALUES ('$productId', '$c_id')";
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully.";
        header("location:cart.php");

    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "POST request failed.";
}
?>
