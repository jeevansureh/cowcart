<div class="fashion_section">
   <div id="main_slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container">
               <h1 class="fashion_taital">All Products</h1>
               <div class="fashion_section_2">
                  <div class="row">
                     <?php
                        // Assume you have a database connection established
                        include('connection.php');

                        // Fetch product information with corresponding category name from the database
                        $query = "SELECT p.pro_id,p.pro_name,p.man_date,p.exp_date,p.pro_price,c.cat_name,p.pro_unit,qty,p.pro_desc,p.pro_imag,p.stock
                                FROM tbl_product p
                                JOIN tbl_category c ON p.cat_id = c.cat_id";
                        $result = mysqli_query($conn, $query);

                        // Check for errors in the query
                        if (!$result) {
                            die("Database query failed: " . mysqli_error($conn));
                        }

                        // Iterate over the fetched products and display them
                        while ($row = mysqli_fetch_assoc($result)) {?>
                           <div class="col-lg-4 col-sm-4">
                              <div class="box_main">
                                 <h4 class="shirt_text"><?php echo $row['pro_name'];?></h4>
                                 <p class="price_text">Price <span style="color: #262626;">₹ <?php echo $row['pro_price'];?></span></p>
                                 <div class="tshirt_img"><img src="./imgs/<?php echo $row['pro_imag'];?>"></div>
                                 <div class="btn_main">
                                    <div class="buy_bt"><a href="buynow.php?id=<?php echo $row['pro_id'];?>">Buy Now</a></div>
                                    <div class="seemore_bt"><a href="ProductPage1.php?productId=<?php echo $row['pro_id'];?>">See More</a></div>
                                 </div>
                              </div>
                           </div>
                     <?php }
                     ?>
                  </div>
               </div>
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
