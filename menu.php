<!-- MENU.PHP -->
<?php 
include("clases/clsAdmin.php");
$objAdmin = new clsAdmin();
?>
<!-- <nav class="navbar fixed-top navbar-light bg-light">
    <a class="navbar-brand" href="#">Fixed top</a>
  </nav> -->
  <div class="row">
    <div class="col-md-12">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark ">
        <a class="nav-link btn" href="index.php?p=inicio"><span class="fa fa-home fa-2x"></span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

          <!-- <button class="navbar-toggler nav-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <span class="navbar-toggler-icon"></span>
          </button> -->

          <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <!-- <a class="nav-link" href="index.php?p=inicio"><span class="fa fa-home"></span></a> -->
              </li>
              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opciones de usuario
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php 
                  if($_SESSION["usuario"]==""){
                    $objAdmin->devuelveMenuArbol($_SESSION["idUsuario"]); 
                  } else {
                    $objAdmin->devuelveMenu(); 
                  }
                  ?>
                </div>
              </li>
              <li class="nav-item active"><a class="nav-link" href="index.php?p=cambioContrasena">Cambiar mi contraseña</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php if($usu!=""){ ?>
                <li class="nav-item">
                  <a class="nav-link active" href="#" onClick="document.location.href='s.php'">Cerrar Sesión</a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </nav>
      </div>
    </div>
