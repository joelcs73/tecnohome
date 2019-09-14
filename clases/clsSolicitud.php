<?php
include_once 'clsConexion.php';
include_once 'funciones.php';
class jsonSolicitud{
	public $datSolicitud="";
    public $datPresupuesto="";
    public $datTotales="";
}

class clsSolicitud{
    private $NumeroDeOrden;
    private $FechaDeOrden;
    private $FechaDeVisita;
    private $NombreDelCliente;
    private $DireccionDelCliente;
    private $TelefonoDelCliente;
    private $CelularDelCliente;
    private $CorreoDelCliente;
    private $DescripcionDelProducto;
    private $MarcaDelProducto;
    private $ModeloDelProducto;
    private $SerieDelProducto;
    private $FallaDelProducto;
    private $DiagnosticoTecnico;
    private $Trabajo;
    private $IvaUtilizado;
    private $jsonTablaPresupuesto;

    public function getNumeroDeOrden(){return $this->NumeroDeOrden;} public function setNumeroDeOrden($_NumeroDeOrden){$this->NumeroDeOrden = $_NumeroDeOrden;}
    public function getFechaDeOrden(){return $this->FechaDeOrden;} public function setFechaDeOrden($_FechaDeOrden){$this->FechaDeOrden = $_FechaDeOrden;}
    public function getFechaDeVisita(){return $this->FechaDeVisita;} public function setFechaDeVisita($_FechaDeVisita){$this->FechaDeVisita = $_FechaDeVisita;}
    public function getNombreDelCliente(){return $this->NombreDelCliente;} public function setNombreDelCliente($_NombreDelCliente){$this->NombreDelCliente = $_NombreDelCliente;}
    public function getDireccionDelCliente(){return $this->DireccionDelCliente;} public function setDireccionDelCliente($_DireccionDelCliente){$this->DireccionDelCliente = $_DireccionDelCliente;}
    public function getTelefonoDelCliente(){return $this->TelefonoDelCliente;} public function setTelefonoDelCliente($_TelefonoDelCliente){$this->TelefonoDelCliente = $_TelefonoDelCliente;}
    public function getCelularDelCliente(){return $this->CelularDelCliente;} public function setCelularDelCliente($_CelularDelCliente){$this->CelularDelCliente = $_CelularDelCliente;}
    public function getCorreoDelCliente(){return $this->CorreoDelCliente;} public function setCorreoDelCliente($_CorreoDelCliente){$this->CorreoDelCliente = $_CorreoDelCliente;}
    public function getDescripcionDelProducto(){return $this->DescripcionDelProducto;} public function setDescripcionDelProducto($_DescripcionDelProducto){$this->DescripcionDelProducto = $_DescripcionDelProducto;}
    public function getMarcaDelProducto(){return $this->MarcaDelProducto;} public function setMarcaDelProducto($_MarcaDelProducto){$this->MarcaDelProducto = $_MarcaDelProducto;}
    public function getModeloDelProducto(){return $this->ModeloDelProducto;} public function setModeloDelProducto($_ModeloDelProducto){$this->ModeloDelProducto = $_ModeloDelProducto;}
    public function getSerieDelProducto(){return $this->SerieDelProducto;} public function setSerieDelProducto($_SerieDelProducto){$this->SerieDelProducto = $_SerieDelProducto;}
    public function getFallaDelProducto(){return $this->FallaDelProducto;} public function setFallaDelProducto($_FallaDelProducto){$this->FallaDelProducto = $_FallaDelProducto;}
    public function getDiagnosticoTecnico(){return $this->DiagnosticoTecnico;} public function setDiagnosticoTecnico($_DiagnosticoTecnico){$this->DiagnosticoTecnico = $_DiagnosticoTecnico;}
    public function getTrabajo(){return $this->Trabajo;} public function setTrabajo($_Trabajo){$this->Trabajo = $_Trabajo;}
    public function getIvaUtilizado(){return $this->IvaUtilizado;} public function setIvaUtilizado($_IvaUtilizado){$this->IvaUtilizado = $_IvaUtilizado;}
    public function getJsonTablaPresupuesto(){return $this->jsonTablaPresupuesto;} public function setJsonTablaPresupuesto($_jsonTablaPresupuesto){$this->jsonTablaPresupuesto = $_jsonTablaPresupuesto;}
   

