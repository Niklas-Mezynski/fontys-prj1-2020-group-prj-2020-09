<?php session_start(); // check if User has session, if not redirect to login page
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
	<link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
	<link rel="shortcut icon" href="../img/Logo.png" />
</head>

<body>
 <?php
		 include_once ("dbconnection.php");
		// get album data from table
		$stmt = $conn->prepare("Select album.cover AS aCover, album.title AS aTitle, album.album_id AS albumid, 
		users.user_name AS uName 
		from album join users on album.artist_id = users.user_id");
		$stmt->execute();
?>
	<main>
	<header>
			<div id="logo"><img id="logo" src="/img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
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
					if ($_SESSION["user_role"] >= 2) { //check if user-role = Registered User
						echo '<li><a href="playlists.php">Playlists</a></li>';
					}
					?>
					<li><a href="shop.php">Shop</a></li>
					<li><a href="trends.php">Trends</a></li>
					<?php
					if ($_SESSION["user_role"] >= 3) { //check if user-role = Artist
						echo '<li><a href="uploadsongs.php">Upload Songs</a></li>';
					}
					?>
					<?php
					if ($_SESSION["user_role"] == 4) { //check if user-role = Admin
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
			<?php //create card for each album entry in database
			foreach ($stmt as $row)
			{
				echo "<div class='grid-item'>";
				echo "<a href='album.php?albumid=" .$row["albumid"] . "'>";
				echo "<div class='card'>";		
				if(isset($row['acover'])) {
					echo "<img src='data:image/jpeg;base64," . $row['acover'] . "' id='coverThumb'></p>";
				}
				else echo "<img src='../img/albumcover-placeholder.jpg'></a>";
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
				<a href="termsandconditions.html">Terms and Conditions</a>
			</p>

		</footer><!-- end of footer -->

	</main><!-- end of main-container -->

</body>

</html>
