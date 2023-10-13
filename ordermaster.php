<?php
include_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $c_id = $_SESSION["customerid"];
    echo "cust";
    echo $c_id;
    $date = date("Y/m/d");
    echo $date;
    $total_amount = 0; // Corrected variable name from $totamt to $total_amount
    $sql = "INSERT INTO tbl_ordermaster(c_id, date, total_price, status) VALUES ('$c_id', '$date', '$total_amount', 'pending')";
    $result = mysqli_query($conn, $sql);
    $orm_id = mysqli_insert_id($conn);

    $cart_query = "SELECT c.pro_id, $orm_id AS o_masterid, c.quantity, (p.pro_price * c.quantity) AS total_amount 
    FROM tbl_cart c 
    JOIN tbl_product p ON c.pro_id = p.pro_id 
    WHERE c.c_id = '$c_id'";

    $cart_result = mysqli_query($conn, $cart_query);

    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
        $pro_id = $cart_row['pro_id'];
        $qty = $cart_row['quantity'];
        $total_amount += $cart_row['total_amount'];

        $order_query = "INSERT INTO tbl_order(o_masterid, pro_id, quantity, pro_totalprice) 
         VALUES('$orm_id', '$pro_id', '$qty', '{$cart_row['total_amount']}')"; // Used the value from the current row

        $order_result = mysqli_query($conn, $order_query);

        if (!$order_result) {
            echo "Error inserting order details: " . mysqli_error($conn); // Corrected variable name from $data to $conn
        }
    }

    // Update the total amount in tbl_ordermaster
    $update_master_total_query = "UPDATE tbl_ordermaster SET total_price = '$total_amount' WHERE o_masterid = '$orm_id'";
    $update_master_total_result = mysqli_query($conn, $update_master_total_query);

    echo "Order placed successfully";
    $_SESSION['o_masterid'] = $orm_id;
    exit();
} else {
    // Handle the case when the request method is not POST
}
?>
