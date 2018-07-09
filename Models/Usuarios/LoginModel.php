<?php

	Class LoginModel extends Model{

		function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
		}

		public function agregarCuenta($usuario){
				$u = array('user' => $usuario['username'], 'pass' => $usuario['contraseña'],
					'id' => $usuario['id']);
				$statement = $this->conn->prepare("CALL EMD04RLSIN(?,?,?)");
				$statement->bind_param("sss", $u['user'], $u['pass'], $u['id']);
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

		public function CambioContra($usuario){
			$u = array('user' => $usuario['username'], 'pass' => $usuario['contraseña'],
					'id' => $usuario['id']);
				$statement = $this->conn->prepare("CALL EMD04RLSCAM(?,?,?)");
				$statement->bind_param("sss", $u['id'], $u['user'], $u['pass']);
				if(($statement->execute()) or die($this->conn->error)){
					echo "Exito";
				}
				else{
					echo "Fallo";
				}	
			$statement->close();
			$this->conn->close(); 
		}

		public function cargaSesion($usuario, $pass){
			$resultado = $this->conn->query("CALL EMD04RLSCARSES('$usuario','$pass')");
			$datos=0;
			$count = mysqli_num_rows($resultado);
			if($count == 1) {
				$this->conn->query("CALL EMD04ACESRLS('$usuario','$pass')");
         	 	while ($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
				$usu = $fila['EMD02IDFUN'];
				$carg = $fila['EMD02CARGFUN'];
				$datos = array("ID" => $usu, "Carg" => $carg);
				}
      		}else{
      			echo 0;
         		header('refresh:0;'.URL.'Login/iniciarSesion');
      		}
			return $datos;
		}

		public function borrarSesion($id){
			$this->conn->query("CALL EMD04CERRLS('$id')");
		}
    }
?>
