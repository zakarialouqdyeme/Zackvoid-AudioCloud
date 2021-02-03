<?php
include '../../../includes/connect.php';

$idt = $_POST['idt'];

$title = $_POST['title'];
$description = $_POST['description'];


$sql="update track set title = '$title' , description = '$description' where idt = '$idt' ";
$result=$conn->query($sql);

if($result){
    echo "Edit1";
}else{
    echo "Edit0";
}