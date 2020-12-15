<?php
session_start();
if (!(isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]))) {
    header("Location: home.php");
    session_destroy();
    exit;
}
if ($_SESSION["user_role"] < 3) {
    header("Location: main.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Create Album</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/upload.css">
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

        <article>
			<h1>Create Album</h1><br>
			
			    <form action="createalbum.php" method="post" enctype="multipart/form-data">
                <label>Album Cover </label><input class="dataInput" type="file" name="file" required><br>
                <label>Album Name </label><input class="dataInput" type="text" name="album_name" required><br>
                <label>Label </label><input class="dataInput" type="text" name="label" required><br>
                <label>Publisher </label><input class="dataInput" type="text" name="publisher" required><br>
                <label>Release Date </label><input class="dataInput" type="date" name="releasedate" required><br>
                <input class="dataInput" type="submit" value="Create Album" name="submit"><br>
            </form>
			<?php
			if (isset($_POST["submit"])) {
				require("dbconnection.php");
				
				$target_dir = "../uploads/";
							$target_file = $target_dir . basename($_FILES["file"]["name"]);
							$uploadOk = 1;
							$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
							$image_base64 = base64_encode(file_get_contents( $_FILES["file"]["tmp_name"] ));

			            $insert = $conn->prepare('INSERT INTO public.album
												(title, "date", artist_id, "label", publisher, cover)
												VALUES(:album_name, :releasedate , :artist_id, :label, :publisher, :cover)');			

						    
                        $insert->bindParam(":album_name", $_POST["album_name"]);
                        $insert->bindParam(":artist_id", $_SESSION["user_id"]);
						$insert->bindParam(":releasedate", $_POST["releasedate"]);
                        $insert->bindParam(":label", $_POST["label"]);
                        $insert->bindParam(":publisher", $_POST["publisher"]);
                        $insert->bindParam(":cover", $image_base64);
                        $insert->execute();
			}
			
			?>
		
        </article><!-- end of article -->

        <footer>
            <p>
                <a href="termsandconditions.html">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->

</body>

</html>