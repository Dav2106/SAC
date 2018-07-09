<?php  

Class Reportes extends Controller

{
	public function index(){
		$this->view->render($this, 'index');
	}

	public function masAtendido(){
		$this->view->render($this, 'MasAtendido');
	}

	public function menosAtendido(){
		$this->view->render($this, 'MenosAtendido');
	}

	public function masRecetado(){
		$this->view->render($this, 'MasRecetado');
	}

	public function menosRecetado(){
		$this->view->render($this, 'MenosRecetado');
	}

	public function masComun(){
		$this->view->render($this, 'EnfermedadesComunes');
	}

	public function atenyPag(){
		$this->view->render($this, 'AtenyPag');
	}

	public function detaFact(){
		$this->view->render($this, 'DetaFact');
	}	

	public function FechaEspecifica(){
		$this->view->render($this, 'ReFechaEspecifica');
	}

	public function rangoFecha(){
		$this->view->render($this, 'ReRangoFecha');
	}

	public function ReporteGeneral(){
		$this->view->render($this, 'ReporteGeneral');
	}

	public function hospiGeneral(){
		$this->view->render($this, 'HospitalizacionGeneral');
	}

	public function controlDia(){
		$this->view->render($this, 'ControlDia');
	}

	public function historialClinico(){
		$this->view->render($this, 'HistorialClinico');
	}

	public function historialFinanciero(){
		$this->view->render($this, 'HistorialFinanciero');
	}

	public function mostrarMasAtendido(){
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];

			$this->model->buscarMasAtendido($fecha1, $fecha2);
	}

	public function mostrarMenosAtendido(){
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];

			$this->model->buscarMenosAtendido($fecha1, $fecha2);
	}

	public function mostrarMasRecetado(){
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];

			$this->model->buscarMasRecetado($fecha1, $fecha2);
	}

	public function mostrarMenosRecetado(){
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];

			$this->model->buscarMenosRecetado($fecha1, $fecha2);
	}

	public function mostrarMasComun(){
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];

			$this->model->buscarEnfMasComun($fecha1, $fecha2);
	}

	public function mostrarAtenyPaga(){
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];

			$this->model->buscarAtenyPag($fecha1,$fecha2);
	}

	public function mostrarDetaFact($param){
			if (isset($param)) {
			$param = explode(".", $param);

			$id = $param[0];
			$fecha1 = $param[1];
				
			$this->model->buscarDetaFact($fecha1,$id);
			}
	}

	public function mostrarFechaEspecifica(){
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];
			$this->model->buscarFechaEspecifica($fecha1,$fecha2);
	}

	public function mostrarRangoFecha(){
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];
			
			$this->model->mostrarRanFecha($fecha1,$fecha2);
	}

	public function BusReporteGeneral() {
			$this->model->buscarReporteGeneral();
	}

	public function Hospitalizacion(){
		$this->model->Hospitalizacion();
	}

	public function contDia(){
		$this->model->controlPorDia();
	}

	public function histCli(){
		$id = $_POST['id'];
		$this->model->historialCli($id);
	}

	public function histFinan(){
		$id = $_POST['id'];
		$this->model->historialFin($id);
	}
}

?>	
