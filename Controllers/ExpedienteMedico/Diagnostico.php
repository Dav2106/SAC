<?php

Class Diagnostico extends Controller{
	function __construct(){
			parent::__construct();//crea el constructor del padre osea Controller.php
		}

		public function mostrarDia($param){
			if (isset($param)) {
				$param = explode("-", $param);
				$id = $param[0];
				$nombre = $param[1];
				$sexo =$param[2];
				session_start();
				$_SESSION['cedula'] = $id;
				$_SESSION['nombre'] = $nombre;	
				$_SESSION['sexo'] = $sexo;	
				$this->view->diagnostico = $diag = $this->model->buscarRangoFecha($id);
				if($_SESSION['sexo']=='M'){
					$this->view->render($this,'MostrarDiagnosticoM');
				}else{
					$this->view->render($this,'MostrarDiagnosticos');
				}
			}else{
				echo "Error";
			}
		} 

		public function mostrarHistorial(){
			session_start();
			$this->model->buscar($_SESSION['cedula']);
		} 

		public function AgregarDiagnostico(){
			if(isset($_POST['fecha']) && isset($_POST['Descripcion']) 
				&& isset($_POST['idFun']) && isset($_POST['idPac'])){
				
				$fecha = $_POST['fecha'];
				$Descripcion = $_POST['Descripcion'];
				$idServ = 1;
				$idFun = $_POST['idFun'];
				$idPac = $_POST['idPac'];
				
				$diag = array('fecha' => $fecha, 'Descripcion' => $Descripcion, 'idServ' => $idServ, 'idFun' => $idFun,'idPac' => $idPac); 
				$this->model->agregarDiagnostico($diag);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function ModificarDiagnostico(){
			if(isset($_POST['fecha']) && isset($_POST['Descripcion']) 
				&& isset($_POST['idFun']) && isset($_POST['idPac']) && isset($_POST['id'])){
				
				$id = $_POST['id'];
				$fecha = $_POST['fecha'];
				$Descripcion = $_POST['Descripcion'];
				$idServ = 1;
				$idFun = $_POST['idFun'];
				$idPac = $_POST['idPac'];
				
				$diag = array('id' => $id,'fecha' => $fecha, 'Descripcion' => $Descripcion, 'idServ' => $idServ, 'idFun' => $idFun,'idPac' => $idPac);
				$this->model->modificarDiagnostico($diag);
				session_start();
				//unset($_SESSION['idLastDgn']);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function EliminarDiagnostico(){
			if(isset($_POST['id']) ){
				$id = $_POST['id'];
				$this->model->eliminarDiagnostico($id);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
				session_start();
				unset($_SESSION['idLastDgn']);
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function CargarDiagnosticos(){

			$this->view->diagnostico = $diag = $this->model->getAll(); 
		}

		public function cargarUltimoDiagnostico(){
			session_start();
			$lastDgn = $this->model->getLastDiag($_SESSION['cedula']);
			$_SESSION['idLastDgn'] = $lastDgn['id'];
			$_SESSION['lastDgn'] = $lastDgn['desc'];
			$_SESSION['cedula2'] = $lastDgn['cedula'];
		}

		public function cargarPenultimoDiagnostico(){
			$penLastDgn = $this->model->getPenLastDiag();
			session_start();
			$_SESSION['penLastDgn'] = $penLastDgn;
			echo $_SESSION['penLastDgn'];
		}

		public function FinalizarConsulta(){
			session_start();
			$this->model->atendido($_SESSION['cedula']);
			unset($_SESSION['cedula']);
			unset($_SESSION['nombre']);
			unset($_SESSION['sexo']);
			unset($_SESSION['idLastDgn']);
			unset($_SESSION['lastDgn']);
			$_SESSION['idLastDgn'] = 0;
			if($_SESSION['funcionario'] == @$_SESSION['Medico']){
				header('refresh:0;'.URL.'Agenda/listaEsperaDoc');	
			}else{
				header('refresh:0;'.URL.'Agenda/listaEspera');	
			}
			
		}
}

?>