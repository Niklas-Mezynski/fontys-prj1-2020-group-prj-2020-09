<?php session_start();
if (!isset($_SESSION["user_name"])) {
		header("Location:../login.php");
		die("Please login");
} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Library</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/css/main.css"><!-- link to stylesheet -->
</head>

<body>
 <?php
		 include_once ("dbconnection.php");
		// create the table - just for testing the connection
		$stmt = $conn->prepare("Select album.title AS aTitle, album.album_id AS albumid, users.user_name AS uName from album join users on album.artist_id = users.user_id");
		$stmt->execute();
?>
	<main>
	<header>
			<a href="main.php"><div id="logo"><img id="logo" src="/img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div></a>
			<div id="profileButton"><a href="profile.php">User Profile</a></div>
			<?php 
				if(isset($_SESSION['user_name'])) {
				echo "<div id='profileButton'><br> Username: " .$_SESSION['user_name'] . "</div>";
				}
			?>
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

		<article>
            <p></p>
			<div class="grid-container">
			<?php 
			foreach ($stmt as $row)
			{
				echo "<div class='grid-item'>";
				echo "<a href='album.php?albumid=" .$row["albumid"] . "'>";
				echo "<div class='card'>";		
				echo "<img src='../img/albumcover-placeholder.jpg' alt='albumcover' style='width:100%'></a>";
				echo "<div class='container'>";
				echo "<h4><b>" . $row["atitle"] . "</b></h4>";
				echo "<p>" .$row["uname"] ."</p>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
			}
			?>  
			  </div>
		</article><!-- end of article -->

		<footer>
			<p>
				<a href="termsandconditions.php">Terms and Conditions</a>
			</p>

		</footer><!-- end of footer -->

	</main><!-- end of main-container -->

</body>

</html>
