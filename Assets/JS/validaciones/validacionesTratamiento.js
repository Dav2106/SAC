function CamposVaciosA(){            
	var idPac = document.getElementById('idPac').value;
	var idDia = document.getElementById('idDia').value;
	var idFun = document.getElementById('idFun').value;
	var fecha = document.getElementById('fecha').value;
	var descripcion = document.getElementById('descripcion').value;
	var nomPro = document.getElementById('nomTra').value;

	if( idPac == null || idPac.length == 0 || /^\s+$/.test(idPac) || idPac == ' '){
		alert('Debe completar todos los a');
		return false;
	}else if(idDia == null || idDia.length == 0 || /^\s+$/.test(idDia) || idDia == ' '){
		alert('Debe completar todos los c');
		return false;
	}else if(idFun == null || idFun.length == 0 || /^\s+$/.test(idFun) || idFun == ' '){
		alert('Debe completar todos los s');
		return false;
	}else if(fecha == null || fecha.length == 0 || /^\s+$/.test(fecha) || fecha == ' '){
		alert('Debe completar todos los ams');
		return false;
	}else if(descripcion == null || descripcion.length == 0 || /^\s+$/.test(descripcion) || descripcion == ' '){
		alert('Debe completar todos los ce');
		return false;
	}else if(nomPro == null || nomPro.length == 0 || /^\s+$/.test(nomPro) || nomPro == ' '){
		alert('Debe completar todos los p');
		return false;
	}else{
		return true;
	}
}
