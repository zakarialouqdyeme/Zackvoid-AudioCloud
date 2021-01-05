$(document).ready(async () => {

    let dataContainer = $("#dataContainer");



    function fetchProfsData() {
        $.ajax({
            type: "POST",
            url: "Requests/fetchProfsData.php",
            dataType: "text",
            success: function (response) {

                if (response != "error") {

                    dataContainer.html(response);

                    $(".colEdit1").on("input", (e) => {
                        let id = $(e.currentTarget).data("id");
                        let name = $(e.currentTarget).text();
                        console.log(id);
                        editProfName(id, name);
                    });

                    $("#addopenModal").click(() => {
                        $("#modal-add").modal();
                        fetchSchoolsData($("#selectSchool"));
                    });
                    $("#add").click(async () => {
                        let name = $("#nameInp").val();
                        let email = $("#InputEmail1").val();
                        let password = $("#passInp").val();
                        let school_id = $("#selectSchool").val();

                        let canAddEmail = await emailExists(email, -1);
                        let picture = await getCroppedImage();
                        let isPicValid = picture != "data:,";
                        let blobPic = await getCroppedBlob();
                        if (name != "" && password != "" && !canAddEmail && validateEmail(email) && isPicValid) {
                            addProf(name, email, password, school_id, blobPic);
                        }

                        if (canAddEmail || !validateEmail(email)) {
                            console.log("error");
                            $("#InputEmail1").addClass("is-invalid");
                        }
                        if (!isPicValid) {
                            console.log("picInvalid");
                            $("#addProfImage").addClass("btn-danger");
                            $("#addProfImage").removeClass("btn-info");
                        }
                        if (password == "") {
                            console.log("password Empty");
                            $("#passInp").addClass("is-invalid");
                        }
                        if (name == "") {
                            console.log("nameEmpty");
                            $("#nameInp").addClass("is-invalid");
                        }



                    });

                    $("#passInp").on("input", async (e) => {
                        if ($("#passInp").val() == "") {
                            console.log("password Empty");
                            $("#passInp").addClass("is-invalid");
                        } else {
                            $("#passInp").removeClass("is-invalid");
                        }
                    });

                    $("#nameInp").on("input", async (e) => {
                        if ($("#nameInp").val() == "") {
                            console.log("nameEmpty");
                            $("#nameInp").addClass("is-invalid");
                        } else {
                            $("#nameInp").removeClass("is-invalid");
                        }
                    });


                    $(".colEdit2").on("input", async (e) => {

                        let id = $(e.currentTarget).data("id");
                        let email = $(e.currentTarget).text();
                        let canEditEmail = await emailExists(email, id);

                        if (!canEditEmail && validateEmail(email)) {
                            //console.log(email);
                            $(".colEdit2[contenteditable]:focus").css({
                                "outline": "2px solid green"
                            });
                            editProfEmail(id, email);
                        } else {
                            $(".colEdit2[contenteditable]:focus").css({
                                "outline": "2px solid red"
                            });
                        }

                    });

                    $(".colEdit2").blur(async (e) => {
                        $(".colEdit2[contenteditable]").css({
                            "outline": "1px solid transparent"
                        });
                    });

                    $(".colEdit3").on("change", (e) => {
                        let id = $(e.currentTarget).data("id");
                        let school_id = $(e.currentTarget).val();
                        console.log(id + " " + school_id);
                        editProfschool(id, school_id);

                    });
                    $(".colEdit4").on("input", (e) => {
                        let id = $(e.currentTarget).data("id");
                        let password = $(e.currentTarget).text();
                        editProfpassword(id, password);

                    });

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
                                deleteProf(id);
                                fetchProfsData();
                                // console.log(e.isConfirmed)
                            } else {
                                Swal.fire("Annuller", "suppression Annuller", "error");
                            }
                        });

                    });
                }
            }
        });
    }

    fetchProfsData();

    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    async function emailExistsCheck(email, id) {
        let requestInit = {
            credentials: 'include',
            method: 'get',
        };

        let url = "Requests/checkEmail.php?email=" + email + "&id=" + id;
        let data = await fetch(url, requestInit);
        return data.text();
    }

    async function emailExists(email, id) {
        return await emailExistsCheck(email, id) == "true" ? true : false;
    }



    function deleteProf(id) {
        console.log(id);
        $.ajax({
            type: "POST",
            url: "Requests/deleteProf.php",
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
    function editProfpassword(id, password) {
        $.ajax({
            type: "POST",
            url: "Requests/editProfPassword.php",
            data: { id: id, password: password },
            dataType: "text",
            success: function (response) {
                console.log(response);
            }
        });
    }

    function editProfEmail(id, email) {
        $.ajax({
            type: "POST",
            url: "Requests/editProfEmail.php",
            data: { id: id, email: email },
            dataType: "text",
            success: function (response) {
                console.log(response);
            }
        });

    }
    function editProfschool(id, school_id) {
        $.ajax({
            type: "POST",
            url: "Requests/editProfSchool.php",
            data: { id: id, schoolId: school_id },
            dataType: "text",
            success: function (response) {
                console.log(response);
            }
        });

    }
    function addProf(name, email, password, school_id, picture) {

        var formData = new FormData();
        formData.append("name",name);
        formData.append("email",email);
        formData.append("password",password);
        formData.append("school_id",school_id);
       
        formData.append("picture",picture);
        $.ajax({
            type: "POST",
            url: "Requests/addProf.php",
            data: formData,
            processData: false,
            contentType: false,

            success: function (response) {
                console.log(response);
                if (response == "success") {
                    fetchProfsData();
                    $("#modal-add").modal("hide");
                    $("#InputEmail1").removeClass("is-invalid");
                    Swal.fire({
                        position: 'bottom-mid',
                        icon: 'success',
                        title: "Prof Ajouté Avec Succès",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            }
        });
    }
    function fetchSchoolsData(container) {

        $.ajax({
            type: "POST",
            url: "Requests/getSchoolData.php",
            dataType: "text",
            success: function (response) {
                container.html(response);
            }
        });

    }

    $("#addProfImage").click(() => {
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

    async function getCroppedImage() {
        return await image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        });
    }
    async function getCroppedBlob(){
        return await image_crop.croppie('result', {
            type: 'blob',
            size: 'viewport'
        });
    }

});