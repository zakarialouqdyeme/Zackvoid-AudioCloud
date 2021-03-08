<?php
include '../includes/connect.php';

$sql = "delete from tp where idp ";
    $result = $conn->query($sql);
function getTrackById($id){
    $id = $_GET["id"];
    
}
function getTrackByName($name){
    $name = $_GET["name"];
}
function getTracks(){
    
    
}