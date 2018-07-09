<?php

Class DiagnosticoModel extends Model{
	function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
	}

	public function agregarDiagnostico($diag){
			$dia = array('fecha' => $diag['fecha'],'Descripcion' => $diag['Descripcion'], 'idServ' => $diag['idServ'], 'idFun' => $diag['idFun'],'idPac' => $diag['idPac']);
			
			$statement = $this->conn->prepare("CALL EMD07DGNIN(?,?,?,?,?)");
			$statement->bind_param("ssiss", $dia['fecha'], $dia['Descripcion'],$dia['idServ'],$dia['idFun'],$dia['idPac']);
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

	public function modificarDiagnostico($diag){
			$dia = array('id' => $diag['id'],'fecha' => $diag['fecha'],'Descripcion' => $diag['Descripcion'], 'idServ' => $diag['idServ'], 'idFun' => $diag['idFun'],'idPac' => $diag['idPac']);
			$idPac = $dia['idPac'];
			$statement = $this->conn->prepare("CALL EMD07DGNUP(?,?,?,?,?,?)");
			$statement->bind_param("ississ", $dia['id'], $dia['fecha'], $dia['Descripcion'], $dia['idServ'], $dia['idFun'], $dia['idPac']);
			if(($statement->execute()) or die($this->conn->error))
			{	
								
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
	}

	public function eliminarDiagnostico($id){
			$idPac = $id;
			
			$statement = $this->conn->prepare("CALL EMD07DGNDE(?)");
			$statement->bind_param("i", $id);
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

	public function buscar($id)
	{
		$idPac = $id;
		$resultado = $this->conn->query("CALL EMD07DGNSEDET('$idPac')");
		while($fila = mysqli_fetch_assoc($resultado)){ 
			$arreglo[] = array('Fecha' => $fila['EMD07FECHDGN'], 'Descripcion' => $fila['EMD07DESCDGN'], 'Tratamiento' => $fila['Tratamiento'], 'Examen' => $fila['Examen'], 'Hospitalizacion' => $fila['Hospitalizacion']);
		}
		echo json_encode($arreglo);
	}

	public function getLastDiag($id){
		$resultado = $this->conn->query("CALL EMD07DGNUL('$id')");

		while ($fila = mysqli_fetch_assoc($resultado)){
			$idDgn = $fila['EMD07IDDGN'];
			$desc = $fila['EMD07DESCDGN'];
			$id = $fila['EMD01PAC_EMD01IDPAC'];
			$datos = array("id" => $idDgn, "desc" => $desc, "cedula" => $id);
		}
		return $datos;
	}

	public function getPenLastDiag(){
		$resultado = $this->conn->query("CALL EMD07DGNPU()");

		while ($fila = mysqli_fetch_assoc($resultado)){
			$idDgn = $fila['EMD07IDDGN'];
		}
		return $idDgn;
	}

	public function buscarRangoFecha($id)
	{
		$idPac = $id;
		$resultado = $this->conn->query("CALL EMD07CONDIAG('$idPac')");
		$diagnostico = $resultado->fetch_all(MYSQLI_ASSOC);
		return $diagnostico;
	}

	public function atendido($id){
		$resultado = $this->conn->query("CALL EMD03CITCE('$id')");
	}
}
?>