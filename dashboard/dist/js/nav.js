$(document).ready(async () => {
    $("#disconnect").click(() => {
        disconnect();
    });

    function disconnect() {
        $.ajax({
            type: "POST",
            url: "Requests/disconnect.php",
            dataType: "text",
            success: function (response) {
                window.location.reload();
            }
        });
    }



});