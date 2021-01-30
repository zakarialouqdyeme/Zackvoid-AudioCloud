<?php
session_start();
include '../../../includes/connect.php';
$userId = $_SESSION["id"];
$sql="select * from playlist where userId = '$userId' ";
$result=$conn->query($sql);
$result_num=$result->num_rows;

if($result_num<1){

    echo'error';

}else{
    $json="[";
$i=1;
    while($row=$result->fetch_assoc()){
       
        $spots = $row;
        foreach($spots as $key=>$value){
            $newArrData[$key] =  $spots[$key];
        }
        header('Content-type: application/json');
        $json .= json_encode($newArrData);
        /* $idp = $row["idp"];
        $sql2="select * from tp where idp = '$idp' ";
        $result=$conn->query($sql2);
        $result_num=$result->num_rows;
        if($result_num > 0){
            $json .="["; 
            
            $json .="";

            $json .="]"; 
        } */

        if($result->num_rows > $i)$json .=",";
        $i++;
    }
     $json.="]";
    echo $json;
}

?>