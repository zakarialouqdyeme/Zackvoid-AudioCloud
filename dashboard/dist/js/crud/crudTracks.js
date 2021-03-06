$(document).ready(async () => {



    let vm = new Vue({
        el: "#TracksVue",
        data: { array: [] },
        methods: {
            update: function (item) {
                this.array.splice(0);
                this.array = item;
                if (item == null) {
                    this.array = [];
                }
                console.log("update");
            }
        }
    });

    
    let clickUploadOnce = true;


    function fetchTracksData() {

        $("#addopenModal").click(() => {
            $("#modal-add").modal();

        });



        $("#customFile").on("change", (e) => {

            let filename = $(e.target).val().replace(/C:\\fakepath\\/i, '');
            if ($(e.target).val() == "") {
                filename = getDefaultAudioLabelName();
            }
            $("#customFileLabel").text(filename);
        });

        $("#upload").unbind('click').bind("click", async () => {

            let title = $("#titleInp").val();
            let description = $("#description").val();
            let picture = await getCroppedImage();
            let isPicValid = picture != "data:,";
            let blobPic = await getCroppedBlob();
            let File = $("#customFile").val();
            let FileBlob = $("#customFile").get(0).files.item(0);
            if (title != "" && description != "" && isPicValid && checkIsAudio(File)) {
                if (clickUploadOnce) {
                    addTrack(title, description, blobPic, FileBlob, File);
                    clickUploadOnce = false;
                }
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
            success: async function (response) {


                if (response != "error") {
                    let data = JSON.parse(response);
                    await vm.update(data);
                    clickUploadOnce = true;

                    $(".edit").unbind('click').bind("click", async (e) => {
                        let id = $(e.currentTarget).data("idt");


                        $.ajax({
                            type: "POST",
                            url: "Requests/Tracks/getEditTrackModalData.php",
                            data: { id: id },
                            dataType: "text",
                            success: async function (response) {
                                let data = JSON.parse(response);
                                ResetTrackEditModal();

                                $("#imgPreviewEdit").attr("src", "data:image/png;base64," + data[0].image);
                                $("#titleInpEdit").val(data[0].title);
                                $("#descriptionEdit").val(data[0].description);
                                //$(".edit").attr("data-idt",data[0].idt);

                                $("#modal-edit").modal();

                                $("#editSubmit").unbind('click').bind("click", async (e) => {

                                    let picture = await getCroppedImageEdit();
                                    let blobPic = await getCroppedBlobEdit();
                                    let idt = data[0].idt;

                                    let title = $("#titleInpEdit").val();
                                    let description = $("#descriptionEdit").val();

                                    let isPicValid = picture != "data:,";
                                    //console.log(await getCroppedImageEdit());
                                    if (isPicValid && title != "" && description != "") {
                                        editTrackWithPic(idt, blobPic, title, description);
                                    }

                                    if (!isPicValid && title != "" && description != "") {
                                        editTrack(idt, title, description);
                                    }

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

                    $(".delete").unbind('click').bind("click", (e) => {
                        var id = $(e.currentTarget).data("idt");
                        var filename = $(e.currentTarget).data("filename");
                        Swal.fire({
                            title: "Confirm?",
                            text: "If you confirm the track will be deleted from the database",
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

    fetchTracksData();

    
    function deleteTrack(id, filename) {

        $.ajax({
            type: "POST",
            url: "Requests/Tracks/deleteTrack.php",
            data: { id: id, filename: filename },
            dataType: "text",
            success: function (response) {
                console.log(response);
                if (response == "DBDS") {
                    fetchTracksData();
                    showMessage("Track Delete Success", "success", 1500);
                } else {
                    showMessage("Track Delete Error", "error", 1500);
                }
            }
        });
    }

    function editTrackWithPic(idt, image, title, description) {
        var formData = new FormData();
        formData.append("idt", idt);
        formData.append("title", title);
        formData.append("description", description);
        formData.append("image", image);
        $.ajax({
            type: "POST",
            url: "Requests/Tracks/editTrackWithPic.php",
            data: formData,
            dataType: "text",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response == "Edit1") {
                    console.log(response);
                    fetchTracksData();

                    closeEditModal();
                }

            }
        });

    }

    function editTrack(idt, title, description) {

        $.ajax({
            type: "POST",
            url: "Requests/Tracks/editTrack.php",
            data: { idt: idt, title: title, description: description },
            dataType: "text",
            success: async function (response) {
                console.log(response);
                if (response == "Edit1") {

                    closeEditModal();
                    fetchTracksData();


                }
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
                       
                        updateProgressUpload(Math.round(percentComplete));
                        console.log(Math.round(percentComplete));
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

                    $("#modal-add").modal("hide");
                    closeUploadModal();
                    showMessage("Track Added", "success", 1500);
                }

            }
        }).done(function (e) {
            fetchTracksData();
        });
    }


    $("#addCoverImage").click(() => {
        $("#images").click();
    });

    image_crop = $('#upload-image').croppie({
        enableExif: true,
        viewport: {
            width: 300,
            height: 300,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
        },
        quality:1

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

    /* image_crop.on('update.croppie', function (ev, cropData) {

         console.log(getCroppedBlob()); 


    }); */

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
        resetAudioFileLabelName();

        image_crop.croppie('destroy');
        image_crop.data('cropper', null);


        $('#upload-image').hide();


        image_crop = $('#upload-image').croppie({

            enableExif: true,

            viewport: {
                width: 150,
                height: 150,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            }

        });

    }

    $("#editCoverImage").click(() => {
        $("#imagesEdit").click();
    });

    $('#imagesEdit').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            image_cropEdit.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
                $('.cr-slider').attr({ 'min': 0.3000, 'max': 1.5000 });
                $('#upload-image-edit').show();
                $("#imgPreviewEdit").hide();

            });
        }
        reader.readAsDataURL(this.files[0]);
    });

    image_cropEdit = $('#upload-image-edit').croppie({
        enableExif: true,
        viewport: {
            width: 300,
            height: 300,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
        },
        quality:1

    });

    $('#upload-image-edit').hide();

    function ResetTrackEditModal() {

        $("#titleInpEdit").val("");
        $("#descriptionEdit").val("");


        image_cropEdit.croppie('destroy');
        image_cropEdit.data('cropper', null);

        $("#imgPreviewEdit").show();
        $('#upload-image-edit').hide();


        image_cropEdit = $('#upload-image-edit').croppie({

            enableExif: true,

            viewport: {
                width: 300,
                height: 300,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            },
            quality:1

        });

    }

    async function getCroppedImageEdit() {
        return await image_cropEdit.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        });
    }
    async function getCroppedBlobEdit() {
        return await image_cropEdit.croppie('result', {
            type: 'blob',
            size: 'viewport'
        });
    }

    function openUploadModal() {

        updateProgressUpload(0);

        $(".modal-backdrop").show();
        $("#modal-upload").show();
        $("#modal-upload").modal({ backdrop: "static", keyboard: false });

    }


    function closeUploadModal() {

        $("#modal-upload").delay(2000).fadeOut(450);

        setTimeout(() => {
            $(".modal-backdrop").fadeOut();
        }, 2600);

        ResetTrackModal();

    }
    function closeEditModal() {

        $("#modal-edit").modal('hide');


    }
    
    function updateProgressUpload(val) {
        var bar2 = document.getElementById('progressUploadBar').ldBar;
        bar2.set(val,false);
    }

    function resetAudioFileLabelName() {
        $("#customFileLabel").text(getDefaultAudioLabelName());
    }

    function getDefaultAudioLabelName() {
        return "Choose Audio File";
    }

});