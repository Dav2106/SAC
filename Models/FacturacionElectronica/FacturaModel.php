<?php  

Class FacturaModel extends Model{
	function __construct(){
			parent::__construct();//crea el constructor del padre osea Controller.php
			$this->conn->set_charset("utf8");
		}

	public function agregarFactura($Factura){
		   $fac = array('IdPac' => $Factura['idPac'], 'IdFun' => $Factura['idFun'], 
				'observacion' => $Factura['observacion'], 'fecha' => $Factura['fecha'], 
				'total' => $Factura['total']);
		
			$stmt = $this->conn->prepare("CALL EMD17CMPIN(?,?,?,?,?)");
			$stmt->bind_param("sdsss", $fac['observacion'], $fac['total'], $fac['fecha'],   $fac['IdFun'], $fac['IdPac']);
			if($stmt->execute() or die ($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$stmt->close();
		$this->conn->close();
	}

	public function mostrarFacturas(){
			$resultado = $this->conn->query("CALL EMD17CMPLI()");

			$fact = $resultado->fetch_all(MYSQLI_ASSOC);

			return $fact;
	}

	public function mostrarFacturasPDF(){
			$resultado = $this->conn->query("CALL EMD17CMPLI()");

			$fact = $resultado->fetch_all(MYSQLI_ASSOC);

			return $fact;
	}

	//PRUEBAS 
	public function buscarDetalles($id){
		$resultado = $this->conn->query("CALL EMD17BUSDET($id)");
      
		while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array(
					'ID' => $data['EMD08IDDET'],
					'Desc' => $data['EMD08DESCDET'],
					'Esta' => $data['EMD08ESTADET'],
					'IdPat' => $data['EMD08IDPADET'],
					'Costo' => number_format($data['EMD08COSTDET']),
					'Fecha' => $data['EMD08DATEDET'],
					'Nombre' => $data['nombreCompleto']
					);
		}
		echo json_encode($arreglo);
	}

	public function modificarDetalle($Factura){
		$fac = array('id' => $Factura['id'],
	  				'desc' => $Factura['desc'],
	  				'idPac' => $Factura['idPac'],
	  				'precio' => $Factura['precio'],
	  				'fecha' => $Factura['fecha']);
		
			$stmt = $this->conn->prepare("CALL EMD19DET(?,?,?,?)");
            $stmt->bind_param("isii", $fac['id'], $fac['desc'],   $fac['idPac'],
            	$fac['precio']);
			if($stmt->execute() or die ($this->conn->error))
			{	
				$id = $fac['idPac'];
				
				$resultado = $this->conn->query("SELECT * FROM emd08det
				WHERE emd08idpadet = '$id' and emd08estadet = 'PENDIENTE'");
		      
				while($data = mysqli_fetch_assoc($resultado)){
						$arreglo[] = array(
							'ID' => $data['EMD08IDDET'],
							'Desc' => $data['EMD08DESCDET'],
							'Esta' => $data['EMD08ESTADET'],
							'IdPat' => $data['EMD08IDPADET'],
							'Costo' => number_format($data['EMD08COSTDET']),
							'Fecha' => $data['EMD08DATEDET']
							);
				}
				echo json_encode($arreglo);
			}
			else{
				echo "Fallo";
			}	
		$stmt->close();
		$this->conn->close(); 
	}

	public function cmpDeta(){
		$resultado = $this->conn->query("CALL DetaFactuta2()");
		$fact = $resultado->fetch_all(MYSQLI_ASSOC);
		return $fact;
	}

	public function camEstado($idDet){
		$resultado = $this->conn->query("CALL cambiarEstado('$idDet')");
		if($resultado == true){
			return true;
		}else{
			return false;
		}		
	}
}

?>
