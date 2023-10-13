<?php
// Start the session
session_start();
?>
<?php include_once('connection.php');
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    echo "inside isset";
    $id=$_POST['ids'];
    echo $id;
    $sql="DELETE FROM tbl_product WHERE pro_id='".$id."'";
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
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */

    }

    .popup-content {
      background-color: rgba(249, 249, 249, 0.273); /* Add an alpha channel for transparency */
        backdrop-filter: blur(10px);
        margin: 5% auto;
        overflow-y: auto; /* Add a scrollbar when content overflows */
        padding: 20px;
        max-height: 80vh; /* Limit the maximum height */
        width: 60%;
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
input[type="text"],
input [type="number"],
input [type="text"],
input [type="text"],{
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
</style>
<body>
<nav class="sidebar">
      <a href="#" class="logo">Hello sir</a>

      <div class="menu-content">
        <ul class="menu-items">
          <div class="menu-title">Your menu title</div>

          <li class="item">
            <a href="#">view orders</a>
          </li>

          <li class="item">
            <div class="submenu-item">
              <span>AUGMENTATION</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>

            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                BACK
              </div>
              <li class="item">
                <a href="staff.php">Add Staff</a>
              </li>
              <li class="item">
                <a href="category.php">Add Category</a>
              </li>
              <li class="item">
                <a href="servicearea.php">Add Service Area</a>
              </li>
              <li class="item">
                <a href="viewproduct.php">Add Products</a>
              </li>
            </ul>
          </li>
          <li class="item">
            <div class="submenu-item">
              <span>Second submenu</span>
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
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
              <li class="item">
                <a href="#">Second sublink</a>
              </li>
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
            <a href="#">Your third link</a>
          </li>
          <li class="item">
  <a href="index.php">Log Out</a>
</li>
        </ul>
      </div>
      </nav>
        </ul>
      </div>
    </nav>

    <nav class="navbar">
    <i class="fa-solid fa-bars" id="sidebar-close"></i><h1></h1>
   





    </nav>
    <main class="main" style="height:auto;">
  <div style="text-align: right; margin-top: 20px; margin-right: 20px;">
    <button class="btn btn-lg" style="background-color: transparent;">
      <a class="fa fa-plus-circle" href="addpro.php">Add</a>
    </button>
  </div>
        <div class="container-fluid">
            <div class="row">
                <?php
                $sql = "SELECT p.*, c.cat_name
                        FROM tbl_product p 
                        JOIN tbl_category c ON p.cat_id = c.cat_id";       
                $result = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class="col-md-3">
    <div class="card">
        <img src="./imgs/<?php echo $row['pro_imag']; ?>" class="card-img-top img-fluid card-img">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['pro_name']; ?></h5>
            <p class="card-text">Product ID: <?php echo $row['pro_id']; ?></p>
            <p class="card-text">Man Date: <?php echo $row['man_date']; ?></p>
            <p class="card-text">Exp Date: <?php echo $row['exp_date']; ?></p>
            <p class="card-text">Category: <?php echo $row['cat_name']; ?></p>
            <p class="card-text">Price: <?php echo $row['pro_price']; ?></p>
            <p class="card-text">Unit: <?php echo $row['pro_unit']; ?></p>
            <p class="card-text">Qty: <?php echo $row['qty']; ?></p>
            <p class="card-text">Description: <?php echo $row['pro_desc']; ?></p>
            <p class="card-text">Stock: <?php echo $row['stock']; ?></p>
            <form method="POST" action="viewproduct.php">
                <input type="hidden" name="ids" value="<?php echo $row['pro_id']; ?>">
                <input type="submit" name="id" value="Delete" class="btn btn-danger">
                <button type="button" class="btn btn-primary" onclick="showUpdatePopup('<?php echo $row['pro_id']; ?>', '<?php echo $row['pro_name']; ?>', '<?php echo $row['pro_price']; ?>','<?php echo $row['pro_unit']; ?>','<?php echo $row['qty']; ?>','<?php echo $row['pro_desc']; ?>','<?php echo $row['stock']; ?>','<?php echo $row['pro_imag']; ?>',' <?php echo $row['man_date']; ?>','<?php echo $row['exp_date']; ?>')">Edit</button>
            </form>
        
    


                            <div id="updatePopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeUpdatePopup()">&times;</span>
        <h2>Update Product</h2>
        <form method="POST" action="update_product.php" enctype="multipart/form-data">
            <input type="hidden" name="pro_id" id="updateProductId">
            <label for="updateProductName">Product Name:</label>
            <input type="text" id="updateProductName" name="pro_name" required>
            <label for="updateProductPrice">Product Price:</label>
            <input type="number" id="updateProductPrice" name="pro_price" required>
            <!-- Hidden input field to store the product ID -->
            <label for="updateProductUnit">Unit:</label>
            <input type="text" id="updateProductUnit" name="pro_unit" required>
            <label for="updateProductQty">Quantity:</label>
            <input type="text" id="updateProductQty" name="qty" required>
            <label for="updateProductDesc">Description:</label>
            <textarea id="updateProductDesc" name="pro_desc" rows="4" required></textarea>
            <label for="updateProductStock">Stock:</label>
            <input type="number" id="updateProductStock" name="stock" required>
            <label for="updateProductMan_date">Man_Date:</label>
            <input type="date" id="updateProductMan_date" name="man_date" required>
            <label for="updateProductExp_date">Exp_Date:</label>
            <input type="date" id="updateProductExp_date" name="exp_date" required>
            <label for="updateProductImage">Product Image:</label>
            <input type="file" id="updateProductImage" name="pro_imag" accept="image/*"> 
            
            <input type="submit" class="btn btn-danger" value="Update">
        </form>
    </div>
</div>



                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <script src="javascript/admindash.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>
function showUpdatePopup(pro_id, pro_name, pro_price, pro_unit, qty, pro_desc, stock, pro_imag,man_date,exp_date) {
    // Code to show the popup and populate the form fields
    document.getElementById('updateProductId').value = pro_id;
    document.getElementById('updateProductName').value = pro_name;
    document.getElementById('updateProductPrice').value = pro_price;
    document.getElementById('updateProductUnit').value = pro_unit;
    document.getElementById('updateProductQty').value = qty;
    document.getElementById('updateProductDesc').value = pro_desc;
    document.getElementById('updateProductMan_date').value = man_date;
    document.getElementById('updateProductExp_date').value = exp_date;
    document.getElementById('updateProductStock').value = stock;
    
    // You may need to handle the image display here if needed

    // Show the popup
    document.getElementById('updatePopup').style.display = 'block';
}

function closeUpdatePopup() {
    // Code to close the popup
    document.getElementById('updatePopup').style.display = 'none';
}
</script>

</body>
</html>