<?php 
session_start();
include '../../../includes/connect.php';
$id = $_POST["id"];
$sql = "delete from playlist where idp = $id";

$result=$conn->query($sql);
if($result){

  echo "success";

  }else{

  echo $conn->error;

  }

?>