<?php
ob_start();
include("header.php");
if(empty($_POST['search_query'])){
	header("location:index.php");
}
// Include database connection and start a session if needed
if (isset($_POST['search'])) {
    if (isset($_POST['search_query'])) { // Check if 'search_query' is set
        $searchQuery = $_POST['search_query'];

        // You should use prepared statements to prevent SQL injection
        $query = $pdo->prepare("SELECT * FROM products WHERE name LIKE :searchQuery");
        $query->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            foreach ($results as $products) {
?>
			<div class="col-md-4 col-xs-6">

				<!-- product -->
				<div class="product">
					<div class="product-img">
						<img src="../adminpanel/img/<?php echo $products['image'] ?>" alt="">
						<div class="product-label">
							<span class="sale">-30%</span>
							<span class="new">NEW</span>
						</div>
					</div>
					<div class="product-body">
						<p class="product-category">Category</p>
						<h3 class="product-name"><a href="#"><?php echo $products['name'] ?></a></h3>
						<h4 class="product-price"><?php echo $products['price'] ?> <del class="product-old-price">$990.00</del></h4>
						<div class="product-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<div class="product-btns">
							<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
							<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
							<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
						</div>
					</div>
					<div class="add-to-cart">
						<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
					</div>
				</div>
				<!-- /product -->
			</div>

			</div>
<?php }
        } else {
			?>
            <p class="text-center">No product found.</p>
			<?php
        }
    } else {
        echo "No search query provided.";
    }
}
?>


<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">letest products</h3>
				</div>
			</div>
			<!-- /section title -->
			<?php
			$query = $pdo->query("select * from products");
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $products) {
			?>
				<div class="col-md-4 col-xs-6">

					<!-- product -->
					<div class="product">
						<div class="product-img">
							<img src="../adminpanel/img/<?php echo $products['image'] ?>" alt="">
							<div class="product-label">
								<span class="sale">-30%</span>
								<span class="new">NEW</span>
							</div>
						</div>
						<div class="product-body">
							<p class="product-category">Category</p>
							<h3 class="product-name"><a href="#"><?php echo $products['name'] ?></a></h3>
							<h4 class="product-price"><?php echo $products['price'] ?> <del class="product-old-price">$990.00</del></h4>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
							<div class="product-btns">
								<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
								<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
								<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
							</div>
						</div>
						<div class="add-to-cart">
							<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
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

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="hot-deal">
					<ul class="hot-deal-countdown">
						<li>
							<div>
								<h3>02</h3>
								<span>Days</span>
							</div>
						</li>
						<li>
							<div>
								<h3>10</h3>
								<span>Hours</span>
							</div>
						</li>
						<li>
							<div>
								<h3>34</h3>
								<span>Mins</span>
							</div>
						</li>
						<li>
							<div>
								<h3>60</h3>
								<span>Secs</span>
							</div>
						</li>
					</ul>
					<h2 class="text-uppercase">hot deal this week</h2>
					<p>New Collection Up to 50% OFF</p>
					<a class="primary-btn cta-btn" href="#">Shop now</a>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Top selling</h3>
					
				</div>
			</div>
			<!-- /section title -->
			<?php
			$query = $pdo->query("select * from products");
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $products) {
			?>
				<div class="col-md-4 col-xs-6">

					<!-- product -->
					<div class="product">
						<div class="product-img">
							<img src="../adminpanel/img/<?php echo $products['image'] ?>" alt="">
							<div class="product-label">
								<span class="sale">-30%</span>
								<span class="new">NEW</span>
							</div>
						</div>
						<div class="product-body">
							<p class="product-category">Category</p>
							<h3 class="product-name"><a href="#"><?php echo $products['name'] ?></a></h3>
							<h4 class="product-price"><?php echo $products['price'] ?> <del class="product-old-price">$990.00</del></h4>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
							<div class="product-btns">
								<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
								<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
								<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
							</div>
						</div>
						<div class="add-to-cart">
							<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
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



<!-- NEWSLETTER -->
<div id="newsletter" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="newsletter">
					<p>Sign Up for the <strong>NEWSLETTER</strong></p>
					<form>
						<input class="input" type="email" placeholder="Enter Your Email">
						<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
					</form>
					<ul class="newsletter-follow">
						<li>
							<a href="#"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-instagram"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-pinterest"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /NEWSLETTER -->

<?php
include("footer.php");
?>