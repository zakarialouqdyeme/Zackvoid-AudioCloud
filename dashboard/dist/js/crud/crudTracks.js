$(document).ready(async () => {

    function fetchTracksData() {

        $("#addopenModal").click(() => {
            $("#modal-add").modal();

        });
        $("#upload").click(async () => {

            let title = $("#titleInp").val();
            let description = $("#description").val();
            let picture = await getCroppedImage();
            let isPicValid = picture != "data:,";
            let blobPic = await getCroppedBlob();
            let File = $("#customFile").val();
            let FileBlob = $("#customFile").get(0).files.item(0);
            if (title != "" && description != "" && isPicValid && checkIsAudio(File)) {
                addTrack(title, description, blobPic, FileBlob, File);
            }
            if (!isPicValid) {
                console.log("picInvalid");
                $("#addCoverImage").addClass("btn-danger");
                $("#addCoverImage").removeClass("btn-info");
            } else {
                $("#addCoverImage").removeClass("btn-danger");
                $("#addCoverImage").addClass("btn-info");
            }

            if (title == "") {
                $("#titleInp").addClass("is-invalid");
            } else {
                $("#titleInp").removeClass("is-invalid");
            }

            if (description == "") {
                $("#description").addClass("is-invalid");
            } else {
                $("#description").removeClass("is-invalid");
            }


            if (!checkIsAudio(File)) {
                console.log("Please Try Choose a Audio File (MP3 OR WAV)");
                $("#customFile").addClass("is-invalid");

            } else {
                $("#customFile").removeClass("is-invalid");
            }

        });

        $.ajax({
            type: "POST",
            url: "Requests/Tracks/fetchTracksData.php",
            dataType: "text",
            success: function (response) {
                console.log(JSON.parse(response));
                if (response != "error") {

                    

                    $(".delete").click((e) => {
                        var id = $(e.currentTarget).data("id");
                        Swal.fire({
                            title: "Vous êtes sûr?",
                            text: "Voullez vous vraiment supprimer",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Confirmer",
                            cancelButtonText: "Annuller",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        }).then(function (e) {
                            if (e.isConfirmed) {
                                console.log(id);
                                deleteTrack(id);
                                fetchTracksData();
                                // console.log(e.isConfirmed)
                            } else {
                                Swal.fire("Annuller", "suppression Annuller", "error");
                            }
                        });

                    });
                } else {
                    showMessage("Tracks Load Error", "error", 1500);
                }
            }
        });
    }

    fetchTracksData();





    function deleteTrack(id) {
        console.log(id);
        $.ajax({
            type: "POST",
            url: "Requests/deleteTrack.php",
            data: { id: id },
            dataType: "text",
            success: function (response) {
                console.log(response);
            }
        });
    }

    function editProfName(id, name) {
        $.ajax({
            type: "POST",
            url: "Requests/editProfName.php",
            data: { id: id, name: name },
            dataType: "text",
            success: function (response) {
                console.log(response);
            }
        });

    }

    function addTrack(title, description, blobPic, File, FilePath) {

        var formData = new FormData();
        formData.append("title", title);
        formData.append("description", description);
        formData.append("cover", blobPic);
        formData.append("Audiofile", File);
        formData.append("AudiofilePath", FilePath);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    $("#modal-add").modal("hide");
                    openUploadModal();
                    if (evt.lengthComputable) {

                        var percentComplete = (evt.loaded / evt.total) * 100;

                        updateProgressUpload(percentComplete);

                        if (percentComplete >= 100) {

                            closeUploadModal();
                        }
                    }
                }, false);
                return xhr;
            },
            type: "POST",
            url: "Requests/Tracks/addTrack.php",
            data: formData,
            processData: false,
            contentType: false,

            success: function (response) {
                console.log(response);
                if (response == "success") {
                    fetchTracksData();
                    $("#modal-add").modal("hide");
                    closeUploadModal();
                    showMessage("Track Added", "success", 1500);
                }

            }
        });
    }


    $("#addCoverImage").click(() => {
        $("#images").click();
    });

    image_crop = $('#upload-image').croppie({
        enableExif: true,
        viewport: {
            width: 150,
            height: 150,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }

    });
    $('#upload-image').hide();

    $('#images').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            image_crop.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
                $('.cr-slider').attr({ 'min': 0.3000, 'max': 1.5000 });
                $('#upload-image').show();
                $("#addProfImage").removeClass("btn-danger");
                $("#addProfImage").addClass("btn-success");

            });
        }
        reader.readAsDataURL(this.files[0]);
    });

    image_crop.on('update.croppie', function (ev, cropData) {

        /* console.log(getCroppedBlob()); */


    });

    function showMessage(message, icon, time) {
        Swal.fire({
            position: 'bottom-mid',
            icon: icon,
            title: message,
            showConfirmButton: false,
            timer: time
        });
    }


    async function getCroppedImage() {
        return await image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        });
    }
    async function getCroppedBlob() {
        return await image_crop.croppie('result', {
            type: 'blob',
            size: 'viewport'
        });
    }

    function checkIsAudio(file) {
        var checkExtension = file.split('.').pop().toLowerCase();
        return jQuery.inArray(checkExtension, ['wav', 'mp3']) != -1;
    }



    function ResetTrackModal() {
        let title = $("#titleInp").val("");
        let description = $("#description").val("");
        let File = $("#customFile").val("");
        image_crop.croppie('destroy');
        image_crop.data('cropper',null);
        $('#upload-image').hide();
        image_crop = $('#upload-image').croppie({
            enableExif: true,
            viewport: {
                width: 150,
                height: 150,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
    
        });
        
    }

    function openUploadModal() {
        updateProgressUpload(0);
        $(".modal-backdrop").show();
        $("#modal-upload").show();
        $("#modal-upload").modal({ backdrop: "static", keyboard: false });
    }
    // openUploadModal();

    function closeUploadModal() {
        $("#modal-upload").delay(2000).fadeOut(450);
        setTimeout(() => {
            $(".modal-backdrop").fadeOut();
        }, 2600);
        ResetTrackModal();

    }
    function updateProgressUpload(val) {
        var bar2 = document.getElementById('progressUploadBar').ldBar;
        bar2.set(val);
    }



});