<?php
session_start();
require_once(dirname(__FILE__)."/".'../config.php');
if(!isset($_SESSION["id"])) header('Location:login.php'); 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php if(true) echo Config::$websiteName ?> - Playlists
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
              <h1>Playlists</h1>
            </div>
            <div class="col-sm-6">

            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- /.modal add -->
        <div class="modal fade" id="modal-addPlayList">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Playlist</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <div class="form-group">
                  <label for="nameInp">Name:</label>
                  <input type="text" class="form-control" id="nameInp" placeholder="Playlist Name">
                </div>
                <div class="form-group">
                <label>Tracks:</label>
                             <select multiple = "" class = "form-control" id="tracks" >
                               <option value="1">test</option>
                               <option value="2">test</option>
                               <option value="3">test</option>
                               <option value="4">test</option>
                               <option value="5">test</option>
                               <option value="6">test</option>
                               <option value="7">test</option>
                             </select>
                             <small class="form-text text-muted">Note: hold ctrl or cmd for multiple choice.</small>
                           </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addPlaylist">Add</button>
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
            <button type="button" class="btn  btn-outline-primary btn-sm" id="addOpenModal">Add Playlist</button>

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
                    <h3 class="card-title">PlayLists</h3>

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

                          <th>Nom</th>
                          <th>Tracks</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody  id="playlistVue">
                        <tr v-for = "data in array">

                          <td>{{data.name}}</td>
                          <td>
                            <div class="form-group">
                             
                              <select multiple = "" class = "form-control" disabled>
                                <option v-for = "data in getTracks()">{{data.title}}</option>
                              </select>
                            </div>
                          </td>
                  </div>

                  <td>
                    <button type="button" class="btn btn-outline-danger btn-sm supprimer">supprimer</button>
                    <button type="button"class="btn btn-outline-info btn-sm edit" v-bind:data-idt="data.idp">Edit</button>
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
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script src="https://unpkg.com/vue/dist/vue.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="dist/js/crud/crudPlaylist.js"></script>
  <script src="dist/js/crud/globalScript.js"></script>
  <?php
 include 'includes/GlobalScripts.php';
 ?>
</body>

</html>