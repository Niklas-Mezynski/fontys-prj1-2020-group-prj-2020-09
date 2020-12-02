<?php
session_start();
if(!(isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]))) {
	header("Location: home.php");
	session_destroy();
	exit;
  }
if ($_SESSION["user_role"] < 4) {
    header("Location: main.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/main.css"><!-- link to stylesheet -->
    <link rel="stylesheet" href="/css/adminpanel.css"><!-- link to stylesheet -->
    <title>Admin</title>
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

        <article>
            <div id="contentbox">
                <h1>Admin Panel</h1>
                <form action="">
                    <input type="text">
                </form>
            </div>
        </article>

        <footer>
            <p>
                <a href="termsandconditions.html">Terms and Conditions</a>
            </p>
        </footer><!-- end of footer -->

    </main><!-- end of main-container -->
</body>
</html>