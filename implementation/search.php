<!DOCTYPE html>
<html>

<head>
    <title>Search</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css"><!-- link to stylesheet -->
    <link rel="stylesheet" href="css/search.css">
</head>

<body>

    <main>
        <header>
            <div style="text-align: center">
                <p>Songify</p>

            </div>
            <div><img src="img/Logo.png" alt="Logo" width="60" height="60" float="left">
            </div>
        </header><!-- end of header -->

        <aside>
            <p>ASIDE</p>

            <nav id="menu_v">
                <p>NAV</p>
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
            <!-- actual search page content -->
            <input id="mainSearchbar" placeholder="Search" type="text" value="<?php echo (isset($_GET["search"])) ? $_GET["search"] : ''; ?>"><br>

            <div>
                <input type="radio" name="search" value="Song" checked> Song <br>
                <input type="radio" name="search" value="Album"> Album <br>
                <input type="radio" name="search" value="Artist"> Artist <br>
            </div>

            <table id="search-results">
                <tr>
                    <th>Song 1</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Duration</th>
                </tr>
                <tr>
                    <th>Song 2</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Duration</th>
                </tr>
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