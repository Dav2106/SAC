<?php

Class HospitalizacionModel extends Model{
	function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
	}
	
	public function agregarHospitalizacion($hos){
		$hospi = array('idPac' => $hos['idPac']);
		$id = $hos['idPac'];
			$serv = 4;
			$statement = $this->conn->prepare("CALL EMD11HOSIN(?)");
			$statement->bind_param("s", $hospi['idPac']);
			if(($statement->execute()) or die($this->conn->error))
			{
				$resultado = $this->conn->query("CALL EMD11HOSDI('$id')");
			
				while ($fila = mysqli_fetch_assoc($resultado)){
					$idHosp = $fila['EMD11IDHOS'];
					$fechIn = $fila['EMD11FEINHOS'];
					$fechFin = $fila['EMD11FESAHOS'];
					$idDGN = $fila['EMD07DGN_EMD07IDDGN'];
					
					$arrayName = array('idHosp' => $idHosp, 'fechIn' => $fechIn,'fechFin'=>$fechFin,'diag'=>$idDGN);	
				}
				return $arrayName;
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
	}

	public function finalizar($idHosp, $id)
	{
		$idhos = $idHosp;
		$statement = $this->conn->prepare("CALL EMD11HOSFI(?)");
		$statement->bind_param("i", $idhos);
		if(($statement->execute()) or die($this->conn->error))
			{
				$resultado = $this->conn->query("CALL EMD11HOSDI('$id')");
			
				while ($fila = mysqli_fetch_assoc($resultado)){
					$idHosp = $fila['EMD11IDHOS'];
					$fechIn = $fila['EMD11FEINHOS'];
					$fechFin = $fila['EMD11FESAHOS'];
					$idDGN = $fila['EMD07DGN_EMD07IDDGN'];
					
					$arrayName = array('idHosp' => $idHosp, 'fechIn' => $fechIn,'fechFin'=>$fechFin,'diag'=>$idDGN);	
				}
				return $arrayName;
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 

	}

	public function eliminarHospitalizacion($id){//en uso
			$idHos = $id;
			$statement = $this->conn->prepare("CALL EMD11HOSDE(?)");
			$statement->bind_param("i", $idHos);
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

	public function Buscar($id)//en uso
	{
		$idpac = $id;
		$resultado = $this->conn->query("CALL EMD11HOSDI('$idpac')");
		while ($fila = mysqli_fetch_assoc($resultado)){
			$idHosp = $fila['EMD11IDHOS'];
			$fechIn = $fila['EMD11FEINHOS'];
			$fechFin = $fila['EMD11FESAHOS'];
			$idDGN = $fila['EMD07DGN_EMD07IDDGN'];
			
			$arrayName = array('idHosp' => $idHosp, 'fechIn' => $fechIn,'fechFin'=>$fechFin,'diag'=>$idDGN);
			
		}
		return $arrayName;
	}
	//Observaciones

	public function agregarObsHospi($hosOB){//en uso
		$hospiOB = array('descob' => $hosOB['descob'],'idDiagMo' => $hosOB['idDiagMo'],'idHosP' => $hosOB['idHosP']);
			$serv = 4;
			$statement = $this->conn->prepare("CALL EMD20OBIN(?,?,?)");
			$statement->bind_param("sii", $hospiOB['descob'], $hospiOB['idDiagMo'],$hospiOB['idHosP']);
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

	public function modificarObsHospi($hosOB){//en uso
		$hospiOB = array('id' => $hosOB['id'],
						 'descob' => $hosOB['descob']);
		
			$statement = $this->conn->prepare("CALL EMD20OBHOSUP(?,?)");
			$statement->bind_param("is",  $hospiOB['id'],$hospiOB['descob']);
			if(($statement->execute()) or die($this->conn->error))
			{
					echo "exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
	}

		public function eliminarOBHospitalizacion($id){//en uso
			$idHosOB = $id;
			$statement = $this->conn->prepare("CALL EMD20OBSDE(?)");
			$statement->bind_param("i", $idHosOB);
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

	public function BuscarObsHospi($idPa)//en uso
	{	
		$idpac = $idPa;
		$resultado = $this->conn->query("CALL EMD20OBHOSSE('$idpac')");
		$Obshospitalizacion = $resultado->fetch_all(MYSQLI_ASSOC);
		return $Obshospitalizacion;
	}

	public function buscarUltHosp($idPa){
		$resultado = $this->conn->query("CALL EMD11HOSUL('$idPa')");
		$count = mysqli_num_rows($resultado);
		if($count > 0){
			while ($fila = mysqli_fetch_assoc($resultado)){
			$id = $fila['EMD01IDPAC'];
			$nombre = $fila['EMD01NOMBPAC'];
			$diag = $fila['EMD07DESCDGN'];
			$idDiag = $fila['EMD07IDDGN'];
			$idHos = $fila['EMD11IDHOS'];
			$hosp = array('id' => $id, 'nombre' => $nombre, 'dgn' => $diag, 'idDiag' => $idDiag, 
				'idHos' => $idHos);
			}
			return $hosp;
		}else{
			return 0;
		}
	}

	public function BuscarHis($id){
		$idPac = $id;
		$resultado = $this->conn->query("CALL HistHospi('$idPac')");
		while($fila = mysqli_fetch_assoc($resultado)){
			$arreglo[] = array('Id' => $fila['EMD01PAC_EMD01IDPAC'], 'nombre' => $fila['nombre_completo'], 'descdgn' => $fila['EMD07DESCDGN'], 'desctrt' => $fila['EMD09DESCTRT'], 'nombretrt' => $fila['EMD09NOMBTRT'], 'fechaen' => $fila['EMD11FEINHOS'], 'fechasa' => $fila['EMD11FESAHOS']);
		}
		echo json_encode($arreglo);
	}
}

?>