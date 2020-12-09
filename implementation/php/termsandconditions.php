<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Terms and Conditions</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
    <link rel="stylesheet" href="../css/terms.css">
</head>

<body>

    <main>
        <header>
            <div class="column" id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60"
                    style="display: inline-block; ;"></div>
            <div class="column" id="profileButton"><a href="profile.php">User Profile</a></div>
            <div id="title"><p>Songify</p></div>
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

        <article>
            <form>
                <div id="terms">
                    <h1> Part 1:</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean scelerisque odio ligula, ac
                        egestas
                        lorem volutpat sit amet. Mauris quis odio ipsum. Ut non justo condimentum, tempor odio nec,
                        ullamcorper diam. Nulla nec odio malesuada, commodo risus sit amet, condimentum leo. In feugiat,
                        nunc ac pretium condimentum, odio elit scelerisque erat, vel dapibus magna nisi nec sem. Sed
                        nisl
                        neque, semper sit amet odio eget, posuere semper sem. Aenean condimentum at neque ut convallis.
                        Vestibulum ultrices ante enim, ut accumsan quam eleifend sed. In id ipsum vel sem suscipit
                        dictum.
                        Pellentesque non lorem risus. Curabitur blandit sem vel augue tempor sollicitudin. Orci varius
                        natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi mollis mattis
                        varius. Phasellus sit amet imperdiet urna.</p>
                    <br>
                    <h1> Part 2:</h1>
                    <p>Maecenas venenatis velit a enim ornare dignissim. Donec risus nibh, tempus a fermentum et,
                        laoreet
                        eget diam. Nam sed consectetur metus. Maecenas a libero dui. Cras euismod mattis nibh sed
                        lacinia.
                        Duis faucibus elementum fringilla. Phasellus pellentesque posuere purus, eget ullamcorper erat
                        fermentum vitae. Sed vitae vestibulum ipsum. Duis a dui convallis justo elementum tempus et sit
                        amet
                        sem. Vestibulum dignissim, odio aliquam pulvinar fermentum, velit nunc consectetur libero, sed
                        ornare elit metus a sem. Morbi vestibulum tincidunt velit et sodales. Aenean id ante fermentum,
                        vestibulum tellus sed, ultricies diam. Donec vitae enim in justo consectetur rutrum. Mauris at
                        tempus lorem. Praesent egestas nunc tempus velit consectetur, quis imperdiet metus placerat.
                        Praesent pulvinar efficitur diam sed tempor.</p>
                    <br>
                    <h1> Part 3:</h1>
                    <p>Sed eleifend malesuada pellentesque. Nam efficitur risus sit amet magna dictum, sed semper justo
                        convallis. Cras urna nulla, commodo nec laoreet eget, gravida sodales ipsum. Etiam faucibus sit
                        amet
                        tellus in luctus. Proin sit amet accumsan ante. Proin placerat lorem sed felis sollicitudin
                        porta.
                        Suspendisse metus tortor, laoreet eget risus quis, sodales venenatis elit. Orci varius natoque
                        penatibus
                        et magnis dis parturient montes, nascetur ridiculus mus. Ut egestas eget ligula accumsan
                        sollicitudin.
                        Pellentesque porta dolor et diam sagittis tempus.</p>
                    <br>
                    <h1> Part 4:</h1>
                    <p>Etiam nec maximus diam. Nulla facilisi. Pellentesque habitant morbi tristique senectus et netus
                        et
                        malesuada fames ac turpis egestas. Curabitur eget lobortis nulla. Mauris lobortis molestie
                        ullamcorper.
                        Curabitur faucibus feugiat sapien sed accumsan. Aliquam tincidunt sollicitudin ultrices.
                        Vestibulum
                        in
                        finibus tortor, ac molestie orci. Nullam rhoncus, ligula a semper egestas, ante urna tempus
                        urna,
                        quis
                        egestas neque ex a nulla.</p>
                    <br>
                    <h1> Part 5:</h1>
                    <p> Pellentesque facilisis suscipit lacinia. Integer quis ultrices turpis, sed consequat quam.
                        Nullam
                        fermentum mi id semper ultricies. Duis eget nibh ac turpis scelerisque ultricies. Sed in pretium
                        mi.
                        Vivamus vel dignissim orci. Nunc blandit suscipit enim a vehicula. Integer tincidunt sapien
                        vestibulum,
                        faucibus lectus luctus, gravida erat. Vestibulum ultrices diam in purus posuere aliquam. Fusce
                        tempor
                        tempus cursus. Aliquam volutpat vestibulum arcu posuere finibus. Sed laoreet nisi nec risus
                        laoreet,
                        nec
                        fermentum sapien accumsan.</p>
                </div>
            </form>
        </article><!-- end of article -->

        <footer>
            <p>
                <a href="termsandconditions.php">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->

</body>

</html>