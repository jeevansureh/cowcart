<?php
include_once('connection.php');
echo "cartoutside";
echo $_GET['id'];

if (isset($_GET['id'])) {
    echo "cart inside";
    echo $_GET['id'];

    error_reporting(E_ALL);
    $cartid = $_GET['id'];

    // Update quantity
    $sql = "UPDATE tbl_cart SET quantity = quantity - 1 WHERE cart_id='".$cartid."'";
    $result = mysqli_query($conn, $sql);

    // Check if quantity is 0 and delete the cart item
    $check_quantity_sql = "SELECT quantity FROM tbl_cart WHERE cart_id='".$cartid."'";
    $check_quantity_result = mysqli_query($conn, $check_quantity_sql);

    if ($check_quantity_result) {
        $row = mysqli_fetch_assoc($check_quantity_result);
        $quantity = $row['quantity'];

        if ($quantity <= 0) {
            // Delete the cart item
            $delete_sql = "DELETE FROM tbl_cart WHERE cart_id='".$cartid."'";
            $delete_result = mysqli_query($conn, $delete_sql);

            if (!$delete_result) {
                echo "Error deleting cart item: " . mysqli_error($conn);
            }
        }
    }

    header("Location: cart.php");
    exit();
} else {
    echo "outside post";
}
?>
