<?php
session_start();
require_once(dirname(__FILE__).'/'.'../config.php');
if(isset($_SESSION["id"])) header("Location:../dashboard/dashboard.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo Config::$websiteName; ?> - LOGIN</title>
    <link rel="stylesheet" href="../dashboard/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../dashboard/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
    
    <link rel="stylesheet" href="../dashboard/dist/css/custom.css">
</head>

<body class="hold-transition login-page ">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b><?php  echo Config::$websiteName; ?></b></a>
            </div>
            <div class="card-body">
                <!-- <p class="login-box-msg">Connectez-vous pour démarrer votre session</p> -->

                <form id="loginForm" method="post">
                    <div class="input-group mb-3">
                        <input type="text" id="username" class="form-control" required placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" class="form-control" required placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Rester identifié
                                </label>
                            </div>
                        </div> -->
                        <!-- /.col -->
                        <!-- <div class="col-12 align-self-center">
                            <div class="form-group">
                                <select class="form-control select2" id="selectLogin" style="width: 100%;">
                                    <option selected="selected" value="0">Prof</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div> -->
                        <!-- /.col -->
                        <div class="col-12 align-self-center">
                            <button type="submit" class="btn btn-primary btn-block" id="connexionBtn">Log-in</button>
                        </div>

                        <!-- /.col -->
                    </div>
                </form>

                <!--  <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
                <!-- /.social-auth-links -->

                <!--   <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../dashboard/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dashboard/dist/js/adminlte.min.js"></script>
    <script src="../dashboard/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="js/login.js"></script>
</body>

</html>