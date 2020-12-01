<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
    <link rel="stylesheet" href="../css/trends.css">
</head>

<body>

    <main>
        <header>
            <div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
            <div id="profileButton"><a href="profile.html">User Profile</a></div>
        </header><!-- end of header -->

        <aside>
            <nav id="menu_v">
                <form action="search.php" method="GET">
                    <input type="text" name="search" placeholder="Search.." id="searchbar">
                </form>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="library.php">Library</a></li>
                    <li><a href="playlists.php">Playlists</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="trends.php">Trends</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav><!-- end of nav -->
        </aside>
        <?php
        include_once("../php/dbconnection.php");
        // get songs ordered by popularity (listens) from database
        $stmt = $conn->prepare("SELECT song.title AS title, users.user_name AS artist, album.title AS album, song.listens AS listens
            FROM song INNER JOIN users ON users.user_id = song.artist_id 
            INNER JOIN album ON song.album_id = album.album_id
            ORDER BY listens DESC;");
        $stmt->execute();
        ?>
        <article>
        <table>
            <?php
            include 'formatNumber.php';

            echo "<th>Song</th>";
            echo "<th>Artist</th>";
            echo "<th>Album</th>";
            echo "<th>Listens</th>";

            foreach ($stmt as $row) {
                echo "<tr>";
                echo "<th>" . $row['title'] . "</th>";
                echo "<th>" . $row['artist'] . "</th>";
                echo "<th>" . $row['album'] . "</th>";
                echo "<th>" . formatNumber($row['listens']) . "</th>";
                echo "</tr>";
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