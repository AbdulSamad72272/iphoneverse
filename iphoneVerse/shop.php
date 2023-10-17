<?php
include("header.php");
$query = $pdo->query("select * from products");
$products = $query->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['categoryid'])) {
	$categoryid = $_GET['categoryid'];

	if ($categoryid == 1) {
?>
		<!-- section title -->
		<div style="margin-top: 10px;" class="container">
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">letest products</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li><a href="?iphone12">Iphone 11</a></li>
							<li><a href="?iphone12pro">Iphone 11 pro</a></li>
							<li><a href="?iphone12promax">Iphone 11 pro max</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /section title -->
	<?php
	} elseif ($categoryid == 2) {
	?>
		<!-- section title -->
		<div style="margin-top: 10px;" class="container">
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">letest products</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li><a href="?iphone12">Iphone 12</a></li>
							<li><a href="?iphone12pro">Iphone 12 pro</a></li>
							<li><a href="?iphone12promax">Iphone 12 pro max</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /section title -->
	<?php
	} elseif ($categoryid == 3) {
	?>
		<!-- section title -->
		<div style="margin-top: 10px;" class="container">
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">letest products</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li><a href="?iphone13">Iphone 13</a></li>
							<li><a href="?iphone13pro">Iphone 13 pro</a></li>
							<li><a href="?iphone13promax">Iphone 13 pro max</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /section title -->
	<?php
	} elseif ($categoryid == 4) {
	?>
		<!-- section title -->
		<div style="margin-top: 10px;" class="container">
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">letest products</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li><a href="?iphone14">Iphone 14</a></li>
							<li><a href="?iphone14plus">Iphone 14 plus</a></li>
							<li><a href="?iphone14pro">Iphone 14 pro</a></li>
							<li><a href="?iphone14promax">Iphone 14 pro max</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /section title -->
	<?php
	} elseif ($categoryid == 5) {
	?>
		<!-- section title -->
		<div style="margin-top: 10px;" class="container">
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">letest products</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li><a href="?iphone15">Iphone 15</a></li>
							<li><a href="?iphone15plus">Iphone 15 plus</a></li>
							<li><a href="?iphone15pro">Iphone 15 pro</a></li>
							<li><a href="?iphone15promax">Iphone 15 pro max</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /section title -->
<?php
	}
}
?>



<!-- SECTION -->
<div class="sectio">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">




			<?php


			if (isset($_GET['categoryid'])) {
				$categoryid = $_GET['categoryid'];

				$query = $pdo->prepare("select * from products where category_id=:id");
				$query->bindParam('id', $categoryid);
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				if (empty($result)) {
					echo "<p>products not available</p>";
				}
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id']?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>

			<?php
				}
			}
			?>







		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->






<?php

if (isset($_GET['iphone11'])) {
	$query = $pdo->query("select * from products where name='iphone 11'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
?>



		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 11</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>

	<?php
	}
} elseif (isset($_GET['iphone11pro'])) {
	$query = $pdo->query("select * from products where name='iphone 11 pro'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 11 pro</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>

	<?php
	}
} elseif (isset($_GET['iphone12promax'])) {
	$query = $pdo->query("select * from products where name='iphone 11 pro max'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 11 pro</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>

	<?php
	}
} elseif (isset($_GET['iphone12'])) {
	$query = $pdo->query("select * from products where name='iphone 12'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 12</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone12pro'])) {
	$query = $pdo->query("select * from products where name='iphone 12 pro'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 12 pro</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone12promax'])) {
	$query = $pdo->query("select * from products where name='iphone 12 pro max'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 12 pro max</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php

	}
} elseif (isset($_GET['iphone13'])) {
	$query = $pdo->query("select * from products where name='iphone 13'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 13</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone13pro'])) {
	$query = $pdo->query("select * from products where name='iphone 13 pro'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 13 pro</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone13promax'])) {
	$query = $pdo->query("select * from products where name='iphone 13 pro max'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 13 pro max</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone14'])) {
	$query = $pdo->query("select * from products where name='iphone 14'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 14</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone14 plus'])) {
	$query = $pdo->query("select * from products where name='iphone 14 plus'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 14 plus</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone14pro'])) {
	$query = $pdo->query("select * from products where name='iphone 14 pro'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 14 pro</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone14promax'])) {
	$query = $pdo->query("select * from products where name='iphone 14 pro max'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 14 pro max</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone15'])) {
	$query = $pdo->query("select * from products where name='iphone 15'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 15</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone15plus'])) {
	$query = $pdo->query("select * from products where name='iphone 15 plus'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 15 plus</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone15pro'])) {
	$query = $pdo->query("select * from products where name='iphone 15 pro'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 15 pro</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
	<?php
	}
} elseif (isset($_GET['iphone15promax'])) {
	$query = $pdo->query("select * from products where name='iphone 15 pro max'");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $products) {
	?>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<h3 class="title">Iphone 15 pro max</h3>
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

							</div>
							<div class="add-to-cart">
								<a href="product_detail.php?productid=<?php echo $products['id'] ?>"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>view product</button></a>
							</div>
						</div>
						<!-- /product -->
					</div>
				</div>
			</div>
		</div>
<?php
	}
}

?>






<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">All products</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<?php
							$query = $pdo->query("select * from category");
							$result = $query->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $category) {

							?>
								<li class="s"><a href="?categoryid=<?php echo  $category['id'] ?>"><?php echo $category['name'] ?></a></li>
							<?php
							}
							?>
						</ul>


					</div>
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



<!-- store bottom filter -->
<div class="store-filter clearfix">
	<span class="store-qty">Showing 20-100 products</span>
	<ul class="store-pagination">
		<li class="active">1</li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
	</ul>
</div>
<!-- /store bottom filter -->
</div>
<!-- /STORE -->
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->

<?php
include("footer.php");
?>