<?php

Class Login extends Controller{

		private $modulo = "Usuarios";
	   
	    public function __construct(){
	   	 	parent::__construct($this->modulo);
	    }

	    public function iniciarSesion(){
	   		$this->view->render($this->modulo, $this, 'Login');
	   	}

	   	public function cambioContra(){
 			$this->view->render($this->modulo, $this,'CambioContra');
 		}

	    public function AgregarCuenta(){
	   		if(isset($_POST['Usuario']) && isset($_POST['contraseña']) 
	   			&& isset($_POST['id'])){

	   			$id = $_POST['id'];
				$username = $_POST['Usuario'];	
				$contraseña = $_POST['contraseña'];
								
				$usuario = array('username' => $username, 'contraseña' => $contraseña,
					'id' => $id);

				echo $this->model->agregarCuenta($usuario);
				header('refresh:0;'.URL.'Usuarios/Login/iniciarSesion');//se ejecute en el modelo esta funcion
			}else{
				header('refresh:0;'.URL.'Usuarios/Funcionario/mostrar');;
			}
	    }

	    public function cambiarContra(){
	   		if(isset($_POST['id']) && isset($_POST['usuario']) && isset($_POST['contraseña'])){

	   			$id = $_POST['id'];
	   			$usuario = $_POST['usuario']; 
		   		$pass = $_POST['contraseña'];								
				$usuario = array('username' => $usuario, 'contraseña' => $pass,
					'id' => $id);

				echo $this->model->CambioContra($usuario);
				header('refresh:0;'.URL.'Usuarios/Login/iniciarSesion');
			}else{
				echo "<script>alert('Debe completar todos los campos');</script>";
			}
	    }

	    public function SesionIniciar(){
		   	if(isset($_POST['usuario']) && isset($_POST['contra'])){

		   		$usuario = $_POST['usuario']; 
		   		$pass = $_POST['contra'];

		   		$carg = $this->model->cargaSesion($usuario,$pass);

				session_start();
				$_SESSION['funcionario'] = $carg['ID'];
				
				if($_SESSION['funcionario'] !== null && $_SESSION['funcionario'] > 0){	
					if ($carg['Carg'] == "Doctor"){
						$_SESSION['Medico'] = $_SESSION['funcionario'];
						header('refresh:0;'.URL.'Usuarios/Index/indexDoc');	
				   	}elseif($carg['Carg'] == "Administrador"){
				   		$_SESSION['Administrador'] = $_SESSION['funcionario'];
				   		header('refresh:0;'.URL.'Usuarios/Index/indexAdm');	
					}elseif($carg['Carg'] == "Recepcionista"){
						$_SESSION['Recepcionista'] = $_SESSION['funcionario'];
						header('refresh:0;'.URL.'Usuarios/Index/indexRes');							
					}elseif($carg==0){
					   	header('refresh:0;'.URL.'Usuarios/Login/iniciarSesion');
					}
				}
		   	}
		}

	    public function CerrarSesion(){
	   		session_start();
	   		$this->model->borrarSesion($_SESSION['funcionario']);  
	   		unset($_SESSION['funcionario']); 
	   		header('refresh:0;'.URL.'Usuarios/Login/iniciarSesion');	 		
	    }
}		
?>  