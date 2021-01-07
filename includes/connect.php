<?php
require_once(dirname(__FILE__)."/".'../config.php');

$servername = Db::$serverName;;
$username = Db::$username;
$password= Db::$password;
$dbname = Db::$dbname;

$conn=new mysqli($servername,$username,$password,$dbname) or die("connection failed".$conn->connect_error);



