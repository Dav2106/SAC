<?php

Class Patologia extends Controller{
		
		private $modulo = "ExpedienteMedico";

		function __construct(){
			parent::__construct($this->modulo);
		}

		public function mostrarDia(){
			session_start();
			$sexo=$_SESSION['sexo'];
			$this->view->patologia = $pat = $this->model->BuscarDia($_SESSION['cedula']); 
			if($sexo=='M'){
				$this->view->render($this->modulo, $this,'MostrarPatologiasM');
			}else{
				$this->view->render($this->modulo, $this,'MostrarPatologias');
			}			
		}

		public function AgregarPatologia(){
			if(isset($_POST['descripcion'])){
				$descripcion = $_POST['descripcion'];
				$descripcion;
				$this->model->agregarPatologia($descripcion);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function ModificarPatologia(){
			session_start();
			if(isset($_POST['id1']) && isset($_POST['descripcion1'])){
				$id = $_POST['id1'];
				$descripcion = $_POST['descripcion1'];
				$pat = array('id' => $id, 'descripcion' => $descripcion);
				echo $this->model->modificarPatologia($pat);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function EliminarPatologia(){
			if(isset($_POST['id1'])){
				$id = $_POST['id1'];
				$idp = $_POST['idP'];
				echo $this->model->eliminarPatologia($id,$idp);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function CargarPatologias(){
			session_start();
			$this->model->getAll($_SESSION['cedula']);
		}

		public function AgregarPatologiaList(){
			$patologias = $_POST['patologia'];
			$idPac = $_POST['idPac'];
			$pat = array('patologia' => $patologias, 'idPac' => $idPac);
			$this->model->agregarPatologiaList($pat);
		}

		public function EliminarPatologiaList(){
			$patologias = $_POST['patologia'];
			$idPac = $_POST['idPac'];
			$pat = array('patologia' => $patologias, 'idPac' => $idPac);
			$this->model->eliminarPatologiaList($pat);
		}
}

?>