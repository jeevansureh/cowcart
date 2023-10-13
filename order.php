<?php
include 'connection.php';
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{  
    $del_fname=$_POST['del_fname'];
    $del_lname=$_POST['del_lname'];
    $del_hname=$_POST['del_hname'];
    $del_phn=$_POST['del_phn'];
    $del_place=$_POST['del_place'];
    $del_lmark=$_POST['del_lmark'];
    $del_pin=$_POST['del_pin'];
    $del_dist=$_POST['del_dist'];
    echo $del_fname;
    echo $del_hname;
    echo $del_phn;
    echo $del_place;
    echo $del_lmark;
    echo $del_pin;
    echo $del_dist;
    $totamt=0;
    $date=date("y/m/d");

    $sql="insert into tbl_delivery(del_fname,del_lname,del_hname,del_phn,del_place,del_lmark,del_pin,del_dist) 
    values('$del_fname','$del_lname','$del_hname','$del_phn','$del_place','$del_lmark','$del_pin','$del_dist')";
    $result=mysqli_query($data,$sql);
    $del_id=mysqli_insert_id($data);

    echo  $del_id;
    echo $date;
   $custid=$_SESSION['customerid'];

    echo $custid;
    $sql="insert into tbl_ordermaster(cust_id,del_id,tot_amt,ord_date) values('$custid','$del_id','$totamt','$date')";
    $result=mysqli_query($data,$sql);
    $orm_id=mysqli_insert_id($data);


    $cart_query = "SELECT c.pro_id, $orm_id AS orm_id, c.qty, (p.pro_price * c.qty) AS total_amount 
    FROM tbl_carts c 
    JOIN tbl_product p ON c.pro_id = p.pro_id 
    WHERE c.cust_id = '$custid'";

$cart_result = mysqli_query($data, $cart_query);

while ($cart_row = mysqli_fetch_assoc($cart_result)) {
$pro_id = $cart_row['pro_id'];
$qty = $cart_row['qty'];
$total_amount += $cart_row['total_amount'];

$order_query = "INSERT INTO tbl_order(orm_id, pro_id, qty, amount) 
         VALUES('$orm_id', '$pro_id', '$qty', '$total_amount')";

$order_result = mysqli_query($data, $order_query);

if (!$order_result) {
echo "Error inserting order details: " . mysqli_error($data);
}
}

//update total amnt in tbl_orm
$update_master_total_query="UPDATE tbl_ordermaster SET tot_amt= '$total_amount' WHERE orm_id='$orm_id'";
$update_master_total_result=mysqli_query($data,$update_master_total_query);

echo"order placed successfully";
$_SESSION['orm_id']=$orm_id;
exit();
 
}
else{
   
    }
?>





<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Out</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="cart/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="cart/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="cart/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="cart/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="cart/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="cart/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="cart/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="cart/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="cart/css/style.css" type="text/css">
        <link rel="stylesheet" href="footer/css/style.css">
</head>

<body>
     <!-- Header Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
  <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="index.php"><i class="fa fa-home" style="color:#e3b80c"></i> Home</a>
                        <a href="cart.php">Cart</a>
                        <span>CheckOut</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</nav>
  
    

    <!-- Shopping Cart Section Begin -->



    <section class="checkout-section spad">
        <div class="container">
            <form action="checkout.php" method="POST" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                    <form action="checkout.php" method="POST" class="checkout-form">
                        <h4>Delivery Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="fir">First Name<span>*</span></label>
                                <input type="text" id="fir" name="del_fname">
                            </div>
                            <div class="col-lg-6">
                                <label for="last">Last Name<span>*</span></label>
                                <input type="text" id="last" name="del_lname">
                            </div>
                            <div class="col-lg-12">
                                <label for="street">House Name<span>*</span></label>
                                <input type="text" id="street" class="street-first" name="del_hname">
                            </div>
                            <div class="col-lg-12">
                                <label for="cun-name">Land Mark</label>
                                <input type="text" id="cun-name" name="del_lmark">
                            </div>
                            <div class="col-lg-6">
                                <label for="town">Place<span>*</span></label>
                                <input type="text" id="town" name="del_place">
                            </div>
                            <div class="col-lg-6">
                                <label for="cun">District<span>*</span></label>
                                <input type="text" id="cun" name="del_dist">
                            </div>
                            <div class="col-lg-6">
                                <label for="zip">Pincode</label>
                                <input type="text" id="zip" name="del_pin">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" id="phone" name="del_phn">
                            </div>
                            <div class="col-lg-12">
                            <input type="submit" value="SUBMIT" class="btn-btn-dark" name="submit" >
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Your Order</h4>
                           <br> <div class="order-total">
                                <ul class="order-table">
                                    <li>Product<span>Total</span></li>
                                    
                    <?php
                      $totalprice=0;
                      $custid = $_SESSION['customerid'];
                      $sql = "SELECT p.pro_image, p.pro_name,p.pro_id, p.pro_price, p.pro_des,c.qty,p.flav_id,p.pro_unit,c.cart_id,(p.pro_price*c.qty)AS total_price FROM tbl_carts c 
                      JOIN tbl_product p ON c.pro_id = p.pro_id where c.cust_id=$custid";
                       $result = mysqli_query($data,$sql);
                       while($item = mysqli_fetch_array($result))
                       {
                        ?>
                   
                                    <li class="fw-normal"><?php echo $item['pro_name'];?>x <?php echo $item['qty']?> <span><?php echo $item['total_price'];?></span></li>
                                    <?php $itemprice=$item['total_price'];
                                    $totalprice=$itemprice+$totalprice;
                                    
                                  
                       }
                       ?>
                                    <li class="total-price">Total<span><?php echo $totalprice;?> ₹</span></li>
                                </ul>
                     
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            UPI
                                            <input type="radio" id="pc-check" name="options">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Net Banking
                                            <input type="radio" id="pc-paypal" name="options">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Credit/Debit/ATM Card
                                            <input type="radio" id="pc-paypal"name="options">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Cash on Delivery
                                            <input type="radio" id="pc-paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="order-btn">
                                    <button type="button" class="site-btn place-btn"  data-toggle="modal" data-target="#myModal">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
   
    <!-- Shopping Cart Section End -->

    <div class>
    <?php
  include('footer.html')
  ?>
  </div>


<!-- modal -->



<div class="modal" id="myModal"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Confirmed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
      <p>We are excited to inform you that your order has been successfully confirmed! </p>
    <p>Thank you for choosing us for your purchase.</p>
    <p>Best regards,</p>
    <p>NUTRAZONE</p>
      </div>
      <div class="modal-footer">
        <form  method='POST' action='bill.php'><input type='hidden' name='orm_id' value="<?php echo $row['orm_id'];?>">
        <input type='submit' name="<?php echo $row['orm_id'];?>"value='Generate Bill'></form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <!-- Js Plugins -->
    <script src="cart/js/jquery-3.3.1.min.js"></script>
    <script src="cart/js/bootstrap.min.js"></script>
    <script src="cart/js/jquery-ui.min.js"></script>
    <script src="cart/js/jquery.countdown.min.js"></script>
    <script src="cart/js/jquery.nice-select.min.js"></script>
    <script src="cart/js/jquery.zoom.min.js"></script>
    <script src="cart/js/jquery.dd.min.js"></script>
    <script src="cart/js/jquery.slicknav.js"></script>
    <script src="cart/js/owl.carousel.min.js"></script>
    <script src="cart/js/main.js"></script>
</body>

</html>