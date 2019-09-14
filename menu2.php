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
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light ">
        <a class="nav-link btn" href="index.php?p=inicio"><span class="fa fa-home fa-2x"></span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
          <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
              <?php 
                $objAdmin->devuelveMenu2(); 
              ?>
              <li class="nav-item "><a class="nav-link" href="index.php?p=cambioContrasena"><span class="fas fa-key" aria-hidden="true"></span> Cambiar mi contraseña</a></li>
            </ul>
            <ul class="navbar-nav navbar-right">
              <?php if($usu!=""){ ?>
                <li class="nav-item">
                  <a class="nav-link " ><span class="fas fa-user" aria-hidden="true"></span> <?= trim($_SESSION["nombreUsuario"]);?></a>
                </li>
                <li class="nav-item">
                  <!-- <a class="nav-link " href="#" onClick="document.location.href='s.php'"><span class="fas fa-sign-out-alt" aria-hidden="true"></span> Cerrar Sesión de <?php echo $_SESSION["nombreUsuario"]; ?></a> -->
                  <a class="nav-link " href="#" onClick="document.location.href='s.php'"><span class="fas fa-sign-out-alt" aria-hidden="true"></span> Cerrar Sesión</a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </nav>
      </div>
    </div>
