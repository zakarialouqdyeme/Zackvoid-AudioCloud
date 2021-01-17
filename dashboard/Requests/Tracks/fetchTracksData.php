<?php
session_start();
include '../../../includes/connect.php';
$userId = $_SESSION["id"];
$sql="select * from track where userId = '$userId' ";
$result=$conn->query($sql);
$result_num=$result->num_rows;




if($result_num<1){

    echo'error';

}else{


    while($row=$result->fetch_assoc()){
       
        $spots = $row;
        foreach($spots as $key=>$value){
            $newArrData[$key] =  $spots[$key];
            $newArrData['image'] = base64_encode($spots['image']);
        }
        header('Content-type: application/json');
        echo json_encode($newArrData);
    }

}

?>