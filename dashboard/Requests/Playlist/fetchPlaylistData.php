<?php
session_start();
include '../../../includes/connect.php';
include '../../../models/playlistModel.php';
include '../../../models/trackModel.php';
$userId = $_SESSION["id"];

  $playlists = array();
  $tempPlaylist = array();
$sql="select * from playlist where userId = '$userId' ";
$result=$conn->query($sql);
$result_num=$result->num_rows;

if($result_num<1){

    echo'error';

}else{
 
    while($row=$result->fetch_assoc()){
      
        $tracksTempArray = array();

        $tempPlaylist = new playlist(array("idp"=>$row["idp"],"name"=>$row["name"],"userId"=>$row["userId"]));
        
        $idp = $row["idp"];
        $sql2="select * from track t, tp ttp where t.idt = ttp.idt and idp = '$idp' ";
        $result2=$conn->query($sql2);
        $result2_num=$result2->num_rows;

        if($result2_num > 0){
            
            while($row=$result2->fetch_assoc()){
            array_push($tracksTempArray,new track($row["idp"],$row["idt"],$row["title"]));
            
        }
        }

        array_push($tempPlaylist->tracks,$tracksTempArray);
        array_push($playlists,$tempPlaylist);

    }
    echo json_encode($playlists);
    }
    
    

  
        
    
    
    



