function CamposVaciosA(){      
	var descripcion = document.getElementById('direccion').value;
	var costo = document.getElementById('Costo').value;
	

	if( descripcion == null || descripcion.length == 0 || /^\s+$/.test(descripcion) || descripcion == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else if(costo == null || costo.length == 0 || /^\s+$/.test(costo) || costo == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}
}
