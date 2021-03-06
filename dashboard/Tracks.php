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
    <link rel="stylesheet" href="plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="plugins/bootstrap-slider/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" type="text/css" href="dist/css/loading-bar.css"/>
   
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

                                <div class="row">
                                    <div class="col-12">
                                        <div id="upload-image"></div>
                                    </div>
                                    <div class="col-12">
                                        <input type="file" id="images" style="display: none;">
                                    </div>
                                    <div class="col-12 text-center mb-2">
                                        <button class="btn btn-info crop_image margin-auto" id="addCoverImage">COVER
                                            IMAGE</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="titleInp">Track Title</label>
                                    <input type="text" class="form-control" id="titleInp" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="email" class="form-control" id="description" placeholder="Description">
                                </div>

                                <div class="form-group">
                                    <label>Select your track file</label>
                                    <div class="custom-file">

                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" id="customFileLabel" for="customFile">Choose Audio File</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="upload">Upload</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal add -->
<!-- /.modal upload -->
<div class="modal fade" id="modal-upload" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Uploading</h4>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="col-sm-12 p-5">
                    <div class="ldBar" id="progressUploadBar"  data-value="0" data-preset="circle" >
                    </div>
                </div>
                </div>
            <div class="modal-footer justify-content-between">
                
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal upload -->
               

<!-- /.modal edit -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Edit Track</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    
                    <div class="col-12 text-center mb-1">
                        <label for="titleInpEdit">Current cover image</label>
                    </div>
                    <div class="col-12 text-center mb-3">
                        <img src="" id="imgPreviewEdit" class="img-thumbnail">
                    </div>
                    <div class="col-12">
                        <div id="upload-image-edit"></div>
                    </div>
                    <div class="col-12">
                        <input type="file" id="imagesEdit" style="display: none;">
                    </div>
                    <div class="col-12 text-center mb-2">
                        <button class="btn btn-info crop_image margin-auto" id="editCoverImage">COVER
                            IMAGE</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="titleInpEdit">Track Title</label>
                    <input type="text" class="form-control" id="titleInpEdit" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="descriptionEdit">Description</label>
                    <input type="email" class="form-control" id="descriptionEdit" placeholder="Description">
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editSubmit">Edit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal edit -->

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
                                        <h3 class="card-title">Tracks List</h3>

                                        <div class="card-tools">

                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Cover</th>
                                                    <th>title</th>
                                                    <th>Description</th>
                                                    <th>Audio</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="TracksVue">
                                                <tr v-for = "data in array">
                                                    <td spellcheck="false" class="colEdit1" v-bind:data-idt="data.idt">
                                                       {{data.idt}}
                                                    </td>
                                                    <td spellcheck="false" class="colEdit1">
                                                        <img v-bind:src="data.image" class="" style="width: 50px;">
                                                    </td>
                                                    <td spellcheck="false" class="colEdit1">
                                                        {{data.title}}</td>
                                                    <td spellcheck="false" class="colEdit2">
                                                        {{data.description}}
                                                    </td>
                                                    <td>
                                                        <audio controls>
                                                            <source v-bind:src="'../uploads/'+data.filename" type="audio/mpeg">
                                                          Your browser does not support the audio element.
                                                          </audio>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm delete" v-bind:data-idt="data.idt" v-bind:data-filename="data.filename">supprimer</button>
                                                        <button type="button"
                                                            class="btn btn-outline-info btn-sm edit" v-bind:data-idt="data.idt">Edit
                                                        </button>

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
    <script src="plugins/bootstrap-slider/bootstrap-slider.min.js">
    </script>
    <script src="https://unpkg.com/vue/dist/vue.min.js"></script>
    <script src="plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script type="text/javascript" src="dist/js/loading-bar.js"></script>
    <script src="dist/js/crud/globalScript.js"></script>
    <script src="dist/js/crud/crudTracks.js"></script>


    <?php
 include 'includes/GlobalScripts.php';
 ?>
</body>

</html>