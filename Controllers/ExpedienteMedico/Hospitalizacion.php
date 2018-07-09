<?php

Class Hospitalizacion extends Controller{
	function __construct(){
			parent::__construct();
		}

		public function AgregarHospitalizacion(){
			if(isset($_POST['idPac']) ){
				$idPac = $_POST['idPac'];
				$hos = array('idPac' => $idPac);
				$Hospi = $this->model->agregarHospitalizacion($hos);
				session_start();
				$_SESSION['idHosP'] = $Hospi['idHosp'];
				header('refresh:0;'.URL.'Hospitalizacion/mostrarObsHospi');			
			}else{
				header('refresh:0;'.URL.'Hospitalizacion/mostrarObsHospi');
			}
		}

		//Pruebas
		public function finalizarHos(){
			$idHosp=$_POST['idhos'];
			session_start();
			$Hospi = $this->model->finalizar($idHosp, $_SESSION['cedula']);
			unset($_SESSION['idHosP']);
			header('refresh:0;'.URL.'Hospitalizacion/mostrarObsHospi');	
		}

		public function EliminarHospitalizacion(){
			if(isset($_POST['idHos'])){
				$idHos = $_POST['idHos'];
				echo $this->model->eliminarHospitalizacion($idHos);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}
	

		//Observaciones 

		public function AgregarObsHospit(){
			if( isset($_POST['descob']) && isset($_POST['idDiagMo']) && isset($_POST['idHosP'])  ){
				$descob = $_POST['descob'];
				$idDiagMo = $_POST['idDiagMo'];
				$idHosP = $_POST['idHosP'];
				$hosOB = array('descob' => $descob, 'idDiagMo' => $idDiagMo,'idHosP' => $idHosP);
				echo $this->model->agregarObsHospi($hosOB);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function ModificarObsHospit(){
			if( isset($_POST['idOB']) && isset($_POST['descob'])){
				$id = $_POST['idOB'];
				$descob = $_POST['descob'];
				$hosOB = array('id' => $id,'descob' => $descob);
				echo $this->model->modificarObsHospi($hosOB);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function EliminarOBHospitalizacion(){
			if(isset($_POST['idOB'])){
				$idob = $_POST['idOB'];
				echo $this->model->eliminarOBHospitalizacion($idob);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}



		public function mostrarObsHospi(){
			session_start();
			$sexo=$_SESSION['sexo'];
			$id=$_SESSION['cedula'];
			$this->view->Hospitalizacion = $diag = $this->model->BuscarObsHospi($id); 
			if($sexo=='M'){
				$this->view->render($this,'MostrarHospitalizacionM');
			}else{
				$this->view->render($this,'MostrarHospitalizacion');
			}				
		}

		public function BuscarHosp(){
			session_start();
			$hos = $this->model->buscarUltHosp($_SESSION['cedula']);
			if($hos != NULL){
				$_SESSION['cedula'] = $hos['id'];
				$_SESSION['nombre'] = $hos['nombre'];
				$_SESSION['lastDgn'] = $hos['dgn'];	
				$_SESSION['idLastDgn'] = $hos['idDiag'];
				$_SESSION['idHosP'] = $hos['idHos'];
			}	
			print_r($hos);
		}

		public function HistorialHospi(){
			session_start();
			$this->model->BuscarHis($_SESSION['cedula']);
		}
}

?>