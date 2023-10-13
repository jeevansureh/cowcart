<?php
// Start the session
session_start();
?>
<?php include('connection.php'); 

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    echo "inside isset";
    $id=$_POST['ids'];
    echo $id;
    $sql="DELETE FROM tbl_product WHERE product_id='".$id."'";
    $result=mysqli_query($conn,$sql);
}
else{

}
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar Menu for Admin Dashboard | CodingNepal</title>
    <link rel="stylesheet" href="css/admindash.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px; /* Add some space between cards */
        }

        .card-img {
            max-height: 300px; /* Limit the maximum height of the image */
        }
        
    .card-body {
        background-color: #e18a3d; /* Adjust the alpha value (0.5 for 50% transparency) */
    }

   
    /* Styles for the popup */
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .popup-content {
      background-color: rgba(249, 249, 249, 0.273); /* Add an alpha channel for transparency */
        backdrop-filter: blur(10px);
        margin: 10% auto;
        padding: 20px;
        width: 40%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    /* Close button style */
    .close {
        float: right;
        cursor: pointer;
        font-size: 20px;
    }


    .close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Style for the form labels */
label {
    display: block;
    margin-bottom: 5px;
}

/* Style for the form inputs */
input[type="text"],
input[type="number"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}



    </style>
  </head>
  <body>
    <nav class="sidebar">
      <a href="#" class="logo">Welcome Back!<br><?php echo $_SESSION['dealername'];?><br> Id:  <?php echo $_SESSION['dealerID'];?></a>
     <div class="menu-content">
        <ul class="menu-items">
          <div class="menu-title">Dashboard</div>

          <li class="item">
            <a href="add_product.php">profile</a>
          </li>

          <li class="item">
            <div class="submenu-item">
              <span>manage Products</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>

            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
               product
              </div>
              <li class="item">
                <a href="add_product.php">Add Product</a>
              </li>
              <li class="item">
                <a href="viewdealerproduct.php">View product</a>
              </li>
              <li class="item">
                <a href="#">First sublink</a>
              </li>
            </ul>
          </li>
          <li class="item">
            <div class="submenu-item">
              <span>menu</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>

            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Your submenu title
              </div>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
            </ul>
          </li>

          <li class="item">
            <a href="#">Your second link</a>
          </li>
          <li class="item">
            <a href="signout.php">sign out</a>
          </li>
        </ul>
      </div>
    
    </nav>

    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>`
    </nav>

    <main class="main" style="height:auto;">
    <main class="py-4 container">
        <div class="row">
            <?php
            
            $id=$_SESSION['dealerID'];
            $sql = "SELECT p.*, c.cat_name, sc.subcat_name 
                    FROM tbl_product p 
                    JOIN tbl_category c ON p.cat_id = c.cat_id 
                    JOIN tbl_subcategory sc ON p.subcat_id = sc.subcat_id where dealer_id='".$id."'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="col-md-3">
                    
                        <img src="./uploadimage/<?php echo $row['image']; ?>" class="card-img-top img-fluid card-img">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                            <p class="card-text">Product ID: <?php echo $row['product_id']; ?></p>
                            <p class="card-text">Price: <?php echo $row['product_price']; ?></p>
                            <p class="card-text">Stock: <?php echo $row['stock']; ?></p>
                            <p class="card-text">Category: <?php echo $row['cat_name']; ?></p>
                            <p class="card-text">Subcategory: <?php echo $row['subcat_name']; ?></p>
                            <form method="POST" action="viewdealerproduct.php">
                                <input type="hidden" name="ids" value="<?php echo $row['product_id']; ?>">
                                <input type="submit" name="id" value="Delete" class="btn btn-danger">
                                <button type="button" class="btn btn-danger" onclick="showUpdatePopup(<?php echo $row['product_id']; ?>, '<?php echo $row['product_name']; ?>', '<?php echo $row['product_price']; ?>', '<?php echo $row['stock']; ?>'  )">Edit</button>
                                
                            </form>

                            <div id="updatePopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeUpdatePopup()">&times;</span>
        <h2>Update Product</h2>
        <form method="POST" action="update_product.php" enctype="multipart/form-data">
            <input type="hidden" name="product_id" id="updateProductId">
            <label for="updateProductName">Product Name:</label>
            <input type="text" id="updateProductName" name="product_name" required>
            <label for="updateProductPrice">Product Price:</label>
            <input type="number" id="updateProductPrice" name="product_price" required>

            <label for="updateProductStock">Stock:</label>
            <input type="number" id="updateProductStock" name="stock" required>

<!--             <label for="updateProductImage">Product Image:</label>
            <input type="file" id="updateProductImage" name="product_image" accept="image/*"> -->
            
            <input type="submit" class="btn btn-danger" value="Update">
        </form>
    </div>
</div>




                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    </main>

    <script src="javascript/admindash.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>





  </body>
</html>



















