<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">

<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/css/main.css"><!-- link to stylesheet -->
</head>
<style> 
<?php include "/css/main.css" ?>
</style>
<body>
  <main>
    <header>
      <div>
      </div>
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
					<li><a href="../main.php">Home</a></li>
					<li><a href="../library.php">Library</a></li>
					<?php
					if ($_SESSION["user_role"] >= 2) {
						echo '<li><a href="playlists.php">Playlists</a></li>';
					}
					?>
					<li><a href="../shop.php">Shop</a></li>
					<li><a href="../trends.php">Trends</a></li>
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
					<li><a href="../logout.php">Logout</a></li>

				</ul>
			</nav><!-- end of nav -->
		</aside>

 <?php
		  include_once ("dbconnection.php");
		// create the table - just for testing the connection
		$stmt = $conn->prepare("SELECT album.title AS aTitle, album.label AS aLabel, album.publisher AS aPublisher, song.title AS sTitle ,song.song_path AS sPath, users.user_name AS sArtist
		from (album left join song
		on album.album_id = song.album_id
		left join users
		on song.artist_id = users.user_id)
		where album.album_id = :albumid");
		$stmt->bindParam(":albumid", htmlspecialchars($_GET["albumid"]));
		$stmt->execute();
?>

    <article>
      <p></p>
      <div>
        <p style="float: left;">
          <img src="/img/albumcover-placeholder.jpg" height="400px" width="400px" id="cover"></p>
		 <?php
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		echo "<br>";
		echo "<p style='text-align: left; font-size: 36px'>" .$result['atitle'] . "</p>";
		echo "<p style='text-align: left; font-size: 24px'>" .$result['alabel'] . "/" .$result['apublisher'] . "</p>";
		?>
        <table id="songlist">
          <tr id="header">
            <th>Name</th>
            <th>Artists</th>
            <th>Play</th>
          </tr>
         <?php
		 $stmt->execute();
			foreach ($stmt as $row)
			{
			echo "<tr id='song'>";
			echo "<td>" . $row['stitle'] . "</td>";
			echo "<td>" . $row['sartist'] . "</td>";
			echo "<td>
              <audio controls controlsList='nodownload'>
                <source src='".$row['spath'] . "' type='audio/mpeg'>
                Your browser does not support the audio element.
              </audio>
            </td>";
			echo "</tr>";
			} ?>
        </table>
    </article><!-- end of article -->

    <footer>
      <p>
        <a href="termsandconditions.html">Terms and Conditions</a>
      </p>

    </footer><!-- end of footer -->

  </main><!-- end of main-container -->

</body>

</html>