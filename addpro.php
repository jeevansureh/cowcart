<?php
// Start the session
session_start();

include('connection.php');error_reporting(E_ALL);
if(isset($_POST['submit']))
{
    echo "inside post";
    $cat_id = $_POST['category'];
    echo" cat_id";
    echo $cat_id;
    $pro_name = $_POST['pro_name'];
    $man_date = $_POST['man_date'];
    $exp_date = $_POST['exp_date'];
    $pro_price = $_POST['pro_price'];
    $pro_unit = $_POST['pro_unit'];
    $qty = $_POST['qty'];
    $pro_desc= $_POST['pro_desc'];
    $pro_imag = $_FILES['pro_imag']['name'];
    $allow = array("jpg","jpeg","gif","png");
    $todir = 'imgs/';      
      if ( !!$_FILES['pro_imag']['name'] ) // is the file uploaded yet?
      {
        echo "inside image 1";
            $info = explode('.', strtolower( $_FILES['pro_imag']['name']) ); // whats the extension of the file
    
            if ( in_array( end($info), $allow) ) // is this file allowed
            {
                echo "inside image 2";
                if ( move_uploaded_file( $_FILES['pro_imag']['tmp_name'], $todir . basename($_FILES['pro_imag']['name'] ) ) )
                {
                    echo "inside image 3";
                    echo " the file has been moved correctly";
                    $dst_db="imgs/".$pro_imag;
                }
    
            }
            else
            {
                $imageErr= " error this file ext is not allowed";
                $flag=0;
            }
        }
    
    
    $stock = $_POST['stock'];  
    $sql = "INSERT INTO tbl_product(cat_id, pro_name, man_date, exp_date, pro_price, pro_unit , qty, pro_desc,pro_imag,stock) VALUES('$cat_id','$pro_name','$man_date','$exp_date','$pro_price','$pro_unit','$qty','$pro_desc','$pro_imag','$stock')"; 
    $result=mysqli_query($conn,$sql);   
}
else {
    echo "post failed";
}
?>

<?php include_once('connection.php');?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Glassmorphism login Form Tutorial in html css</title>
  


  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css”>

    <!--Stylesheet-->
    <style media="screen">
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('img/milk1.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        .form-container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            text-align: center;
        }

        .form-container h2 {
            font-size: 32px;
            font-weight: 500;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .form-row {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            font-weight: 500;
            color: #ffffff;
            display: block;
            text-align: left;
        }

        select,
        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            height: 40px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            font-size: 14px;
            font-weight: 300;
            border: none;
        }

        input[type="file"] {
            height: auto;
        }

        button {
            width: 100%;
            padding: 15px 0;
            background-color: #ffffff60;
            color: #080710;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

    
    <main class="main">


        <div class="form-container">
        <h2>Add Product</h2><br>
         <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <label for="firstname" >select category:</label> &nbsp;
            
            <select name="category" id="category" value="choose category"> <option value="">select category</option>
            <div class="dropdown"> 
                          
            <?php 
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                        include 'connection.php';
                        $sql = "SELECT * FROM tbl_category";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                            }
                        } else {
                            echo "Error: " . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                    ?>
                            </select> 
             </div>
            
    <!--
                    <div class="form-row">
                        <label for="firstname" >select sub category:</label> &nbsp;
            <select name="subcategory" id="subcategory" value="choose sub category"> <option value="">-select subcategory-</option>
                            <div class="dropdown"> 
                                        
                               php code for dropdown   
    
                                </select> 
                            </div>
                    -->          
                        <div class="form-row">
                            <br> <label for="pro_name">Product Name:</label>
            <input type="text" name="pro_name" required>
                         </div>
                         <div class="form-row">
            <label for="man_date">Man:date:</label>
            <input type="date" name="man_date">
                        </div> 
                        <div class="form-row">
            <label for="exp_date">Exp:date:</label>
            <input type="date" name="exp_date">
                        </div> 
                         <div class="form-row">
            <label for="pro_price">Price:</label>
            <input type="number" name="pro_price" required>
                        </div>
                        <div class="form-row">
            <label for="pro_unit">Unit:</label>
            <input type="text" name="pro_unit" required>
                        </div>
    
                         <div class="form-row"> 
            <label for="qty">Quantity:</label>
            <input type="text" name="qty" required>
                        </div>
                        <div class="form-row"> 
            <label for="pro_desc">Description:</label>
            <input type="text" name="pro_desc" required>
                        </div>
                        <div class="form-row">
            <label for="pro_imag">Select an image:</label>
            <input type="file" name="pro_imag">
                        </div> 
                          <div class="form-row">
            <label for="stock">stock:</label>
            <input type="text" name="stock" required>
                          </div>
            
            <input type="submit" name="submit" value="Add Product">
            <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
                    
        </form>
    </div>
</main>
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    
        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"  src="jquery.main.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#category").change(function(){
                    var cat_id = $(this).val();
                    $.ajax({
                        
                        url: "action.php",
                        method: "POST",
                        data: { categoryID: cat_id },
                        success: function(data){
                            $("#subcategory").html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    
    
     
</body>
</html>
