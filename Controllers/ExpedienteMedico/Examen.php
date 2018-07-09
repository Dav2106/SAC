<?php

Class Examen extends Controller{
	function __construct(){
			parent::__construct();//crea el constructor del padre osea Controller.php
		}

		public function mostrarHistorial(){
				session_start();
				$this->model->Buscar($_SESSION['cedula']); 	
		}
		
		public function mostrarDia(){
				session_start();
				$sexo=$_SESSION['sexo'];
				$this->view->examenes = $diag = $this->model->BuscarDia($_SESSION['cedula']);
				if($sexo=='M'){
				$this->view->render($this,'MostrarExamenesM');
			}else{
				$this->view->render($this,'MostrarExamenes');
			}	
		}

		public function AgregarExamen(){
			if( isset($_POST['descripcion']) && isset($_POST['fecha']) && isset($_POST['tipoex'])&&isset($_POST["idDiag"])){
				$descripcion = $_POST['descripcion'];
				$fechadiagnostico = $_POST['fecha'];
				$tipoex = $_POST['tipoex'];
				$ididag = $_POST['idDiag'];
				echo "aqui ".$ididag;
				$examen = array('descripcion' => $descripcion, 'fechadiagnostico' => $fechadiagnostico, 
					'tipoex' => $tipoex,'ididag'=>$ididag);
				echo $this->model->AgregarExamen($examen);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}	
		 
		public function ModificarExamen(){
			if( isset($_POST['idExamen1']) && isset($_POST['descripcion1']) && isset($_POST['resultado1']) && 
				isset($_POST['fecha1']) && isset($_POST['tipoex1'])&&isset($_POST["idDiag1"])){
				$idExamen = $_POST['idExamen1'];
				$descripcion = $_POST['descripcion1'];
				$resultado = $_POST['resultado1'];
				$fechadiagnostico = $_POST['fecha1'];
				$tipoex = $_POST['tipoex1'];
				$ididag = $_POST['idDiag1'];
				echo "aqui ".$ididag;
				$examen = array('idExamen'=> $idExamen,'descripcion' => $descripcion, 'resultado' => $resultado, 'fechadiagnostico' => $fechadiagnostico, 
					'tipoex' => $tipoex,'ididag'=>$ididag);

				echo $this->model->modificarExamen($examen);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function EliminarExamen(){
			if(isset($_POST['idExamen1'])){

				$id = $_POST['idExamen1'];

				echo $this->model->eliminarExamen($id);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}
		public function cargarExamenes(){
			$this->view->examenes = $examen = $this->model->getAll(); 
		} 

		public function cargarPendiente(){
			session_start();
			$sexo=$_SESSION['sexo'];
			$this->view->examenes = $diag = $this->model->BuscarPend($_SESSION['cedula']);
			if($sexo=='M'){
				$this->view->render($this,'MostrarExamenesM');
			}else{
				$this->view->render($this,'MostrarExamenes');
			}
		}

		public function BuscarExam(){
			session_start();
			$exa = $this->model->buscarUltExam($_SESSION['cedula']);
			if($exa != NULL){
				$_SESSION['cedula'] = $exa['id'];
				$_SESSION['nombre'] = $exa['nombre'];
				$_SESSION['lastDgn'] = $exa['dgn'];	
				$_SESSION['idLastDgn'] = $exa['idDiag'];
			}
			print_r($exa);		
		}
}

?>