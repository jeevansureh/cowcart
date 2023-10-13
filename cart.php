
<?php
session_start();
include('connection.php');
$c_id =$_SESSION['customerid']; 
echo $c_id; 
?>
<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $cart_id = htmlspecialchars($_GET['id']);       
    // Prepare SQL query to delete the item with the provided cart_id
    $sql = "DELETE FROM tbl_cart WHERE cart_id = $cart_id";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
   
} else {
   
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/ncart.css"><!-- Your meta tags and CSS links -->
    <link href="css/about.css" rel="stylesheet" />
</head>
<body>
<div class="hero_bg_box">
  <div class="img-box">
    <img src="img/gallery-5.jpg" alt="">
  </div>
</div>
<header class="header_section">
  <div class="header_bottom">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="#">
          <span>
            <h1 class="m-0">COWCART</h1>
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="customer.php">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>

<?php
// Prepare the SQL statement with a placeholder for the user input
$sql = "SELECT p.pro_imag, p.pro_name, p.pro_price, c.cart_id, c.quantity, p.qty AS qty, (p.pro_price * c.quantity) AS total_price 
        FROM tbl_cart c 
        JOIN tbl_product p ON c.pro_id = p.pro_id 
        WHERE c.c_id = '".$c_id."'";
$result = mysqli_query($conn, $sql);

// Initialize a variable to keep track of the total price
$totalPrice = 0;

// Check if there are any products in the cart
if (mysqli_num_rows($result) > 0) {
?>
    <main>
        <section class=" gradient-custom">
            <div class="container py-5">
                <div class="row d-flex justify-content-center my-4">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Cart - <?php echo mysqli_num_rows($result); ?> items</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    // Update the total price with the product's price
                                    $totalPrice += $row['total_price'];
                                    ?>
                                    <!-- Single product -->
                                    <div class="row mb-4">
                                        <div class="col-lg-3 col-md-12">
                                            <!-- Image -->
                                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                                <img src="./imgs/<?php echo $row['pro_imag']; ?>" class="w-100" alt="<?php echo $row['pro_name']; ?>" />
                                                <a href="#!">
                                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                                </a>
                                            </div>
                                            <!-- Image -->
                                        </div>

                                        <div class="col-lg-5 col-md-6">
                                            <!-- Product details -->
                                            <p><strong><?php echo $row['pro_name']; ?></strong></p>
                                            <?php $_SESSION['ProductName']=$row['pro_name'];
                                            ?>
                                            <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
    <a href="cart.php?action=remove&id=<?php echo $row['cart_id']; ?>" style="text-decoration: none; color: white;">
        <i class="fas fa-trash"></i>
    </a>
</button>


                                            <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip" title="Move to the wish list">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                            <!-- Product details -->
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <!-- Quantity and price -->
                                            <div class="d-flex align-items-center mb-4" style="max-width: 300px;">
    <a href="qtyminus.php?id=<?php echo $row['cart_id']; ?>" class="btn btn-primary quantity-btn">
        <i class="fas fa-minus"></i>
    </a>
    <input type="text" id="quantity" value="<?php echo $row['quantity']; ?>" class="form-control mx-2">
    <a href="qtyplus.php?id=<?php echo $row['cart_id']; ?>" class="btn btn-primary quantity-btn">
        <i class="fas fa-plus"></i>
    </a>
</div>

                                            <p class="text-start text-md-center"><strong>₹<?php echo number_format($row['total_price'], 2); ?></strong></p>
                                            <!-- Quantity and price -->
                                        </div>
                                    </div>
                                    <!-- Single product -->
                                <?php  $_SESSION['amount']=$row['pro_price'];
                               } ?>
                                <!-- Total price -->
                                <hr class="my-4">
                                <p class="text-end"></p>
                                <!-- Total price -->
                            </div>
                        </div>
                        <!-- Other cart and checkout information -->
                        <div class="card mb-4">
          <div class="card-body">
            <p><strong>Expected shipping delivery</strong></p>
            <p class="mb-0">12.10.2020 - 14.10.2020</p>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
            <p><strong>We accept</strong></p>
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
              alt="Visa" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
              alt="American Express" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
              alt="Mastercard" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
              alt="PayPal acceptance mark" />
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body">
    <ul class="list-group list-group-flush">
        <?php

$sql = "SELECT p.pro_imag, p.pro_name, p.pro_price, c.cart_id, c.quantity, p.qty AS qty, (p.pro_price * c.quantity) AS total_price 
FROM tbl_cart c 
JOIN tbl_product p ON c.pro_id = p.pro_id 
WHERE c.c_id = '".$c_id."'";
$result = mysqli_query($conn, $sql);


        // Assuming you have an array of products with details, you can loop through them like this:
        while($row = mysqli_fetch_array($result))
                        {
                            ?>

            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            <span><?php echo $row['pro_name']?></span>
            <span><?php echo $row['pro_price']?></span>
            </li>
            <?php
        }
        ?>
        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
            Shipping
            <span></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
            <div>
                <strong>Total amount (including VAT)</strong>
            </div>
            <span><strong>Total Price: ₹<?php echo number_format($totalPrice, 2); ?></strong></span>
        </li>
    </ul>
    <form method='POST' action="ordermaster.php">
    <button type="submit" value="add tbl_ordermaster" class="btn btn-primary btn-lg btn-block">
        Go to checkout
    </button>
</div>

                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
} else {
    // Handle the case where the cart is empty
    echo "<p>Your cart is empty.</p>";
}
?>
</body>
</html>