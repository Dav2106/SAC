<?php

 Class Index extends Controller{

 	private $modulo = "Usuarios";
 	function __construct(){
 		parent::__construct($this->modulo);
 	}

 	public function index(){
 		$this->view->render($this->modulo,$this,'Inicio');
 	}
 	
 	public function indexDoc(){
 		$this->view->render($this->modulo,$this,'IndexDoctor');
 	}

 	public function indexAdm(){
 		$this->view->render($this->modulo,$this,'IndexAdmin');
 	}

 	public function indexRes(){
 		$this->view->render($this->modulo,$this,'IndexRecep');
 	}

 	public function redirect(){
 		@session_start();
 		if($_SESSION['funcionario'] == @$_SESSION['Medico']){
			header('location: '.URL.'Usuarios/Index/indexDoc');
		}elseif($_SESSION['funcionario'] != @$_SESSION['Medico']){
			header('location: '.URL.'Usuarios/Index/indexAdm');
		}
 	}

 	public function redireccion(){
 		@session_start();
 		if($_SESSION['funcionario'] == @$_SESSION['Medico']){
			header('location: '.URL.'Usuarios/Index/indexDoc');
		}elseif($_SESSION['funcionario'] == @$_SESSION['Administrador']){
			header('location: '.URL.'Usuarios/Index/indexAdm');
		}elseif($_SESSION['funcionario'] == @$_SESSION['Recepcionista']){
			header('location: '.URL.'Usuarios/Index/indexRes');
		}
 	}
 } 

?>