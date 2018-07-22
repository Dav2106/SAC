<?php
	
	Class Servicio extends Controller{
		
		private $modulo = "Finanzas";

		function __construct(){
			parent::__construct($this->modulo);
		}

		public function mostrar(){
			echo $this->CargarServicios();
			$this->view->render($this->modulo, $this,'MostrarServicios');
		}

		public function AgregarServicio(){
			if( isset($_POST['direccion']) && isset($_POST['Costo'])){
				$descripcion = $_POST['direccion'];
				$costo = $_POST['Costo'];
				$servicio = array('direccion' => $descripcion, 'Costo' => $costo);
				echo $this->model->agregarServicio($servicio);
				header('refresh:0;'.URL.'Servicio/mostrar');
			}else{
				header('refresh:0;'.URL.'Servicio/mostrar');
			}
		}

		public function ModificarServicio(){
			if(isset($_POST['id1']) && isset($_POST['direccion1']) && isset($_POST['Costo1'])){
				$idServicio = $_POST['id1'];
				$descripcion = $_POST['direccion1'];
				$costo = $_POST['Costo1'];
				$servicio = array('id' => $idServicio, 'direccion' => $descripcion, 'Costo' => $costo);
				echo $this->model->modificarServicio($servicio);
				header('refresh:0;'.URL.'Servicio/mostrar');
			}else{
				header('refresh:0;'.URL.'Servicio/mostrar');
			}
		}

		public function EliminarServicio(){
			if(isset($_POST['id1'])){
				$idServicio = $_POST['id1'];
				echo $this->model->eliminarServicio($idServicio);
				header('refresh:0;'.URL.'Servicio/mostrar');
			}else{
				header('refresh:0;'.URL.'Servicio/mostrar');
			}
		}

		public function CargarServicios(){
			$this->view->servicios = $servi = $this->model->getAll(); 
		}

	}
?>