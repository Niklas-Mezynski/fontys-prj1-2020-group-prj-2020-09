<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/playlist.css">
</head>

<body>

	<main>
		<header>
			<div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
			<div id="profileButton"><a href="profile.html">User Profile</a></div>
		</header><!-- end of header -->

		<aside>
			<p></p>

			<nav id="menu_v">
				<form action="search.php" method="GET">
					<input type="text" name="search" placeholder="Search.." id="searchbar">
				</form>
				<ul>
					<li><a href="home.html">Home</a></li>
					<li><a href="library.html">Library</a></li>
					<li><a href="playlists.html">Playlists</a></li>
					<li><a href="shop.html">Shop</a></li>
					<li><a href="trends.html">Trends</a></li>
					<li><a href="login.html">Logout</a></li>
				</ul>
			</nav><!-- end of nav -->
		</aside>

		<article>

			<?php
			$host = "prj1_postgres";
			$port = "5432";
			$db = "postgres";
			$user = "postgres";
			$pword = "mypassword";
			// Create Data Source Name (DSN)
			$dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pword";
			// Connect to the PostgreSQL database named $dsn
			$conn = new PDO($dsn);
			?>

			<h1>Playlist Example (ID: 3)</h1><br><br>
			<div>
				<ul class="playlist-songs">
				<?php
				// create a statement
				$sqlSelect =
				"SELECT s.title, u.user_name, s.publisher
				FROM song s 
				inner join song_playlist sp 
				on s.song_id = sp.song_id
				inner join users u 
				ON s.artist_id = u.user_id 
				where sp.playlist_id = 3";
				// Execute a statement
				$stmt = $conn->query($sqlSelect);
				// Iterate the table and echo out the tuples
				foreach ($stmt as $row) {
					echo "<li><p>Title: " . $row['title'] . "  |  Artist: " . $row['user_name'] . "  |  Publisher: " . $row['publisher'] . "</p></li>";
				}
				?>
				</ul>
			</div>
		</article>

		<footer>
			<p>
				<a href="termsandconditions.html">Terms and Conditions</a>
			</p>

		</footer><!-- end of footer -->

	</main><!-- end of main-container -->

</body>

</html>