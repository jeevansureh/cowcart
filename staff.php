<?php include_once('connection.php');
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $sql="update tbl_staff set status=1 where s_id='".$id."'";
  $result=mysqli_query($conn,$sql);
}
?>
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
<a class="fa fa-plus-circle" href="addstaff.php">Approve</a>
</button>
    <table class="table table-striped" style="margin-top:50px;margin-left:50px;">
  <thead>
    <tr>
     <th></th>
      <th scope="col">StaffID</th>
      <th scope="col">StaffName</th>
      <th scope="col">Staffmobile</th> 
      <th scope="col">Staffemail</th>
     
    </tr>
  </thead>
  <tbody>
    <?php 
    $sql="select * from tbl_staff where status=1";
    $result=mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <tr>
                     <th scope="row"></th>
                    <td><?php echo  $row['s_id'];?> </td>
                    <td><?php echo  $row['s_name'];?> </td>
                    <td><?php echo  $row['s_mobile'];?> </td>
                    <td><?php echo  $row['s_email'];?> </td>
                    <td>
                                        <form method="POST" action="deletestaff.php">
                                        <input type="hidden" name="ids" value="<?php echo $row['s_id'];?>">
                                        
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








