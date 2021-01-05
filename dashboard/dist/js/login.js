$(document).ready(() => {






    $("#loginForm").submit((e) => {
        e.preventDefault();
        let select = $("#selectLogin");
        let email = $("#email");
        let password = $("#password");

        console.log(email.val() + "  " + password.val());
        Connexion(email.val(), password.val(), select.val());

    });


    function Connexion(username, password, Role) {
        if (Role == 0) {
            $.ajax({
                type: "POST",
                url: "loginRequests/profLogin.php",
                data: { user: username, pass: password },
                dataType: "text",
                success: function (response) {
                    console.log(response);
                    if (response == "login") {

                        console.log("connexion Avec Success");
                        Swal.fire({
                            position: 'bottom-mid',
                            icon: 'success',
                            title: "Connexion Avec Success",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);

                    } else {
                        console.log("Nom d'utilisateur ou mot de passe incorrect");

                        Swal.fire({
                            position: 'bottom-mid',
                            icon: 'error',
                            title: "Nom d'utilisateur ou mot de passe incorrect",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        }
        else if (Role == 1) {
            $.ajax({
                type: "POST",
                url: "loginRequests/adminLogin.php",
                data: { user: username, pass: password },
                dataType: "text",
                success: function (response) {
                    if (response == "login") {

                        Swal.fire({
                            position: 'bottom-mid',
                            icon: 'success',
                            title: "Connexion Avec Success",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.reload();
                        }, 2100);

                    } else {
                        console.log("Nom D'utilisateur Ou Mot de passe incorrect");

                        Swal.fire({
                            position: 'bottom-mid',
                            icon: 'error',
                            title: "Nom d'utilisateur ou mot de passe incorrect",
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }
                }
            });
        }

    }

});