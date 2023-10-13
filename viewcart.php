<?php
include('connection.php');
session_start();
// Assuming you have a session already started
$c_id = $_SESSION['customerid'];

// Prepare the SQL statement with a placeholder for the user input
$sql = "SELECT p.pro_imag, p.pro_name, p.pro_price, c.cart_id, c.quantity, p.qty AS qty, (p.pro_price * c.quantity) AS total_price 
        FROM tbl_cart c 
        JOIN tbl_product p ON c.pro_id = p.pro_id 
        WHERE c.c_id = ?";

// Initialize a prepared statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the user input to the prepared statement as a parameter
    $stmt->bind_param("s", $c_id);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $cartItems = array();
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
        }

    } else {
        $cartItems = array(); // No items in the cart
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle errors with the prepared statement
    die("Error in preparing the statement: " . $conn->error);
}

// Close the database connection
$conn->close();
?>
