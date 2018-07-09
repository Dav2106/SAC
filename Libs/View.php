<?php

	Class View{

		function render($modulo,$controller,$view){//vistas con controlador asociado
			$controller = get_class($controller);//obtiene la clase nombreController
			require './Views/'.$modulo.'/'.$controller.'/'.$view.'.php';
			// views/User/index.php -> folder/Controller/View
		}
	}

?>