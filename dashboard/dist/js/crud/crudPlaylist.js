$(document).ready(async ()=>{

    let vm = new Vue({
        el: "#playlistVue",
        data: { array: [] },
        methods: {
            update: function (item) {
                this.array.splice(0);
                this.array = item;
                if (item == null) {
                    this.array = [];
                }
               
            }
        }
    });

    function fetchPlaylistData(){
        $.ajax({
            type: "POST",
            url: "Requests/Playlist/fetchPlaylistData.php",
            dataType: "text",
            success: async function (response) {
            
                if (response != "error") {
                    let data = JSON.parse(response);
                    console.log(data);
                    await vm.update(data);
                    clickUploadOnce = true;

                    $(".edit").click(async (e) => {
                        let id = $(e.currentTarget).data("idt");
                        $.ajax({
                            type: "POST",
                            url: "Requests/Tracks/getEditPlaylistModalData.php",
                            data: { id: id },
                            dataType: "text",
                            success: async function (response) {
                                let data = JSON.parse(response);
                                ResetTrackEditModal();
                                $("#imgPreviewEdit").attr("src", "data:image/png;base64," + data[0].image);
                                $("#titleInpEdit").val(data[0].title);
                                $("#descriptionEdit").val(data[0].description);
                                $("#modal-edit").modal();

                                $("#editSubmit").click(async (e) => {
                                   
                                  

                                    if (title == "") {
                                        $("#titleInpEdit").addClass("is-invalid");
                                    } else {
                                        $("#titleInpEdit").removeClass("is-invalid");
                                    }

                                    if (description == "") {
                                        $("#description").addClass("is-invalid");
                                    } else {
                                        $("#description").removeClass("is-invalid");
                                    }

                                });

                            }
                        });


                    });

                    $(".delete").click((e) => {
                        var id = $(e.currentTarget).data("idt");
                        var filename = $(e.currentTarget).data("filename");
                        Swal.fire({
                            title: "Confirm?",
                            text: "If you confirm the pl will be deleted from the database",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Confirmer",
                            cancelButtonText: "Annuller",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        }).then(function (e) {
                            if (e.isConfirmed) {

                                deleteTrack(id, filename);
                                fetchTracksData();

                            } else {
                                Swal.fire("Canceled", "Delete canceled", "error");
                            }
                        });

                    });


                } else if (response == "error") {
                    await vm.update(null);
                    //showMessage("Tracks not Found", "question", 1500);
                }
            }
        });
    }
    fetchPlaylistData();

});