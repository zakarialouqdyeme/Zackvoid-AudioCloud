<?php
session_start();
require_once(dirname(__FILE__)."/".'../config.php');
if(!isset($_SESSION["id"])) header('Location:../Auth/login.php'); 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo Config::$websiteName ?> - Tracks
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php
 include 'includes/nav.php';
 ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
 include 'includes/sidebar.php';
 ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tracks</h1>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- /.modal add -->
                <div class="modal fade" id="modal-add">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">Add Track</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <!--  <div class="widget-user-image text-center">
                                    <img class="img-circle elevation-2" id="addProfImage" src="dist/img/user1-128x128.jpg"
                                        alt="User Avatar">
                                        <input type="file" name="" id="selectImageProf" style="display: none;">
                                </div> -->

                                <div class="row">
                                    <div class="col-12">
                                        <div id="upload-image"></div>
                                    </div>
                                    <div class="col-12">
                                        <input type="file" id="images" style="display: none;">
                                    </div>
                                    <div class="col-12 text-center mb-2">
                                        <button class="btn btn-info crop_image margin-auto" id="addProfImage">Photo de
                                            profile</button>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="nameInp">Nom complet</label>
                                    <input type="text" class="form-control" id="nameInp" placeholder="Nom complet">
                                </div>
                                <div class="form-group">
                                    <label for="addInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="InputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="passInp">Mot de passe</label>
                                    <input type="password" class="form-control" id="passInp" placeholder="mot de passe">
                                </div>
                                <div class="form-group">
                                    <label for="selectSchool">Ecole</label>
                                    <select class="custom-select" id="selectSchool">
                                        <!--   <option value="1">Value 1</option>
                    <option value="2">Value 2</option>
                    <option value="3">Value 3</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="add">Ajouter</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal add -->



                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn  btn-outline-primary btn-sm" id="addopenModal">Add
                            Track</button>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">



                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Liste des profs</h3>

                                        <div class="card-tools">
                                            <!-- <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div> -->
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>

                                                    <th>title</th>
                                                    <th>Email</th>
                                                    <th>password</th>

                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dataContainer">
                                                <tr>

                                                    <td contenteditable="true" spellcheck="false" class="colEdit1">
                                                        zakariae louqdyeme</td>
                                                    <td contenteditable="true" spellcheck="false" class="colEdit2">
                                                        zakarialouqdyeme@gmail.com</td>
                                                    <td contenteditable="true" spellcheck="false" class="colEdit3">
                                                        ecole1</td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm supprimer">supprimer</button>

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->

                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php
 include 'includes/footer.php';
 ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="dist/js/crud/crudTracks.js"></script>
    <script src="dist/js/crud/globalScript.js"></script>

    <?php
 include 'includes/GlobalScripts.php';
 ?>
</body>

</html>