function CamposVaciosA(){   
	var fecha = document.getElementById('fecha').value;
	var descripcion = document.getElementById('Descripcion').value;
	var idFunc = document.getElementById('idFun').value;
	var idPaci = document.getElementById('idPac').value;
	
	if( fecha == null || fecha.length == 0 || /^\s+$/.test(fecha) || fecha == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(descripcion == null || descripcion.length == 0 || /^\s+$/.test(descripcion) 
		|| descripcion == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(idFunc == null || idFunc.length == 0 || /^\s+$/.test(idFunc) || idFunc == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(idPaci == null || idPaci.length == 0 || /^\s+$/.test(idPaci) || idPaci == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}
}

/*function CamposVaciosM(){   
	var id = document.getElementById('id').value;
	var fecha = document.getElementById('fecha').value;
	var descripcion = document.getElementById('Descripcion').value;
	var idFunc = document.getElementById('idFun').value;
	var idPaci = document.getElementById('idPac').value;
	
	if(id == null || id.length == 0 || /^\s+$/.test(id) || id == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if( fecha == null || fecha.length == 0 || /^\s+$/.test(fecha) || fecha == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(descripcion == null || descripcion.length == 0 || /^\s+$/.test(descripcion) 
		|| descripcion == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(idFunc == null || idFunc.length == 0 || /^\s+$/.test(idFunc) || idFunc == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(idPaci == null || idPaci.length == 0 || /^\s+$/.test(idPaci) || idPaci == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}
}

function CamposVaciosE(){   
	var id = document.getElementById('id').value;
	
	if(id == null || id.length == 0 || /^\s+$/.test(id) || id == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}
}*/
