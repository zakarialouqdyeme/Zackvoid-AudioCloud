$(document).ready(async () => {


    Array.prototype.next = function() {
        return this[this.current++];
    };
    Array.prototype.prev = function() {
        return this[this.current--];
    };
    Array.prototype.reset = function() {
       this.current = 0;
    };
    Array.prototype.current = 0;
    

    let vm = new Vue({
        el: "#playlistVue",
        data: { array: []},
        methods: {
            update: function (item) {
                this.array.splice(0);
                this.array = item;
                if (item == null) {
                    this.array = [];
                }

            },
            getTracks: function () {
                return this.array.next().tracks[0];
            },
            

        }
    });

    let vm2 = new Vue({
        el: "#tracksVue",
        data: { userTracks: [] },
        methods: {
            updateUserTracks: async function (item) {
                this.userTracks.splice(0);
                this.userTracks = item;
                if (item == null) {
                    this.userTracks = [];
                }

            },
            getUserTracks: function () {
                return this.userTracks;
            },
        }
    });

    async function fetchPlaylistData() {

        $("#addOpenModal").unbind("click").bind("click", async () => {
            let userTracks = await loadUserTracks();
            console.log(userTracks);
            await vm2.updateUserTracks(userTracks);
            $("#modal-addPlayList").modal();
        });


        $.ajax({
            type: "POST",
            url: "Requests/Playlist/fetchPlaylistData.php",
            dataType: "text",
            success: async function (response) {

                if (response != "error") {
                    let data = JSON.parse(response);
                    console.log(data);
                    await vm.update(data);

                    $("#addPlaylist").unbind("click").bind("click", () => {



                        let name = $("#nameInp").val();
                        let tracks = $("#tracks").val();

                        if (tracks.length != 0 && name != "") {
                            addPlaylist(tracks, name);
                        }

                        if (tracks.length == 0) {
                            $("#tracks").addClass("is-invalid");
                        } else {
                            $("#tracks").removeClass("is-invalid");
                        }

                        if (name == "") {
                            $("#nameInp").addClass("is-invalid");
                        } else {
                            $("#nameInp").removeClass("is-invalid");
                        }

                    });

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

                    $(".delete").unbind("click").on("click",async (e) => {
                        let id = $(e.currentTarget).data("idp");
                            
                       await Swal.fire({
                            title: "Confirm?",
                            text: "If you confirm the playlist will be deleted from the database",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Confirmer",
                            cancelButtonText: "Annuller",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        }).then(function (e) {
                            if (e.isConfirmed) {
                               
                                deletePlaylist(id);
                                

                            } else {
                                Swal.fire("Canceled", "Delete canceled", "error");
                            }
                        });

                    });


                } else if (response == "error") {
                    await vm.update(null);
                }
            }
        });
    }
    fetchPlaylistData();


    async function loadUserTracks() {
        let requestInit = {
            credentials: 'include',
            method: 'get',
        };

        let data = await fetch("Requests/Playlist/getUserTracks.php", requestInit);

        return data.json();
    }

    async function addPlaylist(tracks, name) {

        $.ajax({
            type: "POST",
            url: "Requests/Playlist/addPlaylist.php",
            data: { tracks: tracks, name: name },
            dataType: "text",
            success: function (response) {
                if (response == "success") {
                    fetchPlaylistData();
                    closeAddModal();
                }
            }
        });
    }
    async function deletePlaylist(id) {

        $.ajax({
            type: "POST",
            url: "Requests/Playlist/deletePlaylist.php",
            data: { id : id },
            dataType: "text",
            success: function (response) {
               
                if (response == "success") {
                    vm.update(null)
                    fetchPlaylistData();
                }
            }
        });
    }

    function resetAddModal(){
        $("#nameInp").val("");
        vm2.updateUserTracks(null);
    }
    function closeAddModal(){
        resetAddModal();
        $("#modal-addPlayList").modal('hide');
    }

});