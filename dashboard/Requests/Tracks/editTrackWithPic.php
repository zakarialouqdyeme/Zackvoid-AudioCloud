<?php
include '../../../includes/connect.php';
$idt = $_POST['idt'];
$image=$_FILES['image']['tmp_name'];
$file=addslashes(file_get_contents($image));
$title = $_POST['title'];
$description = $_POST['description'];


$sql="update track set title = '$title' , description = '$description', image = '$file'  where idt = '$idt' ";
$result=$conn->query($sql);

if($result){
    echo "Edit1";
}else {
    echo "Edit0";
}
