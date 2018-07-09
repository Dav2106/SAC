<?php
	
	Class Tratamiento extends Controller{
		
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
			$this->view->Tratamiento = $tra = $this->model->BuscarDia($_SESSION['cedula']); 
			if($sexo=='M'){
				$this->view->render($this,'MostrarTratamientoM');
			}else{
				$this->view->render($this,'MostrarTratamiento');
			}
				
			
		}
		     
		public function AgregarTratamiento(){
			if(isset($_POST['nomTra']) && isset($_POST['descripcion']) && isset($_POST['observaciones']) && isset($_POST['idPac']) && isset($_POST['idFun']) && isset($_POST['idDia'])){
				
				$idDia=$_POST['idDia'];
				$idFuncionario=$_POST['idFun'];
				$idPaciennte=$_POST['idPac'];
				$NombreTratamiento = $_POST['nomTra'];
				$Indicaciones = $_POST['observaciones'];
				$Descripcion =$_POST['descripcion'];
				$idServi=2;
				$tratamiento = array('idDia'=> $idDia,'idFunc'=>$idFuncionario,'idPac'=>$idPaciennte,'nomTra' => $NombreTratamiento, 'observaciones' => $Indicaciones,'descripcion'=>$Descripcion,$idServi);

				echo $this->model->agregarTratamiento($tratamiento);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}


		public function ModificarTratamiento(){
			if(isset($_POST['idTrat1']) && isset($_POST['fecha1']) && isset($_POST['observaciones1'])&& isset($_POST['nomTra1'])&& isset($_POST['descripcion1'])&& isset($_POST['idDia1'])&& isset($_POST['idFun1'])){
		
				$idTrt=$_POST['idTrat1'];
				$idDia=$_POST['idDia1'];
				$fecha=$_POST['fecha1'];
				$idFun=$_POST['idFun1'];
				$idPaciennte=$_POST['idPac1'];
				$nomPro = $_POST['nomTra1'];
				$Indicaciones = $_POST['observaciones1'];
				$descripcion =$_POST['descripcion1'];
				$idServi=2;
				
				$tratamiento = array('idTrat'=> $idTrt,'fecha'=>$fecha,'indicaciones'=>$Indicaciones,'nomPro' => $nomPro, 'descripcion' => $descripcion,'idDia'=>$idDia,$idServi,'idFun' => $idFun);

				echo $this->model->modificarTratamiento($tratamiento);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function EliminarTratamiento(){

			if(isset($_POST['idTrat1'])){
				$id = $_POST['idTrat1'];
				echo $this->model->eliminarTrataminto($id);
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
			else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function CargarTrataminto(){
			$this->view->Tratamiento = $tra = $this->model->getAll(); 
		}

	
     }

?>