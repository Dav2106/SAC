function CamposVaciosA(){    
	var tipo = document.getElementById('tipoEnfermedad').selectedIndex;
	var nombre = document.getElementById('nombre').value;
	var idPat = document.getElementById('IDPatologia').value;

	if( tipo == null || tipo == 0 ){
		alert('Debe seleccionar una enfermedad');
		return false;
	}else if(nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) || nombre == ' '){
		alert('Debe completar el campo nombre');
		return false;
	}else if(idPat == null || idPat.length == 0 || /^\s+$/.test(idPat) || idPat == ' '){
		alert('Debe completar el campo ID Paciente');
		return false;
	}else{
		return true;
	}
}

/*function CamposVaciosM(){    
	var tipo = document.getElementById('tipoEnfermedad');
	var nombre = document.getElementById('nombre');
	var idPat = document.getElementById('IDPatologia');
	var idEnf = document.getElementById('id');
	
	if( idEnf == null || idEnf.length == 0 || /^\s+$/.test(idEnf) || idEnf == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(tipo === null || tipo == 0 || tipo == -1){
		alert('Debe seleccionar una enfermedad');
		return false;
	}else if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) || nombre == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if( idPat == null || idPat.length == 0 || /^\s+$/.test(idPat) || idPat == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}

	alert(nombre);
}


function CamposVaciosE(){    
	var idEnf = document.getElementById('id').value;
	
	if( idEnf == null || idEnf.length == 0 || /^\s+$/.test(idEnf) || idEnf == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}
}*/
