<?php
include '../../../includes/connect.php';
$idt = $_POST['idt'];
$title = $_POST['title'];
$description = $_POST['description'];

echo $idt . $title . $description;
/* $sql="update track set title = '$title' , descrition = '$descrition' where idt = '' ";
$result=$conn->query($sql);
$result_num = $result->num_rows;

 */