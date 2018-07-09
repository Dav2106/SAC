<?php 

Class ReportesModel extends Model{

	function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
	}

	public function buscarMasAtendido($fecha1,$fecha2){
		$resultado = $this->conn->query("CALL PacMasAten('$fecha1', '$fecha2')");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Cantidad' => $data['sum'],
					'ID' => $data['EMD01IDPAC'],
					'Nombre' => $data['EMD01NOMBPAC'],
					'Ape1' => $data['EMD01APE1PAC'],
					'Ape2' => $data['EMD01APE2PAC']
					);
		}
		echo json_encode($arreglo);
	}

	public function buscarMenosAtendido($fecha1,$fecha2){
		$resultado = $this->conn->query("CALL PacMenosAten('$fecha1', '$fecha2')");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'cantidad' => $data['count(EMD07IDDGN)'],
					'ID' => $data['EMD01IDPAC'],
					'Nombre' => $data['EMD01NOMBPAC'],
					'Ape1' => $data['EMD01APE1PAC'],
					'Ape2' => $data['EMD01APE2PAC']
					);
		}
		echo json_encode($arreglo);
	}

	public function buscarMasRecetado($fecha1,$fecha2){
		$resultado = $this->conn->query("CALL MedMasRec('$fecha1', '$fecha2')");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Cantidad' => $data['count(*)'],
					'Nombre' => $data['EMD09NOMBTRT']
					);
		}
		echo json_encode($arreglo);
	}

	public function buscarMenosRecetado($fecha1,$fecha2){
		$resultado = $this->conn->query("CALL MedMenosRec('$fecha1', '$fecha2')");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Cantidad' => $data['cantidad'],
					'Nombre' => $data['EMD09NOMBTRT']
					);
		}
		echo json_encode($arreglo);
	}

	public function buscarEnfMasComun($fecha1,$fecha2){
		$resultado = $this->conn->query("CALL EnfMasCom('$fecha1','$fecha2')");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Cantidad' => $data['cantidad'],
					'Nombre' => $data['EMD07DESCDGN']
					);
		}
		echo json_encode($arreglo);
	}

	public function buscarAtenyPag($fecha1,$fecha2){
		$resultado = $this->conn->query("CALL AtenYPaga('$fecha1','$fecha2')");
    
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Cantidad' => $data['count(EMD08IDDET)'],
					'IdPac' => $data['EMD08IDPADET'],
					'Costo' => $data['sum(EMD08COSTDET)'],
					'Nombre' => $data['EMD01NOMBPAC'],
					'fecha1' => $data['fecha1'],
					'fecha2' => $data['fecha2']
					);
		}
		echo json_encode($arreglo);
	}

	public function buscarDetaFact($fecha,$id){
		$resultado = $this->conn->query("CALL DetaFact('$fecha,$id')");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'IdPac' => $data['EMD08IDPADET'],
					'Nombre' => $data['EMD01NOMBPAC'],
					'Descripcion' => $data['EMD08DESCDET'],
					'Costo' => $data['EMD08COSTDET'],
					);
		}
		echo json_encode($arreglo);
	}

	public function buscarFechaEspecifica($fecha1,$fecha2){
		$resultado = $this->conn->query("CALL RepFechaEsp('$fecha1','$fecha2')");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Cantidad' => $data['Cantidad'],
					'Total' => $data['SUM(EMD17TOTACMP)'],
					'Fecha' => $data['EMD17FECHCMP'],
					'MetodoPago' => $data['total']
					);
		}
		echo json_encode($arreglo);
	}

	public function mostrarRanFecha($fecha1,$fecha2){
		$resultado = $this->conn->query("CALL RepRangFecha('$fecha1','$fecha2')");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Cantidad' => $data['Cantidad'],
					'Total' => $data['SUM(EMD17TOTACMP)'],
					'Fecha' => $data['total']
					);
		}
		echo json_encode($arreglo);
	}

	public function buscarReporteGeneral(){
		$resultado = $this->conn->query("CALL RepGeneral()");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Cantidad' => $data['Cantidad'],
					'Total' => $data['total'],
					'Fecha' => $data['fecha']
					);
		}
		echo json_encode($arreglo);
	}

	public function Hospitalizacion(){
		$resultado = $this->conn->query("CALL HistHospi()");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Id'=> $data['EMD01PAC_EMD01IDPAC'],
					'Nombre' => $data['nombre_completo'],
					'Causa'=> $data['EMD07DESCDGN'],
					'Tipo' => $data['EMD09TIPOTRT'],
					'NombreTra'=> $data['EMD09NOMBTRT'],
					'Fecha1' => $data['EMD11FEINHOS'],
					'fecha2' => $data['EMD11FESAHOS']
					);
				
		}
		echo json_encode($arreglo);
	}

	public function controlPorDia(){
		$resultado = $this->conn->query("CALL control_de_pago_por_dia()");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'Fecha'=> $data['fecha'],
					'Paciente' => $data['EMD01PAC_EMD01IDPAC'],
					'Nombre' => $data['EMD01NOMBPAC'],
					'Apellido1' => $data['EMD01APE1PAC'],
					'Apellido2' => $data['EMD01APE2PAC'],
					'Cantidad' => $data['cantidad'],
					'Total'=> $data['total'],
					'Detalle'=> $data['EMD12TISEHIC']
					);
				
		}
		echo json_encode($arreglo);
	}

	public function historialCli($id){
		$resultado = $this->conn->query("CALL histoClini('$id')");
  
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'ID'=> $data['EMD12IDHIC'],
					'Desc' => $data['EMD12DESCHIC'],
					'Diag' => $data['EMD07DGN_EMD07IDDGN'],
					'Fecha' => $data['EMD12DATEHIC'],
					'Tipo' => $data['EMD12TISEHIC'],
					'idPac' => $data['EMD12IDPAC']);
				
		}
		echo json_encode($arreglo);
	}	

	public function historialFin($id){
		$resultado = $this->conn->query("CALL HistorialFianciero('$id')");
  
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'ID'=> $data['EMD17IDCMP'],
					'Desc' => $data['EMD17DESCCMP'],
					'Total' => $data['total'],
					'Fecha' => $data['fecha'],
					'Pac' => $data['EMD01PAC_EMD01IDPAC']);
				
		}
		echo json_encode($arreglo);
	}
}
?>