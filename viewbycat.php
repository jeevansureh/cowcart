
<div class="fashion_section">
    <div id="main_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <?php
                    // Assuming you have a database connection established
                    include('connection.php');
                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                        $cat_id = $_GET['id'];

                        // Fetch the category name
                        $cat_query = "SELECT cat_name FROM tbl_category WHERE cat_id = $cat_id";
                        $cat_result = mysqli_query($conn, $cat_query);
                        $cat_row = mysqli_fetch_assoc($cat_result);
                        $category_name = $cat_row['cat_name'];

                        echo '<h1 class="fashion_taital">' . $category_name . '</h1>';

                        // Fetch products for the given category
                        $query = "SELECT tbl_product.*, tbl_category.cat_name 
                        FROM tbl_product 
                        JOIN tbl_category ON tbl_product.cat_id = tbl_category.cat_id 
                        WHERE tbl_product.cat_id = $cat_id";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            // Loop through the results and display product details
                          ?>
                            <div class ="row">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="box_main">
                                        <h4 class="shirt_text"><?php echo $row['pro_name']; ?></h4>
                                        <p class="price_text">Price <span style="color: #262626;">₹ <?php echo $row['pro_price']; ?></span></p>
                                        <div class="tshirt_img">
                                            <img src="./imgs/<?php echo $row['pro_imag']; ?>">
                                        </div>
                                        <div class="btn_main">
                                            <div class="buy_bt"><a href="buy.php?id=<?php echo $row['pro_id']; ?>">Buy Now</a></div>
                                            <div class="seemore_bt"><a href="addtocart.php?id=<?php echo $row['pro_id']; ?>">Add Cart</a></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                           ?>
                            </div><?php

                        } else {
                            echo "Error fetching products: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Invalid category ID.";
                    }
                    ?>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
