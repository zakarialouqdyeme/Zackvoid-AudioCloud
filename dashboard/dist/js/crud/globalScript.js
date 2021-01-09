$(document).ready(async () => {

    var path = window.location.pathname;
    var page = path.split("/").pop();
    if (page == "Tracks.php") $("#navTracks").addClass("active");
    if (page == "Playlist.php") $("#navPlayLists").addClass("active");


    function showMessage(message,icon,time){
        Swal.fire({
            position: 'bottom-mid',
            icon: icon,
            title: message,
            showConfirmButton: false,
            timer: time
        });
    }
    
    
});