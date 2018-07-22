function CamposVaciosA(){           
	var id = document.getElementById('id').value;
	var nombre = document.getElementById('nombre').value;
	var cargo = document.getElementById('cargo').selectedIndex;
	var apellido1 = document.getElementById('apellido1').value;
	var apellido2 = document.getElementById('apellido2').value;
	var direccion = document.getElementById('direccion').value;
	var fena = document.getElementById('fena').value;
	var correo = document.getElementById('correo').value;

	if( id == null || id.length == 0 || /^\s+$/.test(id) || id == ' ' ){
		alert('Debe completar todos los campos');
		return false;
	}else if(nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) || nombre == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(cargo == null || cargo == 0){
		alert('Debe seleccionar un cargo');
		return false;
	}else if(apellido1 == null || apellido1.length == 0 || /^\s+$/.test(apellido1) || apellido1 == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(apellido2 == null || apellido2.length == 0 || /^\s+$/.test(apellido2) || apellido2 == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(direccion == null || direccion.length == 0 || /^\s+$/.test(direccion) || direccion == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(fena == null || fena.length == 0 || /^\s+$/.test(fena) || fena == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(correo == null || correo.length == 0 || /^\s+$/.test(correo) || correo == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}
}