<?php

Class Funcionario extends Controller{
	private $modulo = "Usuarios";
	function __construct(){
			parent::__construct($this->modulo);//crea el constructor del padre osea Controller.php
		}

		public function mostrar(){
			echo $this->CargarFuncionarios();
			$this->view->render($this->modulo,$this,'MostrarFuncionarios');
		}

		public function AgregarFuncionario(){
			if( isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && 
				isset($_POST['apellido2']) && isset($_POST['direccion']) && isset($_POST['fena'])
				&& isset($_POST['correo']) && isset($_POST['cargo'])){ 

				$id = $_POST['id'];
				$nombre = $_POST['nombre'];
				$apellido1 = $_POST['apellido1'];
				$apellido2 = $_POST['apellido2'];
				$direccion = $_POST['direccion'];
				$fena = $_POST['fena'];
				$correo = $_POST['correo'];
				$cargo = $_POST['cargo'];
				$funcionario = array('id' => $id, 'nombre' => $nombre, 'apellido1' => $apellido1, 
					'apellido2' => $apellido2, 'direccion' => $direccion, 'fena' => $fena, 
					'correo' => $correo, 'cargo' => $cargo);

				echo $this->model->agregarFuncionario($funcionario);
				header('location:'.URL.'Usuarios/Funcionario/mostrar');
			}else{
				header('location:'.URL.'Usuarios/Funcionario/mostrar');
			}
		}

		public function ModificarFuncionario(){
			if( isset($_POST['id1']) && isset($_POST['nombre1']) && isset($_POST['apellido11']) && 
				isset($_POST['apellido21']) && isset($_POST['direccion1']) && isset($_POST['fena1']) && isset($_POST['correo1']) && isset($_POST['cargo1'])){ 
				$id = $_POST['id1'];
				$nombre = $_POST['nombre1'];
				$apellido1 = $_POST['apellido11'];
				$apellido2 = $_POST['apellido21'];
				$direccion = $_POST['direccion1'];
				$fena = $_POST['fena1'];
				$correo = $_POST['correo1'];
				$cargo = $_POST['cargo1'];
				$funcionario = array('id' => $id, 'nombre' => $nombre, 'apellido1' => $apellido1, 
					'apellido2' => $apellido2, 'direccion' => $direccion, 'fena' => $fena, 
					'correo' => $correo, 'cargo' => $cargo);

				echo $this->model->modificarFuncionario($funcionario);
				header('location:'.URL.'Usuarios/Funcionario/mostrar');
			}else{
				header('location:'.URL.'Usuarios/Funcionario/mostrar');
			}
		}

		public function EliminarFuncionario(){
				if( isset($_POST['id1'])){

					$id = $_POST['id1'];
				
					echo $this->model->eliminarFuncionario($id);
					header('location:'.URL.'Usuarios/Funcionario/mostrar');//se ejecute en el modelo esta funcion
				}else{
					header('location:'.URL.'Usuarios/Funcionario/mostrar');
				}
		}

		public function CargarFuncionarios(){
			$this->view->funcionarios = $fun = $this->model->getAll(); 
		}		
}

?>