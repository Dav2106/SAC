function CamposVaciosA(){    
	var fechaIn = document.getElementById('fechaIn').value;
	var idDiag = document.getElementById('idDiag').value;

	if( fechaIn == null || fechaIn.length == 0 || /^\s+$/.test(fechaIn) || fechaIn == ' ' ){
		alert('Debe completar todos los campos');
		return false;
	}else if(idDiag == null || idDiag.length == 0 || /^\s+$/.test(idDiag) || idDiag == ' '){
		alert('Debe completar todos los campos');
		return false;
	}else{
		return true;
	}
}