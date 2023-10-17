<?php
include("query.php");

$query = $pdo->query("select * from users");
$profile = $query->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>iphoneVerse</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	<style>
		/* Style the dropdown menu */
		.dropdown {
			position: relative;
			display: inline-block;
		}

		.dropdown-toggle:hover {
			color: #D10024;
			/* Dark red on hover */
		}

		/* Style the dropdown menu items */
		.dropdown-menu {
			display: none;
			position: absolute;
			background-color: black;
			/* Black background color */
			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
			list-style-type: none;
			padding: 0;
			margin: 0;
		}

		.dropdown-menu li {
			padding: 10px 15px;
			color: white;
			/* White text color */
			text-decoration: none;
			display: block;
		}

		.dropdown-menu li:hover {
			background-color: #D10024;
		}

		/* Show the dropdown menu on hover */
		.dropdown:hover .dropdown-menu {
			display: block;
		}

		/* Add a down arrow icon */
		.fa-caret-down {
			margin-left: 5px;
		}

		/* Center the text and icon vertically */
		.dropdown-toggle,
		.dropdown-menu li {
			line-height: 1.5;
			/* Adjust as needed */
		}

		/* Style for the WhatsApp button container */
		.whatsapp-button {
			text-align: center;
			margin-top: 20px;
			/* Adjust as needed */
		}

		/* Style for the WhatsApp button */
		.whatsapp-button a {
			display: block;
			text-decoration: none;
		}

		.whatsapp-button button {
			background-color: #25d366;
			/* WhatsApp green color */
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			width: 100%;
			/* Make the button full width */
		}

		.whatsapp-button button:hover {
			background-color: #128C7E;
			/* Darker shade when hovered */
		}
	</style>
</head>

