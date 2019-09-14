<?php 
// include("conexion.php");
include_once "clsConexion.php";

class clsAdmin{

	public function devuelveMenu(){
		$oCon = new clsConexion();
		$oCon->abrir_conexion();
		$consulta = "
		SELECT
		m.idDiv,
		m.paginaHref,
		m.tituloMenu,
		m.iconoDelMenu 
		FROM
		admmenu m
		LEFT JOIN
		admusuariomenu um
		ON
		m.idMenu = um.idMenu
		WHERE
		um.idUsuario = ".$_SESSION["idUsuario"]." 
		ORDER BY m.orden";

		$qryMenu = mysqli_query($oCon->obtener_conexion(),$consulta);

		$prefijo = "";
		while($datMenu=mysqli_fetch_array($qryMenu)){
			$idDiv = substr($datMenu["idDiv"],0,3);
			if ($prefijo!=$idDiv){
				if ($prefijo!=""){
					echo '<div class="dropdown-divider"></div>';
				}
				$prefijo = $idDiv;
			}
			echo '<a class="dropdown-item" id="'.$datMenu["idDiv"].'" href="index.php?p='.$datMenu["paginaHref"].'"><span class="'.$datMenu["iconoDelMenu"].'" aria-hidden="true"></span> '.$datMenu["tituloMenu"].'</a>';
		}
		$oCon->cerrar_conexion();
	}

	public function devuelveMenu2(){
		$oCon = new clsConexion();
		$oCon->abrir_conexion();
		$consulta = "
		SELECT
		m.idDiv,
		m.paginaHref,
		m.tituloMenu,
		m.iconoDelMenu 
		FROM
		admmenu m
		LEFT JOIN
		admusuariomenu um
		ON
		m.idMenu = um.idMenu
		WHERE
		um.idUsuario = ".$_SESSION["idUsuario"]." 
		ORDER BY m.orden";

		$qryMenu = mysqli_query($oCon->obtener_conexion(),$consulta);

		$prefijo = "";
		while($datMenu=mysqli_fetch_array($qryMenu)){
			echo '<li class="nav-item "><a class="nav-link" id="'.$datMenu["idDiv"].'" href="index.php?p='.$datMenu["paginaHref"].'"><span class="'.$datMenu["iconoDelMenu"].'" aria-hidden="true"></span> '.$datMenu["tituloMenu"].'</a></li>';
		}
		$oCon->cerrar_conexion();
	}

	public function devuelveDiasParaFecha(){
		echo '<option value="00">Día</option>';
		echo '<option value="01">01</option>';
		echo '<option value="02">02</option>';
		echo '<option value="03">03</option>';
		echo '<option value="04">04</option>';
		echo '<option value="05">05</option>';
		echo '<option value="06">06</option>';
		echo '<option value="07">07</option>';
		echo '<option value="08">08</option>';
		echo '<option value="09">09</option>';
		echo '<option value="10">10</option>';
		echo '<option value="11">11</option>';
		echo '<option value="12">12</option>';
		echo '<option value="13">13</option>';
		echo '<option value="14">14</option>';
		echo '<option value="15">15</option>';
		echo '<option value="16">16</option>';
		echo '<option value="17">17</option>';
		echo '<option value="18">18</option>';
		echo '<option value="19">19</option>';
		echo '<option value="20">20</option>';
		echo '<option value="21">21</option>';
		echo '<option value="22">22</option>';
		echo '<option value="23">23</option>';
		echo '<option value="24">24</option>';
		echo '<option value="25">25</option>';
		echo '<option value="26">26</option>';
		echo '<option value="27">27</option>';
		echo '<option value="28">28</option>';
		echo '<option value="29">29</option>';
		echo '<option value="30">30</option>';
		echo '<option value="31">31</option>';
	}

	public function devuelveMesesParaFecha(){
		echo '<option value="0">Mes</option>';
		echo '<option value="01">ENE</option>';
		echo '<option value="02">FEB</option>';
		echo '<option value="03">MAR</option>';
		echo '<option value="04">ABR</option>';
		echo '<option value="05">MAY</option>';
		echo '<option value="06">JUN</option>';
		echo '<option value="07">JUL</option>';
		echo '<option value="08">AGO</option>';
		echo '<option value="09">SEP</option>';
		echo '<option value="10">OCT</option>';
		echo '<option value="11">NOV</option>';
		echo '<option value="12">DIC</option>';
	}

	public function devuelveAñosParaFecha(){
		echo '<option value="0">Año</option>';
		for($a=2030; $a>=1930; $a--){
			echo '<option value="'.$a.'">'.$a.'</option>';
		}
	}
	
}

?>