    public function guardaSolicitud(){
        $oCon = new clsConexion();
        $oCon->abrir_conexion();
        // echo 'Fecha de visita:'.$this->getFechaDeVisita();
        // Se guarda la orden
        $this->guardaDatosDeLaOrden($oCon->obtener_conexion());

        // Se guarda el presupuesto
        $this->guardaPresupuesto($oCon->obtener_conexion(),2);
        $oCon->cerrar_conexion();
    }

    private function guardaDatosDeLaOrden($conexion){
        $strQuery="";
        if(existe('ordendeservicio','numeroDeOrden',$this->getNumeroDeOrden())==true){
            $strQuery = "
            UPDATE ordendeservicio set 
            fechaOrden = '".$this->getFechaDeOrden()."',
            fechaVisita = '".$this->getFechaDeVisita()."',
            nombreDelCliente = '".$this->getNombreDelCliente()."',
            direccionDelCliente = '".$this->getDireccionDelCliente()."',
            telefonoDelCliente = '".$this->getTelefonoDelCliente()."',
            celularDelCliente = '".$this->getCelularDelCliente()."',
            correoElectronicoDelCliente = '".$this->getCorreoDelCliente()."',
            descripcionDelProducto = '".$this->getDescripcionDelProducto()."',
            marcaDelProducto = '".$this->getMarcaDelProducto()."',
            modeloDelProducto = '".$this->getModeloDelProducto()."',
            serieDelproducto = '".$this->getSerieDelProducto()."',
            diagnostico = '".$this->getDiagnosticoTecnico()."',
            trabajoRealizado = '".$this->getTrabajo()."',
            fallaProducto = '".$this->getFallaDelProducto()."',
            ivaUtilizado = ".$this->getIvaUtilizado()." 
            where numeroDeOrden = ".$this->getNumeroDeOrden();
        } else {
            $strQuery = "
            INSERT INTO ordendeservicio (
                numeroDeOrden, 
                fechaOrden, 
                fechaVisita, 
                nombreDelCliente, 
                direccionDelCliente, 
                telefonoDelCliente, 
                celularDelCliente, 
                correoElectronicoDelCliente, 
                descripcionDelProducto, 
                marcaDelProducto, 
                modeloDelProducto, 
                serieDelProducto, 
                diagnostico, 
                trabajoRealizado, 
                fallaProducto, 
                ivaUtilizado) values (".
                    $this->getNumeroDeOrden().",
                    '".$this->getFechaDeOrden()."',
                    '".$this->getFechaDeVisita()."',
                    '".$this->getNombreDelCliente()."',
                    '".$this->getDireccionDelCliente()."',
                    '".$this->getTelefonoDelCliente()."',
                    '".$this->getCelularDelCliente()."',
                    '".$this->getCorreoDelCliente()."',
                    '".$this->getDescripcionDelProducto()."',
                    '".$this->getMarcaDelProducto()."',
                    '".$this->getModeloDelProducto()."',
                    '".$this->getSerieDelProducto()."',
                    '".$this->getDiagnosticoTecnico()."',
                    '".$this->getTrabajo()."',
                    '".$this->getFallaDelProducto()."',".
                    $this->getIvaUtilizado().")";
            
        }
        $respGuardaOrden = mysqli_query($conexion,$strQuery);
    }

    private function guardaPresupuesto($conexion){
        $strBorra = "delete from presupuesto where numeroDeOrden = ".$this->getNumeroDeOrden();
        mysqli_query($conexion,$strBorra);
        try {
            foreach($this->getJsonTablaPresupuesto() as $filaPpto){
                $c = 1;
                $strGuarda = "INSERT INTO presupuesto (numeroDeOrden,numeroDeParte,concepto,unidades,precio,subtotal) values (".$this->getNumeroDeOrden().",";
                $totalDeColumnas = sizeof($filaPpto);
                foreach($filaPpto as $dato) {
                    $strGuarda=$strGuarda."'".$dato."'";

                    if($c<$totalDeColumnas){
                        $strGuarda=$strGuarda.",";
                        $c++;
                    }
                }
                $strGuarda=$strGuarda.")";
                $respGuardaPresupuesto = mysqli_query($conexion,$strGuarda);
            }
        } catch (Exception $e){
            
        }
    }

    public function tablaDeSolicitudes($campoLink){
        $oCon = new clsConexion();
        $oCon->abrir_conexion();
        $strQuery = "call sp_listaDeSolicitudes";
        // Obtenemos el Query
        $resultado = mysqli_query($oCon->obtener_conexion(),$strQuery);

        // Obtener la información de cada campo
        $info_campo = mysqli_fetch_fields($resultado);
        echo '
        <table class="table table-sm table-hover table-active" style="font-size:12px">
            <thead>
                <tr>
                    ';
                    // Recorremos cada campo para obtener su nombre
                    foreach ($info_campo as $valor) {
                        $nombreDelCampo=$valor->name;
                        if ($nombreDelCampo==$campoLink){
                            echo '<th scope="col" class="text-center">'.$nombreDelCampo.'</th>
                            ';
                        } else {
                            echo '<th scope="col">'.$nombreDelCampo.'</th>
                            ';
                        }
                    }
                    echo '
                </tr>
            </thead>
            <tbody>';
                while($datSolicitud=mysqli_fetch_assoc($resultado)){
                    echo '
                    <tr>
                    ';
                    // Recorremos cada campo para obtener su nombre
                        foreach ($info_campo as $valor2) {
                            $nombreDelCampo2=$valor2->name;
                            if ($nombreDelCampo2==$campoLink){
                                echo '  <th class="text-center"><a href="#" class="text text-primary "><span class="refSolicitud page-link" atributo="'.$datSolicitud[$nombreDelCampo2].'">'.$datSolicitud[$nombreDelCampo2].'</span></a></th>
                    ';
                            } else {
                                echo '  <td>'.$datSolicitud[$nombreDelCampo2].'</td>
                    ';
                            }
                        }
                    echo '</tr>';
                }
            echo '
            </tbody>
        </table>';
    }

    public function registroDeSolicitudes(){
        $oCon = new clsConexion();
        $oCon->abrir_conexion();
        $strQuery = "call sp_listaDeSolicitudes";
        // Obtenemos el Query
        $resultado = mysqli_query($oCon->obtener_conexion(),$strQuery);

        while($datSolicitud=mysqli_fetch_assoc($resultado)){
            $montos ='';
            $falla = '';
            $diagnostico = '';
            $trabajo='';
            $diasTranscurridos='';
            if($datSolicitud["Total"]>0){
                $montos = '<strong>Subtotal:</strong>'.$datSolicitud["Subtotal"].'<strong> Iva:</strong>'.$datSolicitud["Iva"].'<strong> Total:</strong>'.$datSolicitud["Total"];
            }
            if($datSolicitud["Falla"]!=''){
                $falla = '<strong>Falla:</strong>'.$datSolicitud["Falla"].'</br>';
            }
            if($datSolicitud["Diagnostico"]!=''){
                $diagnostico = '<strong>Diagnóstico:</strong>'.$datSolicitud["Diagnostico"].'</br>';
            }
            if($datSolicitud["Trabajo a realizar"]!=''){
                $trabajo = '<strong>Trabajo a realizar:</strong>'.$datSolicitud["Trabajo a realizar"].'</br>';
            }
            if($datSolicitud["Estado"]=='Pendiente' && $datSolicitud["Dias"]>0){
                $diasTranscurridos = '<strong>'.$datSolicitud["Dias"].'</strong> '.($datSolicitud["Dias"]==1 ? 'día' : 'días');
            }
            // <button type="button" class="btn btn-primary btn-circle" id="btnCard" onclick="muestraSolicitud('.$datSolicitud["Orden"].')"><i class="fas fa-pencil-alt"></i></button>
            echo '
            <div class="col col-sm-12">
                <div class="card bg-light border-primary mb-1">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-sm-2">
                            <span class="badge badge-pill badge-dark" >Orden '.$datSolicitud["Orden"].'</span>
                            </div>
                            <div class="col col-sm-10" align="right">
                                '.$datSolicitud["Fecha"].'
                            </div>
                        </div>
                        <div class="row">
                            <div class="col " align="right">
                                '.$montos.'
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-sm-10">
                                <h4 class="card-title">'.$datSolicitud["Cliente"].'</h4>
                            </div>
                            <div class="col col-sm-2" align="right">
                                <button type="button" class="btn btn-primary btn-circle" id="btnCard" onclick="muestraSolicitud('.$datSolicitud["Orden"].')"><i class="fas fa-pencil-alt"></i></button>
                            </div>
                        </div>
                        <p>'.$datSolicitud["Producto"].'</p>
                        <p class="card-text text-secondary">
                            '.$falla.'
                            '.$diagnostico.'
                            '.$trabajo.'
                        </p>  
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col " align="center">
                                <strong>Estado:</strong>'.$datSolicitud["Estado"].' '.$diasTranscurridos.'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }

    public function registroDeSolicitudesMini(){
        $oCon = new clsConexion();
        $oCon->abrir_conexion();
        $strQuery = "call sp_listaDeSolicitudes";
        // Obtenemos el Query
        $resultado = mysqli_query($oCon->obtener_conexion(),$strQuery);
        $row_cnt = $resultado->num_rows;
        if($row_cnt==0){
            echo '
            <div class="jumbotron">
            <h1 class="display-3">TECNOHOME</h1>
            <p class="lead">No se encontró ningún registro para mostrar.</p>
            <hr class="my-4">
            <p>Para iniciar una capturar haga clic</p>
            <p class="lead">
              <a class="btn btn-primary btn-sm" href="http://localhost/tecnohome/index.php?p=th_agregar.php" role="button">aquí</a>
            </p>
          </div>
            ';
        }
        while($datSolicitud=mysqli_fetch_assoc($resultado)){
            $montos ='';
            $diasTranscurridos='';
            if($datSolicitud["Total"]>0){
                $montos = '<strong>Subtotal:</strong>'.$datSolicitud["Subtotal"].'<strong> Iva:</strong>'.$datSolicitud["Iva"].'<strong> Total:</strong>'.$datSolicitud["Total"];
            }
            if($datSolicitud["Estado"]=='Pendiente' && $datSolicitud["Dias"]>0){
                $diasTranscurridos = '<strong>'.$datSolicitud["Dias"].'</strong> '.($datSolicitud["Dias"]==1 ? 'día' : 'días');
            }
            if ($datSolicitud["Estado"]=='Pendiente'){
                $color = "text-warning";
            } else {
                $color = "text-success";
            }
            echo '
                <div class="card bg-light border-default mb-2" align="left" style="max-width: 100%;">
                    <div class="card-header">
                        <div class="row">
                            <h5><strong class="'.$color.'">'.$datSolicitud["Cliente"].'</strong></h5>
                        </div>
                        <div class="row">
                            <p>Orden '.$datSolicitud["Orden"].' | '.$datSolicitud["Fecha"].'<br>
                            <strong>'.$datSolicitud["Producto"].'</strong><br>
                            '.$montos.'<br>
                            <strong>Estado:</strong>'.$datSolicitud["Estado"].' '.$diasTranscurridos.'</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col col-auto">
                                <button type="button" class="btn btn-secondary btn-circle" id="btnCard" onclick="muestraSolicitud('.$datSolicitud["Orden"].')"><i class="fas fa-search-plus"></i></button>
                            </div>
                            <div class="col col-auto">
                                <button type="button" class="btn btn-secondary btn-circle" id="btnCard" onclick="imprimirSolicitud('.$datSolicitud["Orden"].')"><i class="far fa-file-pdf"></i></button>
                            </div>
                            <!--<div class="col col-auto">
                                <button type="button" class="btn btn-secondary btn-circle" id="btnCard" onclick=""><i class="fas fa-pencil-alt"></i></button>
                            </div>-->
                        </div>
                    </div>
                </div>
            ';
        }
    }

    public function devuelveSolicitudJson($numeroDeOrden,$tabla){
        $oCon= new clsConexion();
        $oCon->abrir_conexion();

        $strQryConsulta = 'select * from '.$tabla.' where numeroDeOrden = '.$numeroDeOrden;
        
        $qryConsulta = mysqli_query($oCon->obtener_conexion(),$strQryConsulta);

        $arr = array();
        while($fila=mysqli_fetch_row($qryConsulta)){
            $arr[]=$fila;
        }
        return json_encode($arr);
        $oCon->cerrar_conexion();
    }

    public function devuelveSolicitudPresupuestoJson($numeroDeOrden){
        $oCon= new clsConexion();
        $oCon->abrir_conexion();
        $strQrySolicitud = "select * from ordendeservicio where numeroDeOrden = ".$numeroDeOrden;
        $strQryPresupuesto = "select * from presupuesto where numeroDeOrden = ".$numeroDeOrden;
        
        $sol = mysqli_fetch_array(mysqli_query($oCon->obtener_conexion(),$strQrySolicitud));
        $pres = mysqli_fetch_array(mysqli_query($oCon->obtener_conexion(),$strQryPresupuesto));

        $oSolicitudJson = new jsonSolicitud();

        $oSolicitudJson->datSolicitud = $sol;
        $oSolicitudJson->datPresupuesto = $pres;

        print json_encode($oSolicitudJson);
        $oCon->cerrar_conexion();
    }

    public function devuelveSolicitudPresupuestoArray($numeroDeOrden){
        $oCon= new clsConexion();
        $oCon->abrir_conexion();
        $strQrySolicitud = "
            SELECT
                idOrden, 
                numeroDeOrden, 
                date_format(fechaOrden,'%d-%m-%Y') as fechaOrden,
                date_format(fechaVisita,'%d-%m-%Y') as fechaVisita, 
                nombreDelCliente,
                direccionDelCliente,
                telefonoDelCliente,
                celularDelCliente,
                correoElectronicoDelCliente,
                descripcionDelProducto,
                marcaDelProducto,
                modeloDelProducto,
                serieDelProducto,
                diagnostico,
                trabajoRealizado,
                fallaProducto,
                ivaUtilizado,
                estado,
                DATEDIFF(CURDATE(), fechaOrden) as 'dias' from ordendeservicio where numeroDeOrden = ".$numeroDeOrden;
        
        $strQryTotales = "SELECT p.numeroDeOrden, SUM(p.subtotal) AS 'Subtotal', SUM(p.subtotal)*(c.porcentajeDeIva/100) AS 'Iva', SUM(p.subtotal)+(SUM(p.subtotal)*(c.porcentajeDeIva/100)) AS 'Total' FROM presupuesto p, configuracion c where p.numeroDeOrden = ".$numeroDeOrden." GROUP BY p.numeroDeOrden";
        $sol = mysqli_fetch_array(mysqli_query($oCon->obtener_conexion(),$strQrySolicitud));
        $tot = mysqli_fetch_array(mysqli_query($oCon->obtener_conexion(),$strQryTotales));

        $strQryPresupuesto = "select * from presupuesto where numeroDeOrden = ".$numeroDeOrden;
        $qryPres = mysqli_query($oCon->obtener_conexion(),$strQryPresupuesto);
        if($qryPres){
            while($dat=mysqli_fetch_array($qryPres)){
                $arr[]=$dat;
            }
        }

        $oSolicitudJson = new jsonSolicitud();

        $oSolicitudJson->datSolicitud = $sol;
        $oSolicitudJson->datPresupuesto = $arr;
        $oSolicitudJson->datTotales = $tot;

        $oCon->cerrar_conexion();
        return $oSolicitudJson;
    }
}
?>