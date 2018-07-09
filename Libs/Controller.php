<?php

	Class Controller{
		function __construct($modulo){
			//Session::init();
			$this->view = new View();
			$this->loadModel($modulo);	//forma de acceder a metodos propios de la clase
		}

		function loadModel($modulo){
			$model = get_class($this).'Model';//significa que todos los modelos se llamaran ejm CarroModel
			$path = $modulo.'/Models/'.$model.'.php';

			if(file_exists($path)){
				require $path;
				$this->model = new $model();
			}
		}
	} 

?>