<?php
session_start();
include '../../../includes/connect.php';
$userId = $_SESSION["id"];
$sql="select * from track where userId = '$userId' ";
$imageBase64Reader = "data:image/png;base64,";
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
            $newArrData['image'] = $imageBase64Reader.base64_encode($spots['image']);
            
        }
        header('Content-type: application/json');
        $json .= json_encode($newArrData);

        if($result->num_rows > $i)$json .=",";
        $i++;
    }
     $json.="]";
    echo $json;
}

?>