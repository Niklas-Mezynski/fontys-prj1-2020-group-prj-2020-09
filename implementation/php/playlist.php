<?php
session_start();
if (!(isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]))) {
	header("Location: home.php");
	session_destroy();
	exit;
}
if ($_SESSION["user_role"] < 2) {
	header("Location: main.php");
	exit;
}
if (!isset($_GET["id"])) {
	header("Location: main.php");
	exit;
}
require("dbconnection.php");
$playlist_id = htmlspecialchars($_GET["id"]);
$stmtPlInformation = $conn->query('SELECT * FROM playlist where playlist_id = ' . $playlist_id);
$plInformation = $stmtPlInformation->fetch();
$plName = $plInformation["name"];
if ($plInformation["public"] != 1 && !($plInformation["user_id"] == $_SESSION["user_id"])) {
	header("Location: main.php");
	exit;
}

// Checking if a song was added with post and inserting it to the playlist
if (isset($_POST["submit"])) {
	//checking that the song is not in the playlist yet
	$check = $conn->query("SELECT song_already_in_pl(" . $_POST['playlist_id'] . "," . $_POST['song_id'] . ")");
	$song_already_in_playlist = $check->fetch();

	if ($song_already_in_playlist["song_already_in_pl"] == false) {
		$inserststmt = $conn->prepare("INSERT INTO song_playlist (playlist_id, song_id) VALUES(:playlist_id, :song_id)");
		$inserststmt->bindParam(":playlist_id", $_POST["playlist_id"], PDO::PARAM_INT);
		$inserststmt->bindParam(":song_id", $_POST["song_id"], PDO::PARAM_INT);
		$inserststmt->execute();
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Playlists</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/playlist.css">
</head>

<body>

	<main>
		<header>
			<a href="main.php"><div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div></a>
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
			<?php
			$stmt = $conn->prepare("SELECT s.title, u.user_name AS sartist, a.title AS album, s.listens, s.song_path
				FROM song s
				inner join song_playlist sp 
				on s.song_id = sp.song_id
				inner join users u
				ON s.artist_id = u.user_id
				inner join album a
				on s.album_id = a.album_id 
				where sp.playlist_id = :playlist_id");
			$stmt->bindParam(":playlist_id", $playlist_id, PDO::PARAM_INT);
			$stmt->execute();
			?>

			<h1><?php echo $plName; ?></h1><br>
			<form action="search.php" method="post">
				<input type="hidden" name="playlist_id" value=<?php echo $playlist_id; ?>>
				<input id="add" type="submit" name="plsubmit" value="Add Song to playlist">
			</form>
			<!--<a href="search.php"><button id="add">Add songs</button></a><br>-->

			<table id="songlist">
				<tr id="header">
					<th>Name</th>
					<th>Artists</th>
					<th>Album</th>
					<th>Play</th>
				</tr>
				<?php
				$stmt->execute();
				foreach ($stmt as $row) {
					echo "<tr id='song'>";
					echo "<td>" . $row['title'] . "</td>";
					echo "<td>" . $row['sartist'] . "</td>";
					echo "<td>" . $row['album'] . "</td>";
					echo "<td>
              <audio controls controlsList='nodownload'>
                <source src='" . $row['song_path'] . "' type='audio/mpeg'>
                Your browser does not support the audio element.
              </audio>
            </td>";
					echo "</tr>";
				} ?>
			</table>

		</article>

		<footer>
			<p>
				<a href="termsandconditions.php">Terms and Conditions</a>
			</p>

		</footer><!-- end of footer -->

	</main><!-- end of main-container -->

</body>

</html>