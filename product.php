<?php
include_once'connection.php';error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    echo "inside POST";
    $product_name=$_POST['pro_name'];
    $product_img=$_FILES['pro_image']['name'];
    $product_description=$_POST['pro_desp'];
    $product_price=$_POST['pro_price'];
    $catid=$_POST['category'];
    $brand_id=$_POST['brand'];
    $product_size=$_POST['pro_size'];
    echo $product_name;
    echo $product_img;
    echo $product_description;
    echo $product_price;
    echo $catid;
    echo $brand_id;
    echo $product_size;
    $sql = "insert into products(pro_name,pro_img,pro_desp,pro_price,cat_id,brand_id,pro_size) values('$product_name','$product_img','$product_description','$product_price','$catid','$brand_id','$product_size')";
    $result=mysqli_query($data,$sql);
}
else{
    echo "post failed";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="category.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
    <div id="container" class="container">
    <div class="align-items-center">
        <div class="form-wrapper">
        <h2>add product</h2>
        <form action="product.php" method="post" enctype="multipart/form-data">
        <div class="dropdown">
           <select name="category" id="category" value="choose category"> <option value="">select category</option>
 
                
                    <?php
                    $sql="select * from tbl_category";
                    $result=mysqli_query($data,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_name'] . "</option>";
                    }
                    
                ?>
                </select> </div>
                <div class="dropdown">
           <select name="brand" value="choose brand" id="brand"> <option value="">select Brand</option>
 
                
           <option value="" disabled selected>- Select brand-</option>
            
                </select> </div>
            <label for="product_name">product name</label>
            <input type="text" name="pro_name"class="form-input" placeholder="" required>
           <br>
           <label for="product_img">product image</label>
            <input type="file" id="pro_image" name="pro_image" accept="taqwa/*" class="form-input" placeholder="" required>
           <br>
           <label for="product_description">product description</label>
            <input type="text" name="pro_desp"class="form-input" placeholder="" required>
           <br>
           <label for="product_price">product price</label>
            <input type="text" name="pro_price"class="form-input" placeholder="" required>
           <br>
           <label for="product_size">product size</label>
            <input type="text" name="pro_size"class="form-input" placeholder="" required>
           <br>
          
        
            <input type="submit" value="add product" name="add_product" class="submit-button">
        </form>
    </div>
    </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript"  src="jquery.main.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#category").change(function(){
            var category_id = $(this).val();
           // document.write("ddddddddddddddddddddddd");
           // alert("category");
            $.ajax({
                
                url: "action.php",
                method: "POST",
                data: { categoryID: category_id },
                success: function(data){
                    $("#brand").html(data);
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