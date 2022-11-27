<?php
// connect to database
include '../config/database.php';
 
// include objects
include_once "objects/product.php";
include_once "objects/product_image.php";
include_once "objects/cart_item.php";
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$product_image = new ProductImage($db);
$cart_item = new CartItem($db);
$page_title="orders";
include 'layout_head.php';
?>
<!DOCTYPE html>
<html>
<body>
	<div class="container-fluid">
	
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<h1>Customer Order details</h1>
						<hr/>
						<?php
							include '../config/database1.php';
                            include_once "objects/product.php";
                            include_once "objects/product_image.php";
                            include_once "objects/cart_item.php";
							$orders_list = "SELECT ci.id, ci.product_id, ci.quantity, ci.user_id,p.name FROM cart_items ci,products p  where p.id=ci.product_id  ";
							$stmt = $con->prepare($orders_list);
                            $stmt->execute();
                            $num = $stmt->rowCount();
							if($num>0) {
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);
									?>
										<div class="row">
											<div class="col-md-6">
												<table>
													<tr><td>Product Name</td><td><b><?php echo $row["name"]; ?></b> </td></tr>
													<tr><td>Product Id</td><td><b><?php echo  $row["product_id"]; ?></b></td></tr>
													<tr><td>Quantity</td><td><b><?php echo $row["quantity"]; ?></b></td></tr>
													<tr><td>User Id</td><td><b><?php echo $row["user_id"]; ?></b></td></tr>
												</table>
											</div>
										</div>
									<?php
								}
							}
						?>
						
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
<?php
include 'layout_foot.php';
?>