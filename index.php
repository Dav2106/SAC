<?php
require ("Config/config.php");
//--> definicion de orden controller/method/params 
$url = (isset($_GET['url'])) ? $_GET['url'] : "Usuarios/Login/iniciarSesion";

$url = explode("/", $url); //convierte url en un array y lo va a separar por el /

if(isset($url[0])) {$modulo = $url[0];}
if(isset($url[1])) {$controller = $url[1];}//valida si existe
if(isset($url[2])) {if($url[2] != ''){$method = $url[2];}}
if(isset($url[3])) {if($url[3] != ''){$params = $url[3];}}


//require LIBS.'Session.php';

spl_autoload_register(function($class) {
	if(file_exists(LIBS.$class.".php")){
		require LIBS.$class.".php";
	}
}); //funcion para evitarse los requires

$path = './Controllers/'.$modulo.'/'.$controller.'.php';
if(file_exists($path)){
	require $path; 
	$controller = new $controller(); //este objeto permite crear los controllers...lo que hace es hacer una sobreescritura
	//print_r($controller);

	if(isset($method)){
		if(method_exists($controller, $method)){
			if(isset($params)){
				$controller->{$method}($params);
			}else{
				$controller->{$method}();
			}
		}
	}else{
		$controller->index();
	}
}else{
	echo 'Error 404';
}

?>