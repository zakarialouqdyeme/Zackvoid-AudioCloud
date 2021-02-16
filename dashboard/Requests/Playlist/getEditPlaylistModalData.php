<?php
include '../../../includes/connect.php';
include '../../../models/playlistModel.php';
include '../../../models/trackModel.php';
include '../../../models/tracksModel.php';

$idp = $_POST['id'];

$sql="select * from playlist where idp = '$idp' ";
$result = $conn->query($sql);
$result_num = $result->num_rows;
$tracks=array();
if($result_num > 0){

    while($row = $result->fetch_assoc()){

        $playlist = new playlist(array("idp"=>$row["idp"],"name"=>$row["name"],"userId"=>$row["userId"]));
        $sql2 = "select * from track t, tp tpp where t.idt = tpp.idt and  tpp.idp = '$idp' ";
        $result2 = $conn->query($sql2);
        $result_num2 = $result2->num_rows;
        
    if($result_num2 > 0){
    
        while($row2 = $result2->fetch_assoc()){
            //echo $row2["title"];
           array_push($tracks,new tracks($row2["idt"],$row2["title"]));
        }
        
    }
    
    }

}else{

}


array_push($playlist->tracks,$tracks);
echo json_encode($playlist);