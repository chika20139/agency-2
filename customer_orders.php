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
            <h1>Put Your Informations</h1>
        </div>
 
        <?php
if($_POST){
 
    // include database connection
    include '../config/database1.php';
 
    try{
 
        // insert query
        $query = "INSERT INTO customer_orders SET username=:username, address=:address, number=:number, created=:created";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // posted values
        $username=htmlspecialchars(strip_tags($_POST['username']));
        $address=htmlspecialchars(strip_tags($_POST['address']));
        $number=htmlspecialchars(strip_tags($_POST['number']));
 
        // bind the parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':number', $number);
 
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
<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  id="inscription">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>username</td>
            <td><input type='text' name='username'  id="username" class='form-control' /></td>
        </tr>
        <tr>
            <td>address</td>
            <td><textarea name='address' id="address" class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>number</td>
            <td><input type='text' name='number' id="number" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='checkout.php' class='btn btn-danger'>Confirm</a>
            </td>
        </tr>
    </table>
</form>
<p style="color: red" id="erreur"></p>
 
    </div> <!-- end .container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    document.getElementById('inscription').addEventListener('submit',function(e){
    var erreur;
    var username=document.getElementById('username');
    var address=document.getElementById('address');
    var number=document.getElementById('number');
    if(!username.value){
        erreur="write your username";
    }
   else if(!address.value){
        erreur="write your address";
    }
   else if(!number.value){
        erreur="write your number";
    }
    if(erreur){
        e.preventDefault();
        document.getElementById('erreur').innerHTML=erreur;
    }
});
</script>
 
</body>
</html>