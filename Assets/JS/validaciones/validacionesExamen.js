function CamposVaciosA(){     
	var descripcion = document.getElementById('descripcion').value;
	var fecha = document.getElementById('fecha').value;
	var idDiag = document.getElementById('idDiag').value;
	var tipo = document.getElementById('tipoex').selectedIndex;

	if( descripcion == null || descripcion.length == 0 || /^\s+$/.test(descripcion) || descripcion == ' '){
		alert('Debe completar todos los descripcion');
		return false;
	}else if(fecha == null || fecha.length == 0 || /^\s+$/.test(fecha) || fecha == ' '){
		alert('Debe completar todos los fecha');
		return false;
	}else if(idDiag == null || idDiag.length == 0 || /^\s+$/.test(idDiag) || idDiag == ' '){
		alert('Debe completar todos los diag');
		return false;
	}
	else if(tipo == null || tipo == 0){
		alert('Debe seleccionar un tipo de examen');
		return false;
	}else{
		return true;
	}
}
