<?php
session_start();
if (!(isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]))) {
    header("Location: home.php");
    session_destroy();
    exit;
}
if ($_SESSION["user_role"] < 1) {
    header("Location: main.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Playlists</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/playlist-overview.css">
</head>

<body>

    <main>
        <header>
            <a href="main.php"><div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block;"></div></a>
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

        <article>            
		
		<div id="centered">
                <h1>Create a new playlist</h1><br>
                <?php if($succesfull) {echo '<h3 style="color: #3f48cc">Playlist erfolgreich erstellt.</h3><br>';
                echo '<a href="playlists.php">Back to playlist overview</a><br><br>';} ?>
                <form action="newPlaylist.php" method="POST" enctype="multipart/form-data">
					<label>Album Cover </label>
					<input type="file" name="file"><br>
                    <input class="plform" type="text" name="plname" placeholder="Playlist name"><br><br>
                    <input type="checkbox" name="public">
                    <label for="public">Public</label><br><br>
                    <input class="plform" type="submit" name="submit" value="Create new playlist">
                </form>
            </div>
            <?php
				
                if(isset($_POST["submit"])) {
				require("dbconnection.php");
				$target_dir = "../uploads/";
							$target_file = $target_dir . basename($_FILES["file"]["name"]);
							$uploadOk = 1;
							$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
							$image_base64 = base64_encode(file_get_contents( $_FILES["file"]["tmp_name"] ));
				
                    $insert = $conn->prepare('INSERT INTO playlist
                    ("name", user_id, public, cover)
                    VALUES(:plname,' . $_SESSION["user_id"] . ',:public ,:cover)');
                    $insert->bindParam(":plname", $_POST["plname"]);
                    $insert->bindParam(":public", $_POST["public"],PDO::PARAM_BOOL);
					$insert->bindParam(":cover", $image_base64);
                    $succesfull = $insert->execute();
                }
            ?>


        </article><!-- end of article -->

        <footer>
            <p>
                <a href="termsandconditions.php">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->

</body>

</html>