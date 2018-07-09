<?php

Class ExamenModel extends Model{
	function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
	}

	public function agregarExamen($examen1){
			$examen = array('descripcion' => $examen1['descripcion'],'fecha' => $examen1['fechadiagnostico'], 'tipo' => $examen1['tipoex'],'iddiag'=>$examen1["ididag"]);
			$serv = 3;
			$statement = $this->conn->prepare("CALL EMD10EXMIN(?,?,?,?)");
			$statement->bind_param("ssis", $examen['descripcion'], $examen['fecha'],$examen['iddiag'],$examen['tipo']);
			if(($statement->execute()) or die($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
	}

	public function modificarExamen($examen1){
			$examen = array('idExamen' => $examen1['idExamen'],'descripcion' => $examen1['descripcion'],'fecha' => $examen1['fechadiagnostico'], 'resultado' => $examen1['resultado'], 'tipo' => $examen1['tipoex'],'iddiag'=>$examen1["ididag"]);
			$serv = 3;
			$statement = $this->conn->prepare("CALL EMD10EXMUP(?,?,?,?,?,?)");
			$statement->bind_param("isssis", $examen['idExamen'], $examen['descripcion'], $examen['resultado'], $examen['fecha'],$examen['iddiag'],$examen['tipo']);
			if(($statement->execute()) or die($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); ; 
	}

	public function eliminarExamen($id){
			$idPac = $id;
			$statement = $this->conn->prepare("CALL EMD10EXMDE(?)");
			$statement->bind_param("i", $idPac);
			if(($statement->execute()) or die($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo al eliminar";
			}	
		$statement->close();
		$this->conn->close(); 
	}

	public function getAll(){
			$resultado = $this->conn->query("CALL EMD07DGNLI");
			$diagnostico = $resultado->fetch_all(MYSQLI_ASSOC);
			return $diagnostico;
	}

	public function Buscar($id){
		$idPac = $id;
		$resultado = $this->conn->query("CALL EMD10EXMSE('$idPac')");
		while($fila = mysqli_fetch_assoc($resultado)){
			$arreglo[] = array('Descripcion' => $fila['EMD10DESCEXM'], 'Resultado' => $fila['EMD10RESUEXM'], 'Fecha' => $fila['EMD10FECHEXM'], 'Tipo' => $fila['EMD10TIPOEXM']);
		}
		echo json_encode($arreglo);
	}

	public function BuscarDia($id){
		$idPac = $id;
		$resultado = $this->conn->query("CALL EMD10EXMDI('$idPac')");
		$examen = $resultado->fetch_all(MYSQLI_ASSOC);
		return $examen;
	}

	public function BuscarPend($id){
		$idPac = $id;
		$resultado = $this->conn->query("CALL EMD10EXAUL('$idPac')");
		$examen = $resultado->fetch_all(MYSQLI_ASSOC);
		return $examen;
	}

	public function buscarUltExam($idPa){
		$resultado = $this->conn->query("CALL EMD10EXAUL('$idPa')");
		$count = mysqli_num_rows($resultado);
		if($count > 0){
			while ($fila = mysqli_fetch_assoc($resultado)){
			$id = $fila['EMD01PAC_EMD01IDPAC'];
			$nombre = $fila['EMD01NOMBPAC'];
			$diag = $fila['EMD07DESCDGN'];
			$idDiag = $fila['EMD07DGN_EMD07IDDGN'];
			$hosp = array('id' => $id, 'nombre' => $nombre, 'dgn' => $diag, 'idDiag' => $idDiag);
			}
			return $hosp;
		}else{
			return 0;
		}  
	}
}

?>