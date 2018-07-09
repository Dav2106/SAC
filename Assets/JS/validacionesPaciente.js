function CamposVaciosA(){           
	   
	var identi = document.getElementById('id').value;
	var direccion = document.getElementById('direccion').value;
	var gender = document.getElementsByName('gender');
	var nombre = document.getElementById('nombre').value;
	var fechaNac = document.getElementById('fechaNac').value;
	var lugNa = document.getElementById('lugNa').value;
	var apellido1 = document.getElementById('apellido1').value;
	var email = document.getElementById('email').value;
	var telefono = document.getElementById('telefono').value;
	var apellido2 = document.getElementById('apellido2').value;

	if(identi == null || identi.length == 0 || /^\s+$/.test(identi) || identi == ' '){
		alert('Debe completar el campo cedula');
		return false;
	}else if(direccion == null || direccion.length == 0 || /^\s+$/.test(direccion) || direccion == ' '){
		alert('Debe completar el campo direccion');
		return false;
	}
	var seleccionado = false;
	for(var i=0; i<gender.length; i++) {    
	  if(gender[i].checked) {
	    seleccionado = true;
	    break;
	  }
	}
	 
	if(!seleccionado) {
	  alert('Debe seleccionar un sexo');
	  return false;
	}else if(nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) || nombre == ' '){
		alert('Debe completar el campo nombre');
		return false;
	}else if(fechaNac == null || fechaNac.length == 0 || /^\s+$/.test(fechaNac) || fechaNac == ' '){
		alert('Debe completar el campo fecha');
		return false;
	}else if(lugNa == null || lugNa.length == 0 || /^\s+$/.test(lugNa) || lugNa == ' '){
		alert('Debe completar el campo lugar de nacimiento');
		return false;
	}else if(apellido1 == null || apellido1.length == 0 || /^\s+$/.test(apellido1) || apellido1 == ' '){
		alert('Debe completar el campo apellido1');
		return false;
	}else if(email == null || email.length == 0 || /^\s+$/.test(email) || email == ' '){
		alert('Debe completar el campo email');
		return false;
	}else if(telefono == null || telefono.length == 0 || /^\s+$/.test(telefono) || telefono == ' '){
		alert('Debe completar el campo telefono');
		return false;
	}else if(apellido2 == null || apellido2.length == 0 || /^\s+$/.test(apellido2) || apellido2 == ' '){
		alert('Debe completar el campo apellido2');
		return false;
	}else{
		return true;
	}
}