<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $c_id = $_SESSION['customerid'];
    $qty = $_POST['quenty'];
    
    echo "cust";
    echo $c_id;
    
    echo "date";
    $date = date("y/m/d");
    echo $date;
    
    echo "quantity";
    echo $qty;
    
    $_SESSION["qty"] = $qty;
    
    $pro_id = $_SESSION["pro_id"];
    echo $pro_id;
    
    $sql = "SELECT * FROM tbl_product where pro_id = '$pro_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $amt = $row['pro_price'];
    
    echo "price";
    echo $amt;
    
    $tot = $amt * $qty;
    
    $sql = "INSERT INTO tbl_ordermaster (c_id, total_price, date) VALUES ('$c_id', '$tot', '$date')";
    mysqli_query($conn, $sql);
    $orm_id = mysqli_insert_id($conn);
    
    $sql = "INSERT INTO tbl_order (pro_id, quantity, pro_totalprice, o_masterid) VALUES ('$pro_id', '$qty', '$tot', '$orm_id')";
    mysqli_query($conn, $sql);
    
 
}
?>
