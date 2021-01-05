<?php
session_start();
include '../includes/connection.php';
$user=mysqli_real_escape_string($conn,$_POST['user']);
$password=mysqli_real_escape_string($conn,$_POST['pass']);


if(empty($user) || empty($password)){

  echo'error';
}else{
$sql="select * from admin where email='$user'";
$result=$conn->query($sql);
$result_num=$result->num_rows;
if($result_num<1){

    echo'error';

}else{

    if($row=$result->fetch_assoc()){
        $checkpassword=$password===$row["password"];
    
if($checkpassword===false){
    echo'error';

}else if($checkpassword===true){
$_SESSION["id"]=$row["id"];
$_SESSION["email"]=$row["email"];
$_SESSION["name"]=$row["name"];
$_SESSION["role"]=$row["role"];


echo "login";


}


    }


}





}


?>