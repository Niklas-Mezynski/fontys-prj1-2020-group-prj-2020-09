<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/playlist-overview.css">
</head>

<body>

	<main>
		<header>
			<div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
			<div id="profileButton"><a href="profile.php">User Profile</a></div>
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
					<li><a href="home.html">Logout</a></li>
				</ul>
			</nav><!-- end of nav -->
		</aside>

		<article>
			<h2>Playlist Overview</h2>
			<div class="grid-container">
				<?php
				include_once("dbconnection.php");
				$stmt = $conn->prepare("select playlist_id, name from playlist where user_id = :user_id");
				$stmt->bindParam(":user_id", $_SESSION["user_id"]);
				$stmt->execute();
				
				foreach ($stmt as $row) {
					$playlist_id = $row["playlist_id"];
					$res = $conn->query("select count(song_id) AS counter from song_playlist where playlist_id = $playlist_id ");
					$columm = $res->fetchColumn(0);
					$song_amount = (int) $columm["counter"];
					echo '<div class="grid-item">
					<div class="card">
						<img src="../img/playlistcover-placeholder.jpg" alt="albumcover" style="width:100%">
						<div class="container">
						  <h4><b>' . $row["name"] . '</b></h4>
						  <p>' . $song_amount . ' Songs</p>
						</div>
					  </div>
                </div>';
				}
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