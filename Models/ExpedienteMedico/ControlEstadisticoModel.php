<?php

	Class ControlEstadisticoModel extends Model{
		function __construct(){
			parent::__construct();
			$this->conn->set_charset("utf8");
		}	

	public function agregarControl($contEst)
	{
		$cont= array('fecha' => $contEst['fecha'],'edGest' => $contEst['edGest'], 'peso' => $contEst['peso'], 'P_Arterial' => $contEst['P_Arterial'],'altUt' => $contEst['altUt'],'precentacion' => $contEst['precentacion'],'FCF' => $contEst['FCF'],'movFetal' => $contEst['movFetal'],
			'idDiagnostico' => $contEst['idDiagnostico']);

		$statement = $this->conn->prepare("CALL EMD13ESCIN(?,?,?,?,?,?,?,?,?)");
			$statement->bind_param("ssssssssi", $cont['fecha'], $cont['edGest'],$cont['peso'],$cont['P_Arterial'],$cont['altUt'],$cont['precentacion'],$cont['FCF'],$cont['movFetal'],$cont['idDiagnostico']);
			if(($statement->execute()) or die($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close(); 
	}

	public function ModificarControlEstadistico($contEst)
	{
		$cont= array('ID' => $contEst['ID'],'fecha' => $contEst['fecha'],'edGest' => $contEst['edGest'], 'peso' => $contEst['peso'], 'P_Arterial' => $contEst['P_Arterial'],'altUt' => $contEst['altUt'],'precentacion' => $contEst['precentacion'],'FCF' => $contEst['FCF'],'movFetal' => $contEst['movFetal'],
			'idDiagnostico' => $contEst['idDiagnostico']);

		$statement = $this->conn->prepare("CALL EMD13ESCUP(?,?,?,?,?,?,?,?,?,?)");
			$statement->bind_param("issssssssi", $cont['ID'], $cont['fecha'], $cont['edGest'],$cont['peso'],$cont['P_Arterial'],$cont['altUt'],$cont['precentacion'],$cont['FCF'],$cont['movFetal'],$cont['idDiagnostico']);
			if(($statement->execute()) or die($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo";
			}	
		$statement->close();
		$this->conn->close();
	}

	public function eliminarDiagnostico($id)
	{
		$idPac = $id;
			
			$statement = $this->conn->prepare("CALL EMD13ESCDE(?)");
			$statement->bind_param("i", $id);
			if(($statement->execute()) or die($this->conn->error))
			{
				echo "Exito";
			}
			else{
				echo "Fallo al eliminar";
			}	
		$statement->close();
		$this->conn->close();
	}

	public function getAll($id){
			$resultado = $this->conn->query("CALL EMD13ESCSE('$id')");

			$contr = $resultado->fetch_all(MYSQLI_ASSOC);

			return $contr;
		}

	
}
?>