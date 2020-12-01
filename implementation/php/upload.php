<?php
session_start();
require("dbconnection.php");

$stmtID = $conn->query("SELECT max(song_id) AS song_id FROM song;");
$rowID = $stmtID->fetch();
$song_id = $rowID["song_id"] + 1;

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$finalFile = $target_dir.$song_id.".".$fileType;

/* Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
} */

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
if($fileType != "mp3") {
  echo "Sorry, only MP3 is allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $finalFile)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

$insert = $conn->prepare('INSERT INTO public.song
(title, artist_id, "label", publisher, price, album_id, song_path)
VALUES(:song_name, :artist_id, :label, :publisher, :price,/* placeholder album:1 */ 1, :song_path)');

$insert->bindParam(":song_name",$_POST["song_name"]);
$insert->bindParam(":artist_id",$_SESSION["user_id"]);
$insert->bindParam(":label",$_POST["label"]);
$insert->bindParam(":publisher",$_POST["publisher"]);
$insert->bindParam(":price",$_POST["price"]);
$insert->bindParam(":song_path",$finalFile);
$insert->execute();
?>