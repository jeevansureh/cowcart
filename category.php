<?php include_once('connection.php');?>
<!DOCTYPE html>
<!-- YouTube or Website - CodingLab -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>adminpage</title>
    <link rel="stylesheet" href="css/admindash.css" />
    <!-- Fontawesome CDN Link -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
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

    <main class="container">
    <button class="btn btn-lg" style="background-color:transparent;float: right;">
<a class="fa fa-plus-circle" href="addcategory.php">Add</a>
</button>
    <table class="table table-striped" style="margin-top:50px;margin-left:50px;">
  <thead>
    <tr>
     <th></th>
      <th scope="col">CategoryID</th>
      <th scope="col">CategoryName</th>
      <th scope="col">CategoryImage</th>
     
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql="select * from tbl_category";
    $result=mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <tr>
                     <th scope="row"></th>
                    <td><?php echo  $row['cat_id'];?> </td>
                    <td><?php echo  $row['cat_name'];?> </td>
                    <td><img src="./imgs/<?php echo $row['cat_img']; ?>" class="card-img-top img-fluid card-img"style="width:50px;height:50px;"></td>
                    <td>
                                        <form method="POST" action="deletecategory.php">
                                        <input type="hidden" name="ids" value="<?php echo $row['cat_id'];?>">
                                        
                                        <input type="submit" name="id" value="Delete">
                                        </form>
                                        </td>
      
     
    </tr>
                       <?php
                    }
                    
                ?>
    
  </tbody>
</table>

    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="javascript/admindash.js"></script>
  </body>
</html>








