<?php
session_start();
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php');
header('Location:Auth/login.php'); 
 ?>