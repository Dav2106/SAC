<?php

 Class Agenda extends Controller{

 	function __construct(){
 		parent::__construct();
 	}

 	public function agenda(){
 		$this->mostrarAgenda();
 		$this->view->render($this,'Agenda');
 	}

 	public function listaEspera(){
 		$this->view->render($this,'ListaEspera');
 	}

 	public function listaEsperaDoc(){
 		$this->view->render($this,'ListaEsperaDoc');
 	}
   
 	public function agregarAgenda(){
 		if(isset($_POST['fecha']) && isset($_POST['tipo']) && isset($_POST['observacion']) && isset($_POST['idPac'])){
 			$fecha = $_POST['fecha'];
 			$tipo = $_POST['tipo'];
 			$observacion = $_POST['observacion'];
 			$idPac = $_POST['idPac'];

 			$agenda = array("fecha" => $fecha, "tipo" => $tipo, "observacion" => $observacion, "idPac" => $idPac);

 			$this->model->agregar($agenda);
 			header('location:'.URL.'Agenda/agenda');
 		}else{
 			header('location:'.URL.'Agenda/agenda');
 		}
 	}

 	public function modificarAgenda(){
 			$id = $_POST['id1'];
 			$fecha = $_POST['fecha1'];
 			$tipo = $_POST['tipo1'];
 			$observacion = $_POST['observacion1'];
 			$idPac = $_POST['idPac1'];

 			$agenda = array("id" => $id, "fecha" => $fecha, "tipo" => $tipo, "observacion" => $observacion, "idPac" => $idPac);

 			$this->model->modificar($agenda);
 			header('location:'.URL.'Agenda/agenda');
 	}

 	public function eliminarAgenda(){
 		if(isset($_POST['id1'])){
 			$id = $_POST['id1'];

 			$this->model->eliminar($id);
 			header('location:'.URL.'Agenda/agenda');
 		}else{
 			header('location:'.URL.'Agenda/agenda');
 		}
 	}

 	public function mostrarAgenda(){
 		$this->view->agenda = $this->model->getAll();
 	}
 	
 	public function mostrarListaEspera(){
 		$this->model->bListaEspera();	
 	}

 	public function BuscarCita(){
 		$id = $_POST['id'];
 		$fecha = $_POST['fecha'];
 		$this->model->buscar($id,$fecha);
 	} 

 	public function mostrarAtendidos(){
 		$this->model->getAllA();
 	}
 } 

?>