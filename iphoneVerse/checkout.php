<?php
ob_start();
include("header.php");
if(!isset($_SESSION['id'])){
	$_SESSION['back_to_checkout_url'] = $_SERVER['REQUEST_URI'];
	echo "<script>alert('You have to login first'); location.assign('signin.php');</script>";
}else{
?>

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Checkout</h3>
				<ul class="breadcrumb-tree">
					<li><a href="#">Home</a></li>
					<li class="active">Checkout</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-7">
				<!-- Billing Details -->
				<div class="billing-details">
					<div class="section-title">
						<h3 class="title">Billing address</h3>
					</div>
					<form action="" method="post">
					<div class="form-group">
						<input class="input" type="text" name="first_name" placeholder="First Name" required>
					</div>
					<div class="form-group">
						<input class="input" type="text" name="last_name" placeholder="Last Name" required>
					</div>
					<div class="form-group">
						<input class="input" type="email" name="email" placeholder="Email" required>
					</div>
					<div class="form-group">
						<input class="input" type="text" name="address" placeholder="Address" required>
					</div>
					<div class="form-group">
						<input class="input" type="text" name="city" placeholder="City" required>
					</div>
					
					<div class="form-group">
						<input class="input" type="text" name="zip-code" placeholder="ZIP-Code" required>
					</div>
					<div class="form-group">
						<input class="input" type="tel" name="mobile" placeholder="mobile" required>
					</div>
				</div>
				<!-- /Billing Details -->


			</div>

			<!-- Order Details -->
			<div class="col-md-5 order-details">
				<div class="section-title text-center">
					<h3 class="title">Your Order</h3>
				</div>

				<table class="table">
					<thead>
						<tr>

							<th scope="col">Name</th>
							<th scope="col">Price</th>
							<th scope="col">Qty</th>
							<th scope="col">Total Price</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sub_total = 0;
						if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
							foreach ($_SESSION['cart'] as $value) {
						?>
								<tr>
									<td><?php echo $value['name'] ?></td>
									<td><?php echo $value['price'] ?></td>
									<td><?php echo $value['qty'] ?></td>
									<td><?php echo $value['price'] * $value['qty'];
										$total = $value['price'] * $value['qty'];
										$sub_total += $total;
										?></td>
								</tr>
							<?php
							}
						} else {
							?>

							<p class="mb-4 mt-5 text-center">Your Cart is Empty</p>;
						<?php
						}
						?>

					</tbody>
					
				</table>
				  <!-- Subtotal, Shipping Fee, and Total sections (as provided in previous messages) -->
				  <div class="cart-summary">
                    <!-- Subtotal, Shipping Fee, and Total sections -->
                    <div class="cart-page-heading">
                        <h5>Final info</h5>
                        
                    </div>
					<?php
					
    if (isset($_SESSION['city']) && $_SESSION['city'] == 'karachi') {
        $fee = 300;
    }else{
        $fee = 600;
    }
					?>
                    <ul class="cart-total-chart">
                        <li><span>Subtotal:</span> <span class="text-right"><?php echo  $sub_total  ?></span></li>
                        <li><span>Shipping:</span> <span class="text-right"><?php echo $fee * $cartcount = count($_SESSION['cart'])?></span></li>
                        <li><span><strong>Total:</strong></span class="text-right"> <span><strong><?php echo  $sub_total + $fee?></strong></span></li>
                    </ul>
                   
                </div>

				<div class="payment-method">
					<div class="input-radio">
						<input type="radio" name="payment" id="payment-1">
						<label for="payment-1">
							<span></span>
							Direct Bank Transfer
						</label>
						<div class="caption">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
				</div>
				<div class="input-checkbox">
					<input type="checkbox" id="terms">
					<label for="terms">
						<span></span>
						I've read and accept the <a href="#">terms & conditions</a>
					</label>
				</div>
				
					<button type="submit" name="order" class="primary-btn order-submit">place order</button>
				
			</div>
			</form>
			<!-- /Order Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<?php
}
include("footer.php");
?>