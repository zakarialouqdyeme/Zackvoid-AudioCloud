<?php
session_start();
include '../../../includes/connect.php';

$id = $_SESSION["id"];
$name = $_POST['name'];
$tracks = $_POST['tracks'];

$sql2 = "INSERT INTO playlist(name,userId) VALUES ('$name','$id')";
$result=$conn->query($sql2);

if($result){
    $count = 0;
    $idp = $conn->insert_id;
    for($i = 0 ; $i < sizeof($tracks) ; $i++){
        $sql2 = "INSERT INTO tp(idp,idt) VALUES ('$idp','$tracks[$i]')";
        $result=$conn->query($sql2);
        if($result){
            $count ++;
          }
    }
    if($count == sizeof($tracks)){
        echo "success";
    }else{
        echo "error";
    }
  }


