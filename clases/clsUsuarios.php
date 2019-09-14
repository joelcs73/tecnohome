<?php 
include_once("clsConexion.php");
class clsUsuario{

public function listaDeUsuarios(){
		$oCon = new clsConexion();
		$oCon->abrir_conexion();

		$sql="select idUsuario, clave, nombreUsuario from admusuarios order by nombreUsuario ";
		$resultadoQry = mysqli_query($oCon->obtener_conexion(),$sql);
		echo '<table class="table table-hover table-sm table-striped">';
		echo '<tr>';
		echo 	'<th>Usuario</th>';
		echo 	'<th class="text-center">Edición</th>';
		echo 	'<th class="text-center">Permisos de menú</th>';
		echo 	'<th class="text-center">Eliminar</th>';
		echo '</tr>';
		while ($admusuarios=mysqli_fetch_assoc($resultadoQry)){
			$datos="'".
			$admusuarios["idUsuario"]."||".
			$admusuarios["clave"]."||".
			$admusuarios["nombreUsuario"]."'";

			echo '<tr class="usuario">';
			echo 	'<td><span class=" grpUsuarios">'.trim($admusuarios["nombreUsuario"]).'</span></td>';
			echo    '<td class="text-center"><button class="btn btn-outline-secondary" data-toggle="modal" data-target="#modalEditaUsuario" onclick="agregaDatosAlForm('.$datos.')"><i class="fa fa-pencil-alt"></i></button></td>';
			echo    '<td class="text-center"><button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalOpciones" onclick="agregaDatosAlFormOpciones('.$datos,')"><i class="fa fa-bars"></i></button></td>';
			if ($admusuarios["nombreUsuario"]==$_SESSION["nombreUsuario"]){ $oculto="invisible";} else {$oculto="";}
			echo    '<td class="text-center"><button class="btn btn-outline-danger '.$oculto.'" onclick="confirmaEliminaUsuario('.$datos.')"><i class="far fa-trash-alt"></i></button></td>';
			echo '</tr>';
		}
		echo '</table>';
		$oCon->cerrar_conexion();
	}

	public function guardaUsuario($idUsuario, $clave, $pwd, $nombreUsuario){
		$oCon = new clsConexion();
		$oCon->abrir_conexion();
		if($idUsuario!=0){
			if($pwd==""){
				$sql = "update admusuarios set clave='".$clave."', nombreUsuario = '".$nombreUsuario."' where idUsuario = ".$idUsuario;
			} else {
				$sql = "update admusuarios set clave='".$clave."', pwd='".md5($pwd)."', nombreUsuario = '".$nombreUsuario."' where idUsuario = ".$idUsuario;
			}
		} else {
			$sql = "insert into admusuarios (clave,pwd,nombreUsuario) values ('".$clave."','".md5($pwd)."','".$nombreUsuario."')";
		}
		mysqli_query($oCon->obtener_conexion(),$sql);
		$oCon->cerrar_conexion();
	}

	public function eliminaUsuario($idUsuario){
		$oCon = new clsConexion();
		$oCon->abrir_conexion();
		$sql1="delete from admusuarios where idUsuario=".$idUsuario;
		$sql2="delete from admusuariomenu where idUsuario=".$idUsuario;
		mysqli_query($oCon->obtener_conexion(),$sql2);
		mysqli_query($oCon->obtener_conexion(),$sql1);
		$oCon->cerrar_conexion();
	}

	public function LlenaOpcionesDeAcceso($idUsuario){
		$oCon = new clsConexion();
		$oCon->abrir_conexion();

		$strOpciones = "
			SELECT um.id, um.idMenu, m.tituloMenu
			FROM admusuariomenu um
			LEFT JOIN admmenu m ON um.idMenu = m.idMenu
			WHERE um.idUsuario = ".$idUsuario;

		$resultadoQry = mysqli_query($oCon->obtener_conexion(),$strOpciones);
		echo '<table class="table table-hover table-md table-striped" id="tablaOpciones">';
		while ($admUsuarioMenu = mysqli_fetch_assoc($resultadoQry)){
			$datos="'".
			$admUsuarioMenu["idMenu"]."||".
			$admUsuarioMenu["tituloMenu"]."||".
			$idUsuario."'";
			echo '<tr class="usuario" id="opcion'.$admUsuarioMenu["idMenu"].'">';
			echo 	'<td><span class=" grpUsuarios">'.trim($admUsuarioMenu["tituloMenu"]).'</span></td>';
			echo    '<td class="text-right"><button class="btn btn-danger" onclick="borraOpcion('.$datos.')"><span class="fa fa-times"></span></button></td>';
			echo '</tr>';
		}
		echo '</table>';
		$oCon->cerrar_conexion();
	}

	public function LlenaComboOpcionesDisponibles(){
		$oCon = new clsConexion();
		$oCon->abrir_conexion();
		$strOpc = "select idMenu, tituloMenu from admmenu order by tituloMenu";
		$qryOpc = mysqli_query($oCon->obtener_conexion(),$strOpc);
		while ($datOpc = mysqli_fetch_assoc($qryOpc)){
			echo "<option value=".$datOpc["idMenu"].">".$datOpc["tituloMenu"]."</option>";
		}
		$oCon->cerrar_conexion();
	}

	public function guardaUsuarioMenu($idUsuario,$idMenu,$accion){
		$oCon = new clsConexion(); $oCon->abrir_conexion();
		if($accion=="agregar"){
			$sql="insert into admusuariomenu (idUsuario,idMenu) values (".$idUsuario.",".$idMenu.")";
		} else if($accion=="eliminar"){
			$sql="delete from admusuariomenu where idusuario = ".$idUsuario." and idMenu = ".$idMenu;
		}
		mysqli_query($oCon->obtener_conexion(),$sql);
		$oCon->cerrar_conexion();
	}

	public function guardaContrasena($contrasena,$idUsuario){
		$oCon = new clsConexion(); $oCon->abrir_conexion();
		$sql = "update admusuarios set pwd = '".md5(trim($contrasena))."' where idUsuario = ".$idUsuario;
		$resultado = mysqli_query($oCon->obtener_conexion(),$sql);

		$aResultado = array();
		$aResultado["resultado"] = $resultado;
		$aResultado["cadena"] = $sql;

		print json_encode($aResultado);
		$oCon->cerrar_conexion();
	}

}

 ?>