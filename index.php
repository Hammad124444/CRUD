<?php include'db_connection.php';
?>
<?php include'process.php';?>
<?php
            if(isset($_GET['delete'])){
                $id=0;
                $id = $_GET['delete'];
        
                $query = "DELETE FROM sales1 WHERE id = $id";
                
                $result = mysqli_query($connection,$query);
                
                if(!$result) {
                    die("Query Failed.." . mysqli_error($connection));
                }

            }
            
            
            ?>


            <?php 
//updating the record

$product = ' ';
$price = ' ';

$update = false;

if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    
    $query = "SELECT * FROM sales1 ";
    $query .= "WHERE id = $id";
    
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die("Query Failed. " .  mysqli_error($connection));
    }
    
    $row = mysqli_fetch_assoc($result);
    
    $product = $row['product'];
    $price = $row['price'];
    
    $update = true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>CURD APP</title>
</head>
         <div id="container">
             <div class="col-sm-10 col-sm offset-1">
               
                 <div class="info-form">
                 <form action="process.php" method='post' class="form-inline">
                    <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <label class="sr-only mt-5">Product</label>
                        <input type="text" class="form-control" placeholder="Jane Doe" name='product' required>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Price</label>
                        <input type="text" class="form-control" placeholder="$5" name='price' required>
                    </div>
                    <?php

                  if($update==true){
?>
                    <button type="submit" class="btn btn-danger mt-3 ml-5 " name='update'>Update</button>
  <?php                }
                  else{ ?>
                
                    <button type="submit" class="btn btn-success mt-3 ml-5 " name='save'>submit</button>
                <?php  }
                ?>
                    </form>
                </div>
                
     </div>






<!-- Show data to file index.php-->
<div class="row justify-content-center">
    <div class="col-sm-12 col-md-8">
        <?php 
        
        $query = "SELECT * FROM sales1";

        $result = mysqli_query($connection, $query);

if(!$result) {
    die("Query Failed. " . mysqli_error($connection));
}
        
        ?>
        
        <table class="table table-sm table-hover table-striped mt-5">
            <thead>
                <tr class="table-dark">
                    <th>Product</th>
                    <th>Price($)</th>
                    <th colspan="2">Button</th>
                </tr>
            </thead>
            <?php 
            
            while($row = mysqli_fetch_assoc($result)) {
            
            ?>
            <tr>
                <td><?php echo $row['product']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                    
                    <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
</div>
</body>
</html>