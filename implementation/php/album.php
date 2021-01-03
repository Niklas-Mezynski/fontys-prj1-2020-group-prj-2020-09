<?php session_start(); // check if User has session, if not redirect to login page
if (!isset($_SESSION["user_name"])) {
		header("Location:../login.php");
		die("Please login");
} 
?>
<!DOCTYPE html>
<html xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">

<head>
  <title>Album</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
  <link rel="shortcut icon" href="../img/Logo.png" />
</head>
<style> 
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

 <?php
		include_once ("dbconnection.php");
		// get data from tables album, song and user
		$stmt = $conn->prepare("SELECT album.cover AS aCover, album.title AS aTitle, album.label AS aLabel, album.publisher AS aPublisher, 
		song.title AS sTitle ,song.song_path AS sPath, users.user_name AS sArtist
		from (album left join song
		on album.album_id = song.album_id
		left join users
		on song.artist_id = users.user_id)
		where album.album_id = :albumid");
		$stmt->bindParam(":albumid", htmlspecialchars($_GET["albumid"])); //bind albumid 
		$stmt->execute(); //execute query
?>

    <article>
      <p></p>
      <div>
        <p style="float: left;">
          
		 <?php
		 
		$result = $stmt->fetch(\PDO::FETCH_ASSOC); //get first row of response			
		if(isset($result['acover'])) {
			echo "<img src='data:image/jpeg;base64," . $result['acover'] . "'id='cover'></p>"; 
		} 
		else echo "<img src='../img/albumcover-placeholder.jpg' id='cover'></p>"; //if no album cover was found use default cover
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
		 if ($_SESSION["user_role"] >= 2) {
		 $stmt->execute(); //execute query to get other data
			foreach ($stmt as $row) //foreach song in album create a table row
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
			}} else echo "You have to be a subscriber to listen to music." ?>
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