<body>
	<!-- HEADER -->
	<header>

		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
					<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
					<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
				</ul>
				
				<ul class="header-links pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="fa fa-user-o"></i> My Account <i class="fa fa-caret-down"></i>

						</a>

						<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
							<?php
							$query = $pdo->query("select * from orders");
							$order = $query->fetchAll(PDO::FETCH_ASSOC);

							if (isset($_SESSION['id'])) {
								foreach ($profile as $user) {
									if ($user['id'] == $_SESSION['id']) {
							?>
										<li class="dropdown-item" data-toggle="modal" data-target="#profileModal_<?php echo $user['id'] ?>">Profile</li>
										<li data-toggle="modal" data-target="#resetPasswordModal_<?php echo $user['id'] ?>">Reset password</li>
										<a href="orders.php">
											<li>Your orders</li>
										</a>
										<a href="logout.php">
											<li>Logout</li>
										</a>
								<?php
									}
								}
							
							} else {
								?>
								<a href="signin.php">
									<li>Login</li>
								</a>
							<?php
							}
							?>

						</ul>

					</li>
				</ul>

				</li>
				</ul>
			</div>
		</div>
		<!-- /TOP HEADER -->


		<!-- MAIN HEADER -->
		<div id="header">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- LOGO -->
					<div class="col-md-3">
						<div class="header-logo">
							<a href="#" class="logo">
								<h1 style="color: white; margin:0" >iphoneVerse</h1>
								<p style="color: white; margin:0" class="text-center ">Mobile Store</p>
								<!-- <img src="./img/logo.png" alt=""> -->
							</a>
						</div>
					</div>
					<!-- /LOGO -->

					<!-- SEARCH BAR -->
					<div class="col-md-6">
						<div class="header-search">
							<form action="search.php" method="post">
								<select class="input-select">
									<option value="0">All Categories</option>
									<option value="1">Category 01</option>
									<option value="1">Category 02</option>
								</select>
								<input class="input" name="search_query" placeholder="Search here">
								<button class="search-btn" type="submit" name="search">Search</button>
							</form>


						</div>
					</div>
					<!-- /SEARCH BAR -->

					<?php
					$query = $pdo->prepare("SELECT COUNT(*) AS wishlist_count FROM wishlist WHERE u_id = :u_id");
					$query->bindParam(':u_id', $_SESSION['id']);
					$query->execute();
					$result = $query->fetch(PDO::FETCH_ASSOC);

					$wishlist_count = $result['wishlist_count'];
					?>

					<!-- ACCOUNT -->
					<div class="col-md-3 clearfix">
						<div class="header-ctn">
							<!-- Wishlist -->
							<div>
								<a href="wishlist.php">
									<i class="fa fa-heart-o"></i>
									<span>Your Wishlist</span>
									<div class="qty"><?php echo $wishlist_count ?></div>
								</a>
							</div>
							<!-- /Wishlist -->

							<?php
							$cartcount = 0;
							if (isset($_SESSION['cart'])) {

								$cartcount = count($_SESSION['cart']);
							}
							?>

							<!-- Cart -->
							<div>
								<a href="cart.php">
									<i class="fa fa-shopping-cart"></i>
									<span>Your Cart</span>
									<div class="qty"><?php echo $cartcount ?></div>
								</a>
							</div>
							<!-- /Cart -->

							<!-- Menu Toogle -->
							<div class="menu-toggle">
								<a href="#">
									<i class="fa fa-bars"></i>
									<span>Menu</span>
								</a>
							</div>
							<!-- /Menu Toogle -->
						</div>
					</div>
					<!-- /ACCOUNT -->
				</div>
				<!-- row -->
			</div>
			<!-- container -->
		</div>
		<!-- /MAIN HEADER -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<nav id="navigation">
		<!-- container -->
		<div class="container">
			<!-- responsive-nav -->
			<div id="responsive-nav">
				<!-- NAV -->
				<ul class="main-nav nav navbar-nav">
					<li class="active"><a href="index.php">Home</a></li>
					<li><a href="shop.php">Shop</a></li>
					<li><a href="cart.php">Cart</a></li>
					<li><a href="wishlist.php">Wishlist</a></li>
					<li><a href="#">Contact Us</a></li>
					<?php
					if(isset($_SESSION['id'])){
                     ?>
					 <li><a href="logout.php">Logout</a></li>
					 <?php
					}else{
						?>
						<li><a href="signin.php">Login</a></li>
						<?php
					}
					?>
					

				</ul>
				<!-- /NAV -->
			</div>
			<!-- /responsive-nav -->
		</div>
		<!-- /container -->
	</nav>
	<!-- /NAVIGATION -->


	<!-- Modal -->
	<?php foreach ($profile as $user) { ?>
		<div class="modal fade" id="profileModal_<?php echo $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="profileModalLabel">Edit Profile</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!-- User Profile Image -->
						<div class="text-center">
							<?php
							if (isset($user['image']) && !empty($user['image'])) {
							?>
								<img style="border-radius: 50%;" src="../adminpanel/img/<?php echo $user['image'] ?>" alt="User Profile" class="rounded-circle" width="100" height="100">
							<?php
							} else {
							?>
								<img  style="border-radius: 50%;" src="../adminpanel/img/user.png" alt="Default User Avatar" class="rounded-circle" width="100" height="100">
							<?php
							}
							?>
						</div>

						<!-- Profile Update Form -->
						<form method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" required name="name" value="<?php echo $user['name'] ?>">
							</div>
							<div class="form-group">
								<label for="mobile">Mobile Number</label>
								<input type="tel" class="form-control" id="mobile" required name="mobile" value="<?php echo $user['mobile'] ?>">
							</div>
							<div class="form-group">
								<label for="mobile">City</label>
								<input type="tel" class="form-control" id="mobile" required name="city" value="<?php echo $user['city'] ?>">
							</div>
							<div class="form-group">
								<label for="profilePicture">Profile Picture</label>
								<input type="file" class="form-control-file" required name="image" id="profilePicture">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>

							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	<?php
	} ?>

	<!-- reset pass modal  -->

	<!-- The Modal -->
	<div class="modal fade" id="resetPasswordModal_<?php echo $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<!-- Modal Body -->
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label for="oldPassword">Old Password</label>
							<input type="password" class="form-control" required id="oldpass" name="oldPass" required>
						</div>
						<div class="form-group">
							<label for="newPassword">New Password</label>
							<input type="password" class="form-control" required id="newPass" name="newPass" required>
						</div>
						<div class="form-group">
							<label for="confirmNewPassword">Confirm New Password</label>
							<input type="password" class="form-control" required id="c_newpass" name="c_NewPass" required>
						</div>
						<!-- Modal Footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="reset_pass" class="btn btn-primary">Reset Password</button>
						</div>
				</div>
				</form>
			</div>


		</div>
	</div>