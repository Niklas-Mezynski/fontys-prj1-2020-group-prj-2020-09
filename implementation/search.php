<!DOCTYPE html>
<html xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">

<head>
    <title>Search</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/search.css">
</head>

<body>

    <main>
        <header>
            <div>
                <p>HEADER</p>
            </div>
        </header><!-- end of header -->

        <aside>
            <p>ASIDE</p>

            <nav id="menu_v">
                <p>NAV</p>
                <input id="searchbar" placeholder="Search" type="text">
                <?php echo $_GET["search"];?>
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
            <input id="mainSearchbar" placeholder="Search" type="text"><br>

            <input type="radio" name="search" value="Song" checked> Song <br>
            <input type="radio" name="search" value="Album"> Album <br>
            <input type="radio" name="search" value="Artist"> Artist <br>
        </article><!-- end of article -->

        <footer>
            <p>
                <a href="termsandconditions.html">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->

</body>

</html>