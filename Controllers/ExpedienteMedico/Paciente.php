<?php
	Class Paciente extends Controller{
		
		private $modulo = "ExpedienteMedico";

		function __construct(){
			parent::__construct($this->modulo);
		}

		public function mostrar(){
			$this->view->render($this->modulo, $this,'MostrarPacientes');
		}

		public function AgregarPaciente(){
			if( isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && 
				isset($_POST['apellido2']) && isset($_POST['direccion']) &&  isset($_POST['email']) &&
				isset($_POST['fechaNac']) && isset($_POST['gender']) && isset($_POST['lugNa'])
				&& isset($_POST['telefono'])){

				$id = $_POST['id'];
				$nombre = $_POST['nombre'];
				$apellido1 = $_POST['apellido1'];
				$apellido2 = $_POST['apellido2'];
				$direccion = $_POST['direccion'];
				$email = $_POST['email'];
				$fechaNac = $_POST['fechaNac'];
				$gender = $_POST['gender'];
				$lugNa = $_POST['lugNa'];
				$telefono = $_POST['telefono'];

				$persona = array('id' => $id, 'nombre' => $nombre, 'apellido1' => $apellido1, 
					'apellido2' => $apellido2, 'direccion' => $direccion, 'email' => $email, 
					'fechaNac' => $fechaNac, 'gender' => $gender, 'lugNa' => $lugNa, 'telefono' => $telefono);

				echo $this->model->agregarPaciente($persona);
				header('location:'.URL.'Paciente/mostrar');
			}else{
				header('location:'.URL.'Paciente/mostrar');
			}
		}

		public function ModificarPaciente(){
			if( isset($_POST['id1']) && isset($_POST['nombre1']) && isset($_POST['apellido11']) && 
				isset($_POST['apellido21']) && isset($_POST['direccion1']) &&  isset($_POST['email1']) &&
				isset($_POST['fechaNac1']) && isset($_POST['gender1']) && isset($_POST['lugNa1'])
				&& isset($_POST['telefono1'])){

				$id = $_POST['id1'];
				$nombre = $_POST['nombre1'];
				$apellido1 = $_POST['apellido11'];
				$apellido2 = $_POST['apellido21'];
				$direccion = $_POST['direccion1'];
				$email = $_POST['email1'];
				$fechaNac = $_POST['fechaNac1'];
				$gender = $_POST['gender1'];
				$lugNa = $_POST['lugNa1'];
				$telefono = $_POST['telefono1'];

				$persona = array('id' => $id, 'nombre' => $nombre, 'apellido1' => $apellido1, 
					'apellido2' => $apellido2, 'direccion' => $direccion, 'email' => $email, 
					'fechaNac' => $fechaNac, 'gender' => $gender, 'lugNa' => $lugNa, 'telefono' => $telefono);
				
				echo $this->model->modificarPaciente($persona);
				header('location:'.URL.'Paciente/mostrar');
			}else{
				header('location:'.URL.'Paciente/mostrar');
			}
		}

		public function EliminarPaciente(){
			if(isset($_POST['id1'])){

				$id = $_POST['id1'];

				echo $this->model->eliminarPaciente($id);
				header('location:'.URL.'Paciente/mostrar');
			}else{
				header('location:'.URL.'Paciente/mostrar');
			}
		}

		public function CargarPersonas(){
			$this->model->getAll();
		}

		public function CargarPacientesFactura(){
			$this->model->getPacients();
		}

		public function BuscarPaciente(){
			$id = $_POST['id'];
			$this->model->buscarPaciente($id);
		}

		public function AgregarPacienteAgenda(){
			$id = $_POST['idP'];
			$nombre = $_POST['nombre'];
			$apellido1 = $_POST['apellido1'];
			$apellido2 = $_POST['apellido2'];
			$gender = $_POST['sexo'];
			$persona = array('id' => $id, 'nombre' => $nombre, 'apellido1' => $apellido1, 
					'apellido2' => $apellido2, 'gender' => $gender);
			echo $this->model->agregarPacienteAgenda($persona);
		}
	}

?>