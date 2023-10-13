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

if (isset($_POST['addcart'])) {
  $productId = $_POST['productId'];
  if (isset($_SESSION['name'])) {
    $currentusername = $_SESSION['name'];
    $custId = getCustId($currentusername);
    $stock = $_POST['stock'];
    $sqlcart = "INSERT INTO tbl_cart (cust_id, bookinventory_id,quantity) VALUES (?,?,?)";
    $stmt = $conn->prepare($sqlcart);
    $stmt->bind_param("iii", $custId, $productId, $stock);
    $sqlstock = "SELECT quantity_change FROM tbl_stock WHERE bookinventory_id = '$productId' ";
    $result = $conn->query($sqlstock);
    $stockcount = $result->fetch_assoc()['quantity_change'];
    if ($stock <= $stockcount) {
      $sqlcartitem = "SELECT * FROM tbl_cart WHERE cust_id = '$custId' AND bookinventory_id = '$productId'";
      $resultci = $conn->query($sqlcartitem);

      if ($resultci->num_rows == 1) {
        echo '<script>alert("This product is already in your cart.")</script>';
        header("Location: ProductPage.php?productId=$productId");
      } else {

        if ($stmt->execute()) {
          // Stock quantity updated successfully, you can redirect to the book inventory list or perform any other action.
          header("Location: ProductPage.php?productId=$productId");
          exit;
        } else {
          // Handle any errors during execution, if needed
          echo "Error updating stock quantity: " . $stmt->error;
        }
      }
    }
  } else {
    echo '<script>alert("Please Login."); window.location.href = "ProductPage.php?productId=' . $productId . '";</script>';

    
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>Ink&Paper</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" type="text/css" href="css/ink&paper.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- fevicon -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <!-- fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- font awesome -->
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--  -->
  <!-- owl stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesoeet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>

<body>
  <!-- banner bg main start -->
  <div class="banner_bg_main">
    <!-- header top section start -->
    <!-- <div class="container">
            <div class="header_section_top">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="custom_menu">
                        <ul>
                           <li><a href="#">Best Sellers</a></li>
                           <li><a href="#">Award Winners</a></li>
                           <li><a href="#">New Arrivals</a></li>
                           <li><a href="#">Today's Deals</a></li>
                           <li><a href="#">Customer Service</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header top section start -->
    <!-- logo section start -->
    <div class="logo_section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="logo"><a href="home.php">
                <h2 class="banner_taital">Ink&Paper</h2>
              </a></div>
          </div>
        </div>
      </div>
    </div>
    <!-- logo section end -->
    <!-- header section start -->
    <div class="header_section">
      <div class="container">
        <div class="containt_main">
          <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <h2>Hello Readers!</h2>
            <h3>Shop By Category</h3>
            <?php
            // Fetch category names from the database
            $sql = "SELECT category_name,category_id FROM tbl_category";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Output category links
              while ($row = $result->fetch_assoc()) {
                echo '<a href="home.php?categoryId=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';
              }
            }
            ?>
            <h3>Help & Setting</h3>
            <a href="UserDashboard.php">Your Account</a>
            <a href="ContactUs.php">Contact Us</a>
            <a href="signout.php">Sign Out</a>
          </div>
          <span class="toggle_icon" onclick="openNav()"><img src="images/toggle-icon.png"></span>
          <!--<div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category 
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Best Sellers</a>
                        <a class="dropdown-item" href="#">Award winners</a>
                        <a class="dropdown-item" href="#">Fiction</a>
                        <a class="dropdown-item" href="#">Novels</a>
                     </div>
                  </div>-->
          <div class="main">
            <!-- Another variation with a button -->
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
              <div class="input-group">

                <input type="text" class="form-control" name="searchItem" placeholder="Search by Title, Author, Publishers">
                <div class="input-group-append">
                  <button class="btn btn-secondary" name="query" type="submit" style="background-color: #f26522; border-color:#f26522 ">
                    <i class="fa fa-search"></i>
                  </button>
                </div>

              </div>
            </form>
          </div>
          <div class="header_box">
            <!--<div class="lang_box ">
                        <a href="#" title="Language" class="nav-link" data-toggle="dropdown" aria-expanded="true">
                        <img src="images/flag-uk.png" alt="flag" class="mr-2 " title="United Kingdom"> English <i class="fa fa-angle-down ml-2" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu ">
                           <a href="#" class="dropdown-item">
                           <img src="images/India_Flag .jpeg" class="mr-2" alt="flag">
                           India
                           </a>
                        </div>
                     </div>-->
            <div class="login_menu">
              <?php if (isset($_SESSION["name"])) { ?>
                <li>
                  <a href="Cart.php">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="padding_10">Cart</span>
                  </a>
                </li>

                <li><i class="fa fa-user " aria-hidden="true"></i>
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["name"]; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                      <a class="dropdown-item" href="UserDashboard.php">Your Account</a>
                      <a class="dropdown-item" href="#">Your Order</a>
                      <a class="dropdown-item" href="signout.php">Sign Out</a>

                    </div>
                  </div>
                </li>
              <?php } else { ?>
                <li><a href="login_signup.php?userType=Customer">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="padding_10">Login</span></a>
                </li>
              <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- header section end -->


    <!-- book section start -->
    <?php
      if (isset($_POST['query'])) {
      $searchQuery = $_POST['searchItem'];
      echo '<div class="fashion_section py-5">';
      echo '<div class="container px-4 px-lg-5 mt-5">';
      echo '<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">';

      // Use the search query to construct an SQL query
      $sql = "SELECT bi.bookinventory_id,bi.title,bi.cover_image_url,bi.price,bi.isbn,bi.author,p.publisher_name FROM tbl_bookinventory bi JOIN tbl_publisher p ON bi.publisher_id = p.publisher_id WHERE 
         (bi.title LIKE '%$searchQuery%' OR
         bi.author LIKE '%$searchQuery%' OR
         bi.isbn LIKE '%$searchQuery%' OR p.publisher_name LIKE '%$searchQuery%') AND bi.approval_status='Approved'";

      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
         while ($searchProduct = $result->fetch_assoc()) {


            echo '<div class="col-3 mb-5">';
            echo '<a href="ProductPage.php?productId=' . $searchProduct['bookinventory_id'] . '">';
            echo '<div class="card h-100">';

            // Product image
            echo '<div class="card_img">';
            echo '<img src="' . $searchProduct['cover_image_url'] . '" alt="Product Image" style="padding: 0px 5px 0px 5px; width: 150px; height: 200px; object-fit: cover;" />';
            echo '</div>';

            // Product details
            echo '<div class="card-body p-4">';
            echo '<div class="text-center">';
            // Product name
            echo '<h5 class="fw-bolder">' . $searchProduct['title'] . '</h5>';

            // Product price
            echo 'Rs ' . $searchProduct['price'];
            echo '</div>';
            echo '</div>';
            // Product actions
            echo '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
            echo '<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
         }
      }
      echo '</div>';
      echo '</div>';
      echo '</div>';
   }  elseif (isset($_GET['productId'])) {
      $productId = $_GET['productId'];
      $sql = "SELECT bi.*,p.*,s.quantity_change FROM tbl_bookinventory bi JOIN tbl_publisher p ON bi.publisher_id = p.publisher_id JOIN tbl_stock s ON bi.bookinventory_id = s.bookinventory_id WHERE bi.bookinventory_id= '$productId'";
      $result = $conn->query($sql);
      $productItem = $result->fetch_assoc(); ?>

      <div class="fashion_section">
        <section class="py-5">
          <div class="container px-4 px-lg-5 my-3">
            <div class="row gx-4 gx-lg-5 align-items-center">
              <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="<?php echo $productItem['cover_image_url'] ?>" alt="..." style="width: 100%; max-height: 700px; object-fit: cover;" />
              </div>
              <div class="col-md-6">
                <div class="mb-1 larger-text">ISBN : <?php echo '' . $productItem['isbn'] . ''; ?></div>
                <h1 class="display-5 fw-bolder text-uppercase text-warning"><?php echo strtoupper($productItem['title']); ?></h1>

                <div class="mb-1 larger-text">Author : <?php echo '' . $productItem['author'] . ''; ?></div>
                <div class="mb-1 larger-text">Publisher : <?php echo '' . $productItem['publisher_name'] . ''; ?></div>
                <div class="fs-5 mb-5">
                  <span class="price-text"><?php echo 'Rs ' . $productItem['price'] . ''; ?></span>
                </div>
                <div class="d-flex">
                  <?php
                  $stock = $productItem['quantity_change'];
                  if ($stock <= 0) {
                    echo '<span class="larger-text badge bg-danger text-white">Out of Stock</span>';
                  } else { ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="d-flex align-items-center">
                      <input type="hidden" name="productId" value="<?php echo '' . $productId . ''; ?>">
                      <input type="number" class="form-control text-center me-3" name="stock" value="1" style="max-width: 3rem;">
                      <button name="addcart" class="btn btn-outline-dark flex-shrink-0 ml-2" type="submit">
                        <i class="fa fa-shopping-cart me-1"></i>
                        Add to cart
                      </button>
                    </form>

                  <?php } ?>
                </div>

              </div>
            </div>
        </section>
        <section class="py-3 mx-5">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#book-details">Book Details</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#about-author">About Author</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#publisher-details">Publisher Details</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active book-details" id="book-details">
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Pages
                </div>
                <div class="col-lg-9 col-md-8"><?php echo '' . $productItem['book_length'] . ''; ?></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Published Date
                </div>
                <div class="col-lg-9 col-md-8"><?php echo '' . $productItem['publication_date'] . ''; ?></div>
              </div>
              <div class="col-lg-3 col-md-4 label">
                Description
              </div>
              <div class="col-lg-9 col-md-8">
                <p class="small fst-italic"><?php echo '' . $productItem['description'] . ''; ?></p>
              </div>
            </div>
            <div class="tab-pane fade about-author pt-3" id="about-author">
              <!-- Profile Edit Form -->
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Author Name
                </div>
                <div class="col-lg-9 col-md-8"><?php echo '' . $productItem['author'] . ''; ?></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Author Bio
                </div>
                <div class="col-lg-9 col-md-8">
                  <p class="small fst-italic"><?php echo '' . $productItem['author_bio'] . ''; ?></p>
                </div>
              </div>
            </div>
            <div class="tab-pane fade pt-3" id="publisher-details">
              <!-- Settings Form -->
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  About Publisher
                </div>
                <div class="col-lg-9 col-md-8">
                  <p class="small fst-italic"><?php echo '' . $productItem['publisher_description'] . ''; ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Publisher Name
                </div>
                <div class="col-lg-9 col-md-8"><?php echo '' . $productItem['publisher_name'] . ''; ?></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Publisher Email
                </div>
                <div class="col-lg-9 col-md-8"><?php echo '' . $productItem['publisher_email'] . ''; ?></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Contact Number
                </div>
                <div class="col-lg-9 col-md-8"><?php echo '' . $productItem['publisher_phonenumber'] . ''; ?></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Address
                </div>
                <div class="col-lg-9 col-md-8">
                  <p class="small fst-italic"><?php echo '' . $productItem['publisher_address'] . ''; ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Publisher Email
                </div>
                <div class="col-lg-9 col-md-8"><?php echo '' . $productItem['publisher_email'] . ''; ?></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Publisher Website
                </div>
                <div class="col-lg-9 col-md-8"><?php echo '' . $productItem['publisher_website'] . ''; ?></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">
                  Publisher Founded Year
                </div>
                <div class="col-lg-9 col-md-8"><?php echo '' . $productItem['publisher_foundedyear'] . ''; ?></div>
              </div>
            </div>
          </div>
        </section>
        <!-- Related items section-->

        <section class="py-5 bg-light">
          <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <?php
            echo '<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">';

            // Use the search query to construct an SQL query
            $catId = $productItem['category_id'];
            $sqlCat = "SELECT * FROM tbl_bookinventory WHERE category_id = '$catId' AND approval_status = 'Approved' LIMIT 4";

            $resultcat = $conn->query($sqlCat);
            if ($resultcat->num_rows > 0) {
              while ($catProduct = $resultcat->fetch_assoc()) {


                echo '<div class="col-3 mb-5">';
                echo '<a href="ProductPage.php?productId=' . $catProduct['bookinventory_id'] . '">';
                echo '<div class="card h-100">';

                // Product image
                echo '<div class="card_img">';
                echo '<img src="' . $catProduct['cover_image_url'] . '" alt="Product Image" style="padding: 0px 5px 0px 5px; width: 150px; height: 200px; object-fit: cover;" />';
                echo '</div>';

                // Product details
                echo '<div class="card-body p-4">';
                echo '<div class="text-center">';
                // Product name
                echo '<h5 class="fw-bolder">' . $catProduct['title'] . '</h5>';

                // Product price
                echo 'Rs ' . $catProduct['price'];
                echo '</div>';
                echo '</div>';
                // Product actions
                echo '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
                echo '<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
              }
            }
            echo '</div>';
            ?>
          </div>
        </section>
      </div>
    <?php } ?>

    <!-- footer section start -->
    <div class="footer_section layout_padding">
      <div class="container">
        <div class="footer_logo"><a href="index.html">
            <h2 class="banner_taital">Ink&Paper</h2>
          </a></div>
        <!--<div class="input_bt">
               <input type="text" class="mail_bt" placeholder="Your Email" name="Your Email">
               <span class="subscribe_bt" id="basic-addon2"><a href="#">Subscribe</a></span>
            </div>-->
        <div class="footer_menu">
          <ul>
            <li><a href="#">Best Sellers</a></li>
            <li><a href="#">Award Winners</a></li>
            <li><a href="#">New Releases</a></li>
            <li><a href="login_signup.php?userType=Publisher">Become a Publisher</a></li>
            <li><a href="#">Customer Service</a></li>
          </ul>
        </div>
        <div class="location_main">Help Line Number : <a href="#">+91 00000-00000</a></div>
      </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
      <div class="container">
        <p class="copyright_text">© 2023 All Rights Reserved.</a></p>
      </div>
    </div>
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/popper.min.js"></script>
    <script src="javascript/bootstrap.bundle.min.js"></script>
    <script src="javascript/jquery-3.0.0.min.js"></script>
    <script src="javascript/plugin.js"></script>
    <!-- sidebar -->
    <script src="javascript/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="javascript/custom.js"></script>
    <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
    </script>
</body>

</html>