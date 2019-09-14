<?php
include_once './clases/clsSolicitud.php';
$oSol = new clsSolicitud();
?>
<h3 class="titulo" align="center">Registro</h3>
<div class="container" align="center">
<div class="row">
    <div class="col col-sm-12 align-self-center" id="registroDeSolicitudes">
        <?php $oSol->registroDeSolicitudesMini(); ?>
    </div>
</div>
</div>

<script>

function muestraSolicitud(numero){
    window.location = './index.php?p=solicitudMostrada&n='+numero;
}
</script>