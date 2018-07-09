<?php

	Class PacienteModel extends Model{

		function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
		}

		public function agregarPaciente($persona){
			$per = array('id' => $persona['id'], 'nombre' => $persona['nombre'], 
				'apellido1' => $persona['apellido1'], 'apellido2' => $persona['apellido2'], 
				'direccion' => $persona['direccion'], 'email' => $persona['email'] , 
				'fechaNac' => $persona['fechaNac'], 'gender' => $persona['gender'],
				 'lugNa' => $persona['lugNa'], 'telefono' => $persona['telefono']);
		
			$stmt = $this->conn->prepare("CALL EMD01PACIN(?,?,?,?,?,?,?,?,?,?)");
			$stmt->bind_param("ssssssssss", $per['id'], $per['nombre'], $per['apellido1'], $per['apellido2'], $per['gender'], $per['lugNa'], $per['direccion'], $per['fechaNac'], $per['email'], $per['telefono']);
			if($stmt->execute() or die ($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$stmt->close();
		$this->conn->close(); 
		}

		public function modificarPaciente($persona){
			$per = array('id' => $persona['id'], 'nombre' => $persona['nombre'], 
				'apellido1' => $persona['apellido1'], 'apellido2' => $persona['apellido2'], 
				'direccion' => $persona['direccion'], 'email' => $persona['email'] , 
				'fechaNac' => $persona['fechaNac'], 'gender' => $persona['gender'],
				 'lugNa' => $persona['lugNa'], 'telefono' => $persona['telefono']);
			$stmt = $this->conn->prepare("CALL EMD01PACUP(?,?,?,?,?,?,?,?,?,?)");
			$stmt->bind_param("ssssssssss", $per['id'], $per['nombre'], $per['apellido1'], $per['apellido2'], $per['gender'], $per['lugNa'], $per['direccion'], $per['fechaNac'], $per['email'], $per['telefono']);
			if($stmt->execute() or die ($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$stmt->close();
		$this->conn->close(); 
		}

		public function eliminarPaciente($id){
			$per = $id;
			$statement = $this->conn->prepare("CALL EMD01PACDE(?)");
			$statement->bind_param("s", $id);
			
			if(($statement->execute() or die($this->conn->error)))
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
			$resultado = $this->conn->query("CALL EMD01PACLI()");

			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo["data"][] = $data;
			}
			echo json_encode($arreglo);	
			//return $arreglo;
		}

		public function buscarPaciente($id){
			$resultado = $this->conn->query("CALL EMD01PACSE('$id')");

			if(mysqli_num_rows($resultado) > 0){
				while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
				$arreglo[] = array('Cedula' => $fila['EMD01IDPAC'], 'Nombre' => $fila['EMD01NOMBPAC'], 'Apellido1' => $fila['EMD01APE1PAC'], 'Apellido2' => $fila['EMD01APE2PAC']);
				}
				echo json_encode($arreglo);
			}else{
				echo 0;
			}	
		}

		public function getPacients(){
			$resultado = $this->conn->query("CALL EMD01PACLIPEN()");

			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'ID' => $data['EMD01IDPAC'],
					'Nombre' => $data['EMD01NOMBPAC'],
					'Ape1' => $data['EMD01APE1PAC'],
					'Ape2' => $data['EMD01APE2PAC']);
			}
			echo json_encode($arreglo);
		}

		public function agregarPacienteAgenda($persona){
			$stmt = $this->conn->prepare("CALL EMD01PACIA(?,?,?,?,?)");
			$stmt->bind_param("sssss", $persona['id'], $persona['nombre'], $persona['apellido1'], $persona['apellido2'], $persona['gender']);
			if($stmt->execute() or die ($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$stmt->close();
		$this->conn->close(); 
		}
	}


?>