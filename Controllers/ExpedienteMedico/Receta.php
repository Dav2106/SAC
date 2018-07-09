<?php
	
	Class Receta extends Controller{
		
		function __construct(){
			parent::__construct();//crea el constructor del padre osea Controller.php
		}		
		          
		public function AgregarReceta(){
			if(isset($_POST['nomPro']) && isset($_POST['indicaciones']) && isset($_POST['cantidad']) && isset($_POST['observaciones']) && isset($_POST['idTrt']) && isset($_POST['fecha'])){
				
				$nomPro=$_POST['nomPro'];
				$indicaciones=$_POST['indicaciones'];
				$cantidad=$_POST['cantidad'];
				$observaciones = $_POST['observaciones'];
				$idTrt = $_POST['idTrt'];
				$fecha =$_POST['fecha'];
				
				$receta = array('nomPro'=> $nomPro,'indicaciones'=>$indicaciones,'cantidad'=>$cantidad,'observaciones' => $observaciones, 'idTrt' => $idTrt,
					'fecha'=>$fecha);

				echo $this->model->agregarReceta($receta);
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}


		public function ModificarReceta(){
			if(isset($_POST['id']) && isset($_POST['nomPro']) && isset($_POST['indicaciones']) && isset($_POST['cantidad']) && isset($_POST['observaciones']) && isset($_POST['fecha'])){
				
				$idRec=$_POST['id'];
				$nomPro=$_POST['nomPro'];
				$indicaciones=$_POST['indicaciones'];
				$cantidad=$_POST['cantidad'];
				$observaciones = $_POST['observaciones'];
				$fecha =$_POST['fecha'];
				$idTrt = $_POST['idTrt'];
				
				$receta = array('idRec' => $idRec,'nomPro'=> $nomPro,'indicaciones'=>$indicaciones,'cantidad'=>$cantidad,'observaciones' => $observaciones,'fecha'=>$fecha,'idTrt' => $idTrt);

				$this->model->modificarReceta($receta);
			}else{
				header("location: ".$_SERVER['HTTP_REFERER'] ." ");
			}
		}

		public function EliminarReceta(){
			$id = $_POST['idRec'];
			$idTrt = $_POST['idTrt'];
			$this->model->eliminarReceta($id,$idTrt);
		}

		public function iniciarSesion(){
			session_start();
			$_SESSION['idTrt'] = $_POST['idTrata'];
			$this->model->Buscar($_SESSION['idTrt']);
		}	
     }
?>