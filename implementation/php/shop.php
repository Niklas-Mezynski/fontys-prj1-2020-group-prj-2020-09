<?php
session_start();
if (!(isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]))) {
	header("Location: home.php");
	session_destroy();
	exit;
}
if ($_SESSION["user_role"] < 1) {
	header("Location: main.php");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Shop</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
	<link rel="stylesheet" href="../css/shopNN.css">
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
					<?php
					if ($_SESSION["user_role"] >= 2) {
						echo '<li><a href="playlists.php">Playlists</a></li>';
					}
					?>
					<!-- <li><a href="playlists.php">Playlists</a></li> -->
					<li><a href="shop.php">Shop</a></li>
					<li><a href="trends.php">Trends</a></li>
					<?php
					if ($_SESSION["user_role"] >= 3) {
						echo '<li><a href="uploadsongs.php">Upload Songs</a></li>';
					}
					?>
					<?php
					if ($_SESSION["user_role"] == 4) {
						echo '<li><a href="admin.php">Admin Panel</a></li>';
					}
					?>
					<li><a href="logout.php">Logout</a></li>

				</ul>
			</nav><!-- end of nav -->
		</aside>

		<?php
		include_once("dbconnection.php");
		?>

		<article>

			<!-- Purchase Subscription -->
			<div class="shop">
				<p class="text">Subscription</p>
				<img src="../img/shopitem-placeholder.jpg" class="image"></p>
				<form action="shop.php" method="POST">
					<input type="submit" name="purchaseSubscription" value="Purchase">
					<?php
					if (isset($_POST["submitCC"])) {
						$userID = $_SESSION["user_id"];

						// Add Credit Card to Database
						$sql = "INSERT INTO credit_card VALUES(" . $_POST["cc_number"] . "," . $_POST["cvc_cvv_code"] . ",'" . $_POST["type_of_card"] . "','" . $_POST["first_name"] . "','" . $_POST["last_name"] . "','" . $_POST["expiration_date"] . "');";
						$stmt = $conn->prepare($sql);
						$stmt->execute();

						// Set Subscription Status to true
						$sql = "UPDATE users SET subscription_status=true WHERE user_id=$userID";
						$stmt = $conn->prepare($sql);
						$stmt->execute();

						echo "<br><p class='successText'>Purchased Subscription</p>";
					}
					?>
				</form>
			</div>

			<!-- Purchase Giftcard -->
			<div class="shop">
				<p class="text">Gift Card</p>
				<img src="../img/shopitem-placeholder.jpg" class="image"></p>
				<form action="shop.php" method="POST">
					<input type="submit" name="purchaseGiftcard" value="Purchase">
					<?php
					//
					?>
				</form>
			</div>

			<?php
			// Create input fields to enter credit card details
			if (isset($_POST["purchaseSubscription"])) {
				echo "<br><h1>Enter Credit Card Information:</h1>";

				echo "<form action='shop.php' method='POST'>";
				echo "<table>";
				echo "<tr><td> CC Number: </td>";
				echo "<td> <input type='text' name='cc_number'></input> </td></tr>";
				echo "<tr><td> CVC/CVV-Code: </td>";
				echo "<td> <input type='text' name='cvc_cvv_code'></input> </td></tr>";
				echo "<tr><td> Type of Card: </td>";
				echo "<td> <input type='text' name='type_of_card'></input> </td></tr>";
				echo "<tr><td> First Name: </td>";
				echo "<td> <input type='text' name='first_name'></input> </td></tr>";
				echo "<tr><td> Last Name: </td>";
				echo "<td> <input type='text' name='last_name'></input> </td></tr>";
				echo "<tr><td> Expiration Date: </td>";
				echo "<td> <input type='date' name='expiration_date'></input> </td></tr>";
				echo "</table>";
				echo "<input type='submit' name='submitCC' value='Submit'>";
				echo "</form>";
			}
			?>
		</article><!-- end of article -->

		<footer>
			<p>
				<a href="../termsandconditions.html">Terms and Conditions</a>
			</p>

		</footer><!-- end of footer -->

	</main><!-- end of main-container -->

</body>

</html>