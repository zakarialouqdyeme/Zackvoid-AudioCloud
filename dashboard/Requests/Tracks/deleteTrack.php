<?php 
session_start();
include '../../../includes/connect.php';
$trackId = $_POST["id"];
$file_pointer = $_POST["filename"];
$directory = dirname (__DIR__,3)."/uploads/";
$path=$directory.$file_pointer;
$sql2 = "delete from track where idt=$trackId";

if (!unlink($path)) {  
    
    if(!file_exists($path)){
    $result=$conn->query($sql2);
    if($result){
      echo 'DBDS'; //Database Delete Success
      }else{
        echo $conn->error;
      }
    }
}  
else {  

    $result=$conn->query($sql2);
    if($result){
      echo 'DBDS'; //Database Delete Success
      }else{
        echo $conn->error;
      }
}  
  
?>