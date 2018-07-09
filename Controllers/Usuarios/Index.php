<?php

 Class Index extends Controller{

 	function __construct(){
 		parent::__construct();
 	}

 	public function index(){
 		$this->view->render($this,'Inicio');
 	}
 	
 	public function indexDoc(){
 		$this->view->render($this,'IndexDoctor');
 	}

 	public function indexAdm(){
 		$this->view->render($this,'IndexAdmin');
 	}

 	public function indexRes(){
 		$this->view->render($this,'IndexRecep');
 	}

 	public function redirect(){
 		@session_start();
 		if($_SESSION['funcionario'] == @$_SESSION['Medico']){
			header('location: '.URL.'Index/indexDoc');
		}elseif($_SESSION['funcionario'] != @$_SESSION['Medico']){
			header('location: '.URL.'Index/indexAdm');
		}
 	}

 	public function redireccion(){
 		@session_start();
 		if($_SESSION['funcionario'] == @$_SESSION['Medico']){
			header('location: '.URL.'Index/indexDoc');
		}elseif($_SESSION['funcionario'] == @$_SESSION['Administrador']){
			header('location: '.URL.'Index/indexAdm');
		}elseif($_SESSION['funcionario'] == @$_SESSION['Recepcionista']){
			header('location: '.URL.'Index/indexRes');
		}
 	}
 } 

?>