<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pro_id = $_POST['pro_id'];
    $pro_name = $_POST['pro_name'];
    $man_date = $_POST['man_date'];
    $exp_date = $_POST['exp_date'];
    $pro_price = $_POST['pro_price'];
    $pro_unit = $_POST['pro_unit'];
    $qty = $_POST['qty'];
    $pro_desc = $_POST['pro_desc'];
    $stock = $_POST['stock'];

    // Check if a file was uploaded
    if (isset($_FILES['pro_imag']) && $_FILES['pro_imag']['error'] === UPLOAD_ERR_OK) {
        $imag_name = $_FILES['pro_imag']['name'];
        $imag_temp = $_FILES['pro_imag']['tmp_name'];
        move_uploaded_file($imag_temp, 'imgs/' . $imag_name);
    } else {
        // If no new image is uploaded, keep the old one
        $imag_name = $_POST['old_imag']; // Assuming you have an input with name 'old_imag' in your form
    }

    // Update the product in the database
    $sql = "UPDATE tbl_product SET pro_name=?, man_date=?, exp_date=?, pro_price=?, pro_unit=?, qty=?, pro_desc=?, stock=?, pro_imag=? WHERE pro_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssi", $pro_name, $man_date, $exp_date, $pro_price, $pro_unit, $qty, $pro_desc, $stock, $imag_name, $pro_id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        $_SESSION['update_success'] = true; // Set a session variable for success message
        header("location:viewproduct.php");
    } else {
        $_SESSION['update_error'] = "Error updating product: " . mysqli_error($conn);
        header("location:viewproduct.php");
    }
}
?>

