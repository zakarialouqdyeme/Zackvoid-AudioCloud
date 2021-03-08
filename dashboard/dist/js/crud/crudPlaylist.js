$(document).ready(async () => {


    Array.prototype.next = function () {
        return this[this.current++];
    };
    Array.prototype.prev = function () {
        return this[this.current--];
    };
    Array.prototype.reset = function () {
        this.current = 0;
    };
    Array.prototype.current = 0;


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
                if (response != "error") {
                   // console.log(response);
                    let data = JSON.parse(response);

                   // console.log(data);
                    await vm.update(data);



                    $(".edit").unbind("click").bind("click", async (e) => {
                        let id = $(e.currentTarget).data("idp");

                        $.ajax({
                            type: "POST",
                            url: "Requests/Playlist/getEditPlaylistModalData.php",
                            data: { id: id },
                            dataType: "text",
                            success: async function (response) {
                                let data = JSON.parse(response);
                                //console.log(data);
                                ResetPlaylistEditModal();

                                $("#nameInpEdit").val(data.name);
                                let userTracks = await loadUserTracks();

                                userTracks.forEach(elem => {



                                    if (searchSelectedTracks(data.tracks[0], elem)) {

                                        $("#playlistEditSelect").append(`<option selected = true value = '${elem.idt}'>${elem.title}</option>`);
                                    }
                                    else {
                                        $("#playlistEditSelect").append(`<option  value = '${elem.idt}'>${elem.title}</option>`);
                                    }



                                });


                                $("#modal-editPlayList").modal();


                                $("#editSubmit").unbind("click").bind("click", async (e) => {
                                   // console.log($("#playlistEditSelect").val());
                                    editPlaylist(id, $("#nameInpEdit").val(), $("#playlistEditSelect").val());

                                });

                            }
                        });


                    });

                    $(".delete").unbind("click").on("click", async (e) => {
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
                    console.log("error");
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
            data: { id: id },
            dataType: "text",
            success: function (response) {

                if (response == "success") {
                    vm.update(null)
                    fetchPlaylistData();
                }
            }
        });
    }

    function resetAddModal() {
        $("#nameInp").val("");
        vm2.updateUserTracks(null);
    }
    function closeAddModal() {
        resetAddModal();
        $("#modal-addPlayList").modal('hide');
    }

    function ResetPlaylistEditModal() {
        $("#playlistEditSelect").html("");
        $("#nameInpEdit").val("");
    }

    function searchSelectedTracks(arr, elem) {
        for (let i = 0; i < arr.length; i++) {
            if (arr[i].idt == elem.idt) {
                return true
            }
        }
    }
    async function editPlaylist(id, newTitle, newTracks) {
        $.ajax({
            type: "POST",
            url: "Requests/Playlist/editPlaylist.php",
            data: { id: id, title: newTitle, tracks: newTracks },
            dataType: "text",
            success: function (response) {
                console.log(response);
                if (response == "Edit1") {
                    fetchPlaylistData();
                    closeEditPlaylistModal();
                }
            }
        });

    }

    function closeEditPlaylistModal() {
        $("#modal-editPlayList").modal('hide');
    }

});