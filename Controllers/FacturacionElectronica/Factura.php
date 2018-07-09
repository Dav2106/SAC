<?php  

Class Factura extends Controller

{
	function __construct(){
			parent::__construct();//crea el constructor del padre osea Controller.php
		}

		public function prueba(){
	   	 $this->view->render($this, 'AgregarFactura1');
	   }

		public function agregar(){
			$this->view->render($this,'AgregarFactura');
		}

		public function agregar2(){
			session_start();
			$_SESSION['idPacFac'] = $_GET['id'];
			$this->view->render($this,'AgregarFactura');
		}

        public function modificar(){			
			$this->view->render($this,'ModificarFactura');
		}

		 public function PDF(){			
			echo $this->listarFacturasPDF();
			$this->view->render($this,'FacturaPDF');
		}


        public function eliminar(){			
			$this->view->render($this,'EliminarFactura');
		}

		public function mostrar(){
			echo $this->listarFacturas();
			$this->view->render($this,'MostrarFactura');
		}

		public function AgregarFactura(){
			session_start();
			$_SESSION['idPacRep'] = $_POST['idPac'];
			$_SESSION['idNomRep'] = $_POST['nomPac'];
		if( isset($_POST['idPac']) && isset($_POST['idFun']) && isset($_POST['fecha']) && isset($_POST['txttotal']) ){

			$idPac = $_POST['idPac'];
			$idFun = $_POST['idFun'];
			$observacion = $_POST['observacion'];
			$fecha = $_POST['fecha'];
			$total = $_POST['txttotal'];
			$Factura = array('idPac' => $idPac, 'idFun' => $idFun, 'observacion' => $observacion, 
						 'fecha' => $fecha, 'total' => $total);
			echo $this->model->agregarFactura($Factura);
			header('location:'.URL.'Factura/ComprobatePago');//se ejecute en el modelo esta funcion
			@session_start();
			unset($_SESSION['idPacFac']);
		}else{
			header('refresh:0;'.URL.'Factura/agregar');
			}
		}

		public function ModificarFactura(){
		if( isset($_POST['IDFactura']) && isset($_POST['IDPaciente']) && isset($_POST['IDFuncionario']) && isset($_POST['Monto']) && isset($_POST['Total'])){
		$IDFactura = $_POST['IDFactura'];
		$IDPaciente = $_POST['IDPaciente'];
		$IDFuncionario = $_POST['IDFuncionario'];
		$Monto = $_POST['Monto'];
		$Total = $_POST['Total'];
		$Factura = array('IDFactura' => $IDFactura, 'IDPaciente' => $IDPaciente, 'IDFuncionario' => $IDFuncionario, 
							'Monto' => $Monto, 'Total' => $Total);
		echo $this->model->ModificarFactura($Factura);
		header('refresh:0;'.URL.'Factura/mostrar');//se ejecute en el modelo esta funcion
		}else{
			echo "INFIERNO";
			}
		}

		public function EliminarFactura(){
		if(isset($_POST['IDFactura'])){
		$IDFactura = $_POST['IDFactura'];
		echo $this->model->EliminarFactura($id);
		header('refresh:0;'.URL.'Factura/mostrar');//se ejecute en el modelo esta funcion
			}
		}

		public function listarFacturas(){
			$this->view->facturas = $fac = $this->model->mostrarFacturas(); 
		}

		public function listarFacturasPDF(){
			$this->view->facturas = $fac = $this->model->mostrarFacturasPDF();
		}

		public function Detalles(){
			$id = $_POST['id'];

			$this->model->buscarDetalles($id);
		}

		public function modificarDeta(){

		if( isset($_POST['id']) && isset($_POST['desc']) && isset($_POST['idPac']) && isset($_POST['precio']) && isset($_POST['fecha'])){
			$IDFactura = $_POST['id'];
			$desc =$_POST['desc'];
			$idPaciente=$_POST['idPac'];
			$Monto = $_POST['precio'];
			$fecha = $_POST['fecha'];
				
		$Factura = array('id' => $IDFactura, 'desc' => $desc,'idPac' => 
		$idPaciente, 'precio' => $Monto, 'fecha' => $fecha);
		echo $this->model->modificarDetalle($Factura);
			}else{
				echo "INFIERNO DETA";
			}	
		}

		public function ComprobatePago(){
			$this->view->detalle = $dat = $this->model->cmpDeta();
			session_start();
			foreach($dat as $elementos){
				$_SESSION['numFact'] = $elementos['EMD17IDCMP'];
			}	
			$this->view->render($this, 'ComprobantePago');
	   }

	   public function cambiarEstado(){
	   		$idDet = $_POST['idDet'];
	   		$this->model->camEstado($idDet);
	   }

	   public function datosPerso(){
	   	 $this->model->datosPer();
	   }

}

?>
