<?php

Class PatologiaModel extends Model{
	function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
	}

	public function agregarPatologia($descripcion){
		$pato = array($descripcion);
		$statement = $this->conn->prepare("CALL EMD05PATIN(?)");
		$statement->bind_param("s", $descripcion);
		if(($statement->execute()) or die($this->conn->error)){
			echo "Exito";
		}
		else{
			echo "Fallo";
		}	
		$statement->close();
		$this->conn->close(); 
	}

	public function modificarPatologia($pat){
		$pato = array('id' => $pat['id'], 'descripcion' => $pat['descripcion']);
		$statement = $this->conn->prepare("CALL EMD05PATUP(?,?)");
		$statement->bind_param("is", $pato['id'], $pato['descripcion']);
		if(($statement->execute()) or die($this->conn->error)){
			echo "Exito";
		}
		else{
			echo "Fallo";
		}	
		$statement->close();
		$this->conn->close(); 
	}

	public function eliminarPatologia($id,$idp){
			$idPat = $id;
			$idPac = $idp;
			$statement = $this->conn->prepare("CALL EMD19HPTDE(?,?)");
			$statement->bind_param("is", $idPat,$idPac);
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

	public function getAll($id){
		$resultado = $this->conn->query("CALL EMD05PATVERI('$id')");
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'ID' => $data['EMD05IDPAT'],
					'Patologia' => $data['EMD05DESCPAT']);
		}
		echo json_encode($arreglo);
	}

	public function Buscar($id){
		$idPac = $id;
		$resultado = $this->conn->query("CALL EMD05PATLI('$idPac')");
		$patologia = $resultado->fetch_all(MYSQLI_ASSOC);
		return $patologia;
	}

	public function BuscarDia($id){
		$idPac = $id;	
		$resultado = $this->conn->query("CALL EMD05PATLI('$idPac')");
		$patologia = $resultado->fetch_all(MYSQLI_ASSOC);
		return $patologia;
	}

	public function agregarPatologiaList($pat){
		$statement = $this->conn->prepare("CALL EMD19HPTIN(?,?)");
		$statement->bind_param("is", $pat['patologia'], $pat['idPac']);
		if(($statement->execute()) or die($this->conn->error)){
			echo "Exito";
		}
		else{
			echo "Fallo";
		}
		$statement->close();
		$this->conn->close(); 
	}

	public function eliminarPatologiaList($pat){
		$statement = $this->conn->prepare("CALL EMD19HPTDE(?,?)");
		$statement->bind_param("is", $pat['patologia'], $pat['idPac']);
		if(($statement->execute()) or die($this->conn->error)){
			echo "Exito";
		}
		else{
			echo "Fallo";
		}
		$statement->close();
		$this->conn->close(); 
	}
}

?>