<?php
session_start();
include '../../../includes/connect.php';
include '../../../models/playlistModel.php';
include '../../../models/trackModel.php';
$userId = $_SESSION["id"];
$playlists = array();
$sql="select * from playlist where userId = '$userId' ";
$result=$conn->query($sql);
$result_num=$result->num_rows;

if($result_num<1){

    echo'error';

}else{
   /*  $json="["; */
$i=1;
    while($row=$result->fetch_assoc()){
       
       /*  header('Content-type: application/json'); */
        /* $json .= json_encode($newArrData); */
       
        $tempPlaylist = new playlist($row["idp"],$row["name"],$row["userId"],array());
        array_push($playlists,$tempPlaylist);
        $idp = $row["idp"];
        $sql2="select * from track t, tp ttp where t.idt = ttp.idt and idp = '$idp' ";
        $result2=$conn->query($sql2);
        $result2_num=$result2->num_rows;
        if($result2_num > 0){
            /* $json .=',{"tracks":[';  */
            $j=0;
            while($row=$result2->fetch_assoc()){


                $tempPlaylist->addTracks(new track($row["idp"],$row["idt"],$row["title"]));
                
/* 
                $idpTemp = $row["idp"];
                $idtTemp = $row["idt"];
                $titleTemp = $row["title"];
                $json .='{';
                $json .='"idp":'.'"'.$idpTemp.'",';
                $json .='"idt":'.'"'.$idtTemp.'",';
                $json .='"title":'.'"'.$titleTemp.'"';

                if($result->num_rows > $j)$json .="},"; else $json .="}";
                $j++; */
            }

           /*  $json .="]}";  */
        }
       
       /*  if($result->num_rows > $i)$json .=",";
        $i++; */
    }
  /*    $json.="]"; */

    /* $json = json_encode($playlist); */
    var_dump($playlists);
}

?>