<?php
session_start();
$target_dir = "../../../uploads/";
$title = $_POST["title"];
$description = $_POST["description"];
$image=$_FILES['cover']['tmp_name'];
/* var_dump($_POST); */
$userName = $_SESSION["username"];
$id = $_SESSION["id"];
$newFileName = $id.'_'.$userName.'_'.uniqid().".".strtolower(pathinfo($_FILES['Audiofile']['name'],PATHINFO_EXTENSION));
$target_file = $target_dir . $newFileName;
$uploadOk = 1;


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
/* if ($_FILES["Audiofile"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
} */

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $oldFile = $_FILES['Audiofile']['tmp_name'];
  if (move_uploaded_file($oldFile, $target_file)) {
    addDataToDataBase();
    echo "The file ".$newFileName. " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

function addDataToDataBase(){



}

?>