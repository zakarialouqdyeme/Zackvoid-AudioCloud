$(document).ready(() => {


    $("#loginForm").submit((e) => {
        e.preventDefault();
        let username = $("#username");
        let password = $("#password");

        //console.log(email.val() + "  " + password.val());
        Connexion(username.val(), password.val());

    });


    function Connexion(username, password) {
        
            $.ajax({
                type: "POST",
                url: "loginRequests/userLogin.php",
                data: { user: username, pass: password },
                dataType: "text",
                success: function (response) {
                    console.log(response);
                    if (response == "login") {

                        console.log("Login Success");
                        Swal.fire({
                            position: 'bottom-mid',
                            icon: 'success',
                            title: "Login Success",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);

                    } else {
                        console.log("Username or password incorrect");

                        Swal.fire({
                            position: 'bottom-mid',
                            icon: 'error',
                            title: "Username or password incorrect",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });
        
      

    }

});