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
            <div id="logo"><img id="logo" src="img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
			<div id="profileButton"><a href="profile.php">User Profile</a></div>
			<div id="title"><p>Songify</p></div>
        </header><!-- end of header -->

        <aside>
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
        <?php 
            include_once ("./php/dbconnection.php");
        ?>
        <article>
            <!-- actual search page content -->
            <input id="mainSearchbar" placeholder="Search.." type="text" value="<?php echo (isset($_GET["search"])) ? $_GET["search"] : ''; ?>"><br>

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