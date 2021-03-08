<?php
include '../../../includes/connect.php';

$id = $_POST['id'];
$title = $_POST['title'];
$tracks = $_POST['tracks'];

// Delete All Tracks 
$sql = "delete from tp where idp = $id";
$result = $conn->query($sql);
if ($result) {
    // Add New Tracks
    $count = 0;
    for ($i = 0; $i < sizeof($tracks); $i++) {
        $sql2 = "INSERT INTO tp(idp,idt) VALUES ('$id','$tracks[$i]')";
        $result = $conn->query($sql2);
        if ($result) {
            $count++;
        }
    }
    if ($count == sizeof($tracks)) {
        // Update PlayList Title;
        $sql = "update playlist set name = '$title'  where idp = '$id' ";
        $result = $conn->query($sql);

        if ($result) {
            echo "Edit1";
        } else {
            echo "Edit0";
        }

    } else {
        echo "error0";
    }
} else {
    echo "error1";
}
