<?php
session_start();
include '../../includes/connect.php';
$user=mysqli_real_escape_string($conn,$_POST['user']);
$password=mysqli_real_escape_string($conn,$_POST['pass']);


if(empty($user) || empty($password)){

  echo'error';
}else{
$sql="select * from users where username='$user'";
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
$_SESSION["id"]=$row["idu"];
$_SESSION["username"]=$row["username"];
echo "login";
}


    }


}





}


?>