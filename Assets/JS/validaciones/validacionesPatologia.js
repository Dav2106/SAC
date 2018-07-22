function CamposVaciosA(){     
	var nombre = document.getElementById('nombre').value;
	var descripcion = document.getElementById('descripcion').value;

	if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) || nombre == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(descripcion == null || descripcion.length == 0 || /^\s+$/.test(descripcion) || descripcion == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}
}
