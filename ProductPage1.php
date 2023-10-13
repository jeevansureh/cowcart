<?php
session_start();
include("connection.php");

function getCustID($username)
{
  global $conn;

  // Validate and sanitize the username
  $username = $username;

  // Query to retrieve user payment data from the database
  $sql = "SELECT c_id FROM tbl_customer WHERE c_name = '$username'";

  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    return $result->fetch_assoc()['c_id'];
  } else {
    return null;
  }
}
if (isset($_GET['productId'])) {
  $productId = $_GET['productId'];
  $sql = "SELECT * FROM tbl_product WHERE pro_id= '$productId'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Add Bootstrap CSS link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="fashion_section">
        <section class="py-5">
          <div class="container px-4 px-lg-5 my-3">
            <div class="row gx-4 gx-lg-5 align-items-center">
              <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="./imgs/<?php echo $row['pro_imag'] ?>" alt="Product Image" style="width: 100%; max-height: 700px; object-fit: cover;" />
              </div>
              <div class="col-md-6">
                <h1 class="display-5 fw-bolder text-uppercase text-warning"><?php echo strtoupper($row['pro_name']); ?></h1>
                <div class="mb-1 larger-text">Quantity : <?php echo $row['qty']; ?></div>
                <div class="mb-1 larger-text">Net Unit : <?php echo $row['pro_unit']; ?></div>
                <div class="mb-1 larger-text">Manufacture Date : <?php echo $row['man_date']; ?></div>
                <div class="mb-1 larger-text">Expiry Date : <?php echo $row['exp_date']; ?></div>
                <div class="fs-5 mb-5">
                  <span class="price-text">Rs <?php echo $row['pro_price']; ?></span>
                </div>
                <p class="lead"><?php echo $row['pro_desc']; ?></p>
                <div class="d-flex">
                  <?php
                  $stock = $row['stock'];
                  if ($stock <= 0) {
                    echo '<span class="larger-text badge bg-danger text-white">Out of Stock</span>';
                  } else { ?>
                   
  <input type="number" class="form-control text-center me-3" name="stock" value="1" style="max-width: 3rem;">
<form method='POST' action="addtocart.php"><input type="hidden" name="pro_id" value="<?php echo $row['pro_id']; ?>">
<input type="submit" class="btn btn-outline-dark flex-shrink-0 ml-2" name="<?php echo $row['pro_id']; ?>" value='Addtocart'></form>

                      <button name="buynow.php" class="btn btn-outline-dark flex-shrink-0 ml-2" type="submit">
                        Buy Now
                      </button>
                    </form>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <!-- Related items section-->
        <section class="py-5 bg-light">
          <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
              <?php
              // Use the search query to construct an SQL query
              $catId = $row['cat_id'];
              $sqlCat = "SELECT * FROM tbl_product WHERE cat_id = '$catId' LIMIT 4";

              $resultcat = $conn->query($sqlCat);
              if ($resultcat->num_rows > 0) {
                while ($relatedProduct = $resultcat->fetch_assoc()) {
              ?>
                  <div class="col-3 mb-5">
                    <a href="ProductPage.php?productId=<?php echo $relatedProduct['pro_id']; ?>">
                      <div class="card h-100">
                        <!-- Product image -->
                        <div class="card_img">
                          <img src="./imgs/<?php echo $relatedProduct['pro_imag']; ?>" alt="Product Image" style="padding: 0px 5px 0px 5px; width: 150px; height: 200px; object-fit: cover;" />
                        </div>
                        <!-- Product details -->
                        <div class="card-body p-4">
                          <div class="text-center">
                            <!-- Product name -->
                            <h5 class="fw-bolder"><?php echo $relatedProduct['pro_name']; ?></h5>
                            <!-- Product price -->
                            Rs <?php echo $relatedProduct['pro_price']; ?>
                          </div>
                        </div>
                        <!-- Product actions -->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                          <div class="text-center">
                            <a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>
        </section>
      </div>
    <?php } ?>
  </body>
  </html>
