<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
</head>

<body>

	<main>
		<header>
			<div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
			<div id="profileButton"><a href="profile.php">User Profile</a></div>
			<div id="title"><p>Songify</p></div>
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

	<article>
		<?php
		require("dbconnection.php");
		$stmt = $conn->prepare("select user_name from users where user_id = :user_id");
		$stmt->bindParam(":user_id",$_SESSION["user_id"]);
		$stmt->execute();
		$row = $stmt->fetch();
		echo "<h1>Hallo ". $row["user_name"] ."!";
		?>
	
	</article><!-- end of article -->

		<footer>
			<p>
				<a href="termsandconditions.html">Terms and Conditions</a>
			</p>

		</footer><!-- end of footer -->

	</main><!-- end of main-container -->

</body>

</html>
