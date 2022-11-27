<!DOCTYPE HTML>
<html>
<head>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Create order</h1>
        </div>
 
        <?php
if($_POST){
 
    // include database connection
    include '../config/database1.php';
 
    try{
 
        // insert query
        $query = "INSERT INTO orders SET product_id=:product_id, quantity=:quantity, user_id=:user_id, created=:created";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // posted values
        $product_id=htmlspecialchars(strip_tags($_POST['product_id']));
        $quantity=htmlspecialchars(strip_tags($_POST['quantity']));
        $user_id=htmlspecialchars(strip_tags($_POST['user_id']));
 
        // bind the parameters
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':user_id', $user_id);
 
        // specify when this record was inserted to the database
        $created=date('Y-m-d H:i:s');
        $stmt->bindParam(':created', $created);
 
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
 
    }
 
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!-- html form here where the product information will be entered -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>product_id</td>
            <td><input type='text' name='product_id' class='form-control' /></td>
        </tr>
        <tr>
            <td>quantity</td>
            <td><textarea name='quantity' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>user_id</td>
            <td><input type='text' name='user_id' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='index_order.php' class='btn btn-danger'>Back to read orders</a>
            </td>
        </tr>
    </table>
</form>
 
    </div> <!-- end .container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>