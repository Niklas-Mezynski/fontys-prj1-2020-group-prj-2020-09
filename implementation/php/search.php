<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Search</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
    <link rel="stylesheet" href="../css/search.css">
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
        
        <?php
        require("dbconnection.php");

        // Artist Search
        if ($_POST["searchRadio"] == "Artist") {
            $searchInput = $_POST["search"];
            $stmt = $conn->prepare("SELECT users.user_name AS artist, count(albumsongs.title) AS albums, sum(albumsongs.songs) AS songs
            FROM users INNER JOIN 
            (SELECT album.title, album.artist_id, count(song.title) AS songs
            FROM album INNER JOIN song ON album.album_id = song.album_id
            GROUP BY album.album_id) AS albumsongs
            ON users.user_id = albumsongs.artist_id
            WHERE user_role = 3 AND LOWER(users.user_name) LIKE LOWER('%$searchInput%')
            GROUP BY users.user_name;");
            $stmt->execute();

        // Album Search
        } else if ($_POST["searchRadio"] == "Album") {
            $searchInput = $_POST["search"];
            $stmt = $conn->prepare("SELECT album.title AS album, users.user_name AS artist, count(song_id) AS songamount, album.album_id 
            FROM album INNER JOIN users ON album.artist_id = users.user_id 
            INNER JOIN song ON album.album_id = song.album_id
            WHERE LOWER(album.title) LIKE LOWER('%$searchInput%')
            GROUP BY album.title, users.user_name, album.album_id;");
            $stmt->execute();

        // Song Search
        } else {
            $searchInput = $_POST["search"];
            $stmt = $conn->prepare("SELECT song.title AS title, users.user_name AS artist, album.title AS album, song.listens AS listens,
                                song.song_path AS spath, song.song_id, album.album_id
            FROM song INNER JOIN users ON users.user_id = song.artist_id 
            INNER JOIN album ON song.album_id = album.album_id
            WHERE LOWER(song.title) LIKE LOWER('%$searchInput%')
            ORDER BY listens DESC;");
            $stmt->execute();
        }
        ?>
        <article>
            <!-- actual search page content -->
            <form method="POST">
                <input id="mainSearchbar" name="search" placeholder="Search.." type="text" value="<?php echo (isset($_POST["search"])) ? $_POST["search"] : ''; ?>"><br>

                <div> <!-- Song/Album/Artist Search Selection -->
                    <input type="radio" name="searchRadio" value="Song" checked> Song <br>
                    <input type="radio" name="searchRadio" value="Album"> Album <br>
                    <input type="radio" name="searchRadio" value="Artist"> Artist <br>
                </div>
            </form>

            <!-- Display List of Search Results -->
            <table id="search-results">
                <?php
                include 'formatNumber.php';

                // Artist Search
                if ($_POST["searchRadio"] == "Artist") {
                    echo "<th>Artist</th>";
                    echo "<th>Album Amount</th>";
                    echo "<th>Song Amount</th>";

                    foreach ($stmt as $row) {
                        echo "<tr>";
                        echo "<th>" . $row['artist'] . "</th>";
                        echo "<th>" . $row['albums'] . "</th>";
                        echo "<th>" . $row['songs'] . "</th>";
                        echo "</tr>";
                    }
                
                // Album Search
                } else if ($_POST["searchRadio"] == "Album") {
                    echo "<th>Album</th>";
                    echo "<th>Artist</th>";
                    echo "<th>Song Amount</th>";

                    foreach ($stmt as $row) {
                        echo "<tr>";
                        echo "<th><a href='album.php?albumid=". $row['album_id'] ."'>" . $row['album'] . "</a></th>";
                        echo "<th>" . $row['artist'] . "</th>";
                        echo "<th>" . $row['songamount'] . "</th>";
                        echo "</tr>";
                    }

                // Song Search
                } else {
                    echo "<th>Song</th>";
                    echo "<th>Artist</th>";
                    echo "<th>Album</th>";
                    echo "<th>Listens</th>";
                    echo "<th>Play</th>";
                    if (isset($_POST["plsubmit"])) {echo "<th>Add to playlist</th>";}

                    foreach ($stmt as $row) {
                        echo "<tr>";
                        echo "<th>" . $row['title'] . "</th>";
                        echo "<th>" . $row['artist'] . "</th>";
                        echo "<th><a href='album.php?albumid=". $row['album_id'] ."'>" . $row['album'] . "</a></th>";
                        echo "<th>" . formatNumber($row['listens']) . "</th>";
                        echo "<th>
                                <audio controls controlsList='nodownload'>
                                <source src='" . $row['spath'] . "' type='audio/mpeg'>
                                Your browser does not support the audio element.
                                </audio>
                            </th>";
                        if (isset($_POST["plsubmit"])) { //only executed if the user wants to add a song to one of his playlists
                            echo "<th>
                                <form action='playlist.php?id=".$_POST['playlist_id']."' method='post'>
                                    <input type='hidden' name='playlist_id' value='".$_POST['playlist_id']."'>
                                    <input type='hidden' name='song_id' value='".$row['song_id']."'>
                                    <input class='add' type='submit' name='submit' value='Add song'>
                                </form>
                                </th>";
                        }
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </article><!-- end of article -->

        <footer>
            <p>
                <a href="termsandconditions.php">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->

</body>

</html>