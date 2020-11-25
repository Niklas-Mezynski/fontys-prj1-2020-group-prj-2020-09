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
            <div id="logo"><img id="logo" src="img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
            <div id="profileButton"><a href="php/profile.php">User Profile</a></div>
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
                    <li><a href="home.html">Home</a></li>
                    <li><a href="library.html">Library</a></li>
                    <li><a href="playlists.html">Playlists</a></li>
                    <li><a href="shop.html">Shop</a></li>
                    <li><a href="trends.html">Trends</a></li>
                    <li><a href="home.html">Logout</a></li>
                </ul>
            </nav><!-- end of nav -->
        </aside>
        <?php
        include_once("../php/dbconnection.php");
        if ($_POST["searchRadio"] == "Artist") {
            echo "not implemented yet";
        } else if ($_POST["searchRadio"] == "Album") {
            $stmt = $conn -> prepare("SELECT album.title AS album, users.user_name AS artist, count(song_id) AS songamount 
            FROM album INNER JOIN users ON album.artist_id = users.user_id 
            INNER JOIN song ON album.album_id = song.album_id
            GROUP BY album.title, users.user_name;");
            $stmt->execute();  
        } else {
            $stmt = $conn -> prepare("SELECT song.title AS title, users.user_name AS artist, album.title AS album 
            FROM song INNER JOIN users ON users.user_id = song.artist_id 
            INNER JOIN album ON song.album_id = album.album_id;");
            $stmt->execute();
        }
        ?>
        <article>
            <!-- actual search page content -->
            <form method="POST">
                <input id="mainSearchbar" name="search" placeholder="Search.." type="text" value="<?php echo (isset($_POST["search"])) ? $_POST["search"] : ''; ?>"><br>

                <div>
                    <input type="radio" name="searchRadio" value="Song" checked> Song <br>
                    <input type="radio" name="searchRadio" value="Album"> Album <br>
                    <input type="radio" name="searchRadio" value="Artist"> Artist <br>
                </div>
            </form>

            <table id="search-results">
                <?php
                if ($_POST["searchRadio"] == "Artist") {
                    
                } else if ($_POST["searchRadio"] == "Album") {
                    echo "<th>Album</th>";
                    echo "<th>Artist</th>";
                    echo "<th>Song Amount</th>";

                    foreach ($stmt as $row) {
                        echo "<tr>";
                        echo "<th>" . $row['album'] . "</th>";
                        echo "<th>" . $row['artist'] . "</th>";
                        echo "<th>" . $row['songamount'] . "</th>";
                        echo "</tr>";
                    }
                } else {
                    echo "<th>Song</th>";
                    echo "<th>Artist</th>";
                    echo "<th>Album</th>";
                    echo "<th>Duration</th>";
                    
                    foreach ($stmt as $row) {
                        echo "<tr>";
                        echo "<th>" . $row['title'] . "</th>";
                        echo "<th>" . $row['artist'] . "</th>";
                        echo "<th>" . $row['album'] . "</th>";
                        echo "<th> ? </th>";
                        echo "</tr>";
                    }
                }
                ?>
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