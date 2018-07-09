<?php

	Class ServicioModel extends Model{

		function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
		}

		public function agregarServicio($servicio){
			$serv = array('direccion' => $servicio['direccion'],'Costo' => $servicio['Costo']);

			$statement = $this->conn->prepare("CALL EMD15SVRIN(?,?)");
			$statement->bind_param("ss",$serv['direccion'], $serv['Costo']);
			if($statement->execute() or die($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
		}

		public function modificarServicio($servicio){			
			$serv = array('id' => $servicio['id'], 'direccion' => $servicio['direccion'],'Costo' => $servicio['Costo']);

			$statement = $this->conn->prepare("CALL EMD15SVRUP(?,?,?)");
			$statement->bind_param("iss", $serv['id'], $serv['direccion'], $serv['Costo']);
			
			if(($statement->execute() or die($this->conn->error)))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
		}

		public function eliminarServicio($IdServicio){
			$serv = $IdServicio;
			$statement = $this->conn->prepare("CALL EMD15SVRDE(?)");
			$statement->bind_param("i", $IdServicio);
			if($statement->execute() or die($this->conn->error))
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
			$resultado = $this->conn->query("CALL EMD15SVRLI()");

			$serv = $resultado->fetch_all(MYSQLI_ASSOC);

			return $serv;
		}
	
	}


?>