<?php

Class AgendaModel extends Model{
	function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
	}

	public function agregar($agenda){
			$agen = array('fecha' => $agenda['fecha'], 'tipo' => $agenda['tipo'],'observacion' => $agenda['observacion'], "idPac" => $agenda['idPac']);
			$statement = $this->conn->prepare("CALL EMD03CITIN(?,?,?,?)");
			$statement->bind_param("ssss", $agen['fecha'], $agen['tipo'], $agen['idPac'], $agen['observacion']);
			if(($statement->execute()) or die($this->conn->error)){
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
	}

	public function modificar($agenda){
			$agen = array('id' => $agenda['id'],'fecha' => $agenda['fecha'], 'tipo' => $agenda['tipo'],'observacion' => $agenda['observacion'], "idPac" => $agenda['idPac']);
			$statement = $this->conn->prepare("CALL EMD03CITUP(?,?,?,?,?)");
			$statement->bind_param("issss", $agen['id'], $agen['fecha'], $agen['tipo'], $agen['idPac'], $agen['observacion']);
			if(($statement->execute()) or die($this->conn->error)){
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
	}

	public function eliminar($id){
		$statement = $this->conn->prepare("CALL EMD03CITDE(?)");
		$statement->bind_param("i", $id);
		if(($statement->execute()) or die($this->conn->error)){
			echo "Exito";
		}
		else{
			echo "Fallo al eliminar";
		}	
		$statement->close();
		$this->conn->close(); 
	}

	public function getAll(){
		$resultado = $this->conn->query("CALL EMD03CITLIE()");
		$agenda = $resultado->fetch_all(MYSQLI_ASSOC);
		return $agenda;
	}
    
	public function getAllA(){
		$resultado = $this->conn->query("CALL EMD03CITLIA()");
		while($fila = mysqli_fetch_assoc($resultado)){
			$arreglo[] = array('ID' => $fila['EMD03IDCIT'],'Paciente' => $fila['emd01pac_EMD01IDPAC'],'Fecha' => $fila['EMD03FECHCIT'], 'Triage' => $fila['EMD03TRIACIT'], 'Observaciones' => $fila['EMD03OBSECIT'], 'Estado' => $fila['EMD03ESTACIT']);
		}
		echo json_encode($arreglo);
		return $resultado;
	}

	public function bListaEspera(){
		$resultado = $this->conn->query("CALL EMD03CITES()");
		
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo["data"][] = $data;
		}
		echo json_encode($arreglo);	
	}

	public function buscar($id,$fecha){
		$resultado = $this->conn->query("CALL EMD03CITSE('$id','$fecha')");
		while($fila = mysqli_fetch_assoc($resultado)){
			$arreglo[] = array('ID' => $fila['EMD03IDCIT'],'Cedula' => $fila['emd01pac_EMD01IDPAC'], 'Fecha' => $fila['EMD03FECHCIT']);
		}
		echo json_encode($arreglo);
	}
}

?>