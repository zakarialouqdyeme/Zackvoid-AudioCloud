<?php
session_start();
include '../../../includes/connect.php';
include '../../../models/tracksModel.php';
$userId = $_SESSION["id"];
$sql="select * from track where userId = '$userId' ";
$result=$conn->query($sql);
$result_num=$result->num_rows;
$json = array();
if($result_num<1){

    echo'error';

}else{
    
    while($row=$result->fetch_assoc()){
        array_push($json,new tracks($row["idt"],$row["title"]));
    }
    echo json_encode($json);
}
