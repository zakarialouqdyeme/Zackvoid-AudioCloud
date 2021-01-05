<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">
          <?php if(isset($_SESSION["role"]) && $_SESSION["role"]=="prof" )echo 'ESPACE PROF'; else echo 'ESPACE ADMIN'; ?>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        
          <img src="<?php if(isset($_SESSION["role"]) && $_SESSION["role"]=="prof") echo 'data:image/png;base64,'.base64_encode($_SESSION["picture"]); else echo 'dist/img/avatar5.png';?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php 
            
            if(isset($_SESSION["fullName"]) )echo $_SESSION["fullName"]; else if(isset($_SESSION["name"])) echo $_SESSION["name"];
            
            ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-header">Vos fonctionnalité</li>
               <?php 
               if($_SESSION["role"] == "admin"){
                   echo'
                   <li class="nav-item">
                   <a href="profs.php" class="nav-link" id="navProfs">
                     <i class="fas fa-chalkboard-teacher nav-icon"></i>
                     <p>Gérer les Profs</p>
                   </a>
                 </li>

                 <li class="nav-item">
                   <a href="schools.php" class="nav-link" id="navSchools">
                     <i class="fas fa-school nav-icon"></i>
                     <p>Gérer les ecole</p>
                   </a>
                 </li>
                 ';
               }else{
                   echo '<li class="nav-item">
                 <a href="statistique.php" class="nav-link" id="navStat">
                   <i class="fas fa-chart-line nav-icon"></i>
                   <p>Statistique des classes</p>
                 </a>
               </li>

               <li class="nav-item">
                 <a href="students.php" class="nav-link" id="navStudents">
                   <i class="fas fa-graduation-cap nav-icon"></i>
                   <p>Gérer les eleves</p>
                 </a>
               </li>

               <li class="nav-item">
               <a href="classes.php" class="nav-link" id="navClasses">
                 <i class="fas fa-users nav-icon"></i>
                 <p>Gérer les classes</p>
               </a>
             </li>

               <li class="nav-item">
                 <a href="correction.php" class="nav-link" id="navCorrection">
                   <i class="fas fa-check-circle nav-icon"></i>
                   <p>Correction</p>
                 </a>
               </li>
                   ';
               }
               
               ?>
              
               
               
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>