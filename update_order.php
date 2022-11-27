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
            <h1>Update order</h1>
        </div>
 
        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$order_id=isset($_GET['order_id']) ? $_GET['order_id'] : die('ERROR: Record ID not found.');
 
//include database connection
include '../config/database1.php';
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT order_id, product_id, quantity, user_id FROM orders WHERE order_id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $order_id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $user_id = $row['user_id'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
 <?php
 
 // check if form was submitted
 if($_POST){
  
     try{
  
         // write update query
         // in this case, it seemed like we have so many fields to pass and
         // it is better to label them and not use question marks
         $query = "UPDATE orders
                     SET product_id=:product_id, quantity=:quantity, user_id=:user_id
                     WHERE order_id = :order_id";
  
         // prepare query for excecution
         $stmt = $con->prepare($query);
  
         // posted values
         $product_id=htmlspecialchars(strip_tags($_POST['product_id']));
         $quantity=htmlspecialchars(strip_tags($_POST['quantity']));
         $user_id=htmlspecialchars(strip_tags($_POST['user_id']));
  
         // bind the parameters
         $stmt->bindParam(':product_id', $product_id);
         $stmt->bindParam(':quantity', $quantity);
         $stmt->bindParam(':user_id', $user_id);
         $stmt->bindParam(':order_id', $order_id);
  
         // Execute the query
         if($stmt->execute()){
             echo "<div class='alert alert-success'>Record was updated.</div>";
         }else{
             echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
         }
  
     }
  
     // show errors
     catch(PDOException $exception){
         die('ERROR: ' . $exception->getMessage());
     }
 }
 ?>
 
<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?order_id={$order_id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>product_id</td>
            <td><input type='text' name='product_id' value="<?php echo htmlspecialchars($product_id, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>quantity</td>
            <td><textarea name='quantity' class='form-control'><?php echo htmlspecialchars($quantity, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td>user_id</td>
            <td><input type='text' name='user_id' value="<?php echo htmlspecialchars($user_id, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='index_order.php' class='btn btn-danger'>Back to read Orders</a>
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