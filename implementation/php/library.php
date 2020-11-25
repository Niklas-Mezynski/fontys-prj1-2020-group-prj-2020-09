<!DOCTYPE html>
<html>

<head>
	<title>Library</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
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
			<div class="column" id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
			<div class="column" id="profileButton"><a href="profile.html">User Profile</a></div>
		</header><!-- end of header -->

		<aside>
			<p></p>

			<nav id="menu_v">
				<form action="search.php" method="GET">
					<input type="text" name="search" placeholder="Search.." id="searchbar">
				</form>
				<ul>
					<li><a href="/home.html">Home</a></li>
					<li><a href="/library.html">Library</a></li>
					<li><a href="/playlists.html">Playlists</a></li>
					<li><a href="/shop.html">Shop</a></li>
					<li><a href="/trends.html">Trends</a></li>
					<li><a href="/home.html">Logout</a></li>
				</ul>
			</nav><!-- end of nav -->
		</aside>

		<article>
            <p>Library</p>
			<div class="grid-container">
			<?php 
			foreach ($stmt as $row)
			{
				echo "<div class='grid-item'>";
				echo "<a href='/php/album.php/?albumid=" .$row["albumid"] . "'>";
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
				<a href="termsandconditions.html">Terms and Conditions</a>
			</p>

		</footer><!-- end of footer -->

	</main><!-- end of main-container -->

</body>

</html>
