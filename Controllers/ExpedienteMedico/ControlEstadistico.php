<?php

Class ControlEstadistico extends Controller{
	
	private $modulo = "ExpedienteMedico";

	function __construct(){
		parent::__construct($this->modulo);
	}

	public function mostrar(){
			session_start();
			$this->CargarContEsta($_SESSION['cedula']);
			$this->view->render($this->modulo, $this,'ControlEstadistico');			
	} 

	public function CargarContEsta($id){
		$this->view->contEsta = $cont = $this->model->getAll($id); 
	}

	

	public function AgregarControl()
	{ 
		if(isset($_POST['fecha']) && isset($_POST['P_Arterial']) 
				&& isset($_POST['FCF']) && isset($_POST['edGest']) 
				&& isset($_POST['altUt']) && isset($_POST['movFetal'])
				&& isset($_POST['peso']) && isset($_POST['precentacion'])
				&& isset($_POST['idDiagnostico']) ){
				
				$fecha = $_POST['fecha'];
				$edadGes=$_POST['edGest'];
				$peso=$_POST['peso'];
				$P_Arterial=$_POST['P_Arterial'];
				$altUt=$_POST['altUt'];
				$precentacion=$_POST['precentacion'];
				$FCF=$_POST['FCF'];
				$movFetal=$_POST['movFetal'];
				$idDiagnostico=$_POST['idDiagnostico'];
				
				$contEst = array('fecha' => $fecha, 'edGest'=>$edadGes,'peso'=>$peso,'P_Arterial'=>$P_Arterial,'altUt'=>$altUt,'precentacion'=>$precentacion,'FCF'=>$FCF,'movFetal'=>$movFetal,'idDiagnostico'=>$idDiagnostico);
				echo $this->model->agregarControl($contEst);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				echo "INFIERNO";
			}
	}

	public function ModificarControlEstadistico(){
			if(isset($_POST['ID1'])  && isset($_POST['fecha1']) && isset($_POST['P_Arterial1']) 
				&& isset($_POST['FCF1']) && isset($_POST['edGest1']) 
				&& isset($_POST['altUt1']) && isset($_POST['movFetal1'])
				&& isset($_POST['peso1']) && isset($_POST['precentacion1'])
				&& isset($_POST['idDiagnostico1']) ){
				
				$id = $_POST['ID1'];
				$fecha = $_POST['fecha1'];
				$edadGes=$_POST['edGest1'];
				$peso=$_POST['peso1'];
				$P_Arterial=$_POST['P_Arterial1'];
				$altUt=$_POST['altUt1'];
				$precentacion=$_POST['precentacion1'];
				$FCF=$_POST['FCF1'];
				$movFetal=$_POST['movFetal1'];
				$idDiagnostico=$_POST['idDiagnostico1'];
				
				$contEst = array('ID'=>$id,'fecha' => $fecha, 'edGest'=>$edadGes,'peso'=>$peso,'P_Arterial'=>$P_Arterial,'altUt'=>$altUt,'precentacion'=>$precentacion,'FCF'=>$FCF,'movFetal'=>$movFetal,'idDiagnostico'=>$idDiagnostico);
				echo $this->model->ModificarControlEstadistico($contEst);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				echo "INFIERNO";
			}
		}

		public function EliminarControlEstadistico(){
			if(isset($_POST['ID1']) ){

				$id = $_POST['ID1'];
				
				echo $this->model->eliminarDiagnostico($id);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function CargarControlEstadistico(){

			$this->view->ControlEstadistico = $contr = $this->model->getAll(); 

		}

}

?>