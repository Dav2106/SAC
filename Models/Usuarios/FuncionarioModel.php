<?php

	Class FuncionarioModel extends Model{

		function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
		}

		public function agregarFuncionario($funcionario){
			$fun = array('id' => $funcionario['id'], 'nombre' => $funcionario['nombre'], 
				'apellido1' => $funcionario['apellido1'], 'apellido2' => $funcionario['apellido2'], 
				'direccion' => $funcionario['direccion'], 'fena' => $funcionario['fena'], 
				'correo' => $funcionario['correo'], 'cargo' => $funcionario['cargo']);
			$statement = $this->conn->prepare("CALL EMD02FUNIN(?,?,?,?,?,?,?,?)");
			$statement->bind_param("ssssssss", $fun['id'], $fun['nombre'], $fun['apellido1'], 
				$fun['apellido2'], $fun['direccion'], $fun['fena'], $fun['correo'], 
				$fun['cargo']);
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

		public function modificarFuncionario($funcionario){
			$fun = array('id' => $funcionario['id'], 'nombre' => $funcionario['nombre'], 
				'apellido1' => $funcionario['apellido1'], 'apellido2' => $funcionario['apellido2'], 
				'direccion' => $funcionario['direccion'], 'fena' => $funcionario['fena'], 
				'correo' => $funcionario['correo'], 'cargo' => $funcionario['cargo']);
			$statement = $this->conn->prepare("CALL EMD02FUNUP(?,?,?,?,?,?,?,?)");
			$statement->bind_param("ssssssss", $fun['id'], $fun['nombre'], $fun['apellido1'], 
				$fun['apellido2'], $fun['direccion'], $fun['fena'], $fun['correo'], 
				$fun['cargo']);
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

		public function eliminarFuncionario($id){
			$per = $id;
			$statement = $this->conn->prepare("CALL EMD02FUNDE(?)");
			$statement->bind_param("s", $id);
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
			$resultado = $this->conn->query("CALL EMD02FUNLI");

			$fun = $resultado->fetch_all(MYSQLI_ASSOC);

			return $fun;
		}
	
	}


?>