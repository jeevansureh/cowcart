<?php
include('admindash.php');
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_id = $_POST['ids'];
    $service_id = $_POST['location'];
    
    // Check if a row with the specified s_id exists
    $sql_check = "SELECT * FROM tbl_staffservicearea WHERE s_id='$s_id'";
    $result_check = mysqli_query($conn, $sql_check);
    
    if ($result_check->num_rows > 0) {
        // If a row exists, update it
        $sql_update = "UPDATE tbl_staffservicearea SET service_id='$service_id' WHERE s_id='$s_id'";
        $result_update = mysqli_query($conn, $sql_update);
        
        if (!$result_update) {
            die("Update query failed: " . mysqli_error($conn));
        }
    } else {
        // If no row exists, insert a new one
        $sql_insert = "INSERT INTO tbl_staffservicearea (service_id, s_id) VALUES ('$service_id','$s_id')";
        $result_insert = mysqli_query($conn, $sql_insert);
        
        if (!$result_insert) {
            die("Insert query failed: " . mysqli_error($conn));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="CSS/admin.css" />
    <link href="{% static 'css/bootstrap.min.css" rel="stylesheet' %}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>
<main class="main">
    <h1 class="text-center">Staff Information</h1><br>
    <table class="table table-light table-striped" style="opacity: 0.8;">
        <thead>
            <tr>
                <th>FullName</th>
                <th>PhoneNumber</th>
                <th>Email</th>
                <th>Location</th>
                <th>Change Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT s.*, sa.location AS staff_location
                    FROM tbl_staff s
                    LEFT JOIN tbl_staffservicearea ssa ON s.s_id = ssa.s_id 
                    LEFT JOIN tbl_servicearea sa ON ssa.service_id = sa.service_id
                    WHERE s.status = 1";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['s_name']; ?></td>
                    <td><?php echo $row['s_mobile']; ?></td>
                    <td><?php echo $row['s_email']; ?></td>
                    <td><?php echo $row['staff_location']; ?></td>
                    <td>
                        <form method="POST" action="staffservicearea.php">
                            <input type="hidden" name="ids" value="<?php echo $row['s_id']; ?>">
                            <select name="location">
                                <?php
                                $sql = "SELECT * FROM tbl_servicearea";
                                $serviceResult = mysqli_query($conn, $sql);
                                while ($serviceRow = mysqli_fetch_array($serviceResult)) {
                                    echo "<option value='" . $serviceRow['service_id'] . "'>" . $serviceRow['location'] . "</option>";
                                }
                                ?>
                            </select>
                            &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;   <input type="submit" value="ASSIGN" class="btn btn-success">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</main>








    <main class="main">
        <h1 class="text-center"></h1><br>
        <table class="table table-light table-striped" style="opacity: 0.8;">
            <thead>
                <tr>
                    <th>FullName</th>
                    <th>PhoneNumber</th>
                    <th>Email</th>
                    
                    <th>Assign Location</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $sql = "SELECT  * from tbl_staff  where s_id NOT IN(select s_id from tbl_staffservicearea) and status=1";
                  $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['s_name']?></td>
                    <td><?php echo $row['s_mobile']?></td>
                                    <td><?php echo $row['s_email']?></td>
                                    
                    <td>
                        <form method="POST" action="staffservicearea.php">
                            <input type="hidden" name="ids" value="<?php echo $row['s_id']; ?>">
                            Assign Location:
                            <select name="location">
                                <?php
                                $sql = "SELECT * FROM tbl_servicearea";
                                $serviceResult = mysqli_query($conn, $sql);
                                while ($serviceRow = mysqli_fetch_array($serviceResult)) {
                                    echo "<option value='" . $serviceRow['service_id'] . "'>" . $serviceRow['location'] . "</option>";
                                }
                                ?>
                            </select>
                            &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;   <input type="submit" value="ASSIGN" class="btn btn-warning">
                            
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>