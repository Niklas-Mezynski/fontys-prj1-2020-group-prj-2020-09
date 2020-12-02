<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
	<link rel="stylesheet" href="../css/shopN.css">
</head>

<body>

	<main>
		<header>
			<div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
			<div id="profileButton"><a href="profile.php">User Profile</a></div>
			<div id="title">
				<p>Songify</p>
			</div>
		</header><!-- end of header -->

		<aside>
			<nav id="menu_v">
				<form action="search.php" method="POST">
					<input type="text" name="search" placeholder="Search.." id="searchbar">
				</form>
				<ul>
					<li><a href="main.php">Home</a></li>
					<li><a href="library.php">Library</a></li>
					<li><a href="playlists.php">Playlists</a></li>
					<li><a href="shop.php">Shop</a></li>
					<li><a href="trends.php">Trends</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav><!-- end of nav -->
		</aside>

		<?php
		include_once("dbconnection.php");
		?>

		<article>
			<div class="shop">
				<p class="text">Subscription</p>
				<img src="../img/shopitem-placeholder.jpg" class="image"></p>
				<form action="shop.php" method="POST">
					<input type="submit" name="purchaseSubscription" value="Purchase">
					<?php
						if (isset($_POST["purchaseSubscription"])) {
							echo "<br><p class='successText'>Bought Subscription</p>";
						}
					?>
				</form>
			</div>
			<div class="shop">
				<p class="text">Gift Card</p>
				<img src="../img/shopitem-placeholder.jpg" class="image"></p>
				<form action="shop.php" method="POST">
					<input type="submit" name="purchaseGiftcard" value="Purchase">
					<?php
						if (isset($_POST["purchaseGiftcard"])) {
							echo "<br><p class='successText'>Bought Giftcard</p>";
						}
					?>
				</form>
			</div>
		</article><!-- end of article -->

		<footer>
			<p>
				<a href="../termsandconditions.html">Terms and Conditions</a>
			</p>

		</footer><!-- end of footer -->

	</main><!-- end of main-container -->

</body>

</html>