$(document).ready(async () => {

    var path = window.location.pathname;
    var page = path.split("/").pop();
    if (page == "Tracks.php") $("#navTracks").addClass("active");
    if (page == "Playlist.php") $("#navPlayLists").addClass("active");
    
});