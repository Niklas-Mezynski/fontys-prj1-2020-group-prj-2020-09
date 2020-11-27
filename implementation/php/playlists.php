<?php
session_start();
if (!(isset($_SESSION["user_id"]) && isset($_SESSION["user_id"]))) {
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

		<article>
			<h2>Playlist Overview</h2>
			<div class="grid-container">
				<?php
				require("dbconnection.php");
				$stmt = $conn->prepare("select playlist_id, name from playlist where user_id = :user_id");
				$stmt->bindParam(":user_id", $_SESSION["user_id"]);
				$stmt->execute();
				
				foreach ($stmt as $row) {
					$playlist_id = $row["playlist_id"];
					$songs_in_pl = $conn->query("select song_id from song_playlist where playlist_id = $playlist_id ");
					$song_count = $songs_in_pl->rowCount();
					echo '<div class="grid-item">
					<form action="playlist.php" method="post">
					<input type="hidden" metohd="post" value="'.$row["playlist_id"].'">
					<div class="card">
						<img src="../img/playlistcover-placeholder.jpg" alt="albumcover" style="width:100%">
						<div class="container">
						  <h4><b>' . $row["name"] . '</b></h4>
						  <p>' . $song_count . ' Songs</p>
						</div>
					  </div>
					  <input type="submit">
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