<?php

Class Enfermedad extends Controller{
		private $modulo = "ExpedienteMedico";

		function __construct(){
			parent::__construct($this->modulo);
		}

		public function mostrar(){
			echo $this->CargarEnfermedades();
			$this->view->render($this->modulo, $this,'MostrarEnfermedades');
		}

		public function AgregarEnfermedad(){
			if(isset($_POST['tipoEnfermedad']) && isset($_POST['nombre']) && isset($_POST['IDPatologia']))

			{

			   $tipoEnfermedad = $_POST['tipoEnfermedad'];
				$nombre = $_POST['nombre'];
				$IDPatologia = $_POST['IDPatologia'];
				
				
				$enf = array('tipoEnfermedad' => $tipoEnfermedad, 'nombre' => $nombre,'IDPatologia' => $IDPatologia);

				echo $this->model->agregarEnfermedad($enf);
				header('refresh:0;'.URL.'Enfermedad/mostrar');//se ejecute en el modelo esta funcion
			}else{
				header('refresh:0;'.URL.'Enfermedad/mostrar');
			}
		}

		public function ModificarEnfermedad(){
			if(isset($_POST['id']) && isset($_POST['tipoEnfermedad']) && isset($_POST['nombre']) && isset($_POST['IDPatologia'])){

				$id = $_POST['id'];
				$tipoEnfermedad = $_POST['tipoEnfermedad'];
				$nombre = $_POST['nombre'];
				$IDPatologia = $_POST['IDPatologia'];
				
				$enf = array('id' => $id,'tipoEnfermedad' => $tipoEnfermedad, 'nombre' => $nombre,'IDPatologia' => $IDPatologia);

				echo $this->model->modificarEnfermedad($enf);
				echo "<script>alert('Se ha modificado exitosamente');</script>";
				header('refresh:0; '.URL.'Enfermedad/mostrar');//se ejecute en el modelo esta funcion
			}else{
				echo "<script>alert('Debe completar todos los campos');</script>";
				header('refresh:0;'.URL.'Enfermedad/mostrar');
			}
		}

		public function EliminarEnfermedad(){
			if(isset($_POST['id'])){

				$id = $_POST['id'];

				echo $this->model->eliminarEnfermedad($id);
				echo "<script>alert('Se ha eliminado exitosamente');</script>";
				header('refresh:0; '.URL.'Enfermedad/mostrar');//se ejecute en el modelo esta funcion
			}else{
				echo "<script>alert('Debe completar todos los campos');</script>";
				header('refresh:0;'.URL.'Enfermedad/mostrar');
			}
		}

		public function CargarEnfermedades(){

			$this->view->enfermedad = $enfermedades = $this->model->getAll(); 
		}
}

?>