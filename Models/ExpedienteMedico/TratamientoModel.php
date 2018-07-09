<?php

	Class TratamientoModel extends Model{

		function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
		}
		public function agregarTratamiento($tratamiento){
			$di=2;
			$trata = array('idDia'=>$tratamiento['idDia'],'idPac'=>$tratamiento['idPac'],'Funcionario'=>$tratamiento['idFunc'],'nomTra' => $tratamiento['nomTra'],'descripcion' => $tratamiento['descripcion'], 'observaciones' => $tratamiento['observaciones']);
			$statement = $this->conn->prepare("CALL EMD09TRTIN(?,?,?,?,?,?,?)");
			
			$statement->bind_param("sssiiss", $trata['observaciones'],$trata['nomTra'],$trata['descripcion'],$di,$trata['idDia'],$trata['Funcionario'],$trata['idPac']);

			
			if(($statement->execute() or die($this->conn->error)) )
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
		}

		public function modificarTratamiento($tratamiento){
			$serv=2;
			$trata = array('idTrat'=>$tratamiento['idTrat'],'fecha'=>$tratamiento['fecha'],'indicaciones' => $tratamiento['indicaciones'],'nomPro'=>$tratamiento['nomPro'],'descripcion' => $tratamiento['descripcion'], 'idDia'=>$tratamiento['idDia'],'idFun' => $tratamiento['idFun']);
			$statement = $this->conn->prepare("CALL EMD09TRTUP(?,?,?,?,?,?,?)");
			
			$statement->bind_param("issssis",$trata['idTrat'],$trata['fecha'], $trata['descripcion'],$trata['nomPro'],$trata['indicaciones'],$serv,$trata['idFun']);
		
			if(($statement->execute() or die($this->conn->error)) )
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
		}

		public function eliminarTrataminto($id){

			$per = $id;
			$statement = $this->conn->prepare("CALL EMD09TRTDE(?)");
			$statement->bind_param("i", $id);
			$stmt = $this->conn->prepare("CALL EMD09TRTDE(?)");
			$stmt->bind_param("i", $id);
			if(($statement->execute() or die($this->conn->error)) && ($stmt->execute() 
				or die($this->conn->error)))
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
			$resultado = $this->conn->query("CALL EMD09TRTLI()");

			$per = $resultado->fetch_all(MYSQLI_ASSOC);

			return $per;
		}

		public function Buscar($idpac)
		{
			$id = $idpac;
			$resultado = $this->conn->query("CALL  EMD09TRTSE('$id')");
			while($fila = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array('Fecha' => $fila['EMD09FECHTRT'], 'Observaciones' => $fila['EMD09OBSETRT'], 'Nombre' => $fila['EMD09NOMBTRT'], 'Descripcion' => $fila['EMD09DESCTRT']);
			}
			echo json_encode($arreglo);
		}

		public function BuscarDia($idpac)
		{
			$id = $idpac;
			$resultado = $this->conn->query("CALL  EMD09TRTDI('$id')");
			$diagnostico = $resultado->fetch_all(MYSQLI_ASSOC);
			return $diagnostico;
		}
	
	}


?>