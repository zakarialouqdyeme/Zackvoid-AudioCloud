<?php
include '../includes/connect.php';
include '../models/tracksModel.php';

function getTrackById($conn)
{
    $id = $_GET["id"];
    $sql = "select * from track where idt = $id";
    $arrayData = array();
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

        $directory = explode("/", dirname(__DIR__));
        $dirIndex = sizeof($directory);
        $generateUrl = $_SERVER['HTTP_HOST'] . "/" . $directory[$dirIndex - 1] . "/uploads/" . $row["filename"];
        $base64Image = base64_encode($row["image"]);
        $tampTrack = new apiTrack($row["idt"], $row["title"], $base64Image, $row["description"], $generateUrl);
        array_push($arrayData, $tampTrack);
    }
    header('Content-Type: application/json');
    return json_encode($arrayData, JSON_PRETTY_PRINT);
}



function getTrackByTitle($conn)
{
    $title = $_GET["title"];
    $sql = "select * from track where title = $title";
    $arrayData = array();
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

        $directory = explode("/", dirname(__DIR__));
        $dirIndex = sizeof($directory);
        $generateUrl = $_SERVER['HTTP_HOST'] . "/" . $directory[$dirIndex - 1] . "/uploads/" . $row["filename"];
        $base64Image = base64_encode($row["image"]);
        $tampTrack = new apiTrack($row["idt"], $row["title"], $base64Image, $row["description"], $generateUrl);
        array_push($arrayData, $tampTrack);
    }
    header('Content-Type: application/json');
    return json_encode($arrayData, JSON_PRETTY_PRINT);
}


function getTracks($conn)
{
    $sql = "select * from track";
    $arrayData = array();
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {

        $directory = explode("/", dirname(__DIR__));
        $dirIndex = sizeof($directory);
        $generateUrl = $_SERVER['HTTP_HOST'] . "/" . $directory[$dirIndex - 1] . "/uploads/" . $row["filename"];
        $base64Image = base64_encode($row["image"]);
        $tampTrack = new apiTrack($row["idt"], $row["title"], $base64Image, $row["description"], $generateUrl);
        array_push($arrayData, $tampTrack);
    }
    header('Content-Type: application/json');
    return json_encode($arrayData, JSON_PRETTY_PRINT);
}

if (isset($_GET["id"])) {
    echo getTrackById($conn);
}
if (isset($_GET["name"])) {
    echo getTrackByTitle($conn);
} else {
    echo getTracks($conn);
}
