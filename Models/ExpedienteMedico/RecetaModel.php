<?php

	Class RecetaModel extends Model{

		function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
		}

		public function agregarReceta($receta){
			$statement = $this->conn->prepare("CALL EMD14RECIN(?,?,?,?,?,?)");
			$statement->bind_param("ssssis",$receta['nomPro'], $receta['indicaciones'], $receta['cantidad'], $receta['observaciones'], $receta['idTrt'], $receta['fecha']);	
			if(($statement->execute() or die($this->conn->error))){	
				$idTrt = $receta['idTrt'];
				$resultado = $this->conn->query("CALL EMD14RECSE('$idTrt')");
				while($data = mysqli_fetch_assoc($resultado)){
					$arreglo[] = array('idRec' => $data['EMD14IDREC'], 'Fecha' => $data['EMD14FECHREC'], 'Producto' => $data['EMD14PRODREC'], 'Indicaciones' => $data['EMD14INDIREC'], 'Cantidad' => $data['EMD14CANTREC'], 'Observaciones' => $data['EMD14OBSEREC'], 'idTrt' => $data['EMD09TRT_EMD09IDTRT']);
				}
				echo json_encode($arreglo);
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
		}

		public function modificarReceta($receta){
			$statement = $this->conn->prepare("CALL EMD14RECUP(?,?,?,?,?,?)");
			$statement->bind_param("isssss",$receta['idRec'], $receta['nomPro'], $receta['observaciones'],$receta['indicaciones'], $receta['cantidad'], $receta['fecha']);
			if(($statement->execute() or die($this->conn->error)) )
			{
				$idTrt = $receta['idTrt'];
				$resultado = $this->conn->query("CALL EMD14RECSE('$idTrt')");
				while($data = mysqli_fetch_assoc($resultado)){
					$arreglo[] = array('idRec' => $data['EMD14IDREC'], 'Fecha' => $data['EMD14FECHREC'], 'Producto' => $data['EMD14PRODREC'], 'Indicaciones' => $data['EMD14INDIREC'], 'Cantidad' => $data['EMD14CANTREC'], 'Observaciones' => $data['EMD14OBSEREC'], 'idTrt' => $data['EMD09TRT_EMD09IDTRT']);
				}
				echo json_encode($arreglo);
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
		}

		public function eliminarReceta($id,$idTrt){
			$statement = $this->conn->prepare("CALL EMD14RECDE(?)");
			$statement->bind_param("i", $id);
			if(($statement->execute() or die($this->conn->error)))
			{
				$resultado = $this->conn->query("CALL EMD14RECSE('$idTrt')");
				if(mysqli_num_rows($resultado) > 0){
					while($data = mysqli_fetch_assoc($resultado)){
					$arreglo[] = array('idRec' => $data['EMD14IDREC'], 'Fecha' => $data['EMD14FECHREC'], 'Producto' => $data['EMD14PRODREC'], 'Indicaciones' => $data['EMD14INDIREC'], 'Cantidad' => $data['EMD14CANTREC'], 'Observaciones' => $data['EMD14OBSEREC'], 'idTrt' => $data['EMD09TRT_EMD09IDTRT']);
				}
				echo json_encode($arreglo);
				}else{
					return 0;
				}
			}else{
				return 0;
			}	
		$statement->close();
		$this->conn->close(); 
		}

		public function getAll(){
			$resultado = $this->conn->query("CALL EMD14RECLI()");
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array('idRec' => $data['EMD14IDREC'], 'Fecha' => $data['EMD14FECHREC'], 'Producto' => $data['EMD14PRODREC'], 'Indicaciones' => $data['EMD14INDIREC'], 'Cantidad' => $data['EMD14CANTREC'], 'Observaciones' => $data['EMD14OBSEREC'], 'idTrt' => $data['EMD09TRT_EMD09IDTRT']);
			}
			echo json_encode($arreglo);
		}

		public function Buscar($idTrt)
		{
			$resultado = $this->conn->query("CALL EMD14RECSE('$idTrt')");
			while($data = mysqli_fetch_assoc($resultado)){
				$arreglo[] = array('idRec' => $data['EMD14IDREC'], 'Fecha' => $data['EMD14FECHREC'], 'Producto' => $data['EMD14PRODREC'], 'Indicaciones' => $data['EMD14INDIREC'], 'Cantidad' => $data['EMD14CANTREC'], 'Observaciones' => $data['EMD14OBSEREC'], 'idTrt' => $data['EMD09TRT_EMD09IDTRT']);
			}
			echo json_encode($arreglo);
		}

		public function BuscarDia($idpac)
		{			
			$resultado = $this->conn->query("CALL  EMD14RECDI('$idpac')");
			$diagnostico = $resultado->fetch_all(MYSQLI_ASSOC);
			return $diagnostico;
		}
	
	}


?>