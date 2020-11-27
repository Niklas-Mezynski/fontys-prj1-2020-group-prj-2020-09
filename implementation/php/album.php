<!DOCTYPE html>
<html xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">

<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
</head>
<style> 
<?php include "../css/main.css" ?>
</style>
<body>
  <main>
    <header>
      <div>
        <p>HEADER</p>
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
					<li><a href="playlists.php">Playlists</a></li>
					<li><a href="shop.php">Shop</a></li>
					<li><a href="trends.php">Trends</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav><!-- end of nav -->
		</aside>

 <?php
		  include_once ("dbconnection.php");
		// create the table - just for testing the connection
		$stmt = $conn->prepare("SELECT album.title AS aTitle, album.label AS aLabel, album.publisher AS aPublisher, song.title AS sTitle, song.artist_id AS sArtist
		from album left join song
		on album.album_id = song.album_id
		where album.album_id = :albumid");
		$stmt->bindParam(":albumid", htmlspecialchars($_GET["albumid"]));
		$stmt->execute();
?>

    <article>
      <p>Album</p>
      <div>
        <p style="float: left;">
          <img src="/img/albumcover-placeholder.jpg" height="400px" width="400px" id="cover"></p>
		 <?php
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		echo "<p style='text-align: center'; font-size: 24px>" .$result['atitle'] . "</p>";
		echo "<p style='text-align: center'; font-size: 24px>" .$result['alabel'] . "/" .$result['apublisher'] . "</p>";
		?>
        <table id="songlist">
          <tr id="header">
            <th>Name</th>
            <th>Artists</th>
            <th>Play</th>
          </tr>
         <?php
			foreach ($stmt as $row)
			{
			echo "<tr id='song'>";
			echo "<td>" . $row['stitle'] . "</td>";
			echo "<td>" . $row['sartist'] . "</td>";
			echo "<td>
              <audio controls>
                <source src='audio.mp3' type='audio/mpeg'>
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