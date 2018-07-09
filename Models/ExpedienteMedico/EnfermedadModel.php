<?php

Class EnfermedadModel extends Model{
	function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
	}

	public function agregarEnfermedad($enf){
			$enfer = array('tipoEnfermedad' => $enf['tipoEnfermedad'], 
				'nombre' => $enf['nombre'],'IDPatologia' => $enf['IDPatologia']);
			$statement = $this->conn->prepare("CALL EMD06ENFIN(?,?,?)");
			$statement->bind_param("ssi", $enfer['tipoEnfermedad'], $enfer['nombre'], $enfer['IDPatologia']);
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

	public function modificarEnfermedad($enf){
			$enfer = array('id' => $enf['id'],  'tipoEnfermedad' => $enf['tipoEnfermedad'], 
			'nombre' => $enf['nombre'],	'IDPatologia' => $enf['IDPatologia']);
		$statement = $this->conn->prepare("CALL EMD06ENFUP(?,?,?,?)");
        $statement->bind_param("issi",$enfer['id'], $enfer['tipoEnfermedad'], $enfer['nombre'], $enfer['IDPatologia']);

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

	public function eliminarEnfermedad($id){
			$idE = $id;
			$statement = $this->conn->prepare("CALL EMD06ENFDE(?)");
			$statement->bind_param("s", $idE);
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
			$resultado = $this->conn->query("CALL EMD06ENFLI()");

			$enfermedad = $resultado->fetch_all(MYSQLI_ASSOC);

			return $enfermedad;
		}
}

?>