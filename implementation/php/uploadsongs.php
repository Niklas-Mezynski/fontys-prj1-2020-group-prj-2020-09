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
    <title>Upload Songs</title>
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
			<form action="createalbum.php">
				<input class="dataInput" type="submit" value="Create Album" />
			</form>
            <h1>Upload Songs</h1><br>

            <?php
            if (isset($_POST["submit"])) {

                require("dbconnection.php");

                $stmtID = $conn->query("SELECT max(song_id) AS song_id FROM song;");
                $rowID = $stmtID->fetch();
                $song_id = $rowID["song_id"] + 1;

                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $finalFile = $target_dir . $song_id . "." . $fileType;

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if ($fileType != "mp3") {
                    echo "Sorry, only MP3 is allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $finalFile)) {
                        $insert = $conn->prepare('INSERT INTO public.song
                                    (song_id, title, "date", artist_id, "label", publisher, price, album_id, song_path)
                                    VALUES(:song_id, :song_name, CURRENT_DATE, :artist_id, :label, :publisher, :price, :album, :song_path)');

                        $insert->bindParam(":song_id", $song_id);
                        $insert->bindParam(":song_name", $_POST["song_name"]);
                        $insert->bindParam(":artist_id", $_SESSION["user_id"]);
                        $insert->bindParam(":label", $_POST["label"]);
                        $insert->bindParam(":publisher", $_POST["publisher"]);
                        $insert->bindParam(":price", $_POST["price"]);
                        $insert->bindParam(":album",$_POST["album"]);
                        $insert->bindParam(":song_path", $finalFile);
                        $insert->execute();
                        echo "<h4>The file has been uploaded.</h4>";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }

            ?>

            <form action="uploadsongs.php" method="post" enctype="multipart/form-data">
                <label>Select song to upload (in .mp3 format) </label><input class="dataInput" type="file" name="fileToUpload"><br>
                <label>Song name </label><input class="dataInput" type="text" name="song_name"><br>
                <label>Label </label><input class="dataInput" type="text" name="label"><br>
                <label>Publisher </label><input class="dataInput" type="text" name="publisher"><br>
                <label>Price </label><input class="dataInput" type="number" min="0.0" max="3.0" step="0.01" value="00.00" name="price"><br>
                <label for="album">Album </label>
                <select id="album" name="album">
                    
                    <?php
                    require("dbconnection.php");
                    $stmtAlbum = $conn->prepare("select * from album where artist_id = :user_id");
                    $stmtAlbum->bindParam(":user_id", $_SESSION["user_id"]);
                    $stmtAlbum->execute();
                    
                    foreach ($stmtAlbum as $row) {
                        echo '<option value="'. $row["album_id"] .'">'. $row["title"] .'</option>';
                    }
                    ?>
                </select><br>
                <input class="dataInput" type="submit" value="Upload song" name="submit">
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