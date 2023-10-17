<?php
include("header.php");
if (isset($_GET['productid'])) {
	$productid = $_GET['productid'];
	$query = $pdo->prepare("select * from products where id=:id");
	$query->bindParam('id', $productid);
	$query->execute();
	$product = $query->fetch(PDO::FETCH_ASSOC);
}

			$product_id = $_GET['productid'];
			$query = $pdo->prepare("SELECT COUNT(*) AS review_count FROM reviews WHERE p_id = :product_id");
			$query->bindParam(':product_id', $product_id);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);

			$review_count = $result['review_count'];


?>



<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-6 ">
				<div id="product-main-img">
					<div class="product-preview">
						<img src="../adminpanel/img/<?php echo $product['image'] ?>" alt="">
					</div>
				</div>
			</div>
			<!-- /Product main img -->


			<!-- Product details -->
			<div class="col-md-6">
				<div class="product-details">
					<h2 style="margin-top: 20px;" class="product-name"><?php echo $product['name'] ?></h2>
					<div>
						<div class="product-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o"></i>
						</div>
						<a class="review-link" href="#"><?php echo $review_count ?> Reviews</a>
					</div>
					<div>
						<h3 class="product-price"><?php echo $product['price'] ?></h3>
						<span class="product-available">In Stock</span>
					</div>
					<p><?php echo $product['s_disc'] ?></p>

					<div class="product-options">
						color:
						<?php echo $product['color'] ?>
						<br>
						storage:<?php echo $product['storage'] ?>
					</div>

					<div class="add-to-cart">
						<!-- Add to Cart Form -->
						<form action="cart.php" class="cart clearfix mb-50 d-flex" method="post">

							<input type="hidden" name="id" value="<?php echo $product['id'] ?>">
							<input type="hidden" name="name" value="<?php echo $product['name'] ?>">
							<input type="hidden" name="color" value="<?php echo $product['color'] ?>">
							<input type="hidden" name="storage" value="<?php echo $product['storage'] ?>">
							<input type="hidden" name="type" value="<?php echo $product['type'] ?>">
							<input type="hidden" name="price" value="<?php echo $product['price'] ?>">
							<input type="hidden" name="image" value="<?php echo $product['image'] ?>">

							<br>
                            
							<div style="margin-bottom: 20px;" class="col-md-12 ">
								<div class="qty-label ">
									Qty
									<div class="input-number">
										<input type="number" name="qty" value="1">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<button style="width: 100%; margin-top: 10px;" type="submit" name="addtocart" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
							<div class="col-md-6">
								<a href="wishlist.php"><button style="width: 100%; margin-top: 10px;" type="submit" name="wishlist" class="add-to-cart-btn"><i class="fa fa-heart-o"></i> add to wishlist</button></a>
							</div>

							<!-- 
								<ul class="product-btns">
								<li style="margin-top: 20px;" class="btn" type="submit" name="wishlist"> <i class="fa fa-heart-o"></i> add to wishlist</li>
							</ul> -->

						</form>
						<div class="whatsapp-button">
							<p>For MOre Details</p>
							<a href="https://api.whatsapp.com/send?phone=923278221323" target="_blank">

								<button>WhatsApp</button>
							</a>
						</div>

					</div>


					<ul class="product-links">
						<li>Share:</li>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-envelope"></i></a></li>
					</ul>
				</div>
			</div>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
						<li><a data-toggle="tab" href="#tab3">Reviews <?php echo $review_count ?></a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p><?php echo $product['l_disc'] ?></p>
								</div>
							</div>
						</div>
						<!-- /tab1  -->


						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">


								<!-- Reviews -->
								<div class="col-md-9">
									<div id="reviews">
										<ul class="reviews">
											<?php
											$query = $pdo->prepare("select * from reviews where p_id = :p_id");
											$query->bindParam('p_id', $_GET['productid']);
											$query->execute();
											$review = $query->fetchAll(PDO::FETCH_ASSOC);

											if (empty($review)) {
											?>
												<li>
													<p>
													<p style="margin: 10px; text-align:center">No reviews</p>
													</p>
												</li>
											<?php
											}
											foreach ($review as $rev) {

											?>
												<li>
													<div class="review-heading">
														<h5 class="name"><?php echo $rev['name'] ?></h5>
														<p class="date"><?php echo $rev['date'] ?></p>
													</div>
													<div class="review-body">
														<p><?php echo $rev['review'] ?></p>
													</div>
												</li>
											<?php

											}

											?>
										</ul>
									</div>
								</div>


								<!-- /Reviews -->

								<!-- Review Form -->
								<div class="col-md-3">
									<div id="review-form">
										<form class="review-form" method="post">
											<textarea class="input" placeholder="Your Review About This Product" name="review"></textarea>
											<button class="primary-btn" type="submit" name="add_rev">Submit</button>
										</form>
									</div>
								</div>
								<!-- /Review Form -->
							</div>
						</div>
						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="sectio">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<h3 class="title">Related Products</h3>
		<div class="row">

			<?php
			$query = $pdo->prepare("select * from products");
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $product) {
			?>
				<div class="col-md-4 col-xs-6">

					<!-- product -->
					<div class="product">
						<div class="product-img">
							<img src="../adminpanel/img/<?php echo $product['image'] ?>" alt="">
							<div class="product-label">
								<span class="sale">-30%</span>
								<span class="new">NEW</span>
							</div>
						</div>
						<div class="product-body">
							<p class="product-category">Category</p>
							<h3 class="product-name"><a href="#"><?php echo $product['name'] ?></a></h3>
							<h4 class="product-price"><?php echo $product['price'] ?> <del class="product-old-price">$990.00</del></h4>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>

						</div>
						<div class="add-to-cart">
							<a href="product_detail.php?productid=<?php echo $product['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
						</div>
					</div>
					<!-- /product -->
				</div>

			<?php
			}

			?>


		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->


</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /Section -->
<?php
include("footer.php");
?>