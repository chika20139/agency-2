<!DOCTYPE HTML>
<html>
<head>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Read Cart Items</h1>
        </div>
 
        <?php
// include database connection
include '../config/database1.php';
 
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
 
// select all data
$query = "SELECT id, product_id, quantity, user_id FROM cart_items ORDER BY id DESC";
$stmt = $con->prepare($query);
$stmt->execute();
 
// this is how to get number of rows returned
$num = $stmt->rowCount();
 
// link to create record form
echo "<a href='create.php' class='btn btn-primary m-b-1em'>Create New Cart Item</a>";
 
//check if more than 0 record found
if($num>0){
 
    //start table
echo "<table class='table table-hover table-responsive table-bordered'>";
 
//creating our table heading
echo "<tr>
    <th>id</th>
    <th>product_id</th>
    <th>quantity</th>
    <th>user_id</th>
</tr>";

// retrieve our table contents
// fetch() is faster than fetchAll()
// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['firstname'] to
    // just $firstname only
    extract($row);
 
    // creating new table row per record
    echo "<tr>
        <td>{$id}</td>
        <td>{$product_id}</td>
        <td>{$quantity}</td>
        <td>{$user_id}</td>
        <td>";
            // read one record
            echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";
 
            // we will use this links on next part of this post
            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
 
            // we will use this links on next part of this post
            echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
        echo "</td>";
    echo "</tr>";
}

// end table
echo "</table>";
 
}
 
// if no records found
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>
 
    </div> <!-- end .container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<script type='text/javascript'>
// confirm record deletion
function delete_user( id ){
 
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok,
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    }
}
</script>
<p>Translate this page in your preferred language:</p>
      
      <div id="google_translate_element"></div> 
        
      <script type="text/javascript"> 
      function googleTranslateElementInit() { 
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element'); 
      } 
      </script> 
        
      <script type="text/javascript"
   src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> 
        
      <p>Vous pouvez traduire le contenu de cette page en sélectionnant une
   langue dans le menu déroulant.</p>
</body>
</html>