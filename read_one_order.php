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
            <h1>Read Order</h1>
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
 
        <!--we have our html table here where the record will be displayed-->
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>product_id</td>
        <td><?php echo htmlspecialchars($product_id, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>quantity</td>
        <td><?php echo htmlspecialchars($quantity, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>user_id</td>
        <td><?php echo htmlspecialchars($user_id, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='index_order.php' class='btn btn-danger'>Back to Read Orders</a>
        </td>
    </tr>
</table>
 
    </div> <!-- end .container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>