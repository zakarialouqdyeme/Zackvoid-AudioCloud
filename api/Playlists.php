<?php
include '../includes/connect.php';
include '../models/playlistModel.php';
include '../models/tracksModel.php';

function getPlaylistById($conn)
{
    $id = $_GET["id"];
    $playlists = array();
    $tempPlaylist = array();
    $sql = "select * from playlist where idp = '$id' ";
    $result = $conn->query($sql);
    $result_num = $result->num_rows;

    if ($result_num < 1) {

        echo '404';
    } else {

        while ($row = $result->fetch_assoc()) {

            $tracksTempArray = array();

            $tempPlaylist = new playlist(array("idp" => $row["idp"], "name" => $row["name"], "userId" => $row["userId"]));

            $idp = $row["idp"];
            $sql2 = "select * from track t, tp ttp where t.idt = ttp.idt and idp = '$idp' ";
            $result2 = $conn->query($sql2);
            $result2_num = $result2->num_rows;

            if ($result2_num > 0) {

                while ($row = $result2->fetch_assoc()) {
                    $directory = explode("/", dirname(__DIR__));
                    $dirIndex = sizeof($directory);
                    $generateUrl = $_SERVER['HTTP_HOST'] . "/" . $directory[$dirIndex - 1] . "/uploads/" . $row["filename"];
                    $base64Image = base64_encode($row["image"]);
                    array_push($tracksTempArray, new apiTrack($row["idt"], $row["title"], $base64Image, $row["description"], $generateUrl));
                }
            }

            array_push($tempPlaylist->tracks, $tracksTempArray);
            array_push($playlists, $tempPlaylist);
        }
        header('Content-Type: application/json');
        return json_encode($playlists, JSON_PRETTY_PRINT);
    }
}



function getPlaylistByName($conn)
{
    $name = $_GET["name"];
    $playlists = array();
    $tempPlaylist = array();
    $sql = "select * from playlist where name = '$name' ";
    $result = $conn->query($sql);
    $result_num = $result->num_rows;

    if ($result_num < 1) {

        echo '404';
    } else {

        while ($row = $result->fetch_assoc()) {

            $tracksTempArray = array();

            $tempPlaylist = new playlist(array("idp" => $row["idp"], "name" => $row["name"], "userId" => $row["userId"]));

            $idp = $row["idp"];
            $sql2 = "select * from track t, tp ttp where t.idt = ttp.idt and idp = '$idp' ";
            $result2 = $conn->query($sql2);
            $result2_num = $result2->num_rows;

            if ($result2_num > 0) {

                while ($row = $result2->fetch_assoc()) {
                    $directory = explode("/", dirname(__DIR__));
                    $dirIndex = sizeof($directory);
                    $generateUrl = $_SERVER['HTTP_HOST'] . "/" . $directory[$dirIndex - 1] . "/uploads/" . $row["filename"];
                    $base64Image = base64_encode($row["image"]);
                    array_push($tracksTempArray, new apiTrack($row["idt"], $row["title"], $base64Image, $row["description"], $generateUrl));
                }
            }

            array_push($tempPlaylist->tracks, $tracksTempArray);
            array_push($playlists, $tempPlaylist);
        }
        header('Content-Type: application/json');
        return json_encode($playlists, JSON_PRETTY_PRINT);
    }
}


function getPlaylists($conn)
{
    $playlists = array();
    $tempPlaylist = array();
    $sql = "select * from playlist";
    $result = $conn->query($sql);
    $result_num = $result->num_rows;

    if ($result_num < 1) {

        echo '404';
    } else {

        while ($row = $result->fetch_assoc()) {

            $tracksTempArray = array();

            $tempPlaylist = new playlist(array("idp" => $row["idp"], "name" => $row["name"], "userId" => $row["userId"]));

            $idp = $row["idp"];
            $sql2 = "select * from track t, tp ttp where t.idt = ttp.idt and idp = '$idp' ";
            $result2 = $conn->query($sql2);
            $result2_num = $result2->num_rows;

            if ($result2_num > 0) {

                while ($row = $result2->fetch_assoc()) {
                    $directory = explode("/", dirname(__DIR__));
                    $dirIndex = sizeof($directory);
                    $generateUrl = $_SERVER['HTTP_HOST'] . "/" . $directory[$dirIndex - 1] . "/uploads/" . $row["filename"];
                    $base64Image = base64_encode($row["image"]);
                    array_push($tracksTempArray, new apiTrack($row["idt"], $row["title"], $base64Image, $row["description"], $generateUrl));
                }
            }

            array_push($tempPlaylist->tracks, $tracksTempArray);
            array_push($playlists, $tempPlaylist);
        }
        header('Content-Type: application/json');
        return json_encode($playlists, JSON_PRETTY_PRINT);
    }
}

if (isset($_GET["id"])) {
    echo getPlaylistById($conn);
}
if (isset($_GET["name"])) {
    echo getPlaylistByName($conn);
} else {
    echo getPlaylists($conn);
